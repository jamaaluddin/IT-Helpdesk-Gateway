<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $assetType->name }} - Aset Gateway</title>

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

        /* PAGE HEADING */

        .page-heading {
            margin-bottom: 22px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 12px;
        }

        .breadcrumb a {
            color: #7c3aed;
            text-decoration: none;
            font-weight: bold;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .page-heading h2 {
            font-size: 24px;
            color: #172033;
            margin-bottom: 7px;
        }

        .page-heading p {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* BACK BUTTON */

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: #7c3aed;
            color: white;
            border: 1px solid #7c3aed;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 22px;
            transition: 0.2s ease;
        }

        .back-btn:hover {
            background: #7c3aed;
            transform: translateY(-2px);
        }

        /* CONTENT CARD */

        .content-card {
            background: white;
            border-radius: 14px;
            padding: 24px;
            border: 1px solid #eef2f7;
            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.04),
                0 16px 35px rgba(124, 58, 237, 0.04);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 22px;
        }

        .section-header h3 {
            font-size: 17px;
            color: #172033;
            margin-bottom: 6px;
        }

        .section-header p {
            font-size: 12px;
            color: #6b7280;
        }

        .section-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .asset-count {
            background: #f3e8ff;
            color: #7c3aed;
            padding: 9px 13px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 15px;
            background: #7c3aed;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
            transition: 0.2s ease;
            box-shadow: 0 4px 10px rgba(98, 28, 220, 0.18);
        }

        .btn-add:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }

        /* TABLE */

        .table-scroll {
            width: 100%;
            max-height: 500px;
            overflow-x: auto;
            border: 1px solid #eef2f7;
            border-radius: 10px;
        }

        table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .table-scroll thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: #f8fafc;
        }

        table th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            padding: 15px 14px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        table td {
            padding: 15px 14px;
            font-size: 12px;
            color: #475569;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        table tbody tr:hover {
            background: #faf7ff;
        }

        .number-cell {
            color: #9ca3af;
            width: 55px;
        }

        .asset-code {
            color: #6d28d9;
            font-weight: bold;
            white-space: nowrap;
        }

        .asset-name {
            font-weight: bold;
            color: #1f2937;
        }

        .sub-text {
            display: block;
            color: #9ca3af;
            font-size: 11px;
            margin-top: 4px;
        }

        /* CONDITION BADGES */

        .condition-badge,
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .condition-good {
            background: #dcfce7;
            color: #15803d;
        }

        .condition-minor {
            background: #fef3c7;
            color: #b45309;
        }

        .condition-major {
            background: #ffedd5;
            color: #c2410c;
        }

        .condition-broken {
            background: #fee2e2;
            color: #b91c1c;
        }

        .condition-default {
            background: #f3f4f6;
            color: #4b5563;
        }

        /* STATUS BADGES */

        .status-available {
            background: #dcfce7;
            color: #15803d;
        }

        .status-in-use {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-maintenance {
            background: #fef3c7;
            color: #b45309;
        }

        .status-damaged {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-retired {
            background: #f3f4f6;
            color: #6b7280;
        }

        .status-default {
            background: #f3f4f6;
            color: #4b5563;
        }


        /* DETAIL BUTTON */

        .btn-detail {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 12px;
            background: #ede9fe;
            color: #6d28d9;
            border: 1px solid #e5e7eb;
            border-radius: 7px;
            text-decoration: none;
            font-size: 11px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .btn-detail:hover {
            background: #7c3aed;
            color: white;
            border-color: #7c3aed;
        }


        /* ACTION BUTTON */

        .action-cell {
            white-space: nowrap;
        }

        /* EMPTY STATE */

        .empty-state {
            text-align: center;
            padding: 55px 20px;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            background: #f3e8ff;
            color: #7c3aed;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 17px;
        }

        .empty-state h3 {
            font-size: 16px;
            color: #172033;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
        }

        /* ALERT */

        .alert-success {
            padding: 13px 16px;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .container {
                padding: 25px 20px;
            }

            .content-card {
                padding: 20px;
            }
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }

            .header {
                padding: 18px 20px;
            }

            .container {
                padding: 20px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 65px;
                padding: 20px 8px;
            }

            .sidebar-brand {
                justify-content: center;
                padding: 0;
            }

            .sidebar-brand img {
                width: 42px;
                height: 42px;
            }

            .sidebar-brand-text,
            .menu-title,
            .menu a span:not(.menu-icon),
            .sidebar-logout button {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 13px 5px;
            }

            .sidebar-logout button {
                display: block;
                font-size: 0;
                text-align: center;
            }

            .sidebar-logout button::before {
                content: "🚪";
                font-size: 17px;
            }

            .main {
                margin-left: 65px;
            }

            .header {
                padding: 14px 12px;
                gap: 8px;
            }

            .header-title h1 {
                font-size: 16px;
            }

            .header-title p {
                font-size: 10px;
            }

            .avatar {
                width: 34px;
                height: 34px;
                font-size: 12px;
            }

            .user-text {
                display: none;
            }

            .container {
                padding: 18px 12px;
            }

            .page-heading h2 {
                font-size: 20px;
            }

            .content-card {
                padding: 16px;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .section-actions {
                width: 100%;
                justify-content: space-between;
            }

            .btn-add {
                padding: 10px 12px;
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

            <div class="menu-title">Tiket</div>

            <a href="{{ route('it-support.tickets') }}">
                <span class="menu-icon">🎫</span>
                <span>Semua Tiket</span>
            </a>

            <a href="{{ route('it-support.tickets.history') }}">
                <span class="menu-icon">📜</span>
                <span>Riwayat Tiket</span>
            </a>

            <div class="menu-title">Maintenance</div>

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

            <div class="menu-title">Aset</div>

            <a
                href="{{ route('it-support.assets.index') }}"
                class="active"
            >
                <span class="menu-icon">💻</span>
                <span>Aset Gateway</span>
            </a>

            <div class="menu-title">Akun</div>

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
                    <strong>{{ auth()->user()->name }}</strong>
                    <div class="role">IT Support</div>
                </div>

            </div>

        </header>

        <!-- CONTENT -->

        <main class="container">

            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- PAGE HEADING -->

            <div class="page-heading">

                <div class="breadcrumb">
                    <a href="{{ route('it-support.assets.index') }}">
                        Aset Gateway
                    </a>

                    <span>/</span>

                    <span>{{ $assetType->name }}</span>
                </div>

                <h2>{{ $assetType->name }}</h2>

                <p>
                    Daftar dan informasi inventaris aset Gateway
                    berdasarkan kategori {{ strtolower($assetType->name) }}.
                </p>

            </div>

            <a
                href="{{ route('it-support.assets.index') }}"
                class="back-btn"
            >
                ← Kembali ke Kategori Aset
            </a>

            <!-- ASSET TABLE -->

            <section class="content-card">

                <div class="section-header">

                    <div>
                        <h3>Daftar {{ $assetType->name }}</h3>

                        <p>
                            Informasi aset yang terdaftar dalam kategori ini.
                        </p>
                    </div>

                    <div class="section-actions">

                        <div class="asset-count">
                            {{ $assets->count() }} Aset
                        </div>

                        <a
                            href="{{ route('it-support.assets.create') }}"
                            class="btn-add"
                        >
                            + Tambah Aset
                        </a>

                    </div>

                </div>

                @if ($assets->isEmpty())

                    <div class="empty-state">

                        <div class="empty-icon">📦</div>

                        <h3>Belum Ada Aset</h3>

                        <p>
                            Belum terdapat data aset pada kategori
                            {{ $assetType->name }}.
                            <br>
                            Silakan tambahkan aset untuk mulai mengisi inventaris.
                        </p>

                    </div>

                @else

                    <div class="table-scroll">

                        <table>

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Aset</th>
                                    <th>Nama Aset</th>
                                    <th>Merek / Model</th>
                                    <th>Kantor</th>
                                    <th>Departemen</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($assets as $asset)

                                    @php
                                        $condition = strtolower($asset->condition ?? '');
                                        $status = strtolower($asset->status ?? '');

                                        $conditionLabels = [
                                            'good' => 'Baik',
                                            'minor_damage' => 'Rusak Ringan',
                                            'major_damage' => 'Rusak Berat',
                                            'broken' => 'Rusak Total',
                                        ];

                                        $conditionClasses = [
                                            'good' => 'condition-good',
                                            'minor_damage' => 'condition-minor',
                                            'major_damage' => 'condition-major',
                                            'broken' => 'condition-broken',
                                        ];

                                        $statusLabels = [
                                            'available' => 'Tersedia',
                                            'in_use' => 'Digunakan',
                                            'maintenance' => 'Maintenance',
                                            'damaged' => 'Rusak',
                                            'retired' => 'Dipensiunkan',
                                        ];

                                        $statusClasses = [
                                            'available' => 'status-available',
                                            'in_use' => 'status-in-use',
                                            'maintenance' => 'status-maintenance',
                                            'damaged' => 'status-damaged',
                                            'retired' => 'status-retired',
                                        ];
                                    @endphp

                                    <tr>

                                        <td class="number-cell">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <span class="asset-code">
                                                {{ $asset->asset_code }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="asset-name">
                                                {{ $asset->name }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $asset->brand ?: '—' }}

                                            @if ($asset->model)
                                                <span class="sub-text">
                                                    {{ $asset->model }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $asset->office->name ?? '—' }}
                                        </td>

                                        <td>
                                            {{ $asset->department->name ?? '—' }}
                                        </td>

                                        <td>
                                            <span class="condition-badge {{ $conditionClasses[$condition] ?? 'condition-default' }}">
                                                {{ $conditionLabels[$condition] ?? ($asset->condition ?: '—') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="status-badge {{ $statusClasses[$status] ?? 'status-default' }}">
                                                {{ $statusLabels[$status] ?? ($asset->status ?: '—') }}
                                            </span>
                                        </td>

                                        <td class="action-cell">

                                             <a
                                                href="{{ route('it-support.assets.show', $asset->id) }}"
                                                class="btn-detail"
                                            >
                                                👁️ Detail
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </section>

        </main>

    </div>

</body>

</html>
