<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MaintenanceSchedule;
use App\Models\MaintenanceRecord;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ItSupportMaintenanceController extends Controller
{
    /**
     * Menampilkan daftar jadwal maintenance.
     */
    public function index()
    {
        $schedules = MaintenanceSchedule::with([
            'asset',
            'office',
            'scheduledBy',
            'records.performedBy',
        ])
            ->latest('scheduled_date')
            ->get();

        return view(
            'it-support.maintenance.pc.index',
            compact('schedules')
        );
    }

    /**
     * Menampilkan form pembuatan jadwal maintenance.
     */
    public function create()
    {
        $assets = Asset::with('assetType')
            ->where('status', '!=', 'retired')
            ->orderBy('name')
            ->get();

        $offices = Office::orderBy('name')->get();

        return view(
            'it-support.maintenance.pc.create',
            compact('assets', 'offices')
        );
    }

    /**
     * Menyimpan jadwal maintenance baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'office_id' => 'required|exists:offices,id',
            'scheduled_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        MaintenanceSchedule::create([
            'asset_id' => $validated['asset_id'],
            'office_id' => $validated['office_id'],
            'scheduled_by' => auth()->id(),
            'scheduled_date' => $validated['scheduled_date'],
            'status' => 'scheduled',
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('it-support.maintenance.schedules.index')
            ->with(
                'success',
                'Jadwal maintenance berhasil dibuat.'
            );
    }

    /**
     * Menampilkan detail jadwal maintenance.
     */
    public function show(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->load([
            'asset',
            'office',
            'scheduledBy',
            'records.performedBy',
        ]);

        return view(
            'it-support.maintenance.pc.show',
            compact('maintenanceSchedule')
        );
    }

    /**
     * Menyimpan hasil maintenance yang dilakukan IT Support.
     */
    public function storeRecord(
        Request $request,
        MaintenanceSchedule $maintenanceSchedule
    ) {
        // Hasil maintenance hanya boleh dicatat
        // untuk jadwal yang masih berstatus scheduled.
        if ($maintenanceSchedule->status !== 'scheduled') {
            throw ValidationException::withMessages([
                'maintenance' => 'Hasil maintenance hanya dapat dicatat untuk jadwal yang masih terjadwal.',
            ]);
        }

        // Mencegah pencatatan hasil lebih dari satu kali.
        if ($maintenanceSchedule->records()->exists()) {
            throw ValidationException::withMessages([
                'maintenance' => 'Hasil maintenance untuk jadwal ini sudah pernah dicatat.',
            ]);
        }

        $validated = $request->validate([
            'analysis' => 'required|string',
            'action' => 'required|string',
            'result' => 'required|string',
            'condition_after' => 'required|in:good,minor_damage,major_damage,broken',
            'remarks' => 'nullable|string',
        ]);

        // Simpan hasil pekerjaan maintenance.
        MaintenanceRecord::create([
            'maintenance_schedule_id' => $maintenanceSchedule->id,
            'asset_id' => $maintenanceSchedule->asset_id,
            'performed_by' => auth()->id(),
            'analysis' => $validated['analysis'],
            'action' => $validated['action'],
            'result' => $validated['result'],
            'condition_after' => $validated['condition_after'],
            'remarks' => $validated['remarks'] ?? null,
            'performed_at' => now(),
        ]);

        // Maintenance langsung selesai tanpa konfirmasi User.
        $maintenanceSchedule->update([
            'status' => 'completed',
            'actual_date' => now()->toDateString(),
            'result' => $validated['result'],
        ]);

        return redirect()
            ->route(
                'it-support.maintenance.pc.show',
                $maintenanceSchedule
            )
            ->with(
                'success',
                'Hasil maintenance berhasil disimpan. Status maintenance sekarang Selesai.'
            );
    }
}
