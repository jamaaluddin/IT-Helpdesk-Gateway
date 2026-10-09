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
           SIDEBAR
        ========================================= */

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

            box-shadow:
                0 4px 10px rgba(124, 58, 237, 0.25);
        }

        .sidebar-logout button:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }


        /* =========================================
           HEADER
        ========================================= */

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


        /* =========================================
           CONTAINER
        ========================================= */

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 30px;
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
            margin-bottom: 30px;
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

            text-decoration: none;
            color: inherit;

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
        }


        /* =========================================
           BOTTOM CARDS
        ========================================= */

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(0, 1fr);
            gap: 24px;
            align-items: stretch;
        }

        .dashboard-card {
            background: white;

            border-radius: 18px;
            border: 1px solid #eef2f7;

            padding: 25px;

            height: 460px;

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

        .dashboard-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.07),
                0 22px 45px rgba(0, 0, 0, 0.08),
                0 32px 65px rgba(124, 58, 237, 0.10);
        }


        /* =========================================
           CARD HEADER
        ========================================= */

        .dashboard-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            margin-bottom: 18px;
        }

        .dashboard-card-title h3 {
            font-size: 19px;
            color: #172033;
            margin-bottom: 5px;
        }

        .dashboard-card-title p {
            font-size: 12px;
            color: #94a3b8;
        }

        .view-all {
            color: #7c3aed;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .view-all:hover {
            color: #6d28d9;
        }


        /* =========================================
           SCROLL AREA
        ========================================= */

        .scroll-area {
            flex: 1;

            overflow-y: auto;
            overflow-x: hidden;

            padding-right: 6px;
        }

        .scroll-area::-webkit-scrollbar {
            width: 6px;
        }

        .scroll-area::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .scroll-area::-webkit-scrollbar-thumb {
            background: #c4b5fd;
            border-radius: 10px;
        }

        .scroll-area::-webkit-scrollbar-thumb:hover {
            background: #a78bfa;
        }


        /* =========================================
           TICKET LIST
        ========================================= */

        .ticket-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 15px 10px;

            border-bottom: 1px solid #eef2f7;

            transition: background 0.2s ease;
        }

        .ticket-item:first-child {
            padding-top: 8px;
        }

        .ticket-item:last-child {
            border-bottom: none;
        }

        .ticket-item:hover {
            background: #faf8ff;
            border-radius: 9px;
        }

        .ticket-info {
            min-width: 0;
            flex: 1;
        }

        .ticket-number {
            color: #7c3aed;
            font-size: 13px;
            font-weight: bold;

            text-decoration: none;

            display: inline-block;
            margin-bottom: 5px;
        }

        .ticket-number:hover {
            color: #6d28d9;
            text-decoration: underline;
        }

        .ticket-subject {
            color: #1f2937;
            font-size: 13px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;

            margin-bottom: 5px;
        }

        .ticket-meta {
            color: #94a3b8;
            font-size: 11px;
        }

        .ticket-action {
            flex-shrink: 0;
        }

        .ticket-action a {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: #7c3aed;
            color: white;

            text-decoration: none;

            padding: 7px 12px;
            border-radius: 7px;

            font-size: 11px;
            font-weight: bold;

            transition: 0.2s ease;
        }

        .ticket-action a:hover {
            background: #6d28d9;
            transform: translateY(-1px);
        }


        /* =========================================
           MAINTENANCE LIST
        ========================================= */

        .maintenance-item {
            padding: 16px 10px;

            border-bottom: 1px solid #eef2f7;

            transition: background 0.2s ease;
        }

        .maintenance-item:first-child {
            padding-top: 8px;
        }

        .maintenance-item:last-child {
            border-bottom: none;
        }

        .maintenance-item:hover {
            background: #faf8ff;
            border-radius: 9px;
        }

        .maintenance-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            gap: 12px;

            margin-bottom: 7px;
        }

        .maintenance-asset {
            font-size: 13px;
            font-weight: bold;
            color: #1f2937;

            line-height: 1.4;
        }

        .maintenance-office {
            font-size: 11px;
            color: #94a3b8;

            margin-top: 3px;
        }

        .maintenance-date {
            font-size: 12px;
            color: #64748b;

            white-space: nowrap;
        }


        /* =========================================
           STATUS BADGES
        ========================================= */

        .badge {
            display: inline-block;

            padding: 5px 9px;

            border-radius: 20px;

            font-size: 10px;
            font-weight: bold;
        }

        .badge-open {
            background: #dbeafe;
            color: #2563eb;
        }

        .badge-assigned {
            background: #ede9fe;
            color: #7c3aed;
        }

        .badge-process {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-resolved {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-scheduled {
            background: #dbeafe;
            color: #2563eb;
        }

        .badge-waiting {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-completed {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-rescheduled {
            background: #ede9fe;
            color: #7c3aed;
        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .empty {
            text-align: center;

            padding: 45px 20px;

            color: #6b7280;

            background: #f9fafb;

            border: 1px dashed #dbe2ea;

            border-radius: 10px;

            font-size: 13px;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1200px) {

            .stats {
                grid-template-columns: repeat(3, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-card {
                height: 430px;
            }
        }


        @media (max-width: 900px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .container {
                padding: 20px;
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

            .dashboard-card {
                height: 400px;
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

            .stats {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 15px;
            }

            .menu {
                grid-template-columns: 1fr;
            }

            .dashboard-card {
                height: 380px;
                padding: 20px;
            }

            .dashboard-card-header {
                flex-direction: column;
                gap: 10px;
            }

            .ticket-item {
                align-items: flex-start;
            }

            .ticket-action a {
                padding: 6px 9px;
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

            <!-- DASHBOARD -->

            <a
                href="{{ route('it-support.dashboard') }}"
                class="active"
            >
                <span class="menu-icon">🏠</span>
                <span>Dashboard</span>
            </a>


            <!-- TIKET -->

            <div class="menu-title">
                Tiket
            </div>


            <a href="{{ route('it-support.tickets') }}">
                <span class="menu-icon">🎫</span>
                <span>Semua Tiket</span>
            </a>


            <a href="{{ route('it-support.tickets.history') }}">
                <span class="menu-icon">📜</span>
                <span>Riwayat Tiket</span>
            </a>


            <!-- MAINTENANCE -->

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


            <!-- ASET -->

            <div class="menu-title">
                Aset
            </div>


            <a href="#">
                <span class="menu-icon">💻</span>
                <span>Aset Gateway</span>
            </a>


            <!-- AKUN -->

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
                    Dashboard IT Support
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


            <!-- WELCOME -->

            <div class="welcome">

                <h2>
                    Selamat Datang, {{ auth()->user()->name }} 👋
                </h2>

                <p>
                    Pantau dan tangani laporan masalah IT dari pengguna.
                </p>

            </div>



            <!-- =================================================
                 STATISTICS
            ================================================= -->

            <div class="stats">


                <!-- TOTAL TIKET -->

                <a
                    href="{{ route('it-support.tickets') }}"
                    class="stat-card"
                >

                    <div class="icon">
                        🎫
                    </div>

                    <div class="label">
                        Total Tiket
                    </div>

                    <div class="number">
                        {{ $totalTickets }}
                    </div>

                </a>



                <!-- TIKET BARU -->

                <a
                    href="{{ route('it-support.tickets', ['status' => 'open']) }}"
                    class="stat-card"
                >

                    <div class="icon">
                        🔴
                    </div>

                    <div class="label">
                        Tiket Baru
                    </div>

                    <div class="number">
                        {{ $openTickets }}
                    </div>

                </a>



                <!-- SEDANG DIPROSES -->

                <a
                    href="{{ route('it-support.tickets', ['status' => 'in_progress']) }}"
                    class="stat-card"
                >

                    <div class="icon">
                        🔧
                    </div>

                    <div class="label">
                        Sedang Diproses
                    </div>

                    <div class="number">
                        {{ $inProgressTickets }}
                    </div>

                </a>



                <!-- TIKET SELESAI -->

                <a
                    href="{{ route('it-support.tickets', ['status' => 'resolved']) }}"
                    class="stat-card"
                >

                    <div class="icon">
                        ✅
                    </div>

                    <div class="label">
                        Tiket Selesai
                    </div>

                    <div class="number">
                        {{ $resolvedTickets }}
                    </div>

                </a>



                <!-- PERBAIKAN ULANG -->

                <a
                    href="{{ route('it-support.tickets', ['status' => 'reopened']) }}"
                    class="stat-card"
                >

                    <div class="icon">
                        🔄
                    </div>

                    <div class="label">
                        Perbaikan Ulang
                    </div>

                    <div class="number">
                        {{ $reopenedTickets }}
                    </div>

                </a>

            </div>



            <!-- =================================================
                 TIKET MASUK + JADWAL MAINTENANCE
            ================================================= -->

            <div class="dashboard-grid">


                <!-- =================================================
                     TIKET MASUK
                ================================================= -->

                <section class="dashboard-card">

                    <div class="dashboard-card-header">

                        <div class="dashboard-card-title">

                            <h3>
                                🎫 Tiket Masuk
                            </h3>

                            <p>
                                Tiket terbaru yang masuk ke sistem
                            </p>

                        </div>


                        <a
                            href="{{ route('it-support.tickets') }}"
                            class="view-all"
                        >
                            Lihat Semua →
                        </a>

                    </div>


                    <div class="scroll-area">

                        @forelse ($latestTickets as $ticket)

                            <div class="ticket-item">

                                <div class="ticket-info">

                                    <a
                                        href="{{ route('it-support.tickets.show', $ticket) }}"
                                        class="ticket-number"
                                    >
                                        {{ $ticket->ticket_number }}
                                    </a>


                                    <div class="ticket-subject">
                                        {{ $ticket->subject }}
                                    </div>


                                    <div class="ticket-meta">

                                        {{ $ticket->user->name ?? '-' }}

                                        •

                                        {{ $ticket->created_at->format('d/m/Y H:i') }}

                                    </div>

                                </div>


                                <div class="ticket-action">

                                    <a
                                        href="{{ route('it-support.tickets.show', $ticket) }}"
                                    >
                                        Lihat
                                    </a>

                                </div>

                            </div>

                        @empty

                            <div class="empty">
                                Belum ada tiket yang masuk.
                            </div>

                        @endforelse

                    </div>

                </section>



                <!-- =================================================
                     JADWAL MAINTENANCE
                ================================================= -->

                <section class="dashboard-card">

                    <div class="dashboard-card-header">

                        <div class="dashboard-card-title">

                            <h3>
                                📅 Jadwal Maintenance
                            </h3>

                            <p>
                                Jadwal maintenance yang perlu ditangani
                            </p>

                        </div>


                        <a
                            href="{{ route('it-support.maintenance.pc') }}"
                            class="view-all"
                        >
                            Lihat Semua →
                        </a>

                    </div>


                    <div class="scroll-area">

                        @forelse ($maintenanceSchedules as $schedule)

                            <div class="maintenance-item">

                                <div class="maintenance-top">

                                    <div>

                                        <div class="maintenance-asset">

                                            {{ $schedule->asset->name ?? 'Aset tidak tersedia' }}

                                        </div>


                                        <div class="maintenance-office">

                                            {{ $schedule->office->name ?? '-' }}

                                        </div>

                                    </div>


                                    <div class="maintenance-date">

                                        {{ $schedule->scheduled_date->format('d/m/Y') }}

                                    </div>

                                </div>


                                @if ($schedule->status === 'scheduled')

                                    <span class="badge badge-scheduled">
                                        Terjadwal
                                    </span>

                                @elseif ($schedule->status === 'waiting_confirmation')

                                    <span class="badge badge-waiting">
                                        Menunggu Konfirmasi User
                                    </span>

                                @elseif ($schedule->status === 'completed')

                                    <span class="badge badge-completed">
                                        Selesai
                                    </span>

                                @elseif ($schedule->status === 'rescheduled')

                                    <span class="badge badge-rescheduled">
                                        Dijadwalkan Ulang
                                    </span>

                                @else

                                    <span class="badge">
                                        {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                                    </span>

                                @endif

                            </div>

                        @empty

                            <div class="empty">
                                Belum ada jadwal maintenance.
                            </div>

                        @endforelse

                    </div>

                </section>

            </div>


        </main>

    </div>

</body>

</html>
