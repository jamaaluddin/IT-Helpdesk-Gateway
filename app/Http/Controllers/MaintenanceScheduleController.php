<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;

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

        return view('admin.maintenance.index', compact('schedules'));
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
            'admin.maintenance.show',
            compact('maintenanceSchedule')
        );
    }
}
