<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Internet / Server Maintenance - Gateway</title>

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

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #4c1d95;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 18px;
            color: white;
            overflow-y: auto;
            z-index: 100;
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
            transition: .2s ease;
            box-shadow: 0 4px 10px rgba(124, 58, 237, .25);
        }

        .sidebar-logout button:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }


        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }


        /* =========================
           HEADER
        ========================= */

        .header {
            background: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eef2f7;
            box-shadow:
                0 3px 8px rgba(0, 0, 0, .04),
                0 8px 20px rgba(0, 0, 0, .06),
                0 18px 40px rgba(124, 58, 237, .07);
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


        /* =========================
           CONTENT
        ========================= */

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 30px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #7c3aed;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 24px;
        }

        .back-button:hover {
            color: #5b21b6;
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
            line-height: 1.6;
        }


        /* =========================
           SECTION
        ========================= */

        .section {
            background: white;
            border-radius: 18px;
            padding: 28px;
            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, .03),
                0 8px 18px rgba(0, 0, 0, .05),
                0 16px 35px rgba(0, 0, 0, .06),
                0 25px 60px rgba(124, 58, 237, .07);

            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title h3 {
            font-size: 19px;
            color: #172033;
        }

        .total {
            color: #7c3aed;
            background: #ede9fe;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }


        /* =========================
           BUTTON
        ========================= */

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: #7c3aed;
            color: white;

            text-decoration: none;

            padding: 11px 20px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: bold;

            white-space: nowrap;

            box-shadow:
                0 4px 9px rgba(124, 58, 237, .22),
                0 10px 20px rgba(124, 58, 237, .13);

            transition:
                transform .2s ease,
                background .2s ease,
                box-shadow .2s ease;
        }

        .btn-primary:hover {
            background: #6d28d9;
            color: white;
            transform: translateY(-2px);

            box-shadow:
                0 5px 12px rgba(124, 58, 237, .25),
                0 12px 24px rgba(124, 58, 237, .15);
        }


        /* =========================
           TABLE
        ========================= */

        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
        }

        th {
            text-align: left;
            padding: 14px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        td {
            padding: 16px 14px;
            font-size: 13px;
            border-bottom: 1px solid #eef2f7;
            background: white;
            vertical-align: top;
        }

        tbody tr:hover td {
            background: #fcfaff;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .office-name {
            font-weight: bold;
            color: #1f2937;
        }

        .date {
            white-space: nowrap;
        }


        /* =========================
           EMPTY
        ========================= */

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
            font-size: 32px;
            margin-bottom: 12px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

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


        @media (max-width: 600px) {

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .section-title {
                width: 100%;
                justify-content: space-between;
            }

            .btn-primary {
                width: 100%;
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
                padding: 18px;
            }

            .section-title {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

        }

    </style>

</head>


<body>


<!-- =========================
     SIDEBAR
========================= -->

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


        <!-- DASHBOARD -->

        <a href="{{ route('it-support.dashboard') }}">

            <span class="menu-icon">
                🏠
            </span>

            <span>
                Dashboard
            </span>

        </a>


        <!-- TIKET -->

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


        <!-- MAINTENANCE -->

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


        <a
            href="{{ route('it-support.maintenance.server') }}"
            class="active"
        >

            <span class="menu-icon">
                🌐
            </span>

            <span>
                Internet / Server
            </span>

        </a>


        <a href="{{ route('it-support.maintenance.history') }}">

            <span class="menu-icon">
                📋
            </span>

            <span>
                Riwayat Maintenance
            </span>

        </a>


        <!-- ASET -->

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


        <!-- AKUN -->

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



<!-- =========================
     MAIN
========================= -->

<div class="main">


    <!-- HEADER -->

    <header class="header">

        <div class="header-title">

            <h1>
                Internet / Server Maintenance
            </h1>

            <p>
                Daftar laporan maintenance jaringan dan server IT Gateway
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


        <!-- BACK -->

        <a
            href="{{ route('it-support.dashboard') }}"
            class="back-button"
        >

            ← Kembali ke Dashboard

        </a>



        <!-- PAGE TITLE -->

        <div class="welcome">

            <h2>
                🌐 Internet / Server Maintenance
            </h2>

            <p>
                Lihat laporan pekerjaan maintenance Internet dan Server
                yang telah dicatat oleh IT Support.
            </p>

        </div>



        <!-- TABLE CARD -->

        <section class="section">


            <!-- SECTION HEADER -->

            <div class="section-header">


                <div class="section-title">

                    <h3>
                        Daftar Maintenance
                    </h3>


                    <span class="total">

                        Total:
                        {{ $serverMaintenances->count() }}
                        laporan

                    </span>

                </div>


                <a
                    href="{{ route('it-support.maintenance.server.create') }}"
                    class="btn-primary"
                >

                    + Buat Laporan

                </a>


            </div>



            <!-- TABLE -->

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

                            <th>
                                Hasil
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        @forelse($serverMaintenances as $maintenance)

                            <tr>


                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <div class="office-name">

                                        {{ $maintenance->office->name ?? '-' }}

                                    </div>

                                </td>


                                <td>

                                    <span class="date">

                                        {{ $maintenance->maintenance_date?->format('d/m/Y') ?? '-' }}

                                    </span>

                                </td>


                                <td>

                                    {{ $maintenance->performedBy->name ?? '-' }}

                                </td>


                                <td>

                                    {{ $maintenance->ip_address ?? '-' }}

                                </td>


                                <td>

                                    {{ $maintenance->security ?? '-' }}

                                </td>


                                <td>

                                    {{ $maintenance->bandwidth ?? '-' }}

                                </td>


                                <td>

                                    {{ $maintenance->result ?? '-' }}

                                </td>


                            </tr>


                        @empty

                            <tr>

                                <td colspan="8">

                                    <div class="empty">

                                        <div class="empty-icon">
                                            🌐
                                        </div>

                                        Belum ada laporan
                                        Internet / Server Maintenance.

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
