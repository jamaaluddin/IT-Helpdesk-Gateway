<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Jadwal Maintenance - Admin Gateway</title>

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

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
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

        /* MAIN */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        /* TOPBAR */
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

        /* CONTENT */
        .content {
            padding: 30px;
        }

        .page-heading {
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

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            padding: 25px;
            max-width: 850px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .form-group label span {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-size: 14px;
            background: white;
            color: #374151;
            outline: none;
        }

        .form-control:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5,150,105,0.10);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .error {
            margin-top: 6px;
            font-size: 12px;
            color: #dc2626;
        }

        .info-box {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 13px 15px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 22px;
            line-height: 1.5;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #059669;
            color: white;
        }

        .btn-primary:hover {
            background: #047857;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        /* RESPONSIVE */
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

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
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

                <a href="{{ route('admin.assets.index') }}">
                    <span class="menu-icon">💻</span>
                    <span>Asset Management</span>
                </a>

                <a
                    href="{{ route('admin.maintenance.schedules.index') }}"
                    class="active"
                >
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
                    Jadwal Maintenance
                </h2>

                <p>
                    Buat jadwal maintenance aset IT Gateway
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

                <h1>
                    🔧 Buat Jadwal Maintenance
                </h1>

                <p>
                    Tentukan aset dan tanggal maintenance yang akan dilakukan.
                </p>

            </div>


            <div class="card">

                <div class="info-box">
                    Maintenance rutin PC umumnya dilakukan dalam 1 hari kerja.
                    Jika kondisi aset membutuhkan pemeriksaan atau perbaikan
                    lebih lanjut, periode maintenance dapat diperpanjang sesuai kebutuhan.
                </div>


                <form
                    action="{{ route('admin.maintenance.schedules.store') }}"
                    method="POST"
                >

                    @csrf


                    <!-- ASET -->
                    <div class="form-group">

                        <label for="asset_id">
                            Aset <span>*</span>
                        </label>

                        <select
                            name="asset_id"
                            id="asset_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                -- Pilih Aset --
                            </option>

                            @foreach ($assets as $asset)

                                <option
                                    value="{{ $asset->id }}"
                                    {{ old('asset_id') == $asset->id ? 'selected' : '' }}
                                >
                                    {{ $asset->asset_code }} -
                                    {{ $asset->name }}
                                    @if ($asset->assetType)
                                        ({{ $asset->assetType->name }})
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        @error('asset_id')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- KANTOR -->
                    <div class="form-group">

                        <label for="office_id">
                            Lokasi / Kantor <span>*</span>
                        </label>

                        <select
                            name="office_id"
                            id="office_id"
                            class="form-control"
                            required
                        >

                            <option value="">
                                -- Pilih Kantor --
                            </option>

                            @foreach ($offices as $office)

                                <option
                                    value="{{ $office->id }}"
                                    {{ old('office_id') == $office->id ? 'selected' : '' }}
                                >
                                    {{ $office->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('office_id')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- TANGGAL -->
                    <div class="form-group">

                        <label for="scheduled_date">
                            Tanggal Maintenance <span>*</span>
                        </label>

                        <input
                            type="date"
                            name="scheduled_date"
                            id="scheduled_date"
                            class="form-control"
                            value="{{ old('scheduled_date') }}"
                            required
                        >

                        @error('scheduled_date')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- CATATAN -->
                    <div class="form-group">

                        <label for="remarks">
                            Catatan / Keterangan
                        </label>

                        <textarea
                            name="remarks"
                            id="remarks"
                            class="form-control"
                            placeholder="Contoh: Maintenance rutin komputer..."
                        >{{ old('remarks') }}</textarea>

                        @error('remarks')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- ACTION -->
                    <div class="form-actions">

                        <a
                            href="{{ route('admin.maintenance.schedules.index') }}"
                            class="btn btn-secondary"
                        >
                            ← Kembali
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            🔧 Simpan Jadwal
                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

</div>

</body>
</html>
