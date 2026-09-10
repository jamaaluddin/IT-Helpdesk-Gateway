<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function create()
    {
        $categories = TicketCategory::where('is_active', true)->get();

        return view('user.tickets.create', compact('categories'));
    }

    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->get();

        return view('user.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        // Pastikan user hanya bisa melihat tiket miliknya sendiri
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $ticket->load('category');

        return view('user.tickets.show', compact('ticket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category_id' => 'required|exists:ticket_categories,id',
            'description' => 'required|string',
            'problem_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $problemImagePath = null;

        if ($request->hasFile('problem_image')) {
            $problemImagePath = $request->file('problem_image')
                ->store('problem_images', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Ticket Number
        |--------------------------------------------------------------------------
        | Format:
        | TKT-YYYYMMDD0001
        | TKT-YYYYMMDD0002
        | TKT-YYYYMMDD0003
        |
        | Nomor akan kembali ke 0001 pada tanggal berikutnya.
        |--------------------------------------------------------------------------
        */

        $ticket = DB::transaction(function () use (
            $request,
            $problemImagePath
        ) {
            $today = now()->toDateString();

            /*
             * Buat record sequence untuk hari ini jika belum ada.
             */
            DB::table('ticket_sequences')->insertOrIgnore([
                'sequence_date' => $today,
                'last_number' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            /*
             * Lock sequence hari ini agar dua user yang
             * membuat tiket bersamaan tidak mendapatkan
             * nomor yang sama.
             */
            $sequence = DB::table('ticket_sequences')
                ->where('sequence_date', $today)
                ->lockForUpdate()
                ->first();

            /*
             * Tambahkan nomor tiket.
             */
            $nextNumber = $sequence->last_number + 1;

            /*
             * Simpan nomor terakhir.
             */
            DB::table('ticket_sequences')
                ->where('sequence_date', $today)
                ->update([
                    'last_number' => $nextNumber,
                    'updated_at' => now(),
                ]);

            /*
             * Buat nomor tiket.
             */
            $ticketNumber = 'TKT-' . now()->format('Ymd') . str_pad(
                $nextNumber,
                4,
                '0',
                STR_PAD_LEFT
            );

            /*
             * Buat tiket.
             */
            return Ticket::create([
                'ticket_number' => $ticketNumber,
                'user_id' => auth()->id(),
                'office_id' => auth()->user()->office_id,
                'department_id' => auth()->user()->department_id,
                'category_id' => $request->category_id,
                'subject' => $request->subject,
                'description' => $request->description,
                'problem_image' => $problemImagePath,
                'priority' => null,
                'status' => 'open',
            ]);
        });

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Tiket berhasil dibuat.');
    }

    public function close(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        if ($ticket->status !== 'resolved') {
            abort(403);
        }

        $ticket->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Tiket berhasil ditutup.');
    }

    public function reopen(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id != auth()->id()) {
            abort(403);
        }

        if ($ticket->status !== 'resolved') {
            abort(403);
        }

        $request->validate([
            'reopen_reason' => 'required|string|max:1000',
        ]);

        $ticket->update([
            'status' => 'in_progress',
            'reopen_reason' => $request->reopen_reason,
            'resolution_notes' => null,
            'evidence' => null,
            'resolved_at' => null,
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Tiket dikembalikan untuk perbaikan ulang.');
    }
}
