<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Aset - Admin Gateway</title>

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

        /* =========================
           CARD
        ========================== */

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 18px;
            color: #111827;
        }

        .asset-code {
            margin-top: 5px;
            font-size: 12px;
            color: #6b7280;
        }

        .edit-btn {
            display: inline-block;
            padding: 10px 16px;
            background: #059669;
            color: white;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
        }

        .edit-btn:hover {
            background: #047857;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .retire-btn {
            display: inline-block;
            padding: 10px 16px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .retire-btn:hover {
            background: #b91c1c;
        }

        .delete-btn {
            display: inline-block;
            padding: 10px 16px;
            background: #991b1b;
            color: white;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: #7f1d1d;
        }

        /* =========================
           DETAIL
        ========================== */

        .details {
            padding: 22px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .detail-item {
            padding: 14px;
            background: #f9fafb;
            border: 1px solid #f0f0f0;
            border-radius: 10px;
        }

        .detail-label {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
        }

        .notes {
            grid-column: 1 / -1;
        }

        /* =========================
           BADGE
        ========================== */

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .condition-good,
        .status-available {
            background: #dcfce7;
            color: #166534;
        }

        .condition-minor {
            background: #fef3c7;
            color: #92400e;
        }

        .condition-major,
        .status-maintenance {
            background: #ffedd5;
            color: #9a3412;
        }

        .condition-broken,
        .status-damaged {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-in-use {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-retired {
            background: #e5e7eb;
            color: #374151;
        }

        /* =========================
           BACK BUTTON
        ========================== */

        .back-btn {
            display: inline-block;
            margin-bottom: 18px;
            color: #047857;
            font-size: 13px;
            font-weight: 700;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        /* =========================
           HISTORY
        ========================== */

        .history-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .history-header h3 {
            margin: 0;
            font-size: 17px;
            color: #111827;
        }

        .history-list {
            padding: 10px 22px 22px;
        }

        .history-item {
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .history-item:last-child {
            border-bottom: none;
        }

        .history-top {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 6px;
        }

        .history-action {
            font-size: 13px;
            font-weight: 700;
            color: #047857;
        }

        .history-date {
            font-size: 11px;
            color: #6b7280;
        }

        .history-description {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.5;
        }

        .history-empty {
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
            font-size: 13px;
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

            .details {
                grid-template-columns: 1fr;
            }

            .notes {
                grid-column: auto;
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

            .admin-info {
                width: 100%;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header-actions {
                width: 100%;
                flex-direction: column;
            }

            .edit-btn,
            .retire-btn,
            .delete-btn {
                width: 100%;
                text-align: center;
            }

            .history-top {
                flex-direction: column;
                gap: 5px;
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

                    <h1>
                        IT Helpdesk
                    </h1>

                    <p>
                        Gateway Admin
                    </p>

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


                <a href="#">
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
                    Detail Aset
                </h2>

                <p>
                    Informasi lengkap aset IT Gateway
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
                        Detail Aset
                    </h1>

                    <p>
                        Informasi lengkap aset yang terdaftar di sistem.
                    </p>

                </div>

            </div>


            <a
                href="{{ route('admin.assets.index') }}"
                class="back-btn"
            >
                ← Kembali ke Asset Management
            </a>


            <!-- DETAIL CARD -->

            <div class="card">

                <div class="card-header">

                    <div>

                        <h3>
                            {{ $asset->name }}
                        </h3>

                        <div class="asset-code">
                            Kode Aset: {{ $asset->asset_code }}
                        </div>

                    </div>


                   <div class="header-actions">

                        <a
                            href="{{ route('admin.assets.edit', $asset) }}"
                            class="edit-btn"
                        >
                            Edit Aset
                        </a>

                    @if($asset->status !== 'retired')

                        <form
                            action="{{ route('admin.assets.retire', $asset) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin mempensiunkan aset ini?');"
                        >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="retire-btn"
                        >
                            Pensiunkan Aset
                        </button>

                        </form>

                    @endif

                        <form
                                action="{{ route('admin.assets.destroy', $asset) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus aset ini? Data aset dan riwayatnya akan dihapus permanen.');"
                                >

                            @csrf
                            @method('DELETE')

                                <button
                                   type="submit"
                                   class="delete-btn"
                                >
                                    Hapus Aset
                                </button>

                        </form>

                    </div>

                </div>


                <div class="details">


                    <div class="detail-item">

                        <div class="detail-label">
                            Jenis Aset
                        </div>

                        <div class="detail-value">
                            {{ $asset->assetType->name ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Merek
                        </div>

                        <div class="detail-value">
                            {{ $asset->brand ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Model
                        </div>

                        <div class="detail-value">
                            {{ $asset->model ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Serial Number
                        </div>

                        <div class="detail-value">
                            {{ $asset->serial_number ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Office / Lokasi
                        </div>

                        <div class="detail-value">
                            {{ $asset->office->name ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Departemen
                        </div>

                        <div class="detail-value">
                            {{ $asset->department->name ?? '-' }}
                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Harga Pembelian
                        </div>

                        <div class="detail-value">

                            @if($asset->purchase_price !== null)

                                Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}

                            @else

                                -

                            @endif

                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Tanggal Pembelian
                        </div>

                        <div class="detail-value">

                            {{ $asset->purchase_date ? $asset->purchase_date->format('d/m/Y') : '-' }}

                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Kondisi
                        </div>

                        <div class="detail-value">

                            @switch($asset->condition)

                                @case('good')

                                    <span class="badge condition-good">
                                        Baik
                                    </span>

                                    @break


                                @case('minor_damage')

                                    <span class="badge condition-minor">
                                        Rusak Ringan
                                    </span>

                                    @break


                                @case('major_damage')

                                    <span class="badge condition-major">
                                        Rusak Berat
                                    </span>

                                    @break


                                @case('broken')

                                    <span class="badge condition-broken">
                                        Rusak
                                    </span>

                                    @break


                                @default

                                    -

                            @endswitch

                        </div>

                    </div>


                    <div class="detail-item">

                        <div class="detail-label">
                            Status
                        </div>

                        <div class="detail-value">

                            @switch($asset->status)

                                @case('available')

                                    <span class="badge status-available">
                                        Tersedia
                                    </span>

                                    @break


                                @case('in_use')

                                    <span class="badge status-in-use">
                                        Digunakan
                                    </span>

                                    @break


                                @case('maintenance')

                                    <span class="badge status-maintenance">
                                        Maintenance
                                    </span>

                                    @break


                                @case('damaged')

                                    <span class="badge status-damaged">
                                        Rusak
                                    </span>

                                    @break


                                @case('retired')

                                    <span class="badge status-retired">
                                        Dipensiunkan
                                    </span>

                                    @break


                                @default

                                    -

                            @endswitch

                        </div>

                    </div>


                    <div class="detail-item notes">

                        <div class="detail-label">
                            Catatan
                        </div>

                        <div class="detail-value">
                            {{ $asset->notes ?? '-' }}
                        </div>

                    </div>


                </div>

            </div>


            <!-- HISTORY CARD -->

            <div class="card">

                <div class="history-header">

                    <h3>
                        📜 Riwayat Aset
                    </h3>

                </div>


                @if($asset->histories->count() > 0)

                    <div class="history-list">

                        @foreach($asset->histories->sortByDesc('action_date') as $history)

                            <div class="history-item">

                                <div class="history-top">

                                    <div class="history-action">
                                        {{ $history->action }}
                                    </div>

                                    <div class="history-date">
                                        {{ $history->action_date ? $history->action_date->format('d/m/Y') : '-' }}
                                    </div>

                                </div>


                                <div class="history-description">
                                    {{ $history->description ?? '-' }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="history-empty">
                        Belum ada riwayat untuk aset ini.
                    </div>

                @endif

            </div>


        </main>

    </div>

</div>

</body>
</html>
