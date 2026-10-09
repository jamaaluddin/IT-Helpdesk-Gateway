<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Jadwal Maintenance - Gateway</title>

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


        /* =========================================
           SIDEBAR
        ========================================= */

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

        .submenu {
            display: flex;
            flex-direction: column;
            gap: 3px;
            margin-left: 15px;
        }

        .submenu a {
            font-size: 13px;
            padding: 9px 12px;
            color: #ddd6fe;
        }

        .submenu a:hover {
            background: #6d28d9;
            color: white;
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
                transform 0.2s ease,
                background 0.2s ease,
                box-shadow 0.2s ease;

            box-shadow:
                0 4px 10px rgba(124, 58, 237, 0.25);
        }

        .sidebar-logout button:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }


        /* =========================================
           HEADER
        ========================================= */

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


        /* =========================================
           CONTAINER
        ========================================= */

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 30px;
        }


        /* =========================================
           PAGE TITLE
        ========================================= */

        .page-heading {
            margin-bottom: 27px;
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


        /* =========================================
           BACK BUTTON
        ========================================= */

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-top: 15px;

            background: #ede9fe;
            color: #7c3aed;

            text-decoration: none;

            padding: 10px 15px;

            border-radius: 9px;

            font-size: 13px;
            font-weight: bold;

            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }

        .back-button:hover {
            background: #ddd6fe;
            transform: translateY(-2px);
        }


        /* =========================================
           SECTION / CARD
        ========================================= */

        .section {
            background: white;
            border-radius: 18px;
            padding: 28px;
            border: 1px solid #eef2f7;

            box-shadow:
                0 3px 7px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 16px 35px rgba(0, 0, 0, 0.06),
                0 25px 60px rgba(124, 58, 237, 0.07);

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

        .section-header span {
            color: #6b7280;
            font-size: 13px;
        }


        /* =========================================
           TABLE
        ========================================= */

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


        /* =========================================
           ASSET
        ========================================= */

        .asset-name {
            font-weight: bold;
            color: #172033;
            margin-bottom: 4px;
        }

        .asset-code {
            color: #7c3aed;
            font-size: 12px;
            font-weight: bold;
        }


        /* =========================================
           STATUS BADGES
        ========================================= */

        .badge {
            display: inline-block;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: bold;

            white-space: nowrap;
        }

        .badge-scheduled {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-completed {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-rescheduled {
            background: #e0f2fe;
            color: #0284c7;
        }

        .badge-default {
            background: #f3f4f6;
            color: #6b7280;
        }


        /* =========================================
           DETAIL BUTTON
        ========================================= */

        .detail-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 38px;

            padding: 8px 15px;

            background: #7c3aed;
            color: white;

            border-radius: 9px;

            text-decoration: none;

            font-size: 12px;
            font-weight: bold;

            box-shadow:
                0 4px 9px rgba(124, 58, 237, 0.18);

            transition:
                background 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .detail-button:hover {
            background: #6d28d9;

            transform: translateY(-2px);

            box-shadow:
                0 7px 15px rgba(124, 58, 237, 0.25);
        }


        /* =========================================
           EMPTY
        ========================================= */

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
            font-size: 35px;
            margin-bottom: 10px;
        }

        .empty h3 {
            color: #374151;
            margin-bottom: 6px;
            font-size: 17px;
        }

        .empty p {
            font-size: 13px;
        }



        /* =========================================
           FORM
        ========================================= */

        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .error-box ul {
            margin: 8px 0 0 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%;
            border: 1px solid #dbe2ea;
            border-radius: 9px;
            padding: 12px 13px;
            font-size: 14px;
            color: #1f2937;
            background: white;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-group select:focus,
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124,58,237,0.1);
        }

        .form-group textarea {
            min-height: 110px;
            resize: vertical;
        }

        .asset-info {
            margin-top: 8px;
            padding: 10px 12px;
            background: #f5f3ff;
            border-left: 4px solid #7c3aed;
            border-radius: 7px;
            font-size: 12px;
            color: #5b21b6;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eef2f7;
        }

        .btn-submit,
        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 8px 15px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-submit {
            border: none;
            background: #7c3aed;
            color: white;
            cursor: pointer;
            box-shadow: 0 4px 9px rgba(124, 58, 237, 0.18);
        }

        .btn-submit:hover {
            background: #6d28d9;
            transform: translateY(-2px);
            box-shadow: 0 7px 15px rgba(124, 58, 237, 0.25);
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

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

            .header {
                position: relative;
            }

            .sidebar-logout {
                margin-top: 15px;
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

            .section {
                padding: 20px;
            }

        }
    </style>
</head>

<body>

<!-- =====================================================
     SIDEBAR IT SUPPORT
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


        <a
            href="{{ route('it-support.maintenance.pc') }}"
            class="active"
        >

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


<div class="main">

    <!-- HEADER -->
    <header class="header">

        <div class="header-title">
            <h1>
                Buat Jadwal Maintenance
            </h1>

            <p>
                IT Helpdesk Management System
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

        <!-- PAGE TITLE -->
        <div class="page-heading">

            <h2>
                🔧 Buat Jadwal Maintenance
            </h2>

            <p>
                Tentukan aset dan tanggal untuk maintenance.
            </p>

            <a
                href="{{ route('it-support.maintenance.pc') }}"
                class="back-button"
            >
                ← Kembali ke PC Maintenance
            </a>

        </div>

        <section class="section">

                <div class="section-header">
                    <h3>Informasi Jadwal Maintenance</h3>
                </div>

                <div class="section-body">

                    @if($errors->any())
                        <div class="error-box">

                            <strong>Periksa kembali data yang diisi:</strong>

                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif


                    <form
                        action="{{ route('it-support.maintenance.schedules.store') }}"
                        method="POST"
                    >

                        @csrf


                        <!-- ASSET -->
                        <div class="form-group">

                            <label for="asset_id">
                                Aset yang Akan Di-maintenance
                            </label>

                            <select
                                id="asset_id"
                                name="asset_id"
                                required
                            >

                                <option value="">
                                    -- Pilih Aset --
                                </option>

                                @foreach($assets as $asset)

                                    <option
                                        value="{{ $asset->id }}"
                                        {{ old('asset_id') == $asset->id ? 'selected' : '' }}
                                    >
                                        {{ $asset->name }}
                                        -
                                        {{ $asset->asset_code }}
                                    </option>

                                @endforeach

                            </select>

                            <div class="asset-info">
                                Pilih perangkat yang akan dilakukan maintenance.
                            </div>

                        </div>


                        <!-- OFFICE -->
                        <div class="form-group">

                            <label for="office_id">
                                Kantor / Lokasi
                            </label>

                            <select
                                id="office_id"
                                name="office_id"
                                required
                            >

                                <option value="">
                                    -- Pilih Kantor --
                                </option>

                                @foreach($offices as $office)

                                    <option
                                        value="{{ $office->id }}"
                                        {{ old('office_id') == $office->id ? 'selected' : '' }}
                                    >
                                        {{ $office->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- DATE -->
                        <div class="form-group">

                            <label for="scheduled_date">
                                Tanggal Maintenance
                            </label>

                            <input
                                type="date"
                                id="scheduled_date"
                                name="scheduled_date"
                                value="{{ old('scheduled_date') }}"
                                required
                            >

                        </div>


                        <!-- REMARKS -->
                        <div class="form-group">

                            <label for="remarks">
                                Catatan / Keterangan
                            </label>

                            <textarea
                                id="remarks"
                                name="remarks"
                                placeholder="Contoh: Maintenance rutin komputer user, pengecekan hardware, dan pembersihan perangkat..."
                            >{{ old('remarks') }}</textarea>

                        </div>


                        <div class="actions">

                            <button
                                type="submit"
                                class="btn-submit"
                            >
                                💾 Simpan Jadwal
                            </button>

                            <a
                                href="{{ route('it-support.maintenance.schedules.index') }}"
                                class="btn-cancel"
                            >
                                Batal
                            </a>

                        </div>

                    </form>

                </div>

            </section>

    </main>

</div>


</body>
</html>
