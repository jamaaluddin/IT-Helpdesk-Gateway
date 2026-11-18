
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Aset - IT Support Gateway</title>

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
           CONTENT
        ========================================= */

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

        /* =========================================
           FORM CARD
        ========================================= */

        .form-card {
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

        .form-section {
            margin-bottom: 28px;
        }

        .form-section:last-of-type {
            margin-bottom: 25px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px 24px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 13px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 9px;
        }

        .required {
            color: #ef4444;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            min-height: 43px;
            padding: 11px 13px;
            border: 1px solid #dbe1ea;
            border-radius: 8px;
            background: #fff;
            color: #1f2937;
            font-family: Arial, sans-serif;
            font-size: 13px;
            outline: none;
            transition: 0.2s ease;
        }

        .form-group input:hover,
        .form-group select:hover,
        .form-group textarea:hover {
            border-color: #c4b5fd;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.10);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #9ca3af;
        }

        .form-group textarea {
            min-height: 115px;
            resize: vertical;
            line-height: 1.6;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 7px;
        }

        /* =========================================
           FORM ACTIONS
        ========================================= */

        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding-top: 22px;
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

        .btn-cancel {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
        }

        .btn-save {
            background: #7c3aed;
            color: white;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.20);
        }

        .btn-save:hover {
            background: #6d28d9;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(124, 58, 237, 0.25);
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

            .form-card {
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
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

            .form-card {
                padding: 20px 16px;
            }

            .section-heading {
                margin-bottom: 18px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- =========================================
         SIDEBAR
    ========================================= -->

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
                class="{{ request()->routeIs('it-support.assets.*') ? 'active' : '' }}"
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


    <!-- =========================================
         MAIN
    ========================================= -->

    <div class="main">

        <!-- HEADER -->

        <header class="header">

            <div class="header-title">
                <h1>Tambah Aset</h1>
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


        <!-- =========================================
             CONTENT
        ========================================= -->

        <main class="container">

            <div class="page-heading">

                <h2>Tambah Aset Baru</h2>

                <p>
                    Lengkapi informasi aset untuk menambahkannya ke inventaris Gateway.
                </p>

            </div>


            <div class="form-card">

                <form
                    action="{{ route('it-support.assets.store') }}"
                    method="POST"
                >

                    @csrf


                    <!-- INFORMASI ASET -->

                    <section class="form-section">

                        <div class="section-heading">

                            <div class="section-icon">💻</div>

                            <div>
                                <h3>Informasi Aset</h3>
                                <p>Informasi dasar dan identitas aset.</p>
                            </div>

                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label>
                                    Kategori Aset <span class="required">*</span>
                                </label>

                                <select name="asset_type_id" required>

                                    <option value="">-- Pilih Kategori --</option>

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
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>
                                    Kode Aset <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="asset_code"
                                    value="{{ old('asset_code') }}"
                                    placeholder="Contoh: ACCT-DEWI"
                                    required
                                >

                                @error('asset_code')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>
                                    Nama Aset <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Contoh: Komputer Accounting"
                                    required
                                >

                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>Merek</label>

                                <input
                                    type="text"
                                    name="brand"
                                    value="{{ old('brand') }}"
                                    placeholder="Contoh: Lenovo"
                                >

                                @error('brand')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>Model</label>

                                <input
                                    type="text"
                                    name="model"
                                    value="{{ old('model') }}"
                                    placeholder="Masukkan model aset"
                                >

                                @error('model')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>Nomor Seri</label>

                                <input
                                    type="text"
                                    name="serial_number"
                                    value="{{ old('serial_number') }}"
                                    placeholder="Masukkan nomor seri"
                                >

                                @error('serial_number')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                    </section>


                    <!-- LOKASI ASET -->

                    <section class="form-section">

                        <div class="section-heading">

                            <div class="section-icon">📍</div>

                            <div>
                                <h3>Lokasi Aset</h3>
                                <p>Informasi kantor dan departemen pengguna aset.</p>
                            </div>

                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label>
                                    Kantor <span class="required">*</span>
                                </label>

                                <select name="office_id" required>

                                    <option value="">-- Pilih Kantor --</option>

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
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>Departemen</label>

                                <select name="department_id">

                                    <option value="">-- Pilih Departemen --</option>

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
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                    </section>


                    <!-- INFORMASI PEMBELIAN -->

                    <section class="form-section">

                        <div class="section-heading">

                            <div class="section-icon">🛒</div>

                            <div>
                                <h3>Informasi Pembelian</h3>
                                <p>Data harga dan tanggal pembelian aset.</p>
                            </div>

                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label>Harga Pembelian</label>

                                <input
                                    type="number"
                                    name="purchase_price"
                                    value="{{ old('purchase_price') }}"
                                    placeholder="Contoh: 5000000"
                                    min="0"
                                    step="0.01"
                                >

                                @error('purchase_price')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>Tanggal Pembelian</label>

                                <input
                                    type="date"
                                    name="purchase_date"
                                    value="{{ old('purchase_date') }}"
                                >

                                @error('purchase_date')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                    </section>


                    <!-- KONDISI DAN STATUS -->

                    <section class="form-section">

                        <div class="section-heading">

                            <div class="section-icon">⚙️</div>

                            <div>
                                <h3>Kondisi dan Status Aset</h3>
                                <p>Tentukan kondisi fisik dan status penggunaan aset.</p>
                            </div>

                        </div>

                        <div class="form-grid">

                            <div class="form-group">

                                <label>
                                    Kondisi <span class="required">*</span>
                                </label>

                                <select name="condition" required>

                                    <option value="">-- Pilih Kondisi --</option>

                                    <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>
                                        Baik
                                    </option>

                                    <option value="minor_damage" {{ old('condition') == 'minor_damage' ? 'selected' : '' }}>
                                        Rusak Ringan
                                    </option>

                                    <option value="major_damage" {{ old('condition') == 'major_damage' ? 'selected' : '' }}>
                                        Rusak Berat
                                    </option>

                                    <option value="broken" {{ old('condition') == 'broken' ? 'selected' : '' }}>
                                        Tidak Berfungsi
                                    </option>

                                </select>

                                @error('condition')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label>
                                    Status <span class="required">*</span>
                                </label>

                                <select name="status" required>

                                    <option value="">-- Pilih Status --</option>

                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>

                                    <option value="in_use" {{ old('status') == 'in_use' ? 'selected' : '' }}>
                                        Digunakan
                                    </option>

                                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>
                                        Dalam Maintenance
                                    </option>

                                    <option value="damaged" {{ old('status') == 'damaged' ? 'selected' : '' }}>
                                        Rusak
                                    </option>

                                    <option value="retired" {{ old('status') == 'retired' ? 'selected' : '' }}>
                                        Dipensiunkan
                                    </option>

                                </select>

                                @error('status')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group full">

                                <label>Catatan</label>

                                <textarea
                                    name="notes"
                                    placeholder="Tambahkan informasi atau catatan mengenai aset ini..."
                                >{{ old('notes') }}</textarea>

                                @error('notes')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                    </section>


                    <!-- BUTTON -->

                    <div class="form-actions">

                        <a
                            href="{{ route('it-support.assets.index') }}"
                            class="btn btn-cancel"
                        >
                            ← Batal
                        </a>

                        <button type="submit" class="btn btn-save">
                            💾 Simpan Aset
                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

</body>

</html>
