<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function dashboard()
{
    $userId = auth()->id();

    $totalTickets = \App\Models\Ticket::where('user_id', $userId)
        ->count();

    $processingTickets = \App\Models\Ticket::where('user_id', $userId)
        ->whereIn('status', ['open', 'assigned', 'in_progress'])
        ->count();

    $resolvedTickets = \App\Models\Ticket::where('user_id', $userId)
        ->where('status', 'resolved')
        ->count();

    $latestTickets = \App\Models\Ticket::where('user_id', $userId)
        ->latest()
        ->take(5)
        ->get();

    return view('user.dashboard', compact(
        'totalTickets',
        'processingTickets',
        'resolvedTickets',
        'latestTickets'
    ));
}
}
