<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ITSupportController extends Controller
{
    public function dashboard()
{
    $totalTickets = Ticket::count();

    $openTickets = Ticket::where('status', 'open')->count();

    $inProgressTickets = Ticket::where('status', 'in_progress')->count();

    $resolvedTickets = Ticket::where('status', 'resolved')->count();

    $reopenedTickets = Ticket::whereNotNull('reopen_reason')
    ->where('status', 'in_progress')
    ->count();

    // Tiket yang sedang ditangani oleh IT Support yang login
    $myTickets = Ticket::with(['category', 'user'])
        ->where('assigned_to', auth()->id())
        ->whereIn('status', ['assigned', 'in_progress'])
        ->latest()
        ->get();

    $latestTickets = Ticket::with(['category', 'user'])
        ->latest()
        ->take(5)
        ->get();

    return view('it-support.dashboard', compact(
        'totalTickets',
        'openTickets',
        'inProgressTickets',
        'resolvedTickets',
        'reopenedTickets',
        'myTickets',
        'latestTickets'
    ));
}

    public function tickets()
    {
        $tickets = Ticket::with(['category', 'user'])
            ->latest()
            ->get();

        return view('it-support.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['category', 'user']);

        return view('it-support.tickets.show', compact('ticket'));
    }


    public function take(Ticket $ticket)
    {
    // Tiket hanya boleh diambil jika masih open
    if ($ticket->status !== 'open') {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Tiket sudah diambil oleh IT Support lain.');
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

    public function start(Ticket $ticket)
    {
    if ($ticket->assigned_to !== auth()->id()) {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Anda tidak memiliki akses untuk menangani tiket ini.');
    }

    if ($ticket->status !== 'assigned') {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Tiket tidak dapat dimulai.');
    }

    $ticket->update([
        'status' => 'in_progress',
    ]);

    return redirect()
        ->route('it-support.tickets.show', $ticket)
        ->with('success', 'Tiket mulai ditangani.');
    }


    public function resolve(Request $request, Ticket $ticket)
    {
    if ($ticket->assigned_to !== auth()->id()) {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Anda tidak memiliki akses untuk menyelesaikan tiket ini.');
    }

    if ($ticket->status !== 'in_progress') {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Tiket belum dalam proses.');
    }

    $request->validate([
        'resolution_notes' => 'required|string',
        'evidence' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $evidencePath = $request->file('evidence')->store('evidence', 'public');

    $ticket->update([
        'resolution_notes' => $request->resolution_notes,
        'evidence' => $evidencePath,
        'status' => 'resolved',
        'resolved_at' => now(),
    ]);

    return redirect()
        ->route('it-support.tickets.show', $ticket)
        ->with('success', 'Tiket berhasil diselesaikan.');
    }


    public function setPriority(Request $request, Ticket $ticket)
    {
    if ($ticket->assigned_to !== auth()->id()) {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Anda tidak memiliki akses untuk menentukan prioritas tiket ini.');
    }

    if (!in_array($ticket->status, ['assigned', 'in_progress'])) {
        return redirect()
            ->route('it-support.tickets.show', $ticket)
            ->with('error', 'Prioritas hanya dapat ditentukan saat tiket sedang ditangani.');
    }

    $request->validate([
        'priority' => 'required|in:low,medium,high,critical',
    ]);

    $ticket->update([
        'priority' => $request->priority,
    ]);

    return redirect()
        ->route('it-support.tickets.show', $ticket)
        ->with('success', 'Prioritas tiket berhasil ditentukan.');
    }


    public function myTickets()
    {
        $tickets = Ticket::with(['category', 'user'])
               ->where('assigned_to', auth()->id())
               ->whereIn('status', ['assigned', 'in_progress'])
               ->latest()
               ->get();

    return view('it-support.tickets.my', compact('tickets'));
    }


}
