<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\MaintenanceSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ITSupportController extends Controller
{
    // ==========================================
    // DASHBOARD
    // ==========================================

    public function dashboard()
    {
        // ==========================================
        // STATISTIK TIKET AKTIF
        // ==========================================

        $totalTickets = Ticket::whereIn('status', [
            'open',
            'assigned',
            'in_progress',
        ])->count();


        // ==========================================
        // TIKET BARU
        // ==========================================

        $openTickets = Ticket::where(
            'status',
            'open'
        )->count();


        // ==========================================
        // TIKET SEDANG DIPROSES
        // HANYA IN_PROGRESS BIASA
        // BUKAN PERBAIKAN ULANG
        // ==========================================

        $inProgressTickets = Ticket::where(
            'status',
            'in_progress'
        )
        ->whereNull('reopen_reason')
        ->count();


        // ==========================================
        // TIKET SELESAI
        // HANYA YANG SELESAI DALAM 24 JAM TERAKHIR
        // ==========================================

        $resolvedTickets = Ticket::where(
            'status',
            'resolved'
        )
        ->whereNotNull('resolved_at')
        ->where(
            'resolved_at',
            '>=',
            now()->subHours(24)
        )
        ->count();


        // ==========================================
        // TIKET PERBAIKAN ULANG
        // ==========================================

        $reopenedTickets = Ticket::where(
            'status',
            'in_progress'
        )
        ->whereNotNull('reopen_reason')
        ->count();


        // ==========================================
        // TIKET TERBARU / TIKET MASUK
        // HANYA TIKET AKTIF
        // ==========================================

        $latestTickets = Ticket::with([
            'category',
            'user'
        ])
        ->whereIn('status', [
            'open',
            'assigned',
            'in_progress',
        ])
        ->latest()
        ->take(5)
        ->get();


        // ==========================================
        // JADWAL MAINTENANCE
        // ==========================================

        $maintenanceSchedules = MaintenanceSchedule::with([
            'asset',
            'office'
        ])
        ->latest('scheduled_date')
        ->take(10)
        ->get();


        // ==========================================
        // TAMPILKAN DASHBOARD
        // ==========================================

        return view(
            'it-support.dashboard',
             compact(
                'totalTickets',
                'openTickets',
                'inProgressTickets',
                'resolvedTickets',
                'reopenedTickets',
                'latestTickets',
                'maintenanceSchedules'
            )
        );
    }


    // ==========================================
    // SEMUA TIKET AKTIF
    // ==========================================



    public function tickets(Request $request)
    {
        // MENENTUKAN FILTER PERIODE
        $period = $request->query('period', 'today');

        if (!in_array($period, ['today', 'this_week', 'month'])) {
            $period = 'today';
        }


        // MENENTUKAN BULAN YANG DIPILIH
        $selectedMonth = now()->startOfMonth();

        if ($period === 'month') {

            $requestedMonth = $request->query('month');

            if (
                $requestedMonth &&
                preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $requestedMonth)
            ) {
                $selectedMonth = \Illuminate\Support\Carbon::parse(
                    $requestedMonth . '-01'
                )->startOfMonth();
            }

            // Tidak boleh memilih bulan masa depan
            if ($selectedMonth->greaterThan(now()->startOfMonth())) {
                $selectedMonth = now()->startOfMonth();
            }
        }


        // MENENTUKAN BATAS TANGGAL
        if ($period === 'today') {

            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();

        } elseif ($period === 'this_week') {

            // Senin sampai Jumat
            $startDate = now()->startOfWeek(\Illuminate\Support\Carbon::MONDAY);

            $endDate = $startDate->copy()
                ->addDays(4)
                ->endOfDay();

        } else {

            $startDate = $selectedMonth->copy()->startOfMonth();
            $endDate = $selectedMonth->copy()->endOfMonth();
        }


        // ANTREAN 1: MENUNGGU PENILAIAN PRIORITAS
        // Tidak dibatasi tanggal
        $pendingPriorityTickets = Ticket::with([
            'category',
            'user',
        ])
            ->where('status', 'open')
            ->whereNull('priority')
            ->orderBy('created_at', 'asc')
            ->get();


        // ANTREAN 2: BERDASARKAN PRIORITAS
        // Tidak dibatasi tanggal
        $priorityQueueTickets = Ticket::with([
            'category',
            'user',
        ])
            ->whereNotNull('priority')
            ->whereIn('status', ['open', 'assigned'])
            ->orderByRaw("
                CASE priority
                    WHEN 'critical' THEN 1
                    WHEN 'high' THEN 2
                    WHEN 'medium' THEN 3
                    WHEN 'low' THEN 4
                    ELSE 5
                END
            ")
            ->orderBy('created_at', 'asc')
            ->get();


        // ANTREAN 3: SEDANG DIKERJAKAN
        // Mengikuti filter periode
        $inProgressTickets = Ticket::with([
            'category',
            'user',
        ])
            ->where('status', 'in_progress')
            ->whereBetween('created_at', [
                $startDate,
                $endDate
            ])
            ->orderBy('created_at', 'asc')
            ->get();


        // INFORMASI NAVIGASI BULAN
        $monthLabel = ucfirst(
            $selectedMonth->locale('id')->translatedFormat('F Y')
        );

        $monthValue = $selectedMonth->format('Y-m');

        $previousMonth = $selectedMonth->copy()
            ->subMonth()
            ->format('Y-m');

        $nextMonth = $selectedMonth->copy()
            ->addMonth()
            ->format('Y-m');

        $canGoNextMonth = $selectedMonth->lessThan(
            now()->startOfMonth()
        );


        return view('it-support.tickets.index', compact(
            'pendingPriorityTickets',
            'priorityQueueTickets',
            'inProgressTickets',
            'period',
            'monthLabel',
            'monthValue',
            'previousMonth',
            'nextMonth',
            'canGoNextMonth'
        ));
    }

    public function history(Request $request)
    {
        // MENENTUKAN FILTER PERIODE
        $period = $request->query('period', 'today');

        if (!in_array($period, ['today', 'this_week', 'month'])) {
            $period = 'today';
        }


        // MENENTUKAN BULAN YANG DIPILIH
        $selectedMonth = now()->startOfMonth();

        if ($period === 'month') {

            $requestedMonth = $request->query('month');

            if (
                $requestedMonth &&
                preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $requestedMonth)
            ) {
                $selectedMonth = Carbon::parse(
                    $requestedMonth . '-01'
                )->startOfMonth();
            }

            // Tidak boleh memilih bulan masa depan
            if ($selectedMonth->greaterThan(now()->startOfMonth())) {
                $selectedMonth = now()->startOfMonth();
            }
        }


        // MENENTUKAN BATAS TANGGAL
        if ($period === 'today') {

            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();

        } elseif ($period === 'this_week') {

            // Senin sampai Jumat
            $startDate = now()->startOfWeek(Carbon::MONDAY);

            $endDate = $startDate->copy()
                ->addDays(4)
                ->endOfDay();

        } else {

            $startDate = $selectedMonth->copy()->startOfMonth();
            $endDate = $selectedMonth->copy()->endOfMonth();
        }


        // RIWAYAT TIKET
        // Hanya status resolved dan closed
        // Mengikuti filter periode
        $tickets = Ticket::with([
            'category',
            'user'
        ])
            ->whereIn('status', [
                'resolved',
                'closed',
            ])
            ->whereBetween('created_at', [
                $startDate,
                $endDate
            ])
            ->latest()
            ->get();


        // INFORMASI NAVIGASI BULAN
        $monthLabel = ucfirst(
            $selectedMonth->locale('id')->translatedFormat('F Y')
        );

        $monthValue = $selectedMonth->format('Y-m');

        $previousMonth = $selectedMonth->copy()
            ->subMonth()
            ->format('Y-m');

        $nextMonth = $selectedMonth->copy()
            ->addMonth()
            ->format('Y-m');

        $canGoNextMonth = $selectedMonth->lessThan(
            now()->startOfMonth()
        );


        return view(
            'it-support.tickets.history',
            compact(
                'tickets',
                'period',
                'monthLabel',
                'monthValue',
                'previousMonth',
                'nextMonth',
                'canGoNextMonth'
            )
        );
    }

    // ==========================================
    // DETAIL TIKET
    // ==========================================

    public function show(Ticket $ticket)
    {
        $ticket->load([
            'category',
            'user',
            'office',
            'department',
            'asset'
        ]);


        return view(
            'it-support.tickets.show',
            compact('ticket')
        );
    }


    // ==========================================
    // AMBIL TIKET
    // ==========================================

    public function take(Ticket $ticket)
    {

    if ($ticket->status !== 'open') {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Tiket ini sudah tidak tersedia untuk diambil.');
    }

    if ($ticket->priority === null) {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Tentukan prioritas tiket terlebih dahulu.');
    }

    $ticket->update([
        'assigned_to' => auth()->id(),
        'status' => 'assigned',
        'assigned_at' => now(),
    ]);

    return redirect()
        ->route('it-support.tickets.show', $ticket)
        ->with('success', 'Tiket berhasil diambil.');

    }

    // ==========================================
    // MULAI MENANGANI TIKET
    // ==========================================


    public function start(Ticket $ticket)
    {
        if (! in_array($ticket->status, ['open', 'assigned'])) {
            return redirect()
                ->route('it-support.tickets')
                ->with('error', 'Tiket ini tidak dapat dimulai.');
            }

        if ($ticket->priority === null) {
            return redirect()
                ->route('it-support.tickets')
                ->with('error', 'Tentukan prioritas tiket terlebih dahulu.');
            }

            $ticket->update([
                'assigned_to' => auth()->id(),
                'assigned_at' => $ticket->assigned_at ?? now(),
                'status' => 'in_progress',
           ]);

            return redirect()
                ->route('it-support.tickets')
                ->with('success', 'Tiket berhasil mulai ditangani.');
    }


    // ==========================================
    // SELESAIKAN TIKET
    // ==========================================

    public function resolve(
        Request $request,
        Ticket $ticket
    ) {
        if ($ticket->assigned_to !== auth()->id()) {

            return redirect()
                ->route(
                    'it-support.tickets.show',
                    $ticket
                )
                ->with(
                    'error',
                    'Anda tidak memiliki akses untuk menyelesaikan tiket ini.'
                );
        }


        if ($ticket->status !== 'in_progress') {

            return redirect()
                ->route(
                    'it-support.tickets.show',
                    $ticket
                )
                ->with(
                    'error',
                    'Tiket belum dalam proses.'
                );
        }


        $request->validate([
            'resolution_notes' => 'required|string',

            'evidence' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ]);


        $evidencePath = $request
            ->file('evidence')
            ->store(
                'evidence',
                'public'
            );


        $ticket->update([
            'resolution_notes' => $request->resolution_notes,
            'evidence' => $evidencePath,
            'status' => 'resolved',
            'resolved_at' => now(),
        ]);


        return redirect()
            ->route(
                'it-support.tickets.show',
                $ticket
            )
            ->with(
                'success',
                'Tiket berhasil diselesaikan.'
            );
    }


    // ==========================================
    // TENTUKAN PRIORITAS TIKET
    // ==========================================


    public function setPriority(Request $request, Ticket $ticket)
    {
        if (
            $ticket->status !== 'open'
            || $ticket->assigned_to !== null
            || $ticket->priority !== null
        )
        {
        return redirect()
            ->route('it-support.tickets')
            ->with('error', 'Tiket ini sudah dinilai atau tidak dapat dinilai lagi.');
        }

        $request->validate([
            'priority' => ['required', 'in:low,medium,high,critical'],
        ]);

         $ticket->update([
            'priority' => $request->priority,
        ]);

        return redirect()
            ->route('it-support.tickets')
            ->with('success', 'Penilaian prioritas berhasil disimpan.');
    }
}
