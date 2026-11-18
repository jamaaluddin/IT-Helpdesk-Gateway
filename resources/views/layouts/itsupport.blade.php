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
            background: #f3f7fb;
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
           SIDEBAR
        ========================== */

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #4c1d95;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 18px;
            color: white;
            z-index: 1001;
            overflow-y: auto;
            transition: transform 0.3s ease;
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

        .menu a.active {
            font-weight: 700;
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
            transition: 0.2s ease;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.25);
        }

        .sidebar-logout button:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }

        .sidebar-logout button:active {
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
            border-bottom: 1px solid #eef2f7;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            box-shadow:
                0 3px 8px rgba(0, 0, 0, 0.04),
                0 8px 20px rgba(0, 0, 0, 0.06),
                0 18px 40px rgba(124, 58, 237, 0.07);
        }

        .topbar-left {
            min-width: 0;
        }

        .topbar-left h1 {
            font-size: 22px;
            color: #172033;
        }

        .topbar-left p {
            margin-top: 5px;
            font-size: 13px;
            color: #6b7280;
        }

        .support-info {
            display: flex;
            align-items: center;
            gap: 11px;
            flex-shrink: 0;
        }

        .support-avatar {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 50%;
            background: #7c3aed;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 15px;
        }

        .support-name {
            font-size: 14px;
            font-weight: 700;
            color: #172033;
        }

        .support-role {
            color: #7c3aed;
            font-size: 12px;
            margin-top: 3px;
            font-weight: bold;
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

        @media (max-width: 550px) {

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

                <a
                    href="{{ route('it-support.dashboard') }}"
                    class="{{ request()->routeIs('it-support.dashboard') ? 'active' : '' }}"
                >
                    <span class="menu-icon">🏠</span>
                    <span>Dashboard</span>
                </a>

                <div class="menu-title">Tiket</div>

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

                <div class="menu-title">Maintenance</div>

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

                <div class="menu-title">Aset</div>

                <a
                    href="{{ route('it-support.assets.index') }}"
                    class="{{ request()->routeIs('it-support.assets.*') ? 'active' : '' }}"
                >
                    <span class="menu-icon">💻</span>
                    <span>Aset Gateway</span>
                </a>

               <div class="menu-title">Dokumen</div>

                <a href="#">
                    <span class="menu-icon">📄</span>
                    <span>Berita Acara</span>
                </a>

            </nav>

            <div class="sidebar-logout">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit">
                        🚪 Logout
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
