<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard User - IT Helpdesk Gateway</title>

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

        .header {
            background: white;
            color: #1f2937;
            padding: 20px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow:
                0 3px 8px rgba(0, 0, 0, 0.04),
                0 8px 20px rgba(0, 0, 0, 0.06),
                0 18px 40px rgba(37, 99, 235, 0.06);
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
                0 3px 5px rgba(0, 0, 0, 0.08)
            );
        }

        .header h1 {
            font-size: 24px;
        }

        .header p {
            margin-top: 5px;
            font-size: 13px;
            color: #6b7280;
        }

        .user-info {
            text-align: right;
            font-size: 14px;
        }

        .logout-btn {
            margin-top: 8px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s ease;

            box-shadow:
                0 3px 7px rgba(37, 99, 235, 0.18),
                0 7px 15px rgba(37, 99, 235, 0.10);
        }

        .logout-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 6px 12px rgba(37, 99, 235, 0.22),
                0 12px 22px rgba(37, 99, 235, 0.13);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 35px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 23px;
            margin-bottom: 7px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 14px;
            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 50px rgba(37, 99, 235, 0.06);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.07),
                0 22px 45px rgba(0, 0, 0, 0.08),
                0 30px 60px rgba(37, 99, 235, 0.08);
        }

        .stat-card .label {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 30px;
            font-weight: bold;
            color: #111827;

            text-shadow:
                0 1px 2px rgba(0, 0, 0, 0.05);
        }

        /* =========================================
           ACTION SECTION
        ========================================= */

        .action-section {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 28px;
            margin-bottom: 30px;

            align-items: stretch;
        }

        .action-card {
            background: white;

            padding: 30px 34px;

            border-radius: 18px;
            border: 1px solid #eef2f7;

            min-height: 255px;

            display: flex;
            flex-direction: column;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 50px rgba(37, 99, 235, 0.06);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .action-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.07),
                0 22px 45px rgba(0, 0, 0, 0.08),
                0 30px 60px rgba(37, 99, 235, 0.10);
        }

        .action-card h3 {
            margin-bottom: 12px;
            font-size: 20px;
            line-height: 1.4;
            color: #172033;
        }

        .action-card p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.75;

            margin-bottom: 0;
        }

        /* Tombol selalu berada di bawah card */
        .action-card a {
            margin-top: auto;
            align-self: flex-start;
        }

        .btn-primary,
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 145px;
            min-height: 52px;

            text-decoration: none;

            padding: 11px 22px;

            border-radius: 11px;

            font-size: 15px;
            font-weight: bold;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .btn-primary {
            background: #2563eb;
            color: white;

            box-shadow:
                0 4px 9px rgba(37, 99, 235, 0.20),
                0 9px 18px rgba(37, 99, 235, 0.10);
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-2px);

            box-shadow:
                0 7px 14px rgba(37, 99, 235, 0.25),
                0 13px 25px rgba(37, 99, 235, 0.14);
        }

        .btn-secondary {
            background: #e5edff;
            color: #2563eb;

            box-shadow:
                0 3px 7px rgba(37, 99, 235, 0.08),
                0 7px 14px rgba(37, 99, 235, 0.05);
        }

        .btn-secondary:hover {
            background: #dbe7ff;
            transform: translateY(-2px);

            box-shadow:
                0 5px 10px rgba(37, 99, 235, 0.12),
                0 10px 18px rgba(37, 99, 235, 0.07);
        }

        /* =========================================
           SECTION TIKET TERBARU
        ========================================= */

        .section {
            background: white;
            border-radius: 14px;
            padding: 26px;
            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 55px rgba(37, 99, 235, 0.06);
        }

        .section h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #6b7280;
            background: #f9fafb;
            border: 1px dashed #dbe2ea;
            border-radius: 9px;
            font-size: 14px;

            box-shadow:
                inset 0 0 18px rgba(0, 0, 0, 0.015);
        }

        /* Shadow untuk item tiket terbaru */

        .section > div[style*="display: flex"] {
            transition:
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        .section > div[style*="display: flex"]:hover {
            background: #fafcff !important;

            box-shadow:
                inset 0 4px 10px rgba(37, 99, 235, 0.025),
                inset 0 -4px 10px rgba(37, 99, 235, 0.025);
        }

        /* Shadow badge status */

        .section span {
            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.05),
                0 5px 10px rgba(0, 0, 0, 0.025);
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 800px) {

            .stats,
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
                min-height: 230px;
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

            .user-info {
                text-align: left;
            }

            .action-card {
                padding: 26px;
                border-radius: 16px;
            }

            .btn-primary,
            .btn-secondary {
                min-width: 135px;
            }
        }
    </style>
