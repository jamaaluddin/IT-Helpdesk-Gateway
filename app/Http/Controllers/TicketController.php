<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function create()
    {
        $categories = TicketCategory::where('is_active', true)->get();

        $computers = Asset::where('asset_type_id', 1)
            ->where('status', '!=', 'retired')
            ->orderBy('asset_code')
            ->get(['id', 'asset_code', 'name']);

        return view('user.tickets.create', compact(
            'categories',
            'computers'
       ));
    }

   public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->where('status', '!=', 'closed')
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

        $ticket->load([
            'category',
            'office',
            'department',
            'asset'
        ]);

        return view('user.tickets.show', compact('ticket'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'subject' => 'required|string|max:255',
            'category_id' => 'required|exists:ticket_categories,id',
            'asset_id' => [
                'nullable',
                'integer',
                Rule::exists('assets', 'id')->where(function ($query) {
                    $query->where('asset_type_id', 1)
                    ->where('status', '!=', 'retired');
                }),
            ],
            'description' => 'required|string',
            'problem_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'handling_method' => 'nullable|in:in_person,remote',
            'remote_application' => 'nullable|in:anydesk,teamviewer,ultraviewer',
            'remote_address' => 'nullable|string|max:255',
            'remote_password' => 'nullable|string|max:255',
        ]);
        /*
        |--------------------------------------------------------------------------
        | Cek kategori
        |--------------------------------------------------------------------------
        */

        $category = TicketCategory::findOrFail($request->category_id);

        $isOtherCategory = str_contains(
            strtolower($category->name),
            'lainnya'
        );

        /*
        |--------------------------------------------------------------------------
        | Validasi metode penanganan
        |--------------------------------------------------------------------------
        */

        if ($isOtherCategory && !$request->handling_method) {
            return back()
                ->withErrors([
                    'handling_method' => 'Metode penanganan wajib dipilih.'
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi data Remote
        |--------------------------------------------------------------------------
        */

        if (
            $isOtherCategory &&
            $request->handling_method === 'remote'
        ) {
            $request->validate([
                'remote_application' => 'required|in:anydesk,teamviewer,ultraviewer',
                'remote_address' => 'required|string|max:255',
                'remote_password' => 'required|string|max:255',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Upload gambar masalah
        |--------------------------------------------------------------------------
        */

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
        | Nomor kembali ke 0001 pada tanggal berikutnya.
        |--------------------------------------------------------------------------
        */


        $ticket = DB::transaction(function () use (
            $request,
            $problemImagePath,
            $isOtherCategory
            )
        {
            $today = now()->toDateString();

        /*
        |--------------------------------------------------------------------------
        | Buat sequence harian jika belum ada
        |--------------------------------------------------------------------------
        */

        DB::table('ticket_sequences')->insertOrIgnore([
            'sequence_date' => $today,
            'last_number' => 0,
            'last_queue_number' => 0,
            'created_at' => now(),
            'updated_at' => now(),
            ]);

       /*
       |--------------------------------------------------------------------------
       | Kunci sequence hari ini
       |--------------------------------------------------------------------------
       */

        $sequence = DB::table('ticket_sequences')
            ->where('sequence_date', $today)
            ->lockForUpdate()
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Nomor tiket permanen
        |--------------------------------------------------------------------------
        */

        $nextNumber = $sequence->last_number + 1;

        /*
        |--------------------------------------------------------------------------
        | Nomor antrian harian
        |--------------------------------------------------------------------------
        */

        $nextQueueNumber = $sequence->last_queue_number + 1;

        /*
        |--------------------------------------------------------------------------
        | Simpan kedua penghitung
        |--------------------------------------------------------------------------
        */

        DB::table('ticket_sequences')
           ->where('sequence_date', $today)
           ->update([
                'last_number' => $nextNumber,
                'last_queue_number' => $nextQueueNumber,
                'updated_at' => now(),
            ]);

        /*
        |--------------------------------------------------------------------------
        | Format nomor
        |--------------------------------------------------------------------------
        */

        $ticketNumber = 'TKT-' . now()->format('Ymd') . str_pad(
            $nextNumber,
            4,'0',
            STR_PAD_LEFT
        );

        /*
        |--------------------------------------------------------------------------
        | Buat tiket
        |--------------------------------------------------------------------------
        */

        return Ticket::create([
            'ticket_number' => $ticketNumber,

            'queue_number' => $nextQueueNumber,
            'queue_date' => $today,

            'user_id' => auth()->id(),
            'office_id' => auth()->user()->office_id,
            'department_id' => auth()->user()->department_id,

            'category_id' => $request->category_id,
            'asset_id' => $request->asset_id,
            'subject' => $request->subject,
            'description' => $request->description,
            'problem_image' => $problemImagePath,

            'priority' => null,

            'handling_method' => $isOtherCategory
                ? $request->handling_method
                : null,

            'remote_application' => (
                $isOtherCategory &&
                $request->handling_method === 'remote'
            )
                ? $request->remote_application
                : null,

            'remote_address' => (
                $isOtherCategory &&
                $request->handling_method === 'remote'
            )
                ? $request->remote_address
                : null,

            'remote_password' => (
                $isOtherCategory &&
                $request->handling_method === 'remote'
            )
                ? $request->remote_password
                : null,

            'status' => 'open',
        ]);
    });

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Tiket berhasil dibuat.');
    }



    private function isConfirmationExpired(Ticket $ticket): bool
    {
        if (!$ticket->resolved_at) {
            return false;
        }

        $deadline = Carbon::parse($ticket->resolved_at);

        $workingDays = 0;

        while ($workingDays < 3) {
            $deadline->addDay();

            if (!$deadline->isWeekend()) {
                $workingDays++;
            }
        }

        return now()->greaterThanOrEqualTo($deadline);
    }



    public function close(Request $request, Ticket $ticket)
    {
        $result = DB::transaction(function () use ($ticket) {

            $currentTicket = Ticket::whereKey($ticket->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($currentTicket->user_id != auth()->id()) {
                abort(403);
            }

            if ($currentTicket->status !== 'resolved') {
                abort(403);
            }

            // Periksa apakah batas konfirmasi sudah lewat
            if ($this->isConfirmationExpired($currentTicket)) {

                $currentTicket->update([
                    'status' => 'closed',
                    'closed_at' => now(),
                ]);

                return 'expired';
            }

            // Simpan konfirmasi berhasil
            DB::table('ticket_confirmations')->insert([
                'ticket_id' => $currentTicket->id,
                'user_id' => auth()->id(),
                'confirmation' => 'effective',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $currentTicket->update([
                'status' => 'closed',
                'closed_at' => now(),
            ]);

            return 'success';
        });

        if ($result === 'expired') {
            return redirect()
                ->route('tickets.show', $ticket)
                ->with('success', 'Batas konfirmasi telah berakhir. Tiket ditutup otomatis.');
        }

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Tiket berhasil dikonfirmasi dan ditutup.');
    }


    public function reopen(Request $request, Ticket $ticket)
    {
        $result = DB::transaction(function () use ($request, $ticket) {

            $currentTicket = Ticket::whereKey($ticket->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($currentTicket->user_id != auth()->id()) {
                abort(403);
            }

            if ($currentTicket->status !== 'resolved') {
                abort(403);
            }

            // Periksa tenggat sebelum menerima alasan perbaikan ulang
            if ($this->isConfirmationExpired($currentTicket)) {

                $currentTicket->update([
                    'status' => 'closed',
                    'closed_at' => now(),
                ]);

                return 'expired';
            }

            $request->validate([
                'reopen_reason' => 'required|string|max:1000',
            ]);

            // Simpan konfirmasi tidak berhasil
            DB::table('ticket_confirmations')->insert([
                'ticket_id' => $currentTicket->id,
                'user_id' => auth()->id(),
                'confirmation' => 'not_effective',
                'notes' => $request->reopen_reason,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Kembalikan tiket untuk perbaikan ulang
            $currentTicket->update([
                'status' => 'in_progress',
                'reopen_reason' => $request->reopen_reason,
                'resolution_notes' => null,
                'evidence' => null,
                'resolved_at' => null,
            ]);

            return 'reopened';
        });

        if ($result === 'expired') {
            return redirect()
                ->route('tickets.show', $ticket)
                ->with('success', 'Batas konfirmasi telah berakhir. Tiket ditutup otomatis.');
        }

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Tiket dikembalikan untuk perbaikan ulang.');
    }


}
