<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Aset - Admin Gateway</title>

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

        /* FORM CARD */

        .form-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            padding: 28px;
            max-width: 1000px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 13px;
            font-family: Arial, sans-serif;
            background: white;
            color: #1f2937;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5,150,105,0.10);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            border: none;
            padding: 11px 18px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
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
                gap: 12px;
                flex-direction: column;
            }

            .admin-info {
                width: 100%;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .form-card {
                padding: 20px;
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

    <div class="main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-left">

                <h2>
                    Edit Aset
                </h2>

                <p>
                    Perbarui informasi aset IT Gateway
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
                    Edit Aset
                </h1>

                <p>
                    Ubah informasi aset: {{ $asset->name }}
                </p>

            </div>


            <!-- FORM -->

            <div class="form-card">

                <form
                    action="{{ route('admin.assets.update', $asset) }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <!-- KODE ASET -->

                        <div class="form-group">

                            <label for="asset_code">
                                Kode Aset
                            </label>

                            <input
                                type="text"
                                id="asset_code"
                                name="asset_code"
                                value="{{ old('asset_code', $asset->asset_code) }}"
                                required
                            >

                            @error('asset_code')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- NAMA -->

                        <div class="form-group">

                            <label for="name">
                                Nama Aset
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $asset->name) }}"
                                required
                            >

                            @error('name')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- JENIS -->

                        <div class="form-group">

                            <label for="asset_type_id">
                                Jenis Aset
                            </label>

                            <select
                                id="asset_type_id"
                                name="asset_type_id"
                                required
                            >

                                @foreach ($assetTypes as $type)

                                    <option
                                        value="{{ $type->id }}"
                                        {{ old('asset_type_id', $asset->asset_type_id) == $type->id ? 'selected' : '' }}
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


                        <!-- MEREK -->

                        <div class="form-group">

                            <label for="brand">
                                Merek
                            </label>

                            <input
                                type="text"
                                id="brand"
                                name="brand"
                                value="{{ old('brand', $asset->brand) }}"
                            >

                            @error('brand')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- MODEL -->

                        <div class="form-group">

                            <label for="model">
                                Model
                            </label>

                            <input
                                type="text"
                                id="model"
                                name="model"
                                value="{{ old('model', $asset->model) }}"
                            >

                            @error('model')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- SERIAL NUMBER -->

                        <div class="form-group">

                            <label for="serial_number">
                                Serial Number
                            </label>

                            <input
                                type="text"
                                id="serial_number"
                                name="serial_number"
                                value="{{ old('serial_number', $asset->serial_number) }}"
                            >

                            @error('serial_number')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- OFFICE -->

                        <div class="form-group">

                            <label for="office_id">
                                Lokasi / Office
                            </label>

                            <select
                                id="office_id"
                                name="office_id"
                                required
                            >

                                @foreach ($offices as $office)

                                    <option
                                        value="{{ $office->id }}"
                                        {{ old('office_id', $asset->office_id) == $office->id ? 'selected' : '' }}
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


                        <!-- DEPARTMENT -->

                        <div class="form-group">

                            <label for="department_id">
                                Departemen
                            </label>

                            <select
                                id="department_id"
                                name="department_id"
                            >

                                <option value="">
                                    -- Tidak ada departemen --
                                </option>

                                @foreach ($departments as $department)

                                    <option
                                        value="{{ $department->id }}"
                                        {{ old('department_id', $asset->department_id) == $department->id ? 'selected' : '' }}
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


                        <!-- HARGA -->

                        <div class="form-group">

                            <label for="purchase_price">
                                Harga Pembelian
                            </label>

                            <input
                                type="number"
                                id="purchase_price"
                                name="purchase_price"
                                value="{{ old('purchase_price', $asset->purchase_price) }}"
                                min="0"
                            >

                            @error('purchase_price')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- TANGGAL -->

                        <div class="form-group">

                            <label for="purchase_date">
                                Tanggal Pembelian
                            </label>

                            <input
                                type="date"
                                id="purchase_date"
                                name="purchase_date"
                                value="{{ old('purchase_date', $asset->purchase_date ? $asset->purchase_date->format('Y-m-d') : '') }}"
                            >

                            @error('purchase_date')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- KONDISI -->

                        <div class="form-group">

                            <label for="condition">
                                Kondisi
                            </label>

                            <select
                                id="condition"
                                name="condition"
                                required
                            >

                                <option
                                    value="good"
                                    {{ old('condition', $asset->condition) === 'good' ? 'selected' : '' }}
                                >
                                    Baik
                                </option>

                                <option
                                    value="minor_damage"
                                    {{ old('condition', $asset->condition) === 'minor_damage' ? 'selected' : '' }}
                                >
                                    Rusak Ringan
                                </option>

                                <option
                                    value="major_damage"
                                    {{ old('condition', $asset->condition) === 'major_damage' ? 'selected' : '' }}
                                >
                                    Rusak Berat
                                </option>

                                <option
                                    value="broken"
                                    {{ old('condition', $asset->condition) === 'broken' ? 'selected' : '' }}
                                >
                                    Rusak
                                </option>

                            </select>

                            @error('condition')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- STATUS -->

                        <div class="form-group">

                            <label for="status">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                            >

                                <option
                                    value="available"
                                    {{ old('status', $asset->status) === 'available' ? 'selected' : '' }}
                                >
                                    Tersedia
                                </option>

                                <option
                                    value="in_use"
                                    {{ old('status', $asset->status) === 'in_use' ? 'selected' : '' }}
                                >
                                    Digunakan
                                </option>

                                <option
                                    value="maintenance"
                                    {{ old('status', $asset->status) === 'maintenance' ? 'selected' : '' }}
                                >
                                    Maintenance
                                </option>

                                <option
                                    value="damaged"
                                    {{ old('status', $asset->status) === 'damaged' ? 'selected' : '' }}
                                >
                                    Rusak
                                </option>

                                <option
                                    value="retired"
                                    {{ old('status', $asset->status) === 'retired' ? 'selected' : '' }}
                                >
                                    Tidak Digunakan
                                </option>

                            </select>

                            @error('status')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- CATATAN -->

                        <div class="form-group full">

                            <label for="notes">
                                Catatan
                            </label>

                            <textarea
                                id="notes"
                                name="notes"
                            >{{ old('notes', $asset->notes) }}</textarea>

                            @error('notes')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <!-- ACTION -->

                    <div class="form-actions">

                        <a
                            href="{{ route('admin.assets.show', $asset) }}"
                            class="btn btn-cancel"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-save"
                        >
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

</div>

</body>
</html>
