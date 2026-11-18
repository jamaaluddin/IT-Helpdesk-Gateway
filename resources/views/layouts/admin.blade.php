
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'IT Support - IT Helpdesk Gateway')</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button,
        input {
            font-family: inherit;
        }

        /* =========================
           LAYOUT
        ========================== */

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           SIDEBAR IT SUPPORT
        ========================== */

        .sidebar {
            width: 250px;
            flex: 0 0 250px;
            background: #4c1d95;
            color: white;
            padding: 24px 14px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 1001;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 3px 22px;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .sidebar-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 9px;
            padding: 5px;
        }

        .sidebar-brand h1 {
            font-size: 17px;
            line-height: 1.3;
        }

        .sidebar-brand p {
            margin-top: 3px;
            font-size: 11px;
            color: #ddd6fe;
        }

        .menu-section {
            margin-bottom: 19px;
        }

        .menu-title {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #c4b5fd;
            font-weight: 700;
            margin: 0 10px 9px;
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
            padding: 10px 12px;
            border-radius: 9px;
            font-size: 13px;
            color: #f5f3ff;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.10);
        }

        .menu a.active {
            background: #7c3aed;
            color: white;
            font-weight: 700;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
        }

        .menu-icon {
            width: 22px;
            flex: 0 0 22px;
            text-align: center;
            font-size: 15px;
        }

        .sidebar-bottom {
            padding-top: 3px;
        }

        .logout-form {
            margin-top: 0;
        }

        .logout-btn {
            display: block;
            width: 100%;
            border: 1px solid transparent;
            background: #7c3aed;
            color: white;
            padding: 10px 11px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .logout-btn:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }

        .logout-btn:active {
            transform: translateY(0);
        }

        /* =========================
           SIDEBAR OVERLAY
        ========================== */

        .sidebar-overlay {
            display: none;
        }

        /* =========================
           MAIN
        ========================== */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-width: 0;
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================== */

        .topbar {
            position: sticky;
            top: 0;
            z-index: 999;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .topbar-left {
            min-width: 0;
        }

        .topbar-left h1 {
            font-size: 22px;
            color: #4c1d95;
        }

        .topbar-left p {
            margin-top: 5px;
            font-size: 13px;
            color: #6b7280;
        }

        .support-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .support-avatar {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 50%;
            background: #ede9fe;
            color: #5b21b6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
        }

        .support-name {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .support-role {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* =========================
           HAMBURGER BUTTON
        ========================== */

        .menu-toggle {
            display: none;
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border: none;
            border-radius: 8px;
            background: #7c3aed;
            color: white;
            font-size: 23px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .menu-toggle:hover {
            background: #6d28d9;
        }

        /* =========================
           CONTENT
        ========================== */

        .content {
            width: 100%;
            max-width: 1460px;
            margin: 0 auto;
            padding: 30px;
        }

        @stack('styles')

        /* =========================
           TABLET
        ========================== */

        @media (max-width: 1000px) {

            .menu-toggle {
                display: flex;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .layout.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                opacity: 0;
                visibility: hidden;
                z-index: 1000;
                border: none;
                cursor: pointer;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .layout.sidebar-open .sidebar-overlay {
                opacity: 1;
                visibility: visible;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 18px 24px;
            }

            .content {
                padding: 24px;
            }
        }

        /* =========================
           MOBILE
        ========================== */

        @media (max-width: 700px) {

            .topbar {
                padding: 15px 18px;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .topbar-left h1 {
                font-size: 19px;
            }

            .topbar-left p {
                font-size: 12px;
            }

            .content {
                padding: 18px;
            }
        }

        /* =========================
           SMALL MOBILE
        ========================== */

        @media (max-width: 480px) {

            .topbar {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                padding: 12px 14px;
            }

            .topbar-left {
                flex: 1;
                min-width: 0;
                gap: 9px;
            }

            .menu-toggle {
                width: 36px;
                height: 36px;
                flex-basis: 36px;
                font-size: 21px;
            }

            .topbar-left h1 {
                font-size: 16px;
                white-space: nowrap;
            }

            .topbar-left p {
                font-size: 10px;
                margin-top: 3px;
                white-space: nowrap;
            }

            .support-info {
                width: auto;
                gap: 0;
            }

            .support-info > div:last-child {
                display: none;
            }

            .support-avatar {
                width: 35px;
                height: 35px;
                flex-basis: 35px;
                font-size: 14px;
            }

            .content {
                padding: 15px;
            }
        }
    </style>

    @stack('head')
</head>

<body>

    <div class="layout" id="itSupportLayout">

        <!-- SIDEBAR -->
        <aside class="sidebar" id="itSupportSidebar">

            <div>

                <div class="sidebar-brand">
                    <img
                        src="{{ asset('images/gateway-logo.webp') }}"
                        alt="Gateway Logo"
                    >

                    <div>
                        <h1>IT Helpdesk</h1>
                        <p>Gateway IT Support</p>
                    </div>
                </div>

                <!-- MENU UTAMA -->
                <div class="menu-section">

                    <div class="menu-title">
                        Menu Utama
                    </div>

                    <nav class="menu">

                        <a
                            href="{{ route('it-support.dashboard') }}"
                            class="{{ request()->routeIs('it-support.dashboard') ? 'active' : '' }}"
                        >
                            <span class="menu-icon">🏠</span>
                            <span>Dashboard</span>
                        </a>

                    </nav>

                </div>

                <!-- TIKET -->
                <div class="menu-section">

                    <div class="menu-title">
                        Tiket
                    </div>

                    <nav class="menu">

                        <a
                            href="{{ route('it-support.tickets') }}"
                            class="{{ request()->routeIs('it-support.tickets') && !request()->routeIs('it-support.tickets.history') ? 'active' : '' }}"
                        >
                            <span class="menu-icon">🎫</span>
                            <span>Semua Tiket</span>
                        </a>

                        <a
                            href="{{ route('it-support.tickets.history') }}"
                            class="{{ request()->routeIs('it-support.tickets.history') ? 'active' : '' }}"
                        >
                            <span class="menu-icon">📜</span>
                            <span>Riwayat Tiket</span>
                        </a>

                    </nav>

                </div>

                <!-- MAINTENANCE -->
                <div class="menu-section">

                    <div class="menu-title">
                        Maintenance
                    </div>

                    <nav class="menu">

                        <a
                            href="{{ route('it-support.maintenance.pc') }}"
                            class="{{ request()->routeIs('it-support.maintenance.pc') ? 'active' : '' }}"
                        >
                            <span class="menu-icon">💻</span>
                            <span>PC Maintenance</span>
                        </a>

                        <a
                            href="{{ route('it-support.maintenance.server') }}"
                            class="{{ request()->routeIs('it-support.maintenance.server') ? 'active' : '' }}"
                        >
                            <span class="menu-icon">🌐</span>
                            <span>Internet / Server</span>
                        </a>

                        <a
                            href="{{ route('it-support.maintenance.history') }}"
                            class="{{ request()->routeIs('it-support.maintenance.history') ? 'active' : '' }}"
                        >
                            <span class="menu-icon">📋</span>
                            <span>Riwayat Maintenance</span>
                        </a>

                    </nav>

                </div>

                <!-- ASET -->
                <div class="menu-section">

                    <div class="menu-title">
                        Aset
                    </div>

                    <nav class="menu">

                        <a
                            href="{{ route('it-support.assets.index') }}"
                            class="{{ request()->routeIs('it-support.assets.*') ? 'active' : '' }}"
                        >
                            <span class="menu-icon">💻</span>
                            <span>Aset Gateway</span>
                        </a>

                    </nav>

                </div>

                <!-- AKUN -->
                <div class="menu-section">

                    <div class="menu-title">
                        Akun
                    </div>

                    <nav class="menu">

                        <a href="#">
                            <span class="menu-icon">👤</span>
                            <span>Profil</span>
                        </a>

                    </nav>

                </div>

            </div>

            <!-- LOGOUT -->
            <div class="sidebar-bottom">

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
                >
                    @csrf

                    <button type="submit" class="logout-btn">
                        📜 Logout
                    </button>
                </form>

            </div>

        </aside>

        <!-- SIDEBAR OVERLAY -->
        <button
            type="button"
            class="sidebar-overlay"
            id="sidebarOverlay"
            aria-label="Tutup menu navigasi"
            tabindex="-1"
        ></button>

        <!-- MAIN -->
        <main class="main">

            <!-- TOPBAR -->
            <header class="topbar">

                <div class="topbar-left">

                    <button
                        type="button"
                        class="menu-toggle"
                        id="menuToggle"
                        aria-label="Buka menu navigasi"
                        aria-expanded="false"
                        aria-controls="itSupportSidebar"
                    >
                        ☰
                    </button>

                    <div>
                        <h1>@yield('page-title', 'IT Support')</h1>

                        <p>
                            @yield('page-subtitle', 'IT Helpdesk Management System')
                        </p>
                    </div>

                </div>

                <div class="support-info">

                    <div class="support-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'I', 0, 1)) }}
                    </div>

                    <div>
                        <div class="support-name">
                            {{ auth()->user()->name ?? 'IT Support' }}
                        </div>

                        <div class="support-role">
                            IT Support
                        </div>
                    </div>

                </div>

            </header>

            <!-- CONTENT HALAMAN -->
            <section class="content">
                @yield('content')
            </section>

        </main>

    </div>

    @stack('scripts')

    <!-- SIDEBAR JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const layout = document.getElementById('itSupportLayout');
            const menuToggle = document.getElementById('menuToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const sidebarLinks = document.querySelectorAll('.sidebar .menu a');

            function openSidebar() {
                layout.classList.add('sidebar-open');
                document.body.classList.add('sidebar-open');

                menuToggle.innerHTML = '&times;';
                menuToggle.setAttribute('aria-label', 'Tutup menu navigasi');
                menuToggle.setAttribute('aria-expanded', 'true');
            }

            function closeSidebar() {
                layout.classList.remove('sidebar-open');
                document.body.classList.remove('sidebar-open');

                menuToggle.innerHTML = '&#9776;';
                menuToggle.setAttribute('aria-label', 'Buka menu navigasi');
                menuToggle.setAttribute('aria-expanded', 'false');
            }

            menuToggle.addEventListener('click', function () {

                if (layout.classList.contains('sidebar-open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }

            });

            sidebarOverlay.addEventListener('click', closeSidebar);

            sidebarLinks.forEach(function (link) {
                link.addEventListener('click', closeSidebar);
            });

            document.addEventListener('keydown', function (event) {

                if (event.key === 'Escape') {
                    closeSidebar();
                }

            });

            window.addEventListener('resize', function () {

                if (window.innerWidth > 1000) {
                    closeSidebar();
                }

            });

        });
    </script>

</body>
</html>
