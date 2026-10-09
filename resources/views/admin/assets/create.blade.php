<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Aset - IT Helpdesk Gateway</title>

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
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
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
            margin-top: 2px;
            font-size: 11px;
            color: #6b7280;
        }

        /* =========================
           CONTENT
        ========================== */

        .content {
            padding: 30px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h2 {
            font-size: 28px;
            color: #064e3b;
        }

        .page-heading p {
            margin-top: 7px;
            font-size: 14px;
            color: #6b7280;
        }

        /* =========================
           FORM CARD
        ========================== */

        .form-card {
            max-width: 1000px;
            background: white;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            padding: 25px;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .form-section-title {
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 16px;
            font-weight: 700;
            color: #065f46;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
        }

        .required {
            color: #dc2626;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
            color: #1f2937;
            font-size: 13px;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5,150,105,0.10);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .error {
            margin-top: 5px;
            font-size: 11px;
            color: #dc2626;
        }

        /* =========================
           ALERT
        ========================== */

        .alert {
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 9px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 13px;
        }

        .alert ul {
            padding-left: 18px;
        }

        /* =========================
           ACTION
        ========================== */

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 11px 18px;
            border-radius: 8px;
            border: none;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
        }

        .btn-save {
            background: #059669;
            color: white;
        }

        .btn-save:hover {
            background: #047857;
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

            .layout {
                display: block;
            }

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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }
        }

        @media (max-width: 480px) {

            .menu {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

            .form-card {
                padding: 18px;
            }

            .page-heading h2 {
                font-size: 23px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
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

    <main class="main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-left">

                <h1>
                    Asset Management
                </h1>

                <p>
                    Tambahkan aset IT baru ke dalam sistem
                </p>

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


        <!-- CONTENT -->

        <section class="content">

            <div class="page-heading">

                <h2>
                    + Tambah Aset
                </h2>

                <p>
                    Masukkan informasi aset IT yang ingin didaftarkan.
                </p>

            </div>


            @if ($errors->any())

                <div class="alert">

                    <strong>
                        Data belum dapat disimpan.
                    </strong>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="form-card">

                <form
                    action="{{ route('admin.assets.store') }}"
                    method="POST"
                >

                    @csrf


                    <!-- INFORMASI UTAMA -->

                    <div class="form-section">

                        <div class="form-section-title">
                            Informasi Utama
                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label for="asset_code">
                                    Kode Aset <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="asset_code"
                                    name="asset_code"
                                    value="{{ old('asset_code') }}"
                                    placeholder="Contoh: AST-001"
                                    required
                                >

                                @error('asset_code')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="name">
                                    Nama Aset <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Contoh: Laptop Dell Latitude"
                                    required
                                >

                                @error('name')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="asset_type_id">
                                    Jenis Aset <span class="required">*</span>
                                </label>

                                <select
                                    id="asset_type_id"
                                    name="asset_type_id"
                                    required
                                >

                                    <option value="">
                                        -- Pilih Jenis Aset --
                                    </option>

                                    @foreach ($assetTypes as $type)

                                        <option
                                            value="{{ $type->id }}"
                                            {{ old('asset_type_id') == $type->id ? 'selected' : '' }}
                                        >
                                            {{ $type->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('asset_type_id')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="brand">
                                    Merek
                                </label>

                                <input
                                    type="text"
                                    id="brand"
                                    name="brand"
                                    value="{{ old('brand') }}"
                                    placeholder="Contoh: Dell"
                                >

                            </div>


                            <div class="form-group">

                                <label for="model">
                                    Model
                                </label>

                                <input
                                    type="text"
                                    id="model"
                                    name="model"
                                    value="{{ old('model') }}"
                                    placeholder="Contoh: Latitude 5420"
                                >

                            </div>


                            <div class="form-group">

                                <label for="serial_number">
                                    Serial Number
                                </label>

                                <input
                                    type="text"
                                    id="serial_number"
                                    name="serial_number"
                                    value="{{ old('serial_number') }}"
                                    placeholder="Masukkan serial number"
                                >

                                @error('serial_number')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <!-- LOKASI -->

                    <div class="form-section">

                        <div class="form-section-title">
                            Lokasi & Penempatan
                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label for="office_id">
                                    Office <span class="required">*</span>
                                </label>

                                <select
                                    id="office_id"
                                    name="office_id"
                                    required
                                >

                                    <option value="">
                                        -- Pilih Office --
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


                            <div class="form-group">

                                <label for="department_id">
                                    Department
                                </label>

                                <select
                                    id="department_id"
                                    name="department_id"
                                >

                                    <option value="">
                                        -- Pilih Department --
                                    </option>

                                    @foreach ($departments as $department)

                                        <option
                                            value="{{ $department->id }}"
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}
                                        >
                                            {{ $department->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('department_id')
                                    <div class="error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <!-- KONDISI -->

                    <div class="form-section">

                        <div class="form-section-title">
                            Kondisi & Status
                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label for="condition">
                                    Kondisi <span class="required">*</span>
                                </label>

                                <select
                                    id="condition"
                                    name="condition"
                                    required
                                >

                                    <option value="">
                                        -- Pilih Kondisi --
                                    </option>

                                    <option
                                        value="good"
                                        {{ old('condition', 'good') === 'good' ? 'selected' : '' }}
                                    >
                                        Baik
                                    </option>

                                    <option
                                        value="minor_damage"
                                        {{ old('condition') === 'minor_damage' ? 'selected' : '' }}
                                    >
                                        Rusak Ringan
                                    </option>

                                    <option
                                        value="major_damage"
                                        {{ old('condition') === 'major_damage' ? 'selected' : '' }}
                                    >
                                        Rusak Berat
                                    </option>

                                    <option
                                        value="broken"
                                        {{ old('condition') === 'broken' ? 'selected' : '' }}
                                    >
                                        Rusak
                                    </option>

                                </select>

                            </div>


                            <div class="form-group">

                                <label for="status">
                                    Status <span class="required">*</span>
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    required
                                >

                                    <option value="">
                                        -- Pilih Status --
                                    </option>

                                    <option
                                        value="available"
                                        {{ old('status', 'available') === 'available' ? 'selected' : '' }}
                                    >
                                        Tersedia
                                    </option>

                                    <option
                                        value="in_use"
                                        {{ old('status') === 'in_use' ? 'selected' : '' }}
                                    >
                                        Digunakan
                                    </option>

                                    <option
                                        value="maintenance"
                                        {{ old('status') === 'maintenance' ? 'selected' : '' }}
                                    >
                                        Maintenance
                                    </option>

                                    <option
                                        value="damaged"
                                        {{ old('status') === 'damaged' ? 'selected' : '' }}
                                    >
                                        Rusak
                                    </option>

                                    <option
                                        value="retired"
                                        {{ old('status') === 'retired' ? 'selected' : '' }}
                                    >
                                        Tidak Digunakan
                                    </option>

                                </select>

                            </div>


                            <div class="form-group">

                                <label for="purchase_price">
                                    Harga Pembelian
                                </label>

                                <input
                                    type="number"
                                    id="purchase_price"
                                    name="purchase_price"
                                    value="{{ old('purchase_price') }}"
                                    min="0"
                                    step="0.01"
                                    placeholder="Contoh: 12500000"
                                >

                            </div>


                            <div class="form-group">

                                <label for="purchase_date">
                                    Tanggal Pembelian
                                </label>

                                <input
                                    type="date"
                                    id="purchase_date"
                                    name="purchase_date"
                                    value="{{ old('purchase_date') }}"
                                >

                            </div>


                            <div class="form-group full">

                                <label for="notes">
                                    Catatan
                                </label>

                                <textarea
                                    id="notes"
                                    name="notes"
                                    placeholder="Catatan tambahan mengenai aset..."
                                >{{ old('notes') }}</textarea>

                            </div>

                        </div>

                    </div>


                    <!-- ACTION -->

                    <div class="form-actions">

                        <a
                            href="{{ route('admin.assets.index') }}"
                            class="btn btn-cancel"
                        >
                            ← Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-save"
                        >
                            💾 Simpan Aset
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>
