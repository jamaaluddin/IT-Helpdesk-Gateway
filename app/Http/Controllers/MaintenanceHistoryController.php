<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRecord;
use App\Models\ServerMaintenance;

class MaintenanceHistoryController extends Controller
{
    public function index()
    {
        $pcRecords = MaintenanceRecord::with([
            'asset',
            'performedBy',
            'maintenanceSchedule.office',
        ])
        ->latest('performed_at')
        ->get();

        $serverRecords = ServerMaintenance::with([
            'office',
            'performedBy',
        ])
        ->latest('maintenance_date')
        ->get();

        return view(
            'it-support.maintenance.history.index',
            compact(
                'pcRecords',
                'serverRecords'
            )
        );
    }
}
