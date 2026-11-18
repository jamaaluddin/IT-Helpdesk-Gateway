<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Semua Tiket - IT Support Gateway</title>

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

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #4c1d95;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 18px;
            color: white;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
            padding: 0 5px;
        }

        .sidebar-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 10px;
            padding: 5px;
        }

        .sidebar-brand-text h3 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .sidebar-brand-text p {
            font-size: 12px;
            color: #ddd6fe;
        }

        .menu-title {
            font-size: 11px;
            color: #c4b5fd;
            font-weight: bold;
            margin: 20px 10px 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 11px;
            color: #ede9fe;
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 9px;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .menu a:hover,
        .menu a.active {
            background: #7c3aed;
            color: white;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-logout {
            margin-top: 28px;
            padding-bottom: 10px;
        }

        .sidebar-logout form {
            width: 100%;
        }

        .sidebar-logout button {
            width: 100%;
            border: none;
            background: #7c3aed;
            color: white;
            padding: 11px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition:
                transform 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.25);
        }

        .sidebar-logout button:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            background: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eef2f7;
            box-shadow:
                0 3px 8px rgba(0, 0, 0, 0.04),
                0 8px 20px rgba(0, 0, 0, 0.06),
                0 18px 40px rgba(124, 58, 237, 0.07);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-title h1 {
            font-size: 22px;
            color: #172033;
            margin-bottom: 4px;
        }

        .header-title p {
            font-size: 13px;
            color: #6b7280;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #7c3aed;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .user-text {
            text-align: right;
        }

        .user-text strong {
            display: block;
            font-size: 14px;
        }

        .role {
            color: #7c3aed;
            font-size: 12px;
            margin-top: 3px;
            font-weight: bold;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 30px;
        }


        /* =====================================================
           TOP
        ===================================================== */

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            gap: 20px;
        }

        .top h2 {
            font-size: 23px;
            margin-bottom: 7px;
            color: #172033;
        }

        .top-title-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 7px;
        }

        .top-title-row h2 {
            margin-bottom: 0;
        }

        .total {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 11px;
            border-radius: 20px;
            background: #ede9fe;
            color: #7c3aed;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
            border: 1px solid #ddd6fe;
        }

        .top p {
            color: #6b7280;
            font-size: 14px;
        }


        /* =====================================================
           FILTER TIKET
        ===================================================== */

        .ticket-filter-wrapper {
            margin-top: 16px;
        }

        .ticket-filters {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #64748b;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .filter-btn:hover {
            background: #f5f3ff;
            color: #7c3aed;
            border-color: #ddd6fe;
        }

        .filter-btn.active {
            background: #7c3aed;
            color: white;
            border-color: #7c3aed;
            box-shadow: 0 3px 8px rgba(124, 58, 237, 0.16);
        }

        /* NAVIGASI BULAN */

        .month-navigation {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 13px;
        }

        .month-label {
            color: #172033;
            font-size: 14px;
            font-weight: bold;
            min-width: 125px;
            text-align: center;
        }

        .month-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 29px;
            height: 29px;
            border-radius: 7px;
            border: 1px solid #ddd6fe;
            background: #f5f3ff;
            color: #7c3aed;
            text-decoration: none;
            font-size: 11px;
            transition: 0.2s ease;
        }

        .month-arrow:hover {
            background: #7c3aed;
            color: white;
        }

        .month-arrow.disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }


        /* =====================================================
           BACK BUTTON
        ===================================================== */

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
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


        /* =====================================================
           MAIN CARD
        ===================================================== */

        .section {
            background: white;
            border-radius: 18px;
            padding: 25px;
            border: 1px solid #eef2f7;
            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 55px rgba(124, 58, 237, 0.07);
        }


        /* =====================================================
           TABLE AREA
        ===================================================== */

        .table-scroll {
            width: 100%;
            height: auto;
            max-height: 350px;
            overflow-y: auto;
            overflow-x: auto;
            border-radius: 13px;
            border: 1px solid #eef2f7;
            box-shadow:
                inset 0 0 0 1px rgba(226, 232, 240, 0.5),
                0 4px 12px rgba(0, 0, 0, 0.025);
        }

        .table-scroll::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: #c4b5fd;
            border-radius: 10px;
        }

        .table-scroll::-webkit-scrollbar-thumb:hover {
            background: #a78bfa;
        }


        /* =====================================================
           TABLE - LEBAR KOLOM DISAMAKAN
        ===================================================== */

table {
    width: 100%;
    min-width: 1050px;
    table-layout: fixed;
    border-collapse: separate;
    border-spacing: 0;
}

/* Pengaturan lebar kolom agar sejajar */
table th:nth-child(1),
table td:nth-child(1) { width: 15%; }

