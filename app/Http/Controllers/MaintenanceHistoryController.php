<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRecord;
use App\Models\ServerMaintenance;
use Illuminate\Http\Request;

class MaintenanceHistoryController extends Controller
{
    // RIWAYAT MAINTENANCE IT SUPPORT
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
            compact('pcRecords', 'serverRecords')
        );
    }

    // RIWAYAT MAINTENANCE ADMIN
    public function adminHistory(Request $request)
    {
        $validated = $request->validate([
            'pc_filter' => 'nullable|in:all,day,month,year',
            'pc_date' => 'nullable|date_format:Y-m-d',
            'pc_month' => 'nullable|date_format:Y-m',
            'pc_year' => 'nullable|digits:4|integer|min:2000|max:2100',

            'server_filter' => 'nullable|in:all,day,month,year',
            'server_date' => 'nullable|date_format:Y-m-d',
            'server_month' => 'nullable|date_format:Y-m',
            'server_year' => 'nullable|digits:4|integer|min:2000|max:2100',
        ]);

        // =========================
        // PC / ASSET MAINTENANCE
        // =========================

        $pcQuery = MaintenanceRecord::with([
            'asset',
            'performedBy',
            'maintenanceSchedule.office',
        ]);

        $pcFilter = $validated['pc_filter'] ?? 'all';

        if ($pcFilter === 'day' && !empty($validated['pc_date'])) {
            $pcQuery->whereDate(
                'performed_at',
                $validated['pc_date']
            );
        }

        if ($pcFilter === 'month' && !empty($validated['pc_month'])) {
            [$year, $month] = explode('-', $validated['pc_month']);

            $pcQuery->whereYear('performed_at', $year)
                ->whereMonth('performed_at', $month);
        }

        if ($pcFilter === 'year' && !empty($validated['pc_year'])) {
            $pcQuery->whereYear(
                'performed_at',
                $validated['pc_year']
            );
        }

        $pcRecords = $pcQuery
            ->latest('performed_at')
            ->get();

        // =========================
        // INTERNET / SERVER MAINTENANCE
        // =========================

        $serverQuery = ServerMaintenance::with([
            'office',
            'performedBy',
        ]);

        $serverFilter = $validated['server_filter'] ?? 'all';

        if ($serverFilter === 'day' && !empty($validated['server_date'])) {
            $serverQuery->whereDate(
                'maintenance_date',
                $validated['server_date']
            );
        }

        if ($serverFilter === 'month' && !empty($validated['server_month'])) {
            [$year, $month] = explode('-', $validated['server_month']);

            $serverQuery->whereYear('maintenance_date', $year)
                ->whereMonth('maintenance_date', $month);
        }

        if ($serverFilter === 'year' && !empty($validated['server_year'])) {
            $serverQuery->whereYear(
                'maintenance_date',
                $validated['server_year']
            );
        }

        $serverRecords = $serverQuery
            ->latest('maintenance_date')
            ->get();

        return view(
            'admin.maintenance.index',
            compact(
                'pcRecords',
                'serverRecords',
                'validated'
            )
        );
    }
}