</head>

<body>

<header class="header">

    <div class="brand">

        <img src="{{ asset('images/gateway-logo.webp') }}" alt="Gateway Logo">

        <div>
            <h1>IT Helpdesk Gateway</h1>
            <p>User / Karyawan Dashboard</p>
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

    <div class="welcome">

        <h2>Selamat Datang, {{ auth()->user()->name }} 👋</h2>

        <p>
            Laporkan masalah IT dan pantau proses penyelesaiannya.
        </p>

    </div>

    <div class="stats">

        <div class="stat-card">
            <div class="label">Total Tiket</div>
            <div class="number">{{ $totalTickets }}</div>
        </div>

        <div class="stat-card">

            <div class="label">
                Tiket Diproses
            </div>

            <div class="number">
                {{ $processingTickets }}
            </div>

        </div>

        <div class="stat-card">

            <div class="label">
                Tiket Selesai
            </div>

            <div class="number">
                {{ $resolvedTickets }}
            </div>

        </div>

    </div>

    <!-- ACTION CARDS -->

    <div class="action-section">

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

            <h3>📋 Tiket Saya</h3>

            <p>
                Lihat daftar tiket yang pernah Anda buat
                dan pantau status penyelesaiannya.
            </p>

            <a href="{{ route('tickets.index') }}" class="btn-secondary">
                Lihat Tiket
            </a>

        </div>

    </div>

    <div class="section">

        <h3>Tiket Terbaru</h3>

        @if ($latestTickets->count() > 0)

            @foreach ($latestTickets as $ticket)

                <div style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 15px 0;
                    border-bottom: 1px solid #eef2f7;
                ">

                    <div>

                        <div style="
                            font-weight: bold;
                            color: #2563eb;
                            margin-bottom: 5px;
                        ">

                            <a href="{{ route('tickets.show', $ticket) }}" style="
                                color: #2563eb;
                                text-decoration: none;
                            ">
                                {{ $ticket->ticket_number }}
                            </a>

                        </div>

                        <div style="
                            font-size: 14px;
                            margin-bottom: 5px;
                        ">
                            {{ $ticket->subject }}
                        </div>

                        <div style="
                            font-size: 12px;
                            color: #6b7280;
                        ">
                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                        </div>

                    </div>

                    <div>

                        @if ($ticket->status === 'open')

                            <span style="
                                background: #dbeafe;
                                color: #2563eb;
                                padding: 6px 10px;
                                border-radius: 20px;
                                font-size: 11px;
                                font-weight: bold;
                            ">
                                Menunggu
                            </span>

                        @elseif ($ticket->status === 'assigned')

                            <span style="
                                background: #ede9fe;
                                color: #7c3aed;
                                padding: 6px 10px;
                                border-radius: 20px;
                                font-size: 11px;
                                font-weight: bold;
                            ">
                                Ditugaskan
                            </span>

                        @elseif ($ticket->status === 'in_progress')

                            <span style="
                                background: #fef3c7;
                                color: #d97706;
                                padding: 6px 10px;
                                border-radius: 20px;
                                font-size: 11px;
                                font-weight: bold;
                            ">
                                Diproses
                            </span>

                        @elseif ($ticket->status === 'resolved')

                            <span style="
                                background: #dcfce7;
                                color: #16a34a;
                                padding: 6px 10px;
                                border-radius: 20px;
                                font-size: 11px;
                                font-weight: bold;
                            ">
                                Selesai
                            </span>

                        @endif

                    </div>

                </div>

            @endforeach

        @else

            <div class="empty">
                Belum ada tiket yang dibuat.
            </div>

        @endif

    </div>

</main>

</body>
</html>