table th:nth-child(2),
table td:nth-child(2) { width: 11%; }

table th:nth-child(3),
table td:nth-child(3) { width: 15%; }

table th:nth-child(4),
table td:nth-child(4) { width: 12%; }

table th:nth-child(5),
table td:nth-child(5) { width: 9%; }

table th:nth-child(6),
table td:nth-child(6) { width: 11%; }

table th:nth-child(7),
table td:nth-child(7) { width: 14%; }

table th:nth-child(8),
table td:nth-child(8) { width: 13%; }


        /* =====================================================
           TABLE HEADER
        ===================================================== */

        thead th {
            position: sticky;
            top: 0;
            z-index: 10;
            text-align: left;
            padding: 13px 12px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        thead th:first-child {
            border-top-left-radius: 10px;
        }

        thead th:last-child {
            border-top-right-radius: 10px;
        }


        /* =====================================================
           TABLE BODY
        ===================================================== */

        tbody td {
            padding: 14px 12px;
            font-size: 13px;
            color: #374151;
            border-bottom: 1px solid #eef2f7;
            background: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
            transition:
                background 0.2s ease,
                box-shadow 0.2s ease;
        }

        tbody tr:hover td {
            background: #fcfaff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Kolom aksi selalu berada di tengah */
        thead th:last-child,
        tbody td:last-child {
            text-align: center;
        }


        /* =====================================================
           TICKET NUMBER
        ===================================================== */

        .ticket-number {
            color: #7c3aed;
            font-weight: bold;
            white-space: nowrap;
        }


        /* =====================================================
           PRIORITY
        ===================================================== */

        .priority-low,
        .priority-medium,
        .priority-high,
        .priority-critical {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
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


        /* =====================================================
           BADGE
        ===================================================== */

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
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

        .status-closed {
            background: #dcfce7;
            color: #16a34a;
        }


        /* =====================================================
           VIEW BUTTON
        ===================================================== */

        .view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            min-width: 120px;
            min-height: 36px;
            padding: 8px 10px;
            text-decoration: none;
            background: #7c3aed;
            color: white;
            border: 1px solid #ddd6fe;
            border-radius: 8px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
            cursor: pointer;
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .view-btn:hover {
            background: #6d28d9;
            transform: translateY(-2px);
            box-shadow:
                0 5px 10px rgba(124, 58, 237, 0.13),
                0 11px 20px rgba(124, 58, 237, 0.09);
        }

        .view-btn:active {
            transform: translateY(0);
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .action-buttons form {
            margin: 0;
        }


        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty {
            text-align: center;
            padding: 55px 25px;
            color: #6b7280;
            background: #f9fafb;
            border: 1px dashed #dbe2ea;
            border-radius: 12px;
            font-size: 14px;
        }


        /* =====================================================
           QUEUE HEADING
        ===================================================== */

        .queue-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 16px;
        }

        .queue-heading h3 {
            font-size: 17px;
            color: #172033;
            margin-bottom: 6px;
        }

        .queue-heading p {
            font-size: 13px;
            color: #6b7280;
        }

        .queue-heading-second {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eef2f7;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }

            .container {
                padding: 22px;
            }

            .section {
                padding: 20px;
            }

            .table-scroll {
                height: auto;
                max-height: 350px;
            }
        }


        @media (max-width: 700px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-left: 0;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .header {
                position: relative;
            }

            .top {
                flex-direction: column;
                align-items: flex-start;
            }

            .back-btn {
                width: 100%;
            }
        }


        @media (max-width: 550px) {

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .user-info {
                width: 100%;
            }

            .user-text {
                text-align: left;
            }

            .container {
                padding: 15px;
            }

            .menu {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 15px;
            }

            .top h2 {
                font-size: 21px;
            }

            .table-scroll {
                height: auto;
                max-height: 350px;
            }

            .queue-heading h3 {
                font-size: 15px;
            }
        }

    </style>

</head>


<body>

    <!-- =====================================================
         SIDEBAR IT SUPPORT
    ===================================================== -->

    <aside class="sidebar">

        <div class="sidebar-brand">

            <img
                src="{{ asset('images/gateway-logo.webp') }}"
                alt="Gateway Logo"
            >

            <div class="sidebar-brand-text">

                <h3>IT Helpdesk</h3>

                <p>Gateway IT Support</p>

            </div>

        </div>


        <nav class="menu">

            <div class="menu-title">Menu Utama</div>

            <a href="{{ route('it-support.dashboard') }}">

                <span class="menu-icon">🏠</span>

                <span>Dashboard</span>

            </a>


            <div class="menu-title">
                Tiket
            </div>


            <a
                href="{{ route('it-support.tickets') }}"
                class="active"
            >

                <span class="menu-icon">🎫</span>

                <span>Semua Tiket</span>

            </a>


            <a href="{{ route('it-support.tickets.history') }}">

                <span class="menu-icon">📜</span>

                <span>Riwayat Tiket</span>

            </a>


            <div class="menu-title">
                Maintenance
            </div>


            <a href="{{ route('it-support.maintenance.pc') }}">

                <span class="menu-icon">💻</span>

                <span>PC Maintenance</span>

            </a>


            <a href="{{ route('it-support.maintenance.server') }}">

                <span class="menu-icon">🌐</span>

                <span>Internet / Server</span>

            </a>


            <a href="{{ route('it-support.maintenance.history') }}">

                <span class="menu-icon">📋</span>

                <span>Riwayat Maintenance</span>

            </a>


            <div class="menu-title">
                Aset
            </div>


            <a href="{{ route('it-support.assets.index') }}">

                <span class="menu-icon">💻</span>

                <span>Aset Gateway</span>

            </a>


            <div class="menu-title">
                Akun
            </div>


            <a href="#">

                <span class="menu-icon">👤</span>

                <span>Profil</span>

            </a>

        </nav>


        <!-- LOGOUT -->

        <div class="sidebar-logout">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button type="submit">
                    🚪 Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- =====================================================
         MAIN
    ===================================================== -->

    <div class="main">


        <!-- HEADER -->

        <header class="header">

            <div class="header-title">

                <h1>
                    Semua Tiket
                </h1>

                <p>
                    IT Helpdesk Management System
                </p>

            </div>


            <div class="user-info">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="user-text">

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>

                    <div class="role">
                        IT Support
                    </div>

                </div>

            </div>

        </header>


        <!-- =================================================
             CONTENT
        ================================================= -->

        <main class="container">


            <!-- TOP -->

            <div class="top">

                <div>

                    <div class="top-title-row">

                        <h2>
                            🎫 Semua Tiket
                        </h2>

                        <span class="total">
                            Total: {{ $pendingPriorityTickets->count() + $priorityQueueTickets->count() + $inProgressTickets->count() }} tiket
                        </span>

                    </div>

                    <p>
                        Daftar tiket yang masih aktif dan perlu ditangani oleh IT Support.
                    </p>


                    <!-- FILTER PERIODE -->

                    <div class="ticket-filter-wrapper">

                        <div class="ticket-filters">

                            <a
                                href="{{ route('it-support.tickets', ['period' => 'today']) }}"
                                class="filter-btn {{ $period === 'today' ? 'active' : '' }}"
                            >
                                Hari Ini
                            </a>

                            <a
                                href="{{ route('it-support.tickets', ['period' => 'this_week']) }}"
                                class="filter-btn {{ $period === 'this_week' ? 'active' : '' }}"
                            >
                                Minggu Ini
                            </a>

                            <a
                                href="{{ route('it-support.tickets', [
                                    'period' => 'month',
                                    'month' => $monthValue
                                ]) }}"
                                class="filter-btn {{ $period === 'month' ? 'active' : '' }}"
                            >
                                Bulanan
                            </a>

                        </div>


                        @if ($period === 'month')

                            <div class="month-navigation">

                                <a
                                    href="{{ route('it-support.tickets', [
                                        'period' => 'month',
                                        'month' => $previousMonth
                                    ]) }}"
                                    class="month-arrow"
                                >
                                    &#10094;
                                </a>

                                <span class="month-label">
                                    {{ $monthLabel }}
                                </span>

                                @if ($canGoNextMonth)

                                    <a
                                        href="{{ route('it-support.tickets', [
                                            'period' => 'month',
                                            'month' => $nextMonth
                                        ]) }}"
                                        class="month-arrow"
                                    >
                                        &#10095;
                                    </a>

                                @else

                                    <span class="month-arrow disabled">
                                        &#10095;
                                    </span>

                                @endif

                            </div>

                        @endif

                    </div>

                </div>


                <a
                    href="{{ route('it-support.dashboard') }}"
                    class="back-btn"
                >
                    ← Dashboard
                </a>

            </div>


            <!-- =================================================
                 TICKET TABLE
            ================================================= -->


            <div class="section">


                <!-- ANTREAN 1: MENUNGGU PENILAIAN -->

                <div class="queue-heading">

                    <div>
                        <h3>Menunggu Penilaian Prioritas</h3>
                        <p>Tiket baru yang belum ditentukan tingkat prioritasnya.</p>
                    </div>

                    <span class="total">
                        {{ $pendingPriorityTickets->count() }} tiket
                    </span>

                </div>


                @if ($pendingPriorityTickets->count() > 0)

                    <div class="table-scroll">

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

                                @foreach ($pendingPriorityTickets as $ticket)

                                    <tr>

                                        <td>
                                            <span class="ticket-number">
                                                {{ $ticket->ticket_number }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $ticket->user->name ?? '-' }}
                                        </td>

                                        <td title="{{ $ticket->subject }}">
                                            {{ $ticket->subject }}
                                        </td>

                                        <td>
                                            {{ $ticket->category->name ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="badge status-waiting">
                                                Belum Dinilai
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge status-waiting">
                                                Menunggu Penilaian
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
                                                Nilai Prioritas
                                            </a>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty">
                        Semua tiket baru sudah memiliki prioritas.
                    </div>

                @endif



                <!-- ANTREAN 2: BERDASARKAN PRIORITAS -->

                <div class="queue-heading queue-heading-second">

                    <div>
                        <h3>Antrean Tiket Berdasarkan Prioritas</h3>
                        <p>Prioritas tertinggi ditangani terlebih dahulu.</p>
                    </div>

                    <span class="total">
                        {{ $priorityQueueTickets->count() }} tiket
                    </span>

                </div>


                @if ($priorityQueueTickets->count() > 0)

                    <div class="table-scroll">

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

                                @foreach ($priorityQueueTickets as $ticket)

                                    <tr>

                                        <td>
                                            <span class="ticket-number">
                                                {{ $ticket->ticket_number }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $ticket->user->name ?? '-' }}
                                        </td>

                                        <td title="{{ $ticket->subject }}">
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
                                                if (
                                                    $ticket->status === 'in_progress'
                                                    && $ticket->reopen_reason
                                                ) {
                                                    $statusClass = 'status-process';
                                                    $statusLabel = 'Perbaikan Ulang';
                                                } else {
                                                    $statusClass = match ($ticket->status) {
                                                        'open' => 'status-open',
                                                        'assigned' => 'status-assigned',
                                                        'in_progress' => 'status-process',
                                                        'waiting' => 'status-waiting',
                                                        default => 'status-closed',
                                                    };

                                                    $statusLabel = match ($ticket->status) {
                                                        'open' => 'Baru',
                                                        'assigned' => 'Diambil',
                                                        'in_progress' => 'Diproses',
                                                        'waiting' => 'Menunggu',
                                                        default => ucfirst(
                                                            str_replace('_', ' ', $ticket->status)
                                                        ),
                                                    };
                                                }
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
                        Belum ada tiket dalam antrean prioritas.
                    </div>

                @endif



                <!-- ANTREAN 3: SEDANG DIKERJAKAN -->

                <div class="queue-heading queue-heading-second">

                    <div>
                        <h3>Sedang Dikerjakan</h3>
                        <p>Tiket yang sedang ditangani IT Support, termasuk perbaikan ulang.</p>
                    </div>

                    <span class="total">
                        {{ $inProgressTickets->count() }} tiket
                    </span>

                </div>


                @if ($inProgressTickets->count() > 0)

                    <div class="table-scroll">

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

                                @foreach ($inProgressTickets as $ticket)

                                    <tr>

                                        <td>
                                            <span class="ticket-number">
                                                {{ $ticket->ticket_number }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $ticket->user->name ?? '-' }}
                                        </td>

                                        <td title="{{ $ticket->subject }}">
                                            {{ $ticket->subject }}
                                        </td>

                                        <td>
                                            {{ $ticket->category->name ?? '-' }}
                                        </td>

                                        <td>

                                            @if ($ticket->priority)

                                                <span class="priority-{{ $ticket->priority }}">
                                                    {{ ucfirst($ticket->priority) }}
                                                </span>

                                            @else

                                                <span class="badge"
                                                    style="background:#f3f4f6;color:#6b7280;">
                                                    Belum Ditentukan
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            @if ($ticket->reopen_reason)

                                                <span class="badge status-process">
                                                    Perbaikan Ulang
                                                </span>

                                            @else

                                                <span class="badge status-process">
                                                    Diproses
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                                        </td>

                                        <td>

                                            <div class="action-buttons">

                                                @if (in_array($ticket->status, ['open', 'assigned']))

                                                    <form
                                                        action="{{ route('it-support.tickets.start', $ticket) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Mulai menangani tiket {{ $ticket->ticket_number }}?');"
                                                    >

                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="view-btn"
                                                            style="border: none;"
                                                        >
                                                            🔧 Mulai Penanganan
                                                        </button>

                                                    </form>

                                                @endif


                                                <a
                                                    href="{{ route('it-support.tickets.show', $ticket) }}"
                                                    class="view-btn"
                                                >
                                                    Lihat Detail
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty">
                        Belum ada tiket yang sedang dikerjakan.
                    </div>

                @endif


            </div>


        </main>

    </div>

</body>

</html>
