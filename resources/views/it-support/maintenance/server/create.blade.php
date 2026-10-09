<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Internet / Server Maintenance - Gateway</title>

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
        }

        .sidebar-logout button:hover {
            background: #6d28d9;
        }

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eef2f7;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .05);
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

        .container {
            max-width: 1000px;
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

        .form-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            border: 1px solid #eef2f7;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        }

        .form-section {
            margin-bottom: 28px;
        }

        .form-section:last-child {
            margin-bottom: 0;
        }

        .form-section h3 {
            font-size: 17px;
            color: #172033;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eef2f7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: bold;
            color: #374151;
        }

        .required {
            color: #dc2626;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #dbe2ea;
            border-radius: 10px;
            padding: 12px 13px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #1f2937;
            background: white;
            outline: none;
            transition: border .2s ease, box-shadow .2s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, .10);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        .hint {
            color: #6b7280;
            font-size: 12px;
            line-height: 1.5;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
        }

        .alert {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #eef2f7;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 11px 22px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        .btn-primary {
            background: #7c3aed;
            color: white;
            box-shadow: 0 4px 10px rgba(124, 58, 237, .20);
        }

        .btn-primary:hover {
            background: #6d28d9;
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

            .form-card {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
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

        <a href="{{ route('it-support.dashboard') }}">
            <span class="menu-icon">🏠</span>
            <span>Dashboard</span>
        </a>


        <div class="menu-title">
            Tiket
        </div>


        <a href="{{ route('it-support.tickets') }}">
            <span class="menu-icon">🎫</span>
            <span>Semua Tiket</span>
        </a>


        <a href="{{ route('it-support.tickets.history') }}">
            <span class="menu-icon">📜</span>
            <span>Riwayat Tiket</span>
        </a>


        <div class="menu-title">
            Maintenance
        </div>


        <a href="{{ route('it-support.maintenance.pc') }}">
            <span class="menu-icon">💻</span>
            <span>PC Maintenance</span>
        </a>


        <a
            href="{{ route('it-support.maintenance.server') }}"
            class="active"
        >
            <span class="menu-icon">🌐</span>
            <span>Internet / Server</span>
        </a>


        <a href="{{ route('it-support.maintenance.history') }}">
            <span class="menu-icon">📋</span>
            <span>Riwayat Maintenance</span>
        </a>


        <div class="menu-title">
            Aset
        </div>


        <a href="#">
            <span class="menu-icon">💻</span>
            <span>Aset Gateway</span>
        </a>


        <div class="menu-title">
            Akun
        </div>


        <a href="#">
            <span class="menu-icon">👤</span>
            <span>Profil</span>
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


<div class="main">

    <header class="header">

        <div class="header-title">

            <h1>
                Input Internet / Server Maintenance
            </h1>

            <p>
                Catat hasil pekerjaan maintenance jaringan dan server
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


    <main class="container">

        <a
            href="{{ route('it-support.maintenance.server') }}"
            class="back-button"
        >
            ← Kembali ke Internet / Server
        </a>


        <div class="welcome">

            <h2>
                🌐 Form Maintenance
            </h2>

            <p>
                Isi data pekerjaan maintenance Internet atau Server
                yang telah dilakukan.
            </p>

        </div>


        @if ($errors->any())

            <div class="alert">

                <strong>
                    Terdapat kesalahan pada data yang dimasukkan.
                </strong>

                <ul style="margin: 8px 0 0 18px;">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('it-support.maintenance.server.store') }}"
            method="POST"
            class="form-card"
        >

            @csrf


            <!-- INFORMASI UTAMA -->

            <div class="form-section">

                <h3>
                    Informasi Maintenance
                </h3>


                <div class="form-grid">


                    <div class="form-group">

                        <label for="office_id">
                            Kantor <span class="required">*</span>
                        </label>


                        <select
                            name="office_id"
                            id="office_id"
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

                    </div>


                    <div class="form-group">

                        <label for="maintenance_date">
                            Tanggal Maintenance
                            <span class="required">*</span>
                        </label>


                        <input
                            type="date"
                            name="maintenance_date"
                            id="maintenance_date"
                            value="{{ old('maintenance_date', date('Y-m-d')) }}"
                            required
                        >

                    </div>


                </div>

            </div>


            <!-- DETAIL JARINGAN -->

            <div class="form-section">

                <h3>
                    Detail Internet / Server
                </h3>


                <div class="form-grid">


                    <div class="form-group">

                        <label for="ip_address">
                            IP Address
                        </label>


                        <input
                            type="text"
                            name="ip_address"
                            id="ip_address"
                            value="{{ old('ip_address') }}"
                            placeholder="Contoh: 192.168.1.1"
                        >

                    </div>


                    <div class="form-group">

                        <label for="security">
                            Security
                        </label>


                        <input
                            type="text"
                            name="security"
                            id="security"
                            value="{{ old('security') }}"
                            placeholder="Contoh: Firewall aktif"
                        >

                    </div>


                    <div class="form-group full">

                        <label for="bandwidth">
                            Bandwidth
                        </label>


                        <input
                            type="text"
                            name="bandwidth"
                            id="bandwidth"
                            value="{{ old('bandwidth') }}"
                            placeholder="Contoh: 100 Mbps"
                        >

                    </div>


                </div>

            </div>


            <!-- HASIL -->

            <div class="form-section">

                <h3>
                    Hasil Maintenance
                </h3>


                <div class="form-grid">


                    <div class="form-group full">

                        <label for="result">
                            Hasil Maintenance
                        </label>


                        <textarea
                            name="result"
                            id="result"
                            placeholder="Tuliskan hasil maintenance yang dilakukan..."
                        >{{ old('result') }}</textarea>

                    </div>


                    <div class="form-group full">

                        <label for="remarks">
                            Catatan
                        </label>


                        <textarea
                            name="remarks"
                            id="remarks"
                            placeholder="Tambahkan catatan jika diperlukan..."
                        >{{ old('remarks') }}</textarea>

                    </div>


                </div>

            </div>


            <!-- ACTION -->

            <div class="form-actions">

                <a
                    href="{{ route('it-support.maintenance.server') }}"
                    class="btn btn-cancel"
                >
                    Batal
                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    💾 Simpan Laporan
                </button>

            </div>

        </form>

    </main>

</div>

</body>
</html>
