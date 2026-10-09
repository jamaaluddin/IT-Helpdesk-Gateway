<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\ServerMaintenance;
use Illuminate\Http\Request;

class ServerMaintenanceController extends Controller
{
    public function index()
    {
        $serverMaintenances = ServerMaintenance::with([
            'office',
            'performedBy'
        ])
        ->latest('maintenance_date')
        ->get();

        return view(
            'it-support.maintenance.server.index',
            compact('serverMaintenances')
        );
    }

    public function create()
    {
        $offices = Office::orderBy('name')
            ->get();

        return view(
            'it-support.maintenance.server.create',
            compact('offices')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'office_id' => 'required|exists:offices,id',
            'ip_address' => 'nullable|string|max:255',
            'security' => 'nullable|string|max:255',
            'bandwidth' => 'nullable|string|max:255',
            'maintenance_date' => 'required|date',
            'result' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        ServerMaintenance::create([
            'office_id' => $validated['office_id'],
            'performed_by' => auth()->id(),
            'ip_address' => $validated['ip_address'] ?? null,
            'security' => $validated['security'] ?? null,
            'bandwidth' => $validated['bandwidth'] ?? null,
            'maintenance_date' => $validated['maintenance_date'],
            'result' => $validated['result'] ?? null,
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('it-support.maintenance.server')
            ->with('success', 'Laporan Internet / Server Maintenance berhasil disimpan.');
    }
}
