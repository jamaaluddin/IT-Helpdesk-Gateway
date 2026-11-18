<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Aset - IT Support Gateway</title>

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

        /* CONTENT */

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 30px;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h2 {
            font-size: 23px;
            margin-bottom: 7px;
            color: #172033;
        }

        .page-heading p {
            color: #6b7280;
            font-size: 14px;
        }

        /* HISTORY CARD */

        .history-card {
            background: white;
            border-radius: 17px;
            border: 1px solid #eef2f7;
            padding: 30px;
            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 50px rgba(124, 58, 237, 0.06);
        }

        .asset-summary {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 22px;
            background: #f5f3ff;
            border: 1px solid #ede9fe;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .asset-icon {
            width: 62px;
            height: 62px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 12px;
            font-size: 30px;
        }

        .asset-summary-info h3 {
            color: #172033;
            font-size: 20px;
            margin-bottom: 6px;
        }

        .asset-summary-info p {
            color: #7c3aed;
            font-size: 13px;
            font-weight: bold;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 14px;
            margin-bottom: 22px;
            border-bottom: 1px solid #eef2f7;
        }

        .section-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #ede9fe;
            color: #7c3aed;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .section-heading h3 {
            font-size: 16px;
            color: #172033;
        }

        .section-heading p {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 3px;
        }

        /* HISTORY TABLE */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .history-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .history-table thead {
            background: #f5f3ff;
        }

        .history-table th {
            padding: 15px 16px;
            text-align: left;
            color: #5b21b6;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
            border-bottom: 1px solid #ede9fe;
        }

        .history-table td {
            padding: 17px 16px;
            font-size: 13px;
            color: #4b5563;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
            line-height: 1.6;
        }

        .history-table tbody tr:hover {
            background: #fafaff;
        }

        .history-table tbody tr:last-child td {
            border-bottom: none;
        }

        .action-badge {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .action-created {
            background: #dcfce7;
            color: #15803d;
        }

        .action-updated {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .description {
            max-width: 380px;
            overflow-wrap: anywhere;
        }

        .user-name {
            color: #1f2937;
            font-weight: bold;
        }

        .date-text {
            white-space: nowrap;
            font-weight: bold;
            color: #374151;
        }

        /* EMPTY STATE */

        .empty-state {
            text-align: center;
            padding: 55px 20px;
        }

        .empty-icon {
            font-size: 42px;
            margin-bottom: 15px;
        }

        .empty-state h4 {
            font-size: 16px;
            color: #374151;
            margin-bottom: 7px;
        }

        .empty-state p {
            font-size: 13px;
            color: #9ca3af;
            line-height: 1.6;
        }

        /* ACTIONS */

        .history-actions {
            display: flex;
            justify-content: flex-end;
            padding-top: 22px;
            margin-top: 20px;
            border-top: 1px solid #eef2f7;
        }

        .btn {
            min-width: 115px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-back {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-back:hover {
            background: #e5e7eb;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .container {
                padding: 25px;
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

            .history-card {
                padding: 24px;
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

            .history-card {
                padding: 20px 16px;
            }

            .asset-summary {
                align-items: flex-start;
                padding: 16px;
            }

            .asset-summary-info h3 {
                font-size: 17px;
            }

            .history-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="sidebar-brand">
            <img src="{{ asset('images/gateway-logo.webp') }}" alt="Gateway Logo">

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

            <a href="{{ route('it-support.assets.index') }}"
                class="{{ request()->routeIs('it-support.assets.*') ? 'active' : '' }}">
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
                <button type="submit">🚪 Logout</button>
            </form>
        </div>

    </aside>


    <!-- MAIN -->

    <div class="main">

        <header class="header">

            <div class="header-title">
                <h1>Riwayat Aset</h1>
                <p>IT Helpdesk Management System</p>
            </div>

            <div class="user-info">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="user-text">
                    <strong>{{ auth()->user()->name }}</strong>

                    <div class="role">
                        IT Support
                    </div>
                </div>

            </div>

        </header>


        <!-- CONTENT -->

        <main class="container">

            <div class="page-heading">

                <h2>Riwayat Aktivitas Aset</h2>

                <p>
                    Lihat catatan aktivitas dan perubahan data aset Gateway.
                </p>

            </div>


            <div class="history-card">

                <!-- RINGKASAN ASET -->

                <div class="asset-summary">

                    <div class="asset-icon">
                        💻
                    </div>

                    <div class="asset-summary-info">

                        <h3>{{ $asset->name }}</h3>

                        <p>{{ $asset->asset_code }}</p>

                    </div>

                </div>


                <!-- RIWAYAT AKTIVITAS -->

                <section>

                    <div class="section-heading">

                        <div class="section-icon">📜</div>

                        <div>
                            <h3>Catatan Aktivitas</h3>
                            <p>Daftar perubahan yang tercatat pada aset ini.</p>
                        </div>

                    </div>


                    @if ($histories->isNotEmpty())

                        <div class="table-wrapper">

                            <table class="history-table">

                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Aktivitas</th>
                                        <th>Deskripsi</th>
                                        <th>Petugas</th>
                                        <th>Kantor</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($histories as $history)

                                        <tr>

                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <span class="date-text">
                                                    {{ $history->action_date?->format('d-m-Y') ?? '—' }}
                                                </span>
                                            </td>

                                            <td>

                                                @if ($history->action === 'created')
                                                    <span class="action-badge action-created">
                                                        Aset Ditambahkan
                                                    </span>
                                                @elseif ($history->action === 'updated')
                                                    <span class="action-badge action-updated">
                                                        Data Diperbarui
                                                    </span>
                                                @else
                                                    <span class="action-badge">
                                                        {{ ucfirst($history->action) }}
                                                    </span>
                                                @endif

                                            </td>

                                            <td>
                                                <div class="description">
                                                    {{ $history->description ?: 'Tidak ada deskripsi.' }}
                                                </div>
                                            </td>

                                            <td>
                                                <span class="user-name">
                                                    {{ $history->user?->name ?? '—' }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $history->office?->name ?? '—' }}
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="empty-state">

                            <div class="empty-icon">📋</div>

                            <h4>Belum Ada Riwayat Aktivitas</h4>

                            <p>
                                Belum terdapat catatan aktivitas untuk aset ini.
                                <br>
                                Riwayat akan muncul ketika data aset ditambahkan atau diperbarui.
                            </p>

                        </div>

                    @endif

                </section>


                <!-- BUTTON -->

                <div class="history-actions">

                    <a
                        href="{{ route('it-support.assets.show', $asset->id) }}"
                        class="btn btn-back"
                    >
                        ← Kembali ke Detail
                    </a>

                </div>

            </div>

        </main>

    </div>

</body>

</html>
