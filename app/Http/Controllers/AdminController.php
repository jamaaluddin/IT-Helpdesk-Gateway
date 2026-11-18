<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Asset;
use App\Models\MaintenanceSchedule;
use App\Models\MaintenanceRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ==========================================
    // DASHBOARD ADMIN
    // ==========================================

    public function dashboard()
    {
        // Pengguna yang menunggu persetujuan
        $pendingUsers = User::where('status', 'pending')->get();

        // Statistik pengguna
        $totalUsers = User::where('role_id', 1)->count();

        $totalAdminSupport = User::whereIn('role_id', [2, 3])->count();

        // Statistik tiket
        $totalTickets = Ticket::count();

        $openTickets = Ticket::where('status', 'open')->count();

        $inProgressTickets = Ticket::where('status', 'in_progress')->count();

        $resolvedTickets = Ticket::where('status', 'resolved')->count();

        $closedTickets = Ticket::where('status', 'closed')->count();

        return view('admin.dashboard', compact(
            'pendingUsers',
            'totalUsers',
            'totalAdminSupport',
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'resolvedTickets',
            'closedTickets'
        ));
    }

    // ==========================================
    // MONITORING TIKET ADMIN
    // ==========================================

    public function tickets(Request $request)
    {
        // Ambil tiket beserta data terkait
        $query = Ticket::with([
            'category',
            'user',
            'office',
            'department',
        ]);

        // Filter berdasarkan status tiket
        $allowedStatuses = [
            'open',
            'assigned',
            'in_progress',
            'resolved',
            'closed',
        ];

        if (
            $request->filled('status') &&
            in_array($request->status, $allowedStatuses, true)
        ) {
            $query->where('status', $request->status);
        }

        // Cari berdasarkan nomor tiket atau judul masalah
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Tampilkan tiket terbaru lebih dahulu
        $tickets = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistik keseluruhan
        $totalTickets = Ticket::count();

        $openTickets = Ticket::where('status', 'open')->count();

        $inProgressTickets = Ticket::whereIn('status', [
            'assigned',
            'in_progress',
        ])->count();

        $resolvedTickets = Ticket::where('status', 'resolved')->count();

        $closedTickets = Ticket::where('status', 'closed')->count();

        return view('admin.tickets.index', compact(
            'tickets',
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'resolvedTickets',
            'closedTickets'
        ));
    }

    // ==========================================
    // LAPORAN ADMIN
    // ==========================================


    public function report(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'office_id' => ['nullable', 'integer', 'exists:offices,id'],
            'department_id' => ['nullable', 'integer', 'exists:departments,id'],
        ]);

        $startDate = $validated['start_date'] ?? null;
        $endDate = $validated['end_date'] ?? null;
        $officeId = $validated['office_id'] ?? null;
        $departmentId = $validated['department_id'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | FILTER TIKET
        |--------------------------------------------------------------------------
        */

        $applyTicketFilters = function ($query) use (
            $startDate,
            $endDate,
            $officeId,
            $departmentId
        ) {
            if ($startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            }

            if ($endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            }

            if ($officeId) {
                $query->where('office_id', $officeId);
            }

            if ($departmentId) {
                $query->where('department_id', $departmentId);
            }

            return $query;
        };

        $ticketQuery = $applyTicketFilters(DB::table('tickets'));

        $totalTickets = (clone $ticketQuery)->count();

        $activeTickets = (clone $ticketQuery)
            ->whereIn('status', [
                'open',
                'assigned',
                'in_progress',
                'waiting',
            ])
            ->count();

        $resolvedTickets = (clone $ticketQuery)
            ->where('status', 'resolved')
            ->count();

        $closedTickets = (clone $ticketQuery)
            ->where('status', 'closed')
            ->count();

        $ticketStatusStats = (clone $ticketQuery)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $ticketPriorityStats = (clone $ticketQuery)
            ->selectRaw("
                COALESCE(priority, 'unassessed') as priority_name,
                COUNT(*) as total
            ")
            ->groupBy('priority')
            ->pluck('total', 'priority_name');

        /*
        |--------------------------------------------------------------------------
        | TREN TIKET BULANAN
        |--------------------------------------------------------------------------
        */

        $chartStart = $startDate
            ? Carbon::parse($startDate)->startOfMonth()
            : now()->subMonths(11)->startOfMonth();

        $chartEnd = $endDate
            ? Carbon::parse($endDate)->endOfMonth()
            : now()->endOfMonth();

        $incomingMonthly = DB::table('tickets')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month_key")
            ->selectRaw('COUNT(*) as total')
            ->when($officeId, fn ($q) => $q->where('office_id', $officeId))
            ->when($departmentId, fn ($q) => $q->where('department_id', $departmentId))
            ->whereBetween('created_at', [$chartStart, $chartEnd])
            ->groupBy('month_key')
            ->pluck('total', 'month_key');

        $resolvedMonthly = DB::table('tickets')
            ->selectRaw("DATE_FORMAT(resolved_at, '%Y-%m') as month_key")
            ->selectRaw('COUNT(*) as total')
            ->when($officeId, fn ($q) => $q->where('office_id', $officeId))
            ->when($departmentId, fn ($q) => $q->where('department_id', $departmentId))
            ->whereNotNull('resolved_at')
            ->whereBetween('resolved_at', [$chartStart, $chartEnd])
            ->groupBy('month_key')
            ->pluck('total', 'month_key');

        $monthlyLabels = [];
        $monthlyIncoming = [];
        $monthlyResolved = [];

        $monthCursor = $chartStart->copy();

        while ($monthCursor <= $chartEnd) {
            $monthKey = $monthCursor->format('Y-m');

            $monthlyLabels[] = $monthCursor->translatedFormat('M Y');
            $monthlyIncoming[] = (int) ($incomingMonthly[$monthKey] ?? 0);
            $monthlyResolved[] = (int) ($resolvedMonthly[$monthKey] ?? 0);

            $monthCursor->addMonth();
        }

        /*
        |--------------------------------------------------------------------------
        | KONFIRMASI EFEKTIVITAS PENYELESAIAN TIKET
        |--------------------------------------------------------------------------
        */

        $confirmationQuery = DB::table('ticket_confirmations as tc')
            ->join('tickets as t', 't.id', '=', 'tc.ticket_id')
            ->when($startDate, fn ($q) => $q->whereDate('tc.created_at', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('tc.created_at', '<=', $endDate))
            ->when($officeId, fn ($q) => $q->where('t.office_id', $officeId))
            ->when($departmentId, fn ($q) => $q->where('t.department_id', $departmentId));

        $effectiveConfirmations = (clone $confirmationQuery)
            ->where('tc.confirmation', 'effective')
            ->count();

        $ineffectiveConfirmations = (clone $confirmationQuery)
            ->where('tc.confirmation', 'not_effective')
            ->count();

        $totalConfirmations = $effectiveConfirmations + $ineffectiveConfirmations;

        $effectivenessPercentage = $totalConfirmations > 0
            ? round(($effectiveConfirmations / $totalConfirmations) * 100, 1)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | STATISTIK PENGGUNA
        |--------------------------------------------------------------------------
        */

        $userQuery = DB::table('users')
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->when($startDate, fn ($q) => $q->whereDate('users.created_at', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('users.created_at', '<=', $endDate))
            ->when($officeId, fn ($q) => $q->where('users.office_id', $officeId))
            ->when($departmentId, fn ($q) => $q->where('users.department_id', $departmentId));

        $totalUsers = (clone $userQuery)->count();

        $userRoleStats = (clone $userQuery)
            ->selectRaw('roles.name as role_name, COUNT(*) as total')
            ->groupBy('roles.name')
            ->pluck('total', 'role_name');

        $userStatusStats = (clone $userQuery)
            ->selectRaw('users.status, COUNT(*) as total')
            ->groupBy('users.status')
            ->pluck('total', 'users.status');

        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS IT SUPPORT
        |--------------------------------------------------------------------------
        */

        $itSupportIds = DB::table('users')
            ->where('role_id', 2)
            ->select('id');

        $itSupportActivityQuery = $applyTicketFilters(
            DB::table('tickets')
                ->whereIn('assigned_to', $itSupportIds)
        );

        $totalHandledTickets = (clone $itSupportActivityQuery)->count();

        $itSupportResolvedTickets = (clone $itSupportActivityQuery)
            ->where('status', 'resolved')
            ->count();

        $itSupportActiveTickets = (clone $itSupportActivityQuery)
            ->whereIn('status', [
                'assigned',
                'in_progress',
                'waiting',
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | LAPORAN ASET
        |--------------------------------------------------------------------------
        */

        $assetQuery = DB::table('assets')
            ->when($officeId, fn ($q) => $q->where('office_id', $officeId))
            ->when($departmentId, fn ($q) => $q->where('department_id', $departmentId));

        $totalAssets = (clone $assetQuery)->count();

        $totalAssetValue = (clone $assetQuery)
            ->whereNotNull('purchase_price')
            ->sum('purchase_price');

        $assetCategoryStats = (clone $assetQuery)
            ->leftJoin('asset_types', 'asset_types.id', '=', 'assets.asset_type_id')
            ->selectRaw("COALESCE(asset_types.name, 'Tanpa Kategori') as category_name")
            ->selectRaw('COUNT(assets.id) as total')
            ->groupBy('asset_types.name')
            ->pluck('total', 'category_name');

        $assetConditionStats = (clone $assetQuery)
            ->selectRaw('`condition` as condition_name, COUNT(*) as total')
            ->groupBy('condition')
            ->pluck('total', 'condition_name');

        $assetStatusStats = (clone $assetQuery)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        /*
        |--------------------------------------------------------------------------
        | MAINTENANCE ASET
        |--------------------------------------------------------------------------
        */

        $maintenanceQuery = DB::table('maintenance_schedules as ms')
            ->leftJoin('assets as a', 'a.id', '=', 'ms.asset_id')
            ->when($startDate, fn ($q) => $q->whereDate('ms.scheduled_date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('ms.scheduled_date', '<=', $endDate))
            ->when($officeId, fn ($q) => $q->where('ms.office_id', $officeId))
            ->when($departmentId, fn ($q) => $q->where('a.department_id', $departmentId));

        $totalMaintenance = (clone $maintenanceQuery)->count();

        $maintenanceStatusStats = (clone $maintenanceQuery)
            ->selectRaw('ms.status, COUNT(*) as total')
            ->groupBy('ms.status')
            ->pluck('total', 'ms.status');

        $maintenanceRecordQuery = MaintenanceRecord::with([
            'asset',
            'performedBy',
            'maintenanceSchedule',
        ])
            ->when($startDate, fn ($q) => $q->whereDate('performed_at', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('performed_at', '<=', $endDate))
            ->when($officeId, fn ($q) => $q->whereHas('asset', fn ($a) => $a->where('office_id', $officeId)))
            ->when($departmentId, fn ($q) => $q->whereHas('asset', fn ($a) => $a->where('department_id', $departmentId)));

        $maintenanceRecords = $maintenanceRecordQuery
            ->latest('performed_at')
            ->paginate(10, ['*'], 'maintenance_page')
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | MAINTENANCE INTERNET / SERVER
        |--------------------------------------------------------------------------
        */

        $serverMaintenanceQuery = DB::table('server_maintenance')
            ->when($startDate, fn ($q) => $q->whereDate('maintenance_date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('maintenance_date', '<=', $endDate))
            ->when($officeId, fn ($q) => $q->where('office_id', $officeId));

        $totalServerMaintenance = (clone $serverMaintenanceQuery)->count();

        $serverMaintenanceStats = (clone $serverMaintenanceQuery)
            ->selectRaw('result, COUNT(*) as total')
            ->groupBy('result')
            ->pluck('total', 'result');

        /*
        |--------------------------------------------------------------------------
        | PERBANDINGAN KANTOR
        |--------------------------------------------------------------------------
        */

        $officeTicketCounts = DB::table('tickets')
            ->select('office_id')
            ->selectRaw('COUNT(*) as total_tickets')
            ->when($startDate, fn ($q) => $q->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('created_at', '<=', $endDate))
            ->when($departmentId, fn ($q) => $q->where('department_id', $departmentId))
            ->groupBy('office_id');

        $officeAssetCounts = DB::table('assets')
            ->select('office_id')
            ->selectRaw('COUNT(*) as total_assets')
            ->when($departmentId, fn ($q) => $q->where('department_id', $departmentId))
            ->groupBy('office_id');

        $officeComparison = DB::table('offices as o')
            ->leftJoinSub($officeTicketCounts, 'tc', 'tc.office_id', '=', 'o.id')
            ->leftJoinSub($officeAssetCounts, 'ac', 'ac.office_id', '=', 'o.id')
            ->when($officeId, fn ($q) => $q->where('o.id', $officeId))
            ->select(
                'o.id',
                'o.name',
                DB::raw('COALESCE(tc.total_tickets, 0) as total_tickets'),
                DB::raw('COALESCE(ac.total_assets, 0) as total_assets')
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PERBANDINGAN DEPARTEMEN
        |--------------------------------------------------------------------------
        */

        $departmentTicketCounts = DB::table('tickets')
            ->select('department_id')
            ->selectRaw('COUNT(*) as total_tickets')
            ->when($startDate, fn ($q) => $q->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('created_at', '<=', $endDate))
            ->when($officeId, fn ($q) => $q->where('office_id', $officeId))
            ->groupBy('department_id');

        $departmentAssetCounts = DB::table('assets')
            ->select('department_id')
            ->selectRaw('COUNT(*) as total_assets')
            ->when($officeId, fn ($q) => $q->where('office_id', $officeId))
            ->groupBy('department_id');

        $departmentComparison = DB::table('departments as d')
            ->leftJoinSub($departmentTicketCounts, 'tc', 'tc.department_id', '=', 'd.id')
            ->leftJoinSub($departmentAssetCounts, 'ac', 'ac.department_id', '=', 'd.id')
            ->when($departmentId, fn ($q) => $q->where('d.id', $departmentId))
            ->select(
                'd.id',
                'd.name',
                DB::raw('COALESCE(tc.total_tickets, 0) as total_tickets'),
                DB::raw('COALESCE(ac.total_assets, 0) as total_assets')
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FILTER DROPDOWN
        |--------------------------------------------------------------------------
        */

        $offices = DB::table('offices')
            ->orderBy('name')
            ->get();

        $departments = DB::table('departments')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DETAIL TIKET
        |--------------------------------------------------------------------------
        */

        $ticketDetails = $applyTicketFilters(
            \App\Models\Ticket::with([
                'category',
                'user',
                'office',
                'department',
                'asset',
            ])
        )
            ->latest()
            ->paginate(10, ['*'], 'ticket_page')
            ->withQueryString();

        return view('admin.reports.index', compact(
            'startDate',
            'endDate',
            'officeId',
            'departmentId',
            'offices',
            'departments',
            'totalTickets',
            'activeTickets',
            'resolvedTickets',
            'closedTickets',
            'ticketStatusStats',
            'ticketPriorityStats',
            'monthlyLabels',
            'monthlyIncoming',
            'monthlyResolved',
            'effectiveConfirmations',
            'ineffectiveConfirmations',
            'totalConfirmations',
            'effectivenessPercentage',
            'totalUsers',
            'userRoleStats',
            'userStatusStats',
            'totalHandledTickets',
            'itSupportResolvedTickets',
            'itSupportActiveTickets',
            'totalAssets',
            'totalAssetValue',
            'assetCategoryStats',
            'assetConditionStats',
            'assetStatusStats',
            'totalMaintenance',
            'maintenanceStatusStats',
            'maintenanceRecords',
            'totalServerMaintenance',
            'serverMaintenanceStats',
            'officeComparison',
            'departmentComparison',
            'ticketDetails'
        ));
    }

}
