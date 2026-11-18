<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $totalTickets = Ticket::where('user_id', $userId)
            ->count();

        $processingTickets = Ticket::where('user_id', $userId)
            ->whereIn('status', ['open', 'assigned', 'in_progress'])
            ->count();

        $resolvedTickets = Ticket::where('user_id', $userId)
            ->whereIn('status', ['resolved', 'closed'])
            ->count();

        $latestTickets = Ticket::where('user_id', $userId)
            ->where('status', 'closed')
            ->with('category')
            ->latest()
            ->get();

        // Tanggal hari ini
        $today = now()->toDateString();

        // Total tiket dari seluruh User dan cabang hari ini
        $todayQueueTotal = Ticket::where('queue_date', $today)
            ->count();

        // Tiket terakhir yang dibuat oleh User hari ini
        $todayQueueTicket = Ticket::where('user_id', $userId)
            ->where('queue_date', $today)
            ->latest('id')
            ->first();

        // Nomor antrian User hari ini
        $todayQueueNumber = $todayQueueTicket?->queue_number;

        // Jumlah tiket yang dibuat lebih dahulu hari ini
        $ticketsBeforeMe = $todayQueueTicket
            ? Ticket::where('queue_date', $today)
                ->where('queue_number', '<', $todayQueueNumber)
                ->count()
            : 0;

        return view('user.dashboard', compact(
            'totalTickets',
            'processingTickets',
            'resolvedTickets',
            'latestTickets',
            'todayQueueTotal',
            'todayQueueNumber',
            'ticketsBeforeMe',
            'todayQueueTicket'
        ));
    }
}
