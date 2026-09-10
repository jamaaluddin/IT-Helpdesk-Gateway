<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tiket Saya - Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(124, 58, 237, 0.06),
                    transparent 32%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(99, 102, 241, 0.05),
                    transparent 30%
                ),
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

            font-size: 12px;
            font-weight: bold;

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
           PAGE HEADER
        ========================== */

        .page-header {
            margin-bottom: 28px;
        }

        .page-header h2 {
            font-size: 25px;
            margin-bottom: 8px;

            color: #172033;

            letter-spacing: -0.4px;
        }

        .page-header p {
            color: #6b7280;

            font-size: 14px;

            line-height: 1.6;
        }

        /* =========================
           MAIN SECTION
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

            min-width: 800px;
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
                transform 0.2s ease;
        }

        tbody tr:hover {
            transform: translateY(-1px);
        }

        tbody td {
            padding: 16px 14px;

            font-size: 13px;

            color: #374151;

            background: white;

            border-bottom: 1px solid #eef2f7;

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

            white-space: nowrap;

            text-shadow:
                0 1px 2px rgba(124, 58, 237, 0.10);
        }

        /* =========================
           STATUS BADGES
        ========================== */

        .badge {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 6px 11px;

            border-radius: 20px;

            font-size: 11px;
            font-weight: bold;

            white-space: nowrap;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.05),
                0 5px 10px rgba(0, 0, 0, 0.025);
        }

        .badge-assigned {
            background: #ede9fe;
            color: #7c3aed;
        }

        .badge-process {
            background: #fef3c7;
            color: #d97706;
        }

        /* =========================
           PRIORITY
        ========================== */

        .priority-low,
        .priority-medium,
        .priority-high {
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

        /* =========================
           DETAIL BUTTON
        ========================== */

        .detail-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 92px;

            padding: 9px 14px;

            background: #7c3aed;

            color: white;

            text-decoration: none;

            border-radius: 9px;

            font-size: 12px;

            font-weight: bold;

            box-shadow:
                0 4px 8px rgba(124, 58, 237, 0.20),
                0 9px 18px rgba(124, 58, 237, 0.11);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .detail-btn:hover {
            background: #6d28d9;

            transform: translateY(-2px);

            box-shadow:
                0 7px 13px rgba(124, 58, 237, 0.26),
                0 14px 25px rgba(124, 58, 237, 0.15);
        }

        .detail-btn:active {
            transform: translateY(0);
        }

        /* =========================
           BACK BUTTON
        ========================== */

        .back-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            margin-top: 24px;

            padding: 11px 17px;

            background: #ede9fe;

            color: #7c3aed;

            text-decoration: none;

            border-radius: 10px;

            border: 1px solid #ddd6fe;

            font-weight: bold;

            font-size: 13px;

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
                0 5px 10px rgba(124, 58, 237, 0.13),
                0 12px 22px rgba(124, 58, 237, 0.09);
        }

        /* =========================
           EMPTY STATE
        ========================== */

        .empty {
            text-align: center;

            padding: 55px 25px;

            color: #6b7280;

            background:
                linear-gradient(
                    145deg,
                    #fafbfc,
                    #f7f8fa
                );

            border: 1px dashed #dbe2ea;

            border-radius: 13px;

            box-shadow:
                inset 0 0 18px rgba(0, 0, 0, 0.015),
                0 4px 10px rgba(0, 0, 0, 0.025);
        }

        .empty-icon {
            font-size: 38px;

            margin-bottom: 12px;

            filter:
                drop-shadow(0 4px 5px rgba(0, 0, 0, 0.08));
        }

        .empty strong {
            display: block;

            color: #374151;

            font-size: 14px;
        }

        .empty p {
            margin-top: 8px;

            font-size: 13px;

            color: #6b7280;
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

            .page-header h2 {
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

            .page-header h2 {
                font-size: 20px;
            }

            .page-header p {
                font-size: 13px;
            }

            .back-btn {
                width: 100%;
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
            <p>Tiket Saya Tangani</p>
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

    <div class="page-header">

        <h2>🛠️ Tiket Saya Tangani</h2>

        <p>
            Daftar tiket yang sedang menjadi tanggung jawab Anda.
        </p>

    </div>


    <div class="section">

        @if ($tickets->count() > 0)

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
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($tickets as $ticket)

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

                                    <span class="priority-{{ $ticket->priority }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>

                                </td>

                                <td>

                                    @if ($ticket->status === 'assigned')

                                        <span class="badge badge-assigned">
                                            Ditugaskan
                                        </span>

                                    @elseif ($ticket->status === 'in_progress' && $ticket->reopen_reason)

                                        <span class="badge badge-process">
                                            Perbaikan Ulang
                                        </span>

                                    @elseif ($ticket->status === 'in_progress')

                                        <span class="badge badge-process">
                                            Sedang Diproses
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('it-support.tickets.show', $ticket) }}"
                                        class="detail-btn"
                                    >
                                        Lihat Detail
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">

                <div class="empty-icon">
                    🛠️
                </div>

                <strong>
                    Belum ada tiket yang Anda tangani.
                </strong>

                <p>
                    Tiket yang Anda ambil akan muncul di halaman ini.
                </p>

            </div>

        @endif


        <a
            href="{{ route('it-support.dashboard') }}"
            class="back-btn"
        >
            ← Kembali ke Dashboard
        </a>

    </div>

</main>

</body>
</html>
