<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\MaintenanceSchedule;
use Illuminate\Http\Request;

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
        $query = Ticket::with([
            'category',
            'user'
        ]);


        // ==========================================
        // FILTER STATUS DARI DASHBOARD
        // ==========================================

        // ==========================================
        // TIKET SELESAI
        // HANYA YANG SELESAI DALAM 24 JAM TERAKHIR
        // ==========================================

        if ($request->status === 'resolved') {

            $query
                ->where('status', 'resolved')
                ->whereNotNull('resolved_at')
                ->where(
                    'resolved_at',
                    '>=',
                    now()->subHours(24)
                );

        }

        // ==========================================
        // TIKET PERBAIKAN ULANG
        // ==========================================

        elseif ($request->status === 'reopened') {

            $query
                ->where('status', 'in_progress')
                ->whereNotNull('reopen_reason');

        }

        // ==========================================
        // TIKET SEDANG DIPROSES
        // TIDAK TERMASUK PERBAIKAN ULANG
        // ==========================================

        elseif ($request->status === 'in_progress') {

            $query
                ->where('status', 'in_progress')
                ->whereNull('reopen_reason');

        }

        // ==========================================
        // TIKET BARU
        // ==========================================

        elseif ($request->status === 'open') {

            $query->where(
                'status',
                'open'
            );

        }

        // ==========================================
        // JIKA TIDAK ADA FILTER
        // TAMPILKAN SEMUA TIKET AKTIF
        // ==========================================

        else {

            $query->whereIn('status', [
                'open',
                'assigned',
                'in_progress',
            ]);

        }


        // ==========================================
        // AMBIL DATA
        // ==========================================

        $tickets = $query
            ->latest()
            ->get();


        return view(
            'it-support.tickets.index',
            compact('tickets')
        );
    }


    // ==========================================
    // RIWAYAT TIKET
    // ==========================================

    public function history()
    {
        $tickets = Ticket::with([
            'category',
            'user'
        ])
        ->whereIn('status', [
            'resolved',
            'closed',
        ])
        ->latest()
        ->get();


        return view(
            'it-support.tickets.history',
            compact('tickets')
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
            'department'
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
        // Tiket hanya boleh diambil jika masih open
        if ($ticket->status !== 'open') {

            return redirect()
                ->route(
                    'it-support.tickets.show',
                    $ticket
                )
                ->with(
                    'error',
                    'Tiket sudah diambil oleh IT Support lain.'
                );
        }


        $ticket->update([
            'assigned_to' => auth()->id(),
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);


        return redirect()
            ->route(
                'it-support.tickets.show',
                $ticket
            )
            ->with(
                'success',
                'Tiket berhasil diambil.'
            );
    }


    // ==========================================
    // MULAI MENANGANI TIKET
    // ==========================================

    public function start(Ticket $ticket)
    {
        if ($ticket->assigned_to !== auth()->id()) {

            return redirect()
                ->route(
                    'it-support.tickets.show',
                    $ticket
                )
                ->with(
                    'error',
                    'Anda tidak memiliki akses untuk menangani tiket ini.'
                );
        }


        if ($ticket->status !== 'assigned') {

            return redirect()
                ->route(
                    'it-support.tickets.show',
                    $ticket
                )
                ->with(
                    'error',
                    'Tiket tidak dapat dimulai.'
                );
        }


        $ticket->update([
            'status' => 'in_progress',
        ]);


        return redirect()
            ->route(
                'it-support.tickets.show',
                $ticket
            )
            ->with(
                'success',
                'Tiket mulai ditangani.'
            );
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

    public function setPriority(
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
                    'Anda tidak memiliki akses untuk menentukan prioritas tiket ini.'
                );
        }


        if (!in_array($ticket->status, [
            'assigned',
            'in_progress'
        ])) {

            return redirect()
                ->route(
                    'it-support.tickets.show',
                    $ticket
                )
                ->with(
                    'error',
                    'Prioritas hanya dapat ditentukan saat tiket sedang ditangani.'
                );
        }


        $request->validate([
            'priority' => [
                'required',
                'in:low,medium,high,critical',
            ],
        ]);


        $ticket->update([
            'priority' => $request->priority,
        ]);


        return redirect()
            ->route(
                'it-support.tickets.show',
                $ticket
            )
            ->with(
                'success',
                'Prioritas tiket berhasil ditentukan.'
            );
    }
}
