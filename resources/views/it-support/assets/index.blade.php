<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aset Gateway - IT Support</title>

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

        /* SIDEBAR */

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
            transition: 0.2s ease;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.25);
        }

        .sidebar-logout button:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }

        /* MAIN */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* HEADER */

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

        /* CONTAINER */

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 30px;
        }

        /* PAGE INTRO */

        .page-intro {
            margin-bottom: 27px;
        }

        .page-intro h2 {
            font-size: 23px;
            margin-bottom: 7px;
            color: #172033;
        }

        .page-intro p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }

        /* CATEGORY GRID */

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .category-card {
            display: flex;
            flex-direction: column;
            background: white;
            padding: 25px;
            min-height: 190px;
            border-radius: 17px;
            border: 1px solid #eef2f7;
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

        .category-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 5px 10px rgba(0, 0, 0, 0.04),
                0 12px 25px rgba(0, 0, 0, 0.07),
                0 22px 45px rgba(0, 0, 0, 0.08),
                0 32px 65px rgba(124, 58, 237, 0.12);
        }

        .category-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ede9fe;
            border-radius: 13px;
            font-size: 27px;
            margin-bottom: 17px;
        }

        .category-name {
            font-size: 17px;
            font-weight: bold;
            color: #172033;
            margin-bottom: 7px;
        }

        .category-description {
            color: #6b7280;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .category-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 13px;
            border-top: 1px solid #eef2f7;
        }

        .asset-count {
            font-size: 12px;
            color: #64748b;
        }

        .category-link {
            font-size: 12px;
            color: #7c3aed;
            font-weight: bold;
        }

        /* EMPTY STATE */

        .empty {
            text-align: center;
            padding: 45px 20px;
            color: #6b7280;
            background: white;
            border: 1px dashed #dbe2ea;
            border-radius: 12px;
            font-size: 13px;
            grid-column: 1 / -1;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .category-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
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

            .category-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->

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

            <a href="{{ route('it-support.tickets') }}">
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

            <a
                href="{{ route('it-support.assets.index') }}"
                class="{{ request()->routeIs('it-support.assets.*') ? 'active' : '' }}"
            >
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

        <div class="sidebar-logout">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit">
                    🚪 Logout
                </button>

            </form>

        </div>

    </aside>

    <!-- MAIN -->

    <div class="main">

        <!-- HEADER -->

        <header class="header">

            <div class="header-title">

                <h1>Aset Gateway</h1>

                <p>IT Helpdesk Management System</p>

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

        <!-- CONTENT -->

        <main class="container">

            <div class="page-intro">

                <h2>Pengelolaan Aset Gateway</h2>

                <p>
                    Pilih kategori aset untuk melihat dan mengelola inventaris
                    perangkat milik PT Gateway.
                </p>

            </div>

            <div class="category-grid">

                @forelse ($assetTypes as $assetType)

                    <a
                        href="{{ route('it-support.assets.category', $assetType) }}"
                        class="category-card"
                    >

                       @php
                            $categoryName = strtolower($assetType->name);

                            $categoryIcon = '📦';
                            $categoryClass = 'default';

                            if (str_contains($categoryName, 'komputer') || str_contains($categoryName, 'pc')) {
                                $categoryIcon = '💻';
                                $categoryClass = 'komputer';
                            } elseif (str_contains($categoryName, 'laptop')) {
                                $categoryIcon = '💻';
                                $categoryClass = 'komputer';
                            } elseif (str_contains($categoryName, 'printer')) {
                                $categoryIcon = '🖨️';
                                $categoryClass = 'printer';
                            } elseif (str_contains($categoryName, 'handphone') || str_contains($categoryName, 'hp') || str_contains($categoryName, 'smartphone')) {
                                $categoryIcon = '📱';
                                $categoryClass = 'aksesori';
                            } elseif (str_contains($categoryName, 'monitor')) {
                                $categoryIcon = '🖥️';
                                $categoryClass = 'monitor';
                            } elseif (str_contains($categoryName, 'server')) {
                                $categoryIcon = '🗄️';
                                $categoryClass = 'server';
                            } elseif (str_contains($categoryName, 'router') || str_contains($categoryName, 'modem')) {
                                $categoryIcon = '📡';
                                $categoryClass = 'jaringan';
                            } elseif (str_contains($categoryName, 'jaringan') || str_contains($categoryName, 'network')) {
                                $categoryIcon = '🌐';
                                $categoryClass = 'jaringan';
                            } elseif (str_contains($categoryName, 'keyboard')) {
                                $categoryIcon = '⌨️';
                                $categoryClass = 'aksesori';
                            } elseif (str_contains($categoryName, 'mouse')) {
                                $categoryIcon = '🖱️';
                                $categoryClass = 'aksesori';
                            } elseif (str_contains($categoryName, 'scanner')) {
                                $categoryIcon = '📠';
                                $categoryClass = 'printer';
                            } elseif (str_contains($categoryName, 'ups')) {
                                $categoryIcon = '🔋';
                                $categoryClass = 'aksesori';
                            } elseif (str_contains($categoryName, 'proyektor') || str_contains($categoryName, 'projector')) {
                                $categoryIcon = '📽️';
                                $categoryClass = 'monitor';
                            }
                        @endphp

                        <div class="category-icon {{ $categoryClass }}">
                            {{ $categoryIcon }}
                        </div>

                        <div class="category-name">
                            {{ $assetType->name }}
                        </div>

                        <div class="category-description">
                            Lihat dan kelola inventaris
                            {{ strtolower($assetType->name) }} Gateway.
                        </div>

                        <div class="category-footer">

                            <span class="asset-count">
                                {{ $assetType->assets_count }} aset
                            </span>

                            <span class="category-link">
                                Lihat Aset →
                            </span>

                        </div>

                    </a>

                @empty

                    <div class="empty">
                        Belum ada kategori aset yang tersedia.
                    </div>

                @endforelse

            </div>

        </main>

    </div>

</body>

</html>
