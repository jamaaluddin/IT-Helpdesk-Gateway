<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CloseExpiredResolvedTickets extends Command
{
    protected $signature = 'tickets:close-expired-resolved';

    protected $description = 'Menutup tiket resolved yang melewati 3 hari kerja tanpa konfirmasi User';

    public function handle(): int
    {
        $closedCount = 0;

        Ticket::where('status', 'resolved')
            ->whereNotNull('resolved_at')
            ->chunkById(100, function ($tickets) use (&$closedCount) {

                foreach ($tickets as $ticket) {

                    $closed = DB::transaction(function () use ($ticket) {

                        $currentTicket = Ticket::whereKey($ticket->id)
                            ->lockForUpdate()
                            ->first();

                        if (
                            !$currentTicket ||
                            $currentTicket->status !== 'resolved' ||
                            !$currentTicket->resolved_at
                        ) {
                            return false;
                        }

                        // Hitung batas waktu 3 hari kerja
                        $deadline = Carbon::parse(
                            $currentTicket->resolved_at
                        );

                        $workingDays = 0;

                        while ($workingDays < 3) {
                            $deadline->addDay();

                            // Sabtu dan Minggu tidak dihitung
                            if (!$deadline->isWeekend()) {
                                $workingDays++;
                            }
                        }

                        // Belum melewati batas waktu
                        if ($deadline->isFuture()) {
                            return false;
                        }

                        // Tutup tanpa membuat konfirmasi effective
                        $currentTicket->update([
                            'status' => 'closed',
                            'closed_at' => now(),
                        ]);

                        return true;
                    });

                    if ($closed) {
                        $closedCount++;
                    }
                }
            });

        $this->info(
            "Berhasil menutup {$closedCount} tiket yang melewati batas konfirmasi."
        );

        return self::SUCCESS;
    }
}
