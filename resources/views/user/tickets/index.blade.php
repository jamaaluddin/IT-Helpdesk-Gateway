<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tiket Saya - IT Helpdesk Gateway</title>

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
            padding: 18px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow:
                0 3px 8px rgba(0, 0, 0, 0.04),
                0 8px 20px rgba(0, 0, 0, 0.06),
                0 18px 35px rgba(37, 99, 235, 0.06);
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
        }

        .role {
            color: #6b7280;
            font-size: 12px;
            margin-top: 4px;
        }

        .logout-btn {
            margin-top: 8px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s ease;

            box-shadow:
                0 3px 7px rgba(37, 99, 235, 0.18),
                0 7px 14px rgba(37, 99, 235, 0.10);
        }

        .logout-btn:hover {
            background: #1d4ed8;

            box-shadow:
                0 5px 10px rgba(37, 99, 235, 0.22),
                0 10px 20px rgba(37, 99, 235, 0.13);
        }

        .container {
            max-width: 1250px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .top-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back {
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;

            transition: 0.2s ease;
        }

        .back:hover {
            transform: translateX(-3px);
        }

        .btn-create {
            background: #2563eb;
            color: white;
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;

            box-shadow:
                0 4px 9px rgba(37, 99, 235, 0.20),
                0 9px 18px rgba(37, 99, 235, 0.10);

            transition:
                0.2s ease,
                box-shadow 0.2s ease;
        }

        .btn-create:hover {
            background: #1d4ed8;
            transform: translateY(-2px);

            box-shadow:
                0 7px 14px rgba(37, 99, 235, 0.25),
                0 13px 25px rgba(37, 99, 235, 0.14);
        }

        .detail-btn {
            display: inline-block;
            background: #dbeafe;
            color: #2563eb;
            padding: 7px 12px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;

            box-shadow:
                0 2px 5px rgba(37, 99, 235, 0.08),
                0 5px 10px rgba(37, 99, 235, 0.05);

            transition:
                0.2s ease,
                box-shadow 0.2s ease;
        }

        .detail-btn:hover {
            background: #bfdbfe;

            transform: translateY(-1px);

            box-shadow:
                0 4px 8px rgba(37, 99, 235, 0.12),
                0 8px 15px rgba(37, 99, 235, 0.08);
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 55px rgba(37, 99, 235, 0.07);

            border: 1px solid rgba(229, 231, 235, 0.8);
        }

        .card h2 {
            font-size: 22px;
            margin-bottom: 6px;
        }

        .description {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 14px;

            box-shadow:
                0 3px 7px rgba(22, 101, 52, 0.06),
                0 7px 15px rgba(22, 101, 52, 0.04);
        }

        .table-wrapper {
            overflow-x: auto;

            border-radius: 9px;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.03),
                0 7px 15px rgba(0, 0, 0, 0.04),
                0 14px 28px rgba(0, 0, 0, 0.035);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #f8fafc;
            color: #374151;
            font-size: 12px;
            text-align: left;
            padding: 15px 13px;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 14px 13px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;

            transition:
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        tr:hover td {
            background: #f9fafb;

            box-shadow:
                inset 0 2px 0 rgba(37, 99, 235, 0.025),
                inset 0 -2px 0 rgba(37, 99, 235, 0.025);
        }

        .ticket-number {
            color: #2563eb;
            font-weight: bold;

            text-shadow:
                0 1px 2px rgba(37, 99, 235, 0.08);
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.05),
                0 4px 8px rgba(0, 0, 0, 0.025);
        }

        .priority-low {
            background: #dcfce7;
            color: #166534;
        }

        .priority-medium {
            background: #fef3c7;
            color: #92400e;
        }

        .priority-high {
            background: #fee2e2;
            color: #991b1b;
        }

        .priority-critical {
            background: #7f1d1d;
            color: white;

            box-shadow:
                0 3px 7px rgba(127, 29, 29, 0.18),
                0 6px 12px rgba(127, 29, 29, 0.10);
        }

        .status-open {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-in_progress {
            background: #fef3c7;
            color: #92400e;
        }

        .status-reopen {
            background: #ffedd5;
            color: #c2410c;
        }

        .status-resolved {
            background: #dcfce7;
            color: #166534;
        }

        .status-closed {
            background: #e5e7eb;
            color: #374151;
        }

        .empty {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;

            box-shadow:
                inset 0 0 20px rgba(0, 0, 0, 0.015);
        }

        .empty p {
            margin-bottom: 15px;
        }

        @media (max-width: 700px) {

            .top-area {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .card {
                padding: 18px;
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
            <p>Tiket Saya</p>
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

    <div class="top-area">

        <a href="{{ route('user.dashboard') }}" class="back">
            ← Kembali ke Dashboard
        </a>

        <a href="{{ route('tickets.create') }}" class="btn-create">
            + Buat Tiket
        </a>

    </div>

    <div class="card">

        <h2>Tiket Saya</h2>

        <p class="description">
            Daftar tiket yang telah Anda laporkan kepada tim IT.
        </p>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($tickets->count() > 0)

            <div class="table-wrapper">

                <table>

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

                        @foreach ($tickets as $ticket)

                            <tr>

                                <td>
                                    <span class="ticket-number">
                                        {{ $ticket->ticket_number }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ticket->subject }}
                                </td>

                                <td>
                                    {{ $ticket->category->name ?? '-' }}
                                </td>

                                <td>
                                    <span class="badge priority-{{ $ticket->priority }}">
                                        @if ($ticket->priority === 'low')
                                            Rendah
                                        @elseif ($ticket->priority === 'medium')
                                            Sedang
                                        @elseif ($ticket->priority === 'high')
                                            Tinggi
                                        @elseif ($ticket->priority === 'critical')
                                            Kritis
                                        @endif
                                    </span>
                                </td>

                                <td>

                                    @php
                                        $statusClass = match(true) {
                                            $ticket->status === 'open' => 'status-open',
                                            $ticket->status === 'assigned' => 'status-in_progress',
                                            $ticket->status === 'in_progress' && $ticket->reopen_reason => 'status-reopen',
                                            $ticket->status === 'in_progress' => 'status-in_progress',
                                            $ticket->status === 'resolved' => 'status-resolved',
                                            $ticket->status === 'closed' => 'status-closed',
                                            default => 'status-closed',
                                        };

                                        $statusLabel = match(true) {
                                            $ticket->status === 'open' => 'Baru',
                                            $ticket->status === 'assigned' => 'Ditugaskan',
                                            $ticket->status === 'in_progress' && $ticket->reopen_reason => 'Perbaikan Ulang',
                                            $ticket->status === 'in_progress' => 'Diproses',
                                            $ticket->status === 'resolved' => 'Menunggu Konfirmasi',
                                            $ticket->status === 'closed' => 'Ditutup',
                                            default => ucfirst(str_replace('_', ' ', $ticket->status)),
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
                                        href="{{ route('tickets.show', $ticket->id) }}"
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

                <p>Belum ada tiket yang Anda buat.</p>

                <a href="{{ route('tickets.create') }}" class="btn-create">
                    Buat Tiket Pertama
                </a>

            </div>

        @endif

    </div>

</main>

</body>
</html>
