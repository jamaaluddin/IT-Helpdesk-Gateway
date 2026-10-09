<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MaintenanceSchedule;
use App\Models\Office;
use Illuminate\Http\Request;

class MaintenanceScheduleController extends Controller
{
    public function index()
    {
        $schedules = MaintenanceSchedule::with([
            'asset',
            'office',
            'scheduledBy'
        ])
        ->latest('scheduled_date')
        ->get();

        return view('admin.maintenance.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $assets = Asset::with('assetType')
            ->where('status', '!=', 'retired')
            ->orderBy('name')
            ->get();

        $offices = Office::orderBy('name')
            ->get();

        return view('admin.maintenance.schedules.create', compact(
            'assets',
            'offices'
        ));
    }

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
            ->route('admin.maintenance.schedules.index')
            ->with('success', 'Jadwal maintenance berhasil dibuat.');
    }

    public function show(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->load([
            'asset',
            'office',
            'scheduledBy',
            'records.performedBy'
        ]);

        return view(
            'admin.maintenance.schedules.show',
            compact('maintenanceSchedule')
        );
    }
}
