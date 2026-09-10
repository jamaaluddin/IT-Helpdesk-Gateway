<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tiket Masuk - IT Support Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(124, 58, 237, 0.06), transparent 32%),
                radial-gradient(circle at bottom right, rgba(99, 102, 241, 0.05), transparent 30%),
                #f3f7fb;
            color: #1f2937;
            min-height: 100vh;
        }

        /* =========================
           HEADER
        ========================== */

        .header {
            background: rgba(255, 255, 255, 0.98);
            padding: 18px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eef2f7;

            box-shadow:
                0 3px 8px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
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

            filter:
                drop-shadow(0 3px 4px rgba(0, 0, 0, 0.08))
                drop-shadow(0 7px 10px rgba(124, 58, 237, 0.08));
        }

        .brand h1 {
            font-size: 23px;
            color: #172033;
            letter-spacing: -0.3px;
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
            color: #172033;
        }

        .logout-btn {
            margin-top: 8px;
            background: #7c3aed;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 12px;

            box-shadow:
                0 3px 7px rgba(124, 58, 237, 0.20),
                0 8px 18px rgba(124, 58, 237, 0.12);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .logout-btn:hover {
            background: #6d28d9;
            transform: translateY(-2px);

            box-shadow:
                0 6px 12px rgba(124, 58, 237, 0.25),
                0 13px 25px rgba(124, 58, 237, 0.16);
        }

        /* =========================
           CONTAINER
        ========================== */

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 38px 35px 45px;
        }

        /* =========================
           TOP SECTION
        ========================== */

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            gap: 20px;
        }

        .top h2 {
            font-size: 25px;
            margin-bottom: 8px;
            color: #172033;
            letter-spacing: -0.4px;
        }

        .top p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================
           BACK BUTTON
        ========================== */

        .back-btn {
            text-decoration: none;
            background: #ede9fe;
            color: #7c3aed;

            padding: 11px 18px;
            border-radius: 10px;

            font-size: 13px;
            font-weight: bold;

            border: 1px solid #ddd6fe;

            box-shadow:
                0 3px 6px rgba(124, 58, 237, 0.08),
                0 8px 16px rgba(124, 58, 237, 0.06);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .back-btn:hover {
            background: #ddd6fe;
            transform: translateY(-2px);

            box-shadow:
                0 5px 10px rgba(124, 58, 237, 0.12),
                0 12px 22px rgba(124, 58, 237, 0.09);
        }

        /* =========================
           MAIN CARD
        ========================== */

        .section {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 19px;
            padding: 27px;

            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 55px rgba(124, 58, 237, 0.07);

            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .section:hover {
            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.06),
                0 22px 45px rgba(0, 0, 0, 0.07),
                0 32px 65px rgba(124, 58, 237, 0.10);
        }

        /* =========================
           TABLE
        ========================== */

        .table-wrapper {
            overflow-x: auto;
            border-radius: 13px;

            box-shadow:
                inset 0 0 0 1px rgba(226, 232, 240, 0.8),
                0 4px 12px rgba(0, 0, 0, 0.025);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 900px;
        }

        thead th {
            text-align: left;
            padding: 15px 14px;

            background: linear-gradient(
                to bottom,
                #fafbfc,
                #f6f8fb
            );

            color: #64748b;
            font-size: 12px;
            font-weight: 700;

            border-bottom: 1px solid #e5e7eb;

            white-space: nowrap;
        }

        thead th:first-child {
            border-top-left-radius: 12px;
        }

        thead th:last-child {
            border-top-right-radius: 12px;
        }

        tbody tr {
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        tbody tr:hover {
            transform: translateY(-1px);
        }

        tbody td {
            padding: 16px 14px;

            font-size: 13px;
            color: #374151;

            border-bottom: 1px solid #eef2f7;

            background: white;

            transition:
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        tbody tr:hover td {
            background: #fcfaff;

            box-shadow:
                inset 0 2px 5px rgba(124, 58, 237, 0.025),
                inset 0 -2px 5px rgba(124, 58, 237, 0.025);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        /* =========================
           TICKET NUMBER
        ========================== */

        .ticket-number {
            color: #7c3aed;
            font-weight: bold;
            text-shadow: 0 1px 2px rgba(124, 58, 237, 0.10);
            white-space: nowrap;
        }

        /* =========================
           BADGES
        ========================== */

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;
            font-weight: bold;

            white-space: nowrap;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.05),
                0 5px 10px rgba(0, 0, 0, 0.025);
        }

        .status-open {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-assigned {
            background: #ede9fe;
            color: #7c3aed;
        }

        .status-process {
            background: #fef3c7;
            color: #d97706;
        }

        .status-waiting {
            background: #e0f2fe;
            color: #0284c7;
        }

        .status-resolved {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-closed {
            background: #e5e7eb;
            color: #4b5563;
        }

        /* =========================
           PRIORITY
        ========================== */

        .priority-low,
        .priority-medium,
        .priority-high,
        .priority-critical {
            display: inline-block;

            padding: 5px 9px;
            border-radius: 8px;

            font-size: 11px;
            font-weight: bold;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.035);
        }

        .priority-low {
            color: #0284c7;
            background: #e0f2fe;
        }

        .priority-medium {
            color: #d97706;
            background: #fef3c7;
        }

        .priority-high {
            color: #dc2626;
            background: #fee2e2;
        }

        .priority-critical {
            color: #991b1b;
            background: #fecaca;
        }

        /* =========================
           VIEW BUTTON
        ========================== */

        .view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            text-decoration: none;

            background: #ede9fe;
            color: #7c3aed;

            padding: 8px 13px;
            min-width: 62px;

            border-radius: 8px;

            font-size: 12px;
            font-weight: bold;

            border: 1px solid #ddd6fe;

            box-shadow:
                0 3px 6px rgba(124, 58, 237, 0.08),
                0 7px 14px rgba(124, 58, 237, 0.06);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .view-btn:hover {
            background: #ddd6fe;

            transform: translateY(-2px);

            box-shadow:
                0 5px 10px rgba(124, 58, 237, 0.13),
                0 11px 20px rgba(124, 58, 237, 0.09);
        }

        .view-btn:active {
            transform: translateY(0);
        }

        /* =========================
           EMPTY STATE
        ========================== */

        .empty {
            text-align: center;

            padding: 50px 30px;

            color: #6b7280;

            background:
                linear-gradient(
                    145deg,
                    #fafbfc,
                    #f7f8fa
                );

            border: 1px dashed #dbe2ea;

            border-radius: 13px;

            font-size: 14px;

            box-shadow:
                inset 0 0 18px rgba(0, 0, 0, 0.015),
                0 4px 10px rgba(0, 0, 0, 0.025);
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 900px) {

            .container {
                padding: 30px 25px 40px;
            }

            .section {
                padding: 22px;
            }

            .top h2 {
                font-size: 22px;
            }
        }

        @media (max-width: 700px) {

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 18px 22px;
            }

            .user-info {
                text-align: left;
            }

            .container {
                padding: 22px 18px 35px;
            }

            .top {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .brand img {
                width: 100px;
            }

            .brand h1 {
                font-size: 20px;
            }

            .section {
                padding: 18px;
                border-radius: 15px;
            }
        }

        @media (max-width: 480px) {

            .brand {
                gap: 11px;
            }

            .brand img {
                width: 90px;
            }

            .brand h1 {
                font-size: 18px;
            }

            .brand p {
                font-size: 11px;
            }

            .top h2 {
                font-size: 20px;
            }

            .top p {
                font-size: 13px;
            }

            .back-btn {
                width: 100%;
                text-align: center;
            }

            .logout-btn {
                margin-top: 6px;
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
            <p>IT Support - Tiket Masuk</p>
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

    <div class="top">

        <div>
            <h2>🎫 Tiket Masuk</h2>

            <p>
                Daftar laporan masalah IT dari seluruh pengguna.
            </p>
        </div>

        <a
            href="{{ route('it-support.dashboard') }}"
            class="back-btn"
        >
            ← Dashboard
        </a>

    </div>


    <div class="section">

        @if($tickets->count() > 0)

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Pelapor</th>
                            <th>Masalah</th>
                            <th>Kategori</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($tickets as $ticket)

                            <tr>

                                <td>
                                    <span class="ticket-number">
                                        {{ $ticket->ticket_number }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ticket->user->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $ticket->subject }}
                                </td>

                                <td>
                                    {{ $ticket->category->name ?? '-' }}
                                </td>

                                <td>
                                    <span class="priority-{{ $ticket->priority }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>

                                <td>

                                    @php

                                        $statusClass = match($ticket->status) {

                                            'open' => 'status-open',

                                            'assigned' => 'status-assigned',

                                            'in_progress' => 'status-process',

                                            'waiting' => 'status-waiting',

                                            'resolved' => 'status-resolved',

                                            'closed' => 'status-closed',

                                            default => 'status-closed',

                                        };


                                        $statusLabel = match(true) {

                                            $ticket->status === 'open'
                                                => 'Baru',

                                            $ticket->status === 'assigned'
                                                => 'Diambil',

                                            $ticket->status === 'in_progress'
                                                && $ticket->reopen_reason
                                                => 'Perbaikan Ulang',

                                            $ticket->status === 'in_progress'
                                                => 'Diproses',

                                            $ticket->status === 'waiting'
                                                => 'Menunggu',

                                            $ticket->status === 'resolved'
                                                => 'Selesai',

                                            $ticket->status === 'closed'
                                                => 'Ditutup',

                                            default
                                                => ucfirst(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $ticket->status
                                                    )
                                                ),

                                        };

                                    @endphp


                                    <span class="badge {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>

                                </td>

                                <td>
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('it-support.tickets.show', $ticket->id) }}"
                                        class="view-btn"
                                    >
                                        Lihat
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">

                🎫 Belum ada tiket yang masuk.

            </div>

        @endif

    </div>

</main>

</body>
</html>
