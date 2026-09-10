<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Tiket - Gateway</title>

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
                    rgba(37, 99, 235, 0.07),
                    transparent 32%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(59, 130, 246, 0.05),
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
                0 18px 40px rgba(37, 99, 235, 0.07);

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
                drop-shadow(0 7px 10px rgba(37, 99, 235, 0.08));
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

            background: #2563eb;
            color: white;

            border: none;

            padding: 8px 16px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 12px;
            font-weight: bold;

            box-shadow:
                0 3px 7px rgba(37, 99, 235, 0.20),
                0 8px 18px rgba(37, 99, 235, 0.12);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .logout-btn:hover {
            background: #1d4ed8;

            transform: translateY(-2px);

            box-shadow:
                0 6px 12px rgba(37, 99, 235, 0.25),
                0 13px 25px rgba(37, 99, 235, 0.16);
        }

        /* =========================
           MAIN
        ========================== */

        .container {
            max-width: 1050px;

            margin: auto;

            padding: 38px 35px 50px;
        }

        /* =========================
           TOP BAR
        ========================== */

        .top-bar {
            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;

            margin-bottom: 25px;
        }

        .top-title h2 {
            font-size: 25px;

            color: #172033;

            letter-spacing: -0.4px;

            margin-bottom: 7px;
        }

        .top-title p {
            font-size: 14px;

            color: #6b7280;

            line-height: 1.6;
        }

        .back-btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            text-decoration: none;

            background: #dbeafe;

            color: #2563eb;

            padding: 11px 17px;

            border-radius: 10px;

            border: 1px solid #bfdbfe;

            font-size: 13px;

            font-weight: bold;

            white-space: nowrap;

            box-shadow:
                0 3px 6px rgba(37, 99, 235, 0.08),
                0 8px 16px rgba(37, 99, 235, 0.06);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .back-btn:hover {
            background: #bfdbfe;

            transform: translateY(-2px);

            box-shadow:
                0 5px 10px rgba(37, 99, 235, 0.13),
                0 12px 22px rgba(37, 99, 235, 0.09);
        }

        /* =========================
           MAIN CARD
        ========================== */

        .card {
            background: rgba(255, 255, 255, 0.98);

            padding: 32px;

            border-radius: 20px;

            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 60px rgba(37, 99, 235, 0.08);

            transition: box-shadow 0.25s ease;
        }

        .card:hover {
            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.06),
                0 22px 45px rgba(0, 0, 0, 0.07),
                0 32px 70px rgba(37, 99, 235, 0.11);
        }

        .card-title {
            font-size: 20px;

            color: #172033;

            padding-bottom: 18px;

            margin-bottom: 24px;

            border-bottom: 1px solid #eef2f7;
        }

        /* =========================
           SUCCESS MESSAGE
        ========================== */

        .success-message {
            background:
                linear-gradient(
                    145deg,
                    #f0fdf4,
                    #dcfce7
                );

            color: #166534;

            padding: 14px 17px;

            border-radius: 11px;

            margin-bottom: 22px;

            font-size: 13px;

            font-weight: bold;

            border: 1px solid #bbf7d0;

            box-shadow:
                0 4px 10px rgba(22, 101, 52, 0.06);
        }

        /* =========================
           ERROR MESSAGE
        ========================== */

        .error-message {
            background:
                linear-gradient(
                    145deg,
                    #fff5f5,
                    #fee2e2
                );

            color: #991b1b;

            padding: 14px 17px;

            border-radius: 11px;

            margin-bottom: 20px;

            font-size: 13px;

            border: 1px solid #fecaca;

            box-shadow:
                0 4px 10px rgba(220, 38, 38, 0.06);
        }

        /* =========================
           INFORMATION GRID
        ========================== */

        .info-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;

            margin-bottom: 24px;
        }

        .info-box {
            background:
                linear-gradient(
                    145deg,
                    #ffffff,
                    #fafbfc
                );

            border: 1px solid #edf0f5;

            border-radius: 13px;

            padding: 17px 18px;

            min-height: 84px;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.025),
                0 6px 14px rgba(0, 0, 0, 0.035);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .info-box:hover {
            transform: translateY(-2px);

            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.04),
                0 10px 20px rgba(0, 0, 0, 0.06);
        }

        .label {
            font-size: 11px;

            color: #6b7280;

            margin-bottom: 7px;

            font-weight: 600;

            text-transform: uppercase;

            letter-spacing: 0.3px;
        }

        .value {
            font-size: 15px;

            font-weight: 600;

            color: #1f2937;

            line-height: 1.5;
        }

        .ticket-number {
            color: #2563eb;

            font-weight: bold;

            text-shadow:
                0 1px 2px rgba(37, 99, 235, 0.10);
        }

        /* =========================
           BADGES
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
        }

        .status-open {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-assigned {
            background: #e0e7ff;
            color: #3730a3;
        }

        .status-in_progress {
            background: #fef3c7;
            color: #92400e;
        }

        .status-resolved {
            background: #dcfce7;
            color: #166534;
        }

        .status-closed {
            background: #e5e7eb;
            color: #374151;
        }

        /* =========================
           CONTENT
        ========================== */

        .row {
            margin-bottom: 23px;
        }

        .row:last-child {
            margin-bottom: 0;
        }

        .description {
            background:
                linear-gradient(
                    145deg,
                    #fafbfc,
                    #f7f8fa
                );

            padding: 17px 18px;

            border-radius: 12px;

            border: 1px solid #edf0f5;

            line-height: 1.7;

            font-size: 14px;

            color: #374151;

            white-space: pre-line;

            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.025),
                0 3px 8px rgba(0, 0, 0, 0.025);
        }

        /* =========================
           REOPEN REASON
        ========================== */

        .reopen-reason {
            background:
                linear-gradient(
                    145deg,
                    #fffaf5,
                    #fff7ed
                );

            border: 1px solid #fed7aa;

            color: #9a3412;

            box-shadow:
                inset 0 1px 3px rgba(154, 52, 18, 0.025),
                0 4px 10px rgba(154, 52, 18, 0.04);
        }

        /* =========================
           PROBLEM IMAGE
        ========================== */

        .problem-image-box {
            background:
                linear-gradient(
                    145deg,
                    #fafbfc,
                    #f7f8fa
                );

            padding: 18px;

            border-radius: 13px;

            border: 1px solid #edf0f5;

            text-align: center;

            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.025),
                0 4px 10px rgba(0, 0, 0, 0.025);
        }

        .problem-image {
            display: block;

            max-width: 550px;

            width: 100%;

            max-height: 500px;

            object-fit: contain;

            margin: 0 auto;

            border-radius: 11px;

            border: 1px solid #e5e7eb;

            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.06),
                0 10px 22px rgba(0, 0, 0, 0.08);
        }

        /* =========================
           RESOLUTION
        ========================== */

        .resolution-box {
            background:
                linear-gradient(
                    145deg,
                    #f3fff7,
                    #f0fdf4
                );

            border: 1px solid #bbf7d0;

            padding: 19px;

            border-radius: 13px;

            line-height: 1.7;

            font-size: 14px;

            color: #166534;

            box-shadow:
                inset 0 1px 3px rgba(22, 101, 52, 0.025),
                0 5px 14px rgba(22, 101, 52, 0.05);
        }

        .resolution-title {
            font-size: 14px;

            font-weight: bold;

            color: #166534;
        }

        .resolution-text {
            margin-top: 8px;

            color: #374151;

            white-space: pre-line;
        }

        .evidence-area {
            margin-top: 18px;

            padding-top: 16px;

            border-top: 1px solid #bbf7d0;
        }

        .evidence-title {
            font-weight: bold;

            color: #166534;

            font-size: 13px;

            margin-bottom: 8px;
        }

        .evidence-link {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            color: #2563eb;

            text-decoration: none;

            font-weight: bold;

            font-size: 13px;

            padding: 8px 11px;

            border-radius: 8px;

            background: #eff6ff;

            border: 1px solid #bfdbfe;

            box-shadow:
                0 3px 7px rgba(37, 99, 235, 0.06);

            transition:
                transform 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        .evidence-link:hover {
            background: #dbeafe;

            transform: translateY(-2px);

            box-shadow:
                0 5px 10px rgba(37, 99, 235, 0.10);
        }

        /* =========================
           CONFIRMATION
        ========================== */

        .confirm-box {
            margin-top: 30px;

            padding: 23px;

            background:
                linear-gradient(
                    145deg,
                    #f5f9ff,
                    #eff6ff
                );

            border-radius: 15px;

            border: 1px solid #bfdbfe;

            box-shadow:
                inset 0 1px 3px rgba(37, 99, 235, 0.025),
                0 6px 16px rgba(37, 99, 235, 0.06);
        }

        .confirm-title {
            font-size: 17px;

            font-weight: bold;

            color: #1e3a8a;

            margin-bottom: 10px;
        }

        .confirm-box p {
            font-size: 14px;

            margin-bottom: 18px;

            line-height: 1.7;

            color: #374151;
        }

        .action-area {
            display: flex;

            gap: 12px;

            flex-wrap: wrap;

            align-items: flex-start;
        }

        .action-btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-height: 48px;

            padding: 11px 19px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            border-radius: 10px;

            font-weight: bold;

            border: none;

            cursor: pointer;

            font-size: 13px;

            box-shadow:
                0 4px 8px rgba(37, 99, 235, 0.20),
                0 10px 20px rgba(37, 99, 235, 0.11);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .action-btn:hover {
            background: #1d4ed8;

            transform: translateY(-2px);

            box-shadow:
                0 7px 13px rgba(37, 99, 235, 0.26),
                0 14px 25px rgba(37, 99, 235, 0.15);
        }

        .action-btn:active {
            transform: translateY(0);
        }

        /* =========================
           REOPEN FORM
        ========================== */

        .reopen-form {
            width: 100%;

            margin-top: 5px;

            padding-top: 17px;

            border-top: 1px solid #bfdbfe;
        }

        .reopen-label {
            display: block;

            margin-bottom: 8px;

            font-size: 13px;

            font-weight: bold;

            color: #374151;
        }

        .reopen-form textarea {
            width: 100%;

            min-height: 110px;

            padding: 13px 14px;

            border: 1px solid #d1d5db;

            border-radius: 10px;

            resize: vertical;

            font-family: Arial, sans-serif;

            font-size: 13px;

            line-height: 1.6;

            outline: none;

            background: white;

            box-shadow:
                inset 0 1px 3px rgba(0, 0, 0, 0.025),
                0 2px 5px rgba(0, 0, 0, 0.025);

            transition:
                border 0.2s ease,
                box-shadow 0.2s ease;
        }

        .reopen-form textarea:focus {
            border-color: #93c5fd;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10),
                0 4px 10px rgba(37, 99, 235, 0.06);
        }

        .reopen-btn {
            margin-top: 10px;

            background: #dc2626;

            box-shadow:
                0 4px 8px rgba(220, 38, 38, 0.20),
                0 10px 20px rgba(220, 38, 38, 0.10);
        }

        .reopen-btn:hover {
            background: #b91c1c;

            box-shadow:
                0 7px 13px rgba(220, 38, 38, 0.25),
                0 14px 25px rgba(220, 38, 38, 0.14);
        }

        /* =========================
           BOTTOM
        ========================== */

        .bottom-area {
            margin-top: 28px;

            padding-top: 24px;

            border-top: 1px solid #eef2f7;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 800px) {

            .container {
                padding: 30px 25px 40px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 25px;
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

            .top-bar {
                flex-direction: column;

                align-items: flex-start;
            }

            .top-title h2 {
                font-size: 22px;
            }

            .back-btn {
                width: 100%;
            }

            .brand img {
                width: 100px;
            }

            .brand h1 {
                font-size: 20px;
            }

            .card {
                padding: 20px;

                border-radius: 16px;
            }

            .confirm-box {
                padding: 18px;
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

            .card-title {
                font-size: 18px;
            }

            .action-btn {
                width: 100%;
            }

            .reopen-form {
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
            <p>Detail Tiket Pengguna</p>
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

    <div class="top-bar">

        <div class="top-title">

            <h2>🎫 Detail Tiket</h2>

            <p>
                Pantau proses penanganan dan hasil perbaikan tiket Anda.
            </p>

        </div>

        <a
            href="{{ route('tickets.index') }}"
            class="back-btn"
        >
            ← Tiket Saya
        </a>

    </div>


    <div class="card">

        @if (session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        @if ($errors->any())

            <div class="error-message">

                <strong>
                    Terjadi kesalahan:
                </strong>

                <ul style="margin: 8px 0 0 20px;">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="card-title">
            Informasi Tiket
        </div>


        <div class="info-grid">

            <div class="info-box">

                <div class="label">
                    Nomor Tiket
                </div>

                <div class="value ticket-number">
                    {{ $ticket->ticket_number }}
                </div>

            </div>


            <div class="info-box">

                <div class="label">
                    Pelapor
                </div>

                <div class="value">
                    {{ $ticket->user->name ?? '-' }}
                </div>

            </div>


            <div class="info-box">

                <div class="label">
                    Masalah
                </div>

                <div class="value">
                    {{ $ticket->subject }}
                </div>

            </div>


            <div class="info-box">

                <div class="label">
                    Kategori
                </div>

                <div class="value">
                    {{ $ticket->category->name ?? '-' }}
                </div>

            </div>


            <div class="info-box">

                <div class="label">
                    Prioritas
                </div>

                <div class="value">

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

                </div>

            </div>


            <div class="info-box">

                <div class="label">
                    Status
                </div>

                <div class="value">

                    @if ($ticket->status === 'open')

                        <span class="badge status-open">
                            Baru
                        </span>

                    @elseif ($ticket->status === 'assigned')

                        <span class="badge status-assigned">
                            Ditugaskan
                        </span>

                    @elseif ($ticket->status === 'in_progress' && $ticket->reopen_reason)

                        <span class="badge status-in_progress">
                            Perbaikan Ulang
                        </span>

                    @elseif ($ticket->status === 'in_progress')

                        <span class="badge status-in_progress">
                            Diproses
                        </span>

                    @elseif ($ticket->status === 'resolved')

                        <span class="badge status-resolved">
                            Menunggu Konfirmasi
                        </span>

                    @elseif ($ticket->status === 'closed')

                        <span class="badge status-closed">
                            Ditutup
                        </span>

                    @endif

                </div>

            </div>

        </div>


        @if ($ticket->reopen_reason)

            <div class="row">

                <div class="label">
                    Alasan Perbaikan Ulang
                </div>

                <div class="description reopen-reason">

                    {{ $ticket->reopen_reason }}

                </div>

            </div>

        @endif


        <div class="row">

            <div class="label">
                Deskripsi Masalah
            </div>

            <div class="description">

                {{ $ticket->description }}

            </div>

        </div>


        @if ($ticket->problem_image)

            <div class="row">

                <div class="label">
                    Foto / Bukti Masalah
                </div>

                <div class="problem-image-box">

                    <img
                        src="{{ asset('storage/' . $ticket->problem_image) }}"
                        alt="Foto masalah"
                        class="problem-image"
                    >

                </div>

            </div>

        @endif


        <div class="row">

            <div class="label">
                Tanggal Laporan
            </div>

            <div class="value">
                {{ $ticket->created_at->format('d/m/Y H:i') }}
            </div>

        </div>


        @if ($ticket->status === 'resolved' || $ticket->status === 'closed')

            <div class="row">

                <div class="label">
                    Hasil Penanganan IT
                </div>

                <div class="resolution-box">

                    <div class="resolution-title">
                        ✅ Hasil Pekerjaan / Perbaikan
                    </div>

                    <div class="resolution-text">
                        {{ $ticket->resolution_notes }}
                    </div>


                    @if ($ticket->evidence)

                        <div class="evidence-area">

                            <div class="evidence-title">
                                📎 Bukti Perbaikan
                            </div>

                            <a
                                href="{{ asset('storage/' . $ticket->evidence) }}"
                                target="_blank"
                                class="evidence-link"
                            >
                                📎 Lihat Bukti Perbaikan
                            </a>

                        </div>

                    @endif

                </div>

            </div>

        @endif


        @if ($ticket->status === 'resolved')

            <div class="confirm-box">

                <div class="confirm-title">
                    🔍 Konfirmasi Hasil Perbaikan
                </div>

                <p>
                    IT Support telah menyelesaikan penanganan tiket ini.
                    Silakan periksa hasil perbaikan dan bukti yang diberikan.
                    Jika masalah sudah benar-benar selesai, pilih
                    <strong>Konfirmasi Selesai</strong>.
                    Jika masalah masih terjadi, pilih
                    <strong>Perbaikan Ulang</strong>.
                </p>


                <div class="action-area">

                    <form
                        action="{{ route('tickets.close', $ticket) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="action-btn"
                        >
                            ✅ Konfirmasi Selesai
                        </button>

                    </form>


                    <form
                        action="{{ route('tickets.reopen', $ticket) }}"
                        method="POST"
                        class="reopen-form"
                    >

                        @csrf

                        <label
                            for="reopen_reason"
                            class="reopen-label"
                        >
                            🔄 Masalah masih terjadi?
                        </label>

                        <textarea
                            name="reopen_reason"
                            id="reopen_reason"
                            placeholder="Jelaskan kenapa masalah masih terjadi..."
                            required
                        ></textarea>

                        <button
                            type="submit"
                            class="action-btn reopen-btn"
                        >
                            🔄 Perbaikan Ulang
                        </button>

                    </form>

                </div>

            </div>

        @endif


        <div class="bottom-area">

            <a
                href="{{ route('tickets.index') }}"
                class="back-btn"
            >
                ← Kembali ke Tiket Saya
            </a>

        </div>

    </div>

</main>

</body>
</html>
