<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Maintenance - Gateway</title>

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
            letter-spacing: .5px;
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
            transition: .2s ease;
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
                transform .2s ease,
                background .2s ease,
                box-shadow .2s ease;

            box-shadow:
                0 4px 10px rgba(124,58,237,.25);
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
                0 3px 8px rgba(0,0,0,.04),
                0 8px 20px rgba(0,0,0,.06),
                0 18px 40px rgba(124,58,237,.07);

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


        /* =====================================================
           BACK BUTTON
        ===================================================== */

        .back-button {
            display: inline-flex;
            align-items: center;

            text-decoration: none;

            color: #7c3aed;

            font-size: 13px;
            font-weight: bold;

            margin-bottom: 20px;

            transition: .2s ease;
        }

        .back-button:hover {
            color: #6d28d9;
            transform: translateX(-2px);
        }


        /* =====================================================
           SECTION
        ===================================================== */

        .section {
            background: white;
            border-radius: 18px;
            padding: 28px;

            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0,0,0,.03),
                0 8px 18px rgba(0,0,0,.05),
                0 16px 35px rgba(0,0,0,.06),
                0 25px 60px rgba(124,58,237,.07);

            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 20px;
        }

        .section-header h3 {
            font-size: 19px;
            color: #172033;
        }

        .total {
            color: #6b7280;
            font-size: 13px;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            text-align: left;

            padding: 14px;

            background: #f8fafc;

            color: #64748b;

            font-size: 12px;

            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px 14px;

            font-size: 13px;

            border-bottom: 1px solid #eef2f7;

            background: white;
        }

        tbody tr:hover td {
            background: #fcfaff;
        }

        tr:last-child td {
            border-bottom: none;
        }


        /* =====================================================
           TYPE
        ===================================================== */

        .type-badge {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: bold;
        }

        .type-pc {
            background: #ede9fe;
            color: #7c3aed;
        }

        .type-server {
            background: #e0f2fe;
            color: #0284c7;
        }


        /* =====================================================
           ASSET
        ===================================================== */

        .asset-name {
            font-weight: bold;
            color: #172033;
        }

        .asset-code {
            color: #7c3aed;
            font-size: 12px;
            margin-top: 3px;
            font-weight: bold;
        }


        /* =====================================================
           DATE
        ===================================================== */

        .date {
            color: #374151;
            font-weight: 600;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: bold;
        }

        .status-completed {
            background: #dcfce7;
            color: #16a34a;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {
            text-align: center;

            padding: 35px;

            color: #6b7280;

            background: #f9fafb;

            border: 1px dashed #dbe2ea;

            border-radius: 10px;

            font-size: 14px;
        }

        .empty-icon {
            font-size: 30px;
            margin-bottom: 10px;
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

            .menu {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 15px;
            }

            .section {
                padding: 20px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside class="sidebar">

    <div class="sidebar-brand">

        <img
            src="{{ asset('images/gateway-logo.webp') }}"
            alt="Gateway Logo"
        >

        <div class="sidebar-brand-text">

            <h3>
                IT Helpdesk
            </h3>

            <p>
                Gateway IT Support
            </p>

        </div>

    </div>


    <nav class="menu">


        <a href="{{ route('it-support.dashboard') }}">

            <span class="menu-icon">
                🏠
            </span>

            <span>
                Dashboard
            </span>

        </a>


        <div class="menu-title">
            Tiket
        </div>


        <a href="{{ route('it-support.tickets') }}">

            <span class="menu-icon">
                🎫
            </span>

            <span>
                Semua Tiket
            </span>

        </a>


        <a href="{{ route('it-support.tickets.history') }}">

            <span class="menu-icon">
                📜
            </span>

            <span>
                Riwayat Tiket
            </span>

        </a>


        <div class="menu-title">
            Maintenance
        </div>


        <a href="{{ route('it-support.maintenance.pc') }}">

            <span class="menu-icon">
                💻
            </span>

            <span>
                PC Maintenance
            </span>

        </a>


        <a href="{{ route('it-support.maintenance.server') }}">

            <span class="menu-icon">
                🌐
            </span>

            <span>
                Internet / Server
            </span>

        </a>


        <a
            href="{{ route('it-support.maintenance.history') }}"
            class="active"
        >

            <span class="menu-icon">
                📋
            </span>

            <span>
                Riwayat Maintenance
            </span>

        </a>


        <div class="menu-title">
            Aset
        </div>


        <a href="#">

            <span class="menu-icon">
                💻
            </span>

            <span>
                Aset Gateway
            </span>

        </a>


        <div class="menu-title">
            Akun
        </div>


        <a href="#">

            <span class="menu-icon">
                👤
            </span>

            <span>
                Profil
            </span>

        </a>


    </nav>


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
                Riwayat Maintenance
            </h1>

            <p>
                Riwayat pekerjaan maintenance IT Gateway
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


    <!-- CONTENT -->

    <main class="container">


        <a
            href="{{ route('it-support.dashboard') }}"
            class="back-button"
        >
            ← Kembali ke Dashboard
        </a>


        <div class="welcome">

            <h2>
                📋 Riwayat Maintenance
            </h2>

            <p>
                Daftar pekerjaan maintenance yang telah dilakukan oleh IT Support.
            </p>

        </div>


        <!-- =================================================
             PC MAINTENANCE
        ================================================== -->

        <section class="section">

            <div class="section-header">

                <h3>
                    💻 PC / Asset Maintenance
                </h3>

                <span class="total">
                    Total: {{ $pcRecords->count() }} pekerjaan
                </span>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                No.
                            </th>

                            <th>
                                Aset
                            </th>

                            <th>
                                Kantor
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Dilakukan Oleh
                            </th>

                            <th>
                                Kondisi Setelah
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse($pcRecords as $record)


                            <tr>


                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <div class="asset-name">

                                        {{ $record->asset->name ?? '-' }}

                                    </div>


                                    <div class="asset-code">

                                        {{ $record->asset->asset_code ?? '-' }}

                                    </div>

                                </td>


                                <td>

                                    {{ $record->maintenanceSchedule->office->name ?? '-' }}

                                </td>


                                <td>

                                    <span class="date">

                                        {{ $record->performed_at?->format('d/m/Y H:i') ?? '-' }}

                                    </span>

                                </td>


                                <td>

                                    {{ $record->performedBy->name ?? '-' }}

                                </td>


                                <td>

                                    {{ $record->condition_after ?? '-' }}

                                </td>


                                <td>

                                    <span class="status status-completed">
                                        Selesai
                                    </span>

                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td colspan="7">

                                    <div class="empty">

                                        <div class="empty-icon">
                                            🔧
                                        </div>

                                        Belum ada riwayat PC maintenance.

                                    </div>

                                </td>

                            </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>

        </section>


        <!-- =================================================
             SERVER MAINTENANCE
        ================================================== -->

        <section class="section">

            <div class="section-header">

                <h3>
                    🌐 Internet / Server Maintenance
                </h3>

                <span class="total">
                    Total: {{ $serverRecords->count() }} pekerjaan
                </span>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                No.
                            </th>

                            <th>
                                Kantor
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Dilakukan Oleh
                            </th>

                            <th>
                                IP Address
                            </th>

                            <th>
                                Security
                            </th>

                            <th>
                                Bandwidth
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse($serverRecords as $record)


                            <tr>


                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    {{ $record->office->name ?? '-' }}

                                </td>


                                <td>

                                    <span class="date">

                                        {{ $record->maintenance_date?->format('d/m/Y') ?? '-' }}

                                    </span>

                                </td>


                                <td>

                                    {{ $record->performedBy->name ?? '-' }}

                                </td>


                                <td>

                                    {{ $record->ip_address ?? '-' }}

                                </td>


                                <td>

                                    {{ $record->security ?? '-' }}

                                </td>


                                <td>

                                    {{ $record->bandwidth ?? '-' }}

                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td colspan="7">

                                    <div class="empty">

                                        <div class="empty-icon">
                                            🌐
                                        </div>

                                        Belum ada riwayat Internet / Server maintenance.

                                    </div>

                                </td>

                            </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>

        </section>


    </main>

</div>


</body>

</html>
