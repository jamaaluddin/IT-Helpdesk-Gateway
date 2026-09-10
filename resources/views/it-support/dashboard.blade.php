<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard IT Support - Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f7fb;
            color: #1f2937;
        }

        /* =========================================
           HEADER
        ========================================= */

        .header {
            background: white;
            padding: 20px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            border-bottom: 1px solid #eef2f7;

            box-shadow:
                0 3px 8px rgba(0, 0, 0, 0.04),
                0 8px 20px rgba(0, 0, 0, 0.06),
                0 18px 40px rgba(124, 58, 237, 0.07);

            position: relative;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand img {
            width: 120px;
            height: auto;
            display: block;

            filter: drop-shadow(
                0 4px 6px rgba(0, 0, 0, 0.10)
            );
        }

        .brand h1 {
            font-size: 23px;
            color: #1f2937;
        }

        .brand p {
            margin-top: 5px;
            font-size: 13px;
            color: #6b7280;
        }

        .user-info {
            text-align: right;
            font-size: 14px;
            font-weight: 600;
        }

        .role {
            color: #7c3aed;
            font-size: 12px;
            margin-top: 4px;
            font-weight: bold;
        }

        .logout-btn {
            margin-top: 8px;
            background: #7c3aed;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;

            box-shadow:
                0 3px 7px rgba(124, 58, 237, 0.20),
                0 8px 18px rgba(124, 58, 237, 0.12);
        }

        .logout-btn:hover {
            background: #6d28d9;
            transform: translateY(-2px);

            box-shadow:
                0 6px 12px rgba(124, 58, 237, 0.25),
                0 13px 25px rgba(124, 58, 237, 0.16);
        }


        /* =========================================
           CONTAINER
        ========================================= */

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 35px;
        }


        /* =========================================
           WELCOME
        ========================================= */

        .welcome {
            margin-bottom: 27px;
        }

        .welcome h2 {
            font-size: 23px;
            margin-bottom: 7px;
            color: #172033;
        }

        .welcome p {
            color: #6b7280;
            font-size: 14px;
        }


        /* =========================================
           STATISTICS
        ========================================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 32px;
            align-items: stretch;
        }

        .stat-card {
            background: white;

            padding: 24px 22px;

            border-radius: 17px;
            border: 1px solid #eef2f7;

            min-height: 155px;

            display: flex;
            flex-direction: column;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 50px rgba(124, 58, 237, 0.07);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.07),
                0 22px 45px rgba(0, 0, 0, 0.08),
                0 32px 65px rgba(124, 58, 237, 0.12);
        }

        .stat-card .icon {
            font-size: 25px;
            margin-bottom: 13px;

            filter: drop-shadow(
                0 3px 4px rgba(0, 0, 0, 0.08)
            );
        }

        .stat-card .label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .stat-card .number {
            font-size: 29px;
            font-weight: bold;
            color: #111827;

            margin-top: auto;

            text-shadow:
                0 1px 2px rgba(0, 0, 0, 0.06);
        }


        /* =========================================
           ACTION CARDS
        ========================================= */

        .action-section {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 28px;
            margin-bottom: 32px;

            align-items: stretch;
        }

        .action-card {
            background: white;

            padding: 30px 34px;

            border-radius: 18px;
            border: 1px solid #eef2f7;

            min-height: 315px;

            display: flex;
            flex-direction: column;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 55px rgba(124, 58, 237, 0.07);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.07),
                0 22px 45px rgba(0, 0, 0, 0.08),
                0 32px 65px rgba(124, 58, 237, 0.12);
        }

        .action-card h3 {
            margin-bottom: 12px;
            font-size: 20px;
            line-height: 1.4;
            color: #172033;
        }

        .action-card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.75;

            margin-bottom: 20px;
        }

        /* =========================================
           MINI TICKET LIST DALAM CARD
        ========================================= */

        .my-ticket-list {
            background: #f8fafc;
            padding: 13px 15px;

            border-radius: 11px;
            border: 1px solid #eef2f7;

            margin-bottom: 20px;

            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.025),
                0 3px 8px rgba(0, 0, 0, 0.025);
        }

        .my-ticket-item {
            padding: 9px 0;
            border-bottom: 1px solid #e5e7eb;

            transition:
                padding-left 0.2s ease,
                background 0.2s ease;
        }

        .my-ticket-item:last-child {
            border-bottom: none;
        }

        .my-ticket-item:hover {
            padding-left: 5px;
        }

        .my-ticket-number {
            font-weight: bold;
            color: #7c3aed;

            text-shadow:
                0 1px 2px rgba(124, 58, 237, 0.10);
        }

        .my-ticket-subject {
            font-size: 13px;
            margin-top: 3px;
        }

        .my-ticket-status {
            font-size: 12px;
            color: #6b7280;
            margin-top: 3px;
        }

        .empty-my-ticket {
            margin-bottom: 20px;

            background: #f9fafb;
            border: 1px dashed #dbe2ea;

            padding: 16px;

            border-radius: 10px;

            color: #6b7280;
            font-size: 13px;

            box-shadow:
                inset 0 0 18px rgba(0, 0, 0, 0.015);
        }


        /* =========================================
           BUTTON
        ========================================= */

        .action-card > a {
            margin-top: auto;
            align-self: flex-start;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 155px;
            min-height: 52px;

            text-decoration: none;

            padding: 11px 22px;

            border-radius: 11px;

            font-size: 14px;
            font-weight: bold;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .btn-primary {
            background: #7c3aed;
            color: white;

            box-shadow:
                0 4px 9px rgba(124, 58, 237, 0.22),
                0 10px 20px rgba(124, 58, 237, 0.13);
        }

        .btn-primary:hover {
            background: #6d28d9;
            transform: translateY(-2px);

            box-shadow:
                0 7px 14px rgba(124, 58, 237, 0.28),
                0 15px 28px rgba(124, 58, 237, 0.17);
        }

        .btn-secondary {
            background: #ede9fe;
            color: #7c3aed;

            box-shadow:
                0 4px 8px rgba(124, 58, 237, 0.08),
                0 9px 18px rgba(124, 58, 237, 0.06);
        }

        .btn-secondary:hover {
            background: #ddd6fe;
            transform: translateY(-2px);

            box-shadow:
                0 6px 12px rgba(124, 58, 237, 0.13),
                0 13px 24px rgba(124, 58, 237, 0.09);
        }


        /* =========================================
           TICKET TABLE
        ========================================= */

        .section {
            background: white;

            border-radius: 18px;

            padding: 28px;

            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 60px rgba(124, 58, 237, 0.07);

            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h3 {
            font-size: 19px;
            color: #172033;
        }

        .view-all {
            color: #7c3aed;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;

            transition:
                transform 0.2s ease,
                color 0.2s ease;
        }

        .view-all:hover {
            color: #6d28d9;
        }

        .table-wrapper {
            overflow-x: auto;

            border-radius: 12px;

            box-shadow:
                inset 0 0 0 1px rgba(226, 232, 240, 0.75),
                0 4px 12px rgba(0, 0, 0, 0.025);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            text-align: left;

            padding: 14px;

            background: #f8fafc;

            color: #64748b;

            font-size: 12px;

            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px 14px;

            font-size: 13px;

            border-bottom: 1px solid #eef2f7;

            background: white;

            transition:
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        tbody tr {
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        tbody tr:hover td {
            background: #fcfaff;

            box-shadow:
                inset 0 2px 6px rgba(124, 58, 237, 0.025),
                inset 0 -2px 6px rgba(124, 58, 237, 0.025);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .ticket-number {
            color: #7c3aed;
            font-weight: bold;

            text-shadow:
            0 1px 2px rgba(124, 58, 237, 0.10);
        }

        .ticket-link {
            text-decoration: none;
            cursor: pointer;

            transition:
               color 0.2s ease,
               transform 0.2s ease;
        }

        .ticket-link:hover {
           color: #6d28d9;
           text-decoration: underline;
        }


        /* =========================================
           BADGES
        ========================================= */

        .badge {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;
            font-weight: bold;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.05),
                0 5px 10px rgba(0, 0, 0, 0.025);
        }

        .badge-open {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-process {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-resolved {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-low {
            background: #e0f2fe;
            color: #0284c7;
        }

        .badge-medium {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-high {
            background: #fee2e2;
            color: #dc2626;
        }


        /* =========================================
           EMPTY
        ========================================= */

        .empty {
            text-align: center;

            padding: 35px;

            color: #6b7280;

            background: #f9fafb;

            border: 1px dashed #dbe2ea;

            border-radius: 10px;

            font-size: 14px;

            box-shadow:
                inset 0 0 18px rgba(0, 0, 0, 0.015);
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1100px) {

            .stats {
                grid-template-columns: repeat(3, 1fr);
            }

        }

        @media (max-width: 800px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .action-section {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 20px;
            }

            .header {
                padding: 18px 20px;
            }

            .action-card {
                min-height: 280px;
            }
        }

        @media (max-width: 550px) {

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .brand img {
                width: 100px;
            }

            .brand h1 {
                font-size: 19px;
            }

            .user-info {
                text-align: left;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 15px;
            }

            .action-card {
                padding: 26px;
                border-radius: 16px;
                min-height: auto;
            }

            .btn-primary,
            .btn-secondary {
                min-width: 140px;
            }
        }
    </style>
</head>

<body>

<header class="header">

    <div class="brand">

        <img
            src="{{ asset('images/gateway-logo.webp') }}"
            alt="Gateway Logo"
        >

        <div>
            <h1>IT Helpdesk Gateway</h1>
            <p>IT Support Dashboard</p>
        </div>

    </div>

    <div class="user-info">

        <div>
            {{ auth()->user()->name }}
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

    <!-- WELCOME -->

    <div class="welcome">

        <h2>
            Selamat Datang, {{ auth()->user()->name }} 👋
        </h2>

        <p>
            Kelola laporan masalah IT dan bantu menyelesaikan tiket pengguna.
        </p>

    </div>


    <!-- STATISTICS -->

    <div class="stats">

        <div class="stat-card">

            <div class="icon">🎫</div>

            <div class="label">
                Total Tiket
            </div>

            <div class="number">
                {{ $totalTickets }}
            </div>

        </div>


        <div class="stat-card">

            <div class="icon">🔴</div>

            <div class="label">
                Tiket Baru
            </div>

            <div class="number">
                {{ $openTickets }}
            </div>

        </div>


        <div class="stat-card">

            <div class="icon">🔧</div>

            <div class="label">
                Sedang Diproses
            </div>

            <div class="number">
                {{ $inProgressTickets }}
            </div>

        </div>


        <div class="stat-card">

            <div class="icon">✅</div>

            <div class="label">
                Tiket Selesai
            </div>

            <div class="number">
                {{ $resolvedTickets }}
            </div>

        </div>


        <div class="stat-card">

            <div class="icon">🔄</div>

            <div class="label">
                Perbaikan Ulang
            </div>

            <div class="number">
                {{ $reopenedTickets }}
            </div>

        </div>

    </div>


    <!-- ACTION -->

    <div class="action-section">

        <!-- TIKET MASUK -->

        <div class="action-card">

            <h3>
                🎫 Tiket Masuk
            </h3>

            <p>
                Lihat laporan masalah IT yang dibuat oleh pengguna
                dan lakukan penanganan terhadap tiket.
            </p>

            <a
                href="{{ route('it-support.tickets') }}"
                class="btn-primary"
            >
                Lihat Tiket Masuk
            </a>

        </div>


        <!-- TIKET SAYA -->

        <div class="action-card">

            <h3>
                🛠️ Tiket Saya Tangani
            </h3>

            <p>
                Anda sedang menangani
                <strong>{{ $myTickets->count() }} tiket</strong>.
                Lanjutkan proses penyelesaian tiket Anda.
            </p>


            @if ($myTickets->count() > 0)

                <div class="my-ticket-list">

                    @foreach ($myTickets->take(3) as $ticket)

                        <div class="my-ticket-item">

                            <div class="my-ticket-number">
                                {{ $ticket->ticket_number }}
                            </div>

                            <div class="my-ticket-subject">
                                {{ $ticket->subject }}
                            </div>

                            <div class="my-ticket-status">
                                Status:
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-my-ticket">
                    Belum ada tiket yang Anda tangani.
                </div>

            @endif


            <a
                href="{{ route('it-support.my-tickets') }}"
                class="btn-secondary"
            >
                Lihat Tiket Saya
            </a>

        </div>

    </div>


    <!-- TICKET LIST -->

    <div class="section">

        <div class="section-header">

            <h3>
                List Tiket Terbaru
            </h3>

            <a
                href="{{ route('it-support.tickets') }}"
                class="view-all"
            >
                Lihat Semua
            </a>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>No. Tiket</th>
                        <th>Pelapor</th>
                        <th>Masalah</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse ($latestTickets as $ticket)

                        <tr>

                            <td>
                                <a
                                   href="{{ route('it-support.tickets.show', $ticket) }}"
                                   class="ticket-number ticket-link"
                                >
                                  {{ $ticket->ticket_number }}
                                </a>
                            </td>


                            <td>
                                {{ $ticket->user->name ?? '-' }}
                            </td>


                            <td>
                                {{ $ticket->subject }}
                            </td>


                            <td>

                                @if ($ticket->priority)

                                    <span class="badge badge-{{ $ticket->priority }}">
                                       {{ ucfirst($ticket->priority) }}
                                    </span>

                                @else

                                    <span
                                       class="badge"
                                       style="background: #f3f4f6; color: #6b7280;"
                                    >
                                       Belum Ditentukan
                                    </span>

                                @endif

                            </td>


                            <td>

                                @if ($ticket->status === 'open')

                                    <span class="badge badge-open">
                                        Baru
                                    </span>

                                @elseif ($ticket->status === 'in_progress' && $ticket->reopen_reason)

                                    <span class="badge badge-process">
                                        Perbaikan Ulang
                                    </span>

                                @elseif ($ticket->status === 'in_progress')

                                    <span class="badge badge-process">
                                        Diproses
                                    </span>

                                @elseif ($ticket->status === 'resolved')

                                    <span class="badge badge-resolved">
                                        Selesai
                                    </span>

                                @else

                                    <span class="badge badge-process">
                                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                    </span>

                                @endif

                            </td>


                            <td>
                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty">
                                    Belum ada tiket yang perlu ditangani.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>

</body>
</html>
