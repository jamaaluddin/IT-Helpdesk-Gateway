<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard User - IT Helpdesk Gateway</title>

    <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
</head>

<body>

<header class="header">
    <div class="brand">
        <img src="{{ asset('images/gateway-logo.webp') }}" alt="Gateway Logo">

        <div class="brand-text">
            <h1>IT Helpdesk Gateway</h1>
            <p>User / Karyawan Dashboard</p>
        </div>
    </div>

    <div class="user-info">
        <div>
            {{ auth()->user()->name }}
        </div>

        <div class="role">
            User
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-btn">
                Logout
            </button>

        </form>

    </div>
</header>

<main class="container">

    <section class="welcome">
        <h2>Selamat Datang, {{ auth()->user()->name }} 👋</h2>

        <p>
            Laporkan masalah IT dan pantau proses penyelesaiannya.
        </p>
    </section>

    <!-- STATISTIK TIKET -->
    <section class="stats">

        <div class="stat-card">
            <div class="label">Total Tiket</div>
            <div class="number">{{ $totalTickets }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Tiket Diproses</div>
            <div class="number">{{ $processingTickets }}</div>
        </div>

        <div class="stat-card">
            <div class="label">Tiket Selesai</div>
            <div class="number">{{ $resolvedTickets }}</div>
        </div>

    </section>


    <!-- ANTRIAN TIKET HARI INI -->
    <section class="queue-card">

        <div class="label">Antrian Tiket Hari Ini</div>

        @if (!$todayQueueTicket)

            <div class="queue-empty">
                Belum Ada Antrian
            </div>

            <div class="queue-description">
                Anda belum membuat tiket hari ini.
                Buat tiket baru melalui menu Buat Tiket Baru di bawah.
            </div>

        @elseif ($todayQueueTicket->status === 'open' || $todayQueueTicket->status === 'assigned')

            <div class="queue-number">
                A-{{ str_pad($todayQueueTicket->queue_number, 3, '0', STR_PAD_LEFT) }}
            </div>

            <div class="queue-description">
                @if ($todayQueueTicket->status === 'open')
                    Tiket Anda sedang menunggu penilaian dan penanganan dari IT Support.
                @else
                    Tiket Anda sudah ditugaskan dan menunggu proses pengerjaan oleh IT Support.
                @endif

                <br><br>

                Total {{ $todayQueueTotal }} tiket dari seluruh cabang hari ini.

                <br>

                {{ $ticketsBeforeMe }} tiket memiliki nomor antrian lebih dahulu.
            </div>

        @elseif ($todayQueueTicket->status === 'in_progress')

            <div class="queue-empty">
                Tiket Sedang Ditangani
            </div>

            <div class="queue-description">
                Tiket Anda sedang ditangani oleh tim IT Support.
                Silakan pantau perkembangan pengerjaannya melalui Detail Pengerjaan.
            </div>

        @elseif ($todayQueueTicket->status === 'resolved')

            <div class="queue-empty">
                Menunggu Konfirmasi Anda
            </div>

            <div class="queue-description">
                IT Support telah menyelesaikan tiket Anda.
                Silakan periksa hasil pengerjaan dan konfirmasi melalui halaman detail tiket.
            </div>

        @elseif ($todayQueueTicket->status === 'closed')

            <div class="queue-empty">
                Tiket Telah Ditutup
            </div>

            <div class="queue-description">
                Tiket Anda telah ditutup. Terima kasih telah menggunakan IT Helpdesk Gateway.
            </div>

        @else

            <div class="queue-empty">
                Informasi Tiket
            </div>

            <div class="queue-description">
                Silakan buka Detail Pengerjaan untuk melihat status tiket Anda.
            </div>

        @endif

    </section>
    <!-- AKHIR ANTRIAN TIKET HARI INI -->


    <!-- ACTION CARDS -->
    <section class="action-section">

        <div class="action-card">
            <h3>🎫 Buat Tiket Baru</h3>

            <p>
                Laporkan masalah komputer, software,
                jaringan, printer, server, atau masalah IT lainnya.
            </p>

            <a href="{{ route('tickets.create') }}" class="btn-primary">
                Buat Tiket
            </a>
        </div>

        <div class="action-card">
            <h3>📋 Detail Pengerjaan</h3>

            <p>
                Lihat daftar tiket yang pernah Anda buat
                dan pantau status serta proses penyelesaiannya.
            </p>

            <a href="{{ route('tickets.index') }}" class="btn-secondary">
                Lihat Detail Pengerjaan
            </a>
        </div>

    </section>
    <!-- AKHIR ACTION CARDS -->


    <!-- RIWAYAT TIKET -->
    <section class="section">

        <div class="section-header">
            <h3>Riwayat Tiket</h3>
        </div>

        <div class="ticket-history-table-wrapper">

            @if ($latestTickets->count() > 0)

                <table class="ticket-history-table">
                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Judul Masalah</th>
                            <th>Kategori</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($latestTickets as $ticket)
                            <tr>
                                <td>
                                    <a
                                        href="{{ route('tickets.show', $ticket) }}"
                                        class="history-ticket-number"
                                    >
                                        {{ $ticket->ticket_number }}
                                    </a>
                                </td>

                                <td class="history-subject">
                                    {{ $ticket->subject }}
                                </td>

                                <td>
                                    {{ $ticket->category->name ?? '-' }}
                                </td>

                                <td>
                                    @if ($ticket->priority === 'low')
                                        <span class="history-badge priority-low">
                                            Rendah
                                        </span>
                                    @elseif ($ticket->priority === 'medium')
                                        <span class="history-badge priority-medium">
                                            Sedang
                                        </span>
                                    @elseif ($ticket->priority === 'high')
                                        <span class="history-badge priority-high">
                                            Tinggi
                                        </span>
                                    @elseif ($ticket->priority === 'critical')
                                        <span class="history-badge priority-critical">
                                            Kritis
                                        </span>
                                    @else
                                        <span class="history-badge priority-unset">
                                            Belum Dinilai
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($ticket->reopen_reason !== null && $ticket->status === 'in_progress')
                                        <span class="history-badge status-reopened">
                                            Perbaikan Ulang
                                        </span>
                                    @elseif ($ticket->status === 'open')
                                        <span class="history-badge status-open">
                                            Menunggu
                                        </span>
                                    @elseif ($ticket->status === 'assigned')
                                        <span class="history-badge status-assigned">
                                            Ditugaskan
                                        </span>
                                    @elseif ($ticket->status === 'in_progress')
                                        <span class="history-badge status-in-progress">
                                            Diproses
                                        </span>
                                    @elseif ($ticket->status === 'resolved')
                                        <span class="history-badge status-resolved">
                                            Selesai
                                        </span>
                                    @elseif ($ticket->status === 'closed')
                                        <span class="history-badge status-closed">
                                            Ditutup
                                        </span>
                                    @else
                                        <span class="history-badge status-unknown">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="history-date">
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route('tickets.show', $ticket) }}"
                                        class="history-detail-button"
                                    >
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else

                <div class="empty">
                    Belum ada tiket yang dibuat.
                </div>

            @endif

        </div>

    </section>

    <!-- AKHIR RIWAYAT TIKET -->

</main>

</body>
</html>
