
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin - IT Helpdesk Gateway')</title>

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
           SIDEBAR
        ========================== */

        .sidebar {
            width: 250px;
            flex: 0 0 250px;
            background: #064e3b;
            color: white;
            padding: 24px 18px;
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
            padding: 0 8px 25px;
            margin-bottom: 20px;
        }

        .sidebar-brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 10px;
            padding: 5px;
        }

        .sidebar-brand h1 {
            font-size: 17px;
            line-height: 1.3;
        }

        .sidebar-brand p {
            margin-top: 3px;
            font-size: 11px;
            color: #a7f3d0;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a7f3d0;
            margin: 0 10px 10px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 9px;
            font-size: 14px;
            color: #ecfdf5;
            transition: 0.2s;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.10);
        }

        .menu a.active {
            background: #059669;
            color: white;
            font-weight: 700;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .logout-form {
            margin-top: 20px;
        }

        .logout-btn {
            display: block;
            width: 100%;
            border: 1px solid transparent;
            background: #059669;
            color: white;
            padding: 11px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            transition: background 0.2s ease;
        }

        .logout-btn:hover {
            background: #047857;
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
            color: #064e3b;
        }

        .topbar-left p {
            margin-top: 5px;
            font-size: 13px;
            color: #6b7280;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 50%;
            background: #d1fae5;
            color: #065f46;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .admin-role {
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
            background: #059669;
            color: white;
            font-size: 23px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .menu-toggle:hover {
            background: #047857;
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

            .admin-info {
                width: auto;
                gap: 0;
            }

            .admin-info > div:last-child {
                display: none;
            }

            .admin-avatar {
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

    <div class="layout" id="adminLayout">

        <!-- SIDEBAR -->
        <aside class="sidebar" id="adminSidebar">

            <div>

                <div class="sidebar-brand">
                    <img
                        src="{{ asset('images/gateway-logo.webp') }}"
                        alt="Gateway Logo"
                    >

                    <div>
                        <h1>IT Helpdesk</h1>
                        <p>Gateway Admin</p>
                    </div>
                </div>

                <div class="menu-title">
                    Menu Utama
                </div>

                <nav class="menu">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    >
                        <span class="menu-icon">🏠</span>
                        <span>Dashboard</span>
                    </a>

                    <a
                        href="{{ route('admin.tickets.index') }}"
                        class="{{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}"
                    >
                        <span class="menu-icon">🎫</span>
                        <span>Monitoring Tiket</span>
                    </a>

                    <a
                        href="#"
                        class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    >
                        <span class="menu-icon">👥</span>
                        <span>User Management</span>
                    </a>

                    <a
                        href="{{ route('admin.assets.index') }}"
                        class="{{ request()->routeIs('admin.assets.*') ? 'active' : '' }}"
                    >
                        <span class="menu-icon">💻</span>
                        <span>Asset Management</span>
                    </a>

                   <a
                        href="{{ route('admin.maintenance.history') }}"
                        class="{{ request()->routeIs('admin.maintenance.history') ? 'active' : '' }}"
                    >
                        <span class="menu-icon">🔧</span>
                        <span>Riwayat Maintenance</span>
                    </a>

                    <a
                        href="{{ route('admin.reports.index') }}"
                        class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                    >
                        <span class="menu-icon">📊</span>
                        <span>Reports</span>
                    </a>

                </nav>

            </div>

            <div class="sidebar-bottom">

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
                >
                    @csrf

                    <button type="submit" class="logout-btn">
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
                        aria-controls="adminSidebar"
                    >
                        ☰
                    </button>

                    <div>
                        <h1>@yield('page-title', 'Admin')</h1>

                        <p>
                            @yield('page-subtitle', 'IT Helpdesk Management System')
                        </p>
                    </div>

                </div>

                <div class="admin-info">

                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div>
                        <div class="admin-name">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </div>

                        <div class="admin-role">
                            Administrator
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

            const layout = document.getElementById('adminLayout');
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
