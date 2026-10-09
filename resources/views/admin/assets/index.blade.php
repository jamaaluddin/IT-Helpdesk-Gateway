<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Asset Management - Admin Gateway</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        a {
            text-decoration: none;
            color: inherit;
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
            background: #064e3b;
            color: white;
            padding: 24px 18px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            margin-bottom: 25px;
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
            margin: 0;
            font-size: 17px;
            line-height: 1.3;
        }

        .sidebar-brand p {
            margin: 3px 0 0;
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
            gap: 6px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 13px;
            border-radius: 9px;
            font-size: 14px;
            color: #ecfdf5;
            transition: 0.2s;
        }

        .menu a:hover {
            background: rgba(255,255,255,0.10);
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
        }

        .logout-form {
            margin-top: 20px;
        }

        .logout-btn {
            width: 100%;
            border: 1px solid rgba(255,255,255,0.18);
            background: rgba(255,255,255,0.08);
            color: white;
            padding: 11px;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.15);
        }

        /* =========================
           MAIN
        ========================== */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================== */

        .topbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-left h2 {
            margin: 0;
            font-size: 22px;
            color: #064e3b;
        }

        .topbar-left p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #6b7280;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #d1fae5;
            color: #065f46;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
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
           CONTENT
        ========================== */

        .content {
            padding: 30px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            margin: 0;
            font-size: 28px;
            color: #064e3b;
        }

        .page-heading p {
            margin: 7px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .add-btn {
            background: #059669;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .add-btn:hover {
            background: #047857;
        }

        /* =========================
           CARD
        ========================== */

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            margin: 0;
            font-size: 17px;
            color: #111827;
        }

        .card-header span {
            font-size: 12px;
            color: #6b7280;
        }

        /* =========================
           TABLE
        ========================== */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1150px;
        }

        th {
            background: #ecfdf5;
            color: #065f46;
            padding: 13px 14px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
            color: #374151;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .asset-code {
            font-weight: 700;
            color: #047857;
        }

        .asset-name {
            font-weight: 600;
            color: #111827;
        }

        .price {
            font-weight: 600;
            white-space: nowrap;
        }

        /* =========================
           BADGE
        ========================== */

        .badge {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .condition-good {
            background: #dcfce7;
            color: #166534;
        }

        .condition-minor {
            background: #fef3c7;
            color: #92400e;
        }

        .condition-major {
            background: #ffedd5;
            color: #9a3412;
        }

        .condition-broken {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-available {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-in-use {
            background: #dcfce7;
            color: #166534;
        }

        .status-maintenance {
            background: #fef3c7;
            color: #92400e;
        }

        .status-damaged {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-retired {
            background: #e5e7eb;
            color: #374151;
        }

        .empty {
            text-align: center;
            padding: 50px 20px !important;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .empty-title {
            font-size: 15px;
            font-weight: 700;
            color: #374151;
        }

        .empty-text {
            font-size: 12px;
            margin-top: 5px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 900px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .content {
                padding: 22px;
            }

            .topbar {
                padding: 17px 22px;
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                padding: 15px;
            }

            .sidebar-brand {
                margin-bottom: 15px;
                padding-bottom: 15px;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }

            .sidebar-bottom {
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 15px 18px;
            }

            .content {
                padding: 18px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .add-btn {
                width: 100%;
            }

        }

        @media (max-width: 480px) {

            .menu {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                gap: 12px;
                flex-direction: column;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .admin-info {
                width: 100%;
            }

        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

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

                <a href="{{ route('admin.dashboard') }}">
                    <span class="menu-icon">🏠</span>
                    <span>Dashboard</span>
                </a>

                <a href="#">
                    <span class="menu-icon">👥</span>
                    <span>User Management</span>
                </a>

                <a
                    href="{{ route('admin.assets.index') }}"
                    class="active"
                >
                    <span class="menu-icon">💻</span>
                    <span>Asset Management</span>
                </a>

                <a href="{{ route('admin.maintenance.schedules.index') }}">
                    <span class="menu-icon">🔧</span>
                    <span>Maintenance</span>
                </a>

                <a href="#">
                    <span class="menu-icon">📊</span>
                    <span>Reports</span>
                </a>

            </nav>
        </div>

        <div class="sidebar-bottom">

            <div class="menu-title">
                Akun
            </div>

            <form
                action="{{ route('logout') }}"
                method="POST"
                class="logout-form"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >
                    🚪 Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    Asset Management
                </h2>

                <p>
                    Kelola dan pantau aset IT Gateway
                </p>

            </div>


            <div class="admin-info">

                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>

                    <div class="admin-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="admin-role">
                        Administrator
                    </div>

                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <main class="content">

            <div class="page-heading">

                <div>

                    <h1>
                        💻 Asset Management
                    </h1>

                    <p>
                        Daftar aset IT yang terdaftar di sistem.
                    </p>

                </div>

                <a
                   href="{{ route('admin.assets.create') }}"
                   class="add-btn"
                >
                   + Tambah Aset
                </a>

            </div>


            <!-- TABLE CARD -->
            <div class="card">

                <div class="card-header">

                    <h3>
                        Daftar Aset
                    </h3>

                    <span>
                        Total: {{ $assets->count() }} aset
                    </span>

                </div>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>Kode Aset</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Merek</th>
                                <th>Model</th>
                                <th>Serial Number</th>
                                <th>Lokasi</th>
                                <th>Harga</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($assets as $asset)

                                <tr>

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
                                        {{ $asset->assetType->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $asset->brand ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $asset->model ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $asset->serial_number ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $asset->office->name ?? '-' }}
                                    </td>

                                    <td>
                                        @if ($asset->purchase_price !== null)

                                            <span class="price">
                                                Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}
                                            </span>

                                        @else

                                            -

                                        @endif
                                    </td>

                                    <td>

                                        @if ($asset->condition === 'good')

                                            <span class="badge condition-good">
                                                Baik
                                            </span>

                                        @elseif ($asset->condition === 'minor_damage')

                                            <span class="badge condition-minor">
                                                Rusak Ringan
                                            </span>

                                        @elseif ($asset->condition === 'major_damage')

                                            <span class="badge condition-major">
                                                Rusak Berat
                                            </span>

                                        @elseif ($asset->condition === 'broken')

                                            <span class="badge condition-broken">
                                                Rusak
                                            </span>

                                        @else

                                            <span class="badge">
                                                {{ $asset->condition }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if ($asset->status === 'available')

                                            <span class="badge status-available">
                                                Tersedia
                                            </span>

                                        @elseif ($asset->status === 'in_use')

                                            <span class="badge status-in-use">
                                                Digunakan
                                            </span>

                                        @elseif ($asset->status === 'maintenance')

                                            <span class="badge status-maintenance">
                                                Maintenance
                                            </span>

                                        @elseif ($asset->status === 'damaged')

                                            <span class="badge status-damaged">
                                                Rusak
                                            </span>

                                        @elseif ($asset->status === 'retired')

                                            <span class="badge status-retired">
                                                Tidak Digunakan
                                            </span>

                                        @else

                                            <span class="badge">
                                                {{ $asset->status }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        <a
                                            href="{{ route('admin.assets.show', $asset) }}"
                                            style="
                                                display: inline-block;
                                                padding: 10px 16px;
                                                background: #059669;
                                                color: white;
                                                border: 1px solid #a7f3d0;
                                                border-radius: 9px;
                                                font-size: 13px;
                                                font-weight: 700;
                                            "
                                        >
                                             Detail
                                        </a>
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="10"
                                        class="empty"
                                    >

                                        <div class="empty-icon">
                                            💻
                                        </div>

                                        <div class="empty-title">
                                            Belum ada data aset
                                        </div>

                                        <div class="empty-text">
                                            Tambahkan aset IT Gateway untuk mulai mengelola inventaris.
                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</div>

</body>
</html>
