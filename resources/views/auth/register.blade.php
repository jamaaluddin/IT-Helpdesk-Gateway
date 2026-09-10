<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - IT Helpdesk Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            position: relative;
            overflow-x: hidden;

            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.10), transparent 35%),
                radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.10), transparent 35%),
                #f4f7fb;
        }


        /* =========================
           CONTAINER
        ========================== */

        .register-container {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 900px;

             background: rgba(255, 255, 255, 0.90);
            border-radius: 20px;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, 0.12),
                0 5px 20px rgba(37, 99, 235, 0.06);

            overflow: hidden;
        }

        /* =========================
           HEADER
        ========================== */

        .header {
            background: linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            color: white;
            padding: 30px 40px;

            display: flex;
            align-items: center;
            gap: 18px;
        }

        .header-logo {
            width: 68px;
            height: 68px;

            object-fit: contain;

            background: rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 8px;
        }

        .header-text h1 {
            font-size: 27px;
            margin-bottom: 7px;
            letter-spacing: 0.2px;
        }

        .header-text p {
            font-size: 14px;
            opacity: 0.92;
        }

        /* =========================
           FORM
        ========================== */

        .form-container {
            padding: 35px 40px 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #374151;
        }

        input,
        select {
            width: 100%;
            padding: 13px 14px;

            border: 1px solid #d1d5db;
            border-radius: 9px;

            font-size: 14px;
            color: #374151;

            background: #fff;
            outline: none;

            transition: 0.2s ease;
        }

        input::placeholder {
            color: #9ca3af;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        input:disabled {
            background: #f3f4f6;
            color: #6b7280;
            cursor: not-allowed;
        }

        /* =========================
           INFO
        ========================== */

        .info-box {
            margin-bottom: 25px;

            padding: 15px 17px;

            background: #eff6ff;
            border: 1px solid #bfdbfe;

            border-radius: 10px;

            color: #1e40af;

            font-size: 14px;
            line-height: 1.55;
        }

        /* =========================
           ERROR
        ========================== */

        .error-box {
            margin-bottom: 20px;

            padding: 14px 16px;

            background: #fef2f2;
            border: 1px solid #fecaca;

            border-radius: 10px;

            color: #b91c1c;

            font-size: 14px;
            line-height: 1.5;
        }

        .error-box ul {
            margin-top: 7px;
            margin-left: 18px;
        }

        /* =========================
           BUTTON
        ========================== */

        .button-container {
            margin-top: 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 20px;
        }

        .login-link {
            color: #2563eb;
            text-decoration: none;

            font-size: 14px;
            font-weight: 600;

            transition: 0.2s ease;
        }

        .login-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .btn-register {
            border: none;

            background: linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            color: white;

            padding: 13px 27px;

            border-radius: 9px;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 6px 15px rgba(37, 99, 235, 0.20);

            transition: 0.2s ease;
        }

        .btn-register:hover {
            transform: translateY(-1px);

            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.28);
        }

        .required {
            color: #dc2626;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 700px) {

            body {
                padding: 18px;
            }

            .register-container {
                border-radius: 16px;
            }

            .header {
                padding: 25px;
            }

            .header-logo {
                width: 58px;
                height: 58px;
            }

            .header-text h1 {
                font-size: 22px;
            }

            .header-text p {
                font-size: 13px;
            }

            .form-container {
                padding: 25px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .form-group.full {
                grid-column: auto;
            }

            .button-container {
                flex-direction: column;
                align-items: stretch;
            }

            .login-link {
                text-align: center;
                order: 2;
            }

            .btn-register {
                width: 100%;
                order: 1;
            }

        }

        @media (max-width: 450px) {

            body {
                padding: 10px;
            }

            .header {
                padding: 22px 20px;
            }

            .header-logo {
                width: 52px;
                height: 52px;
            }

            .header-text h1 {
                font-size: 19px;
            }

            .header-text p {
                font-size: 12px;
            }

            .form-container {
                padding: 22px 20px 25px;
            }
        }
    </style>
</head>

<body>

<div class="register-container">

    <!-- HEADER -->
    <div class="header">

        <img
            src="{{ asset('images/gateway-logo.webp') }}"
            alt="Gateway Logo"
            class="header-logo"
        >

        <div class="header-text">
            <h1>IT Helpdesk Gateway</h1>
            <p>Registrasi Akun Karyawan</p>
        </div>

    </div>

    <!-- FORM -->
    <div class="form-container">

        <div class="info-box">
            Setelah melakukan registrasi, akun Anda akan berstatus
            <strong>Pending</strong> dan harus disetujui oleh Admin sebelum dapat digunakan.
        </div>

        @if ($errors->any())
            <div class="error-box">
                <strong>Terjadi kesalahan:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-grid">

                <!-- NAMA -->
                <div class="form-group">
                    <label for="name">
                        Nama Lengkap <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >
                </div>

                <!-- EMAIL -->
                <div class="form-group">
                    <label for="email">
                        Email <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@gateway.co.id"
                        required
                    >
                </div>

                <!-- NOMOR HP -->
                <div class="form-group">
                    <label for="phone">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                    >
                </div>

                <!-- OFFICE -->
                <div class="form-group">
                    <label for="office_id">
                        Office / Cabang <span class="required">*</span>
                    </label>

                    <select id="office_id" name="office_id" required>
                        <option value="">-- Pilih Office --</option>

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

                <!-- DEPARTMENT -->
                <div class="form-group">
                    <label for="department_id">
                        Department / Divisi <span class="required">*</span>
                    </label>

                    <select id="department_id" name="department_id" required>
                        <option value="">-- Pilih Department --</option>

                        @foreach ($departments as $department)
                            <option
                                value="{{ $department->id }}"
                                {{ old('department_id') == $department->id ? 'selected' : '' }}
                            >
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- ROLE -->
                <div class="form-group">
                    <label>
                        Role
                    </label>

                    <input
                        type="text"
                        value="User / Karyawan"
                        disabled
                    >
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label for="password">
                        Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                    >
                </div>

                <!-- KONFIRMASI PASSWORD -->
                <div class="form-group">
                    <label for="password_confirmation">
                        Konfirmasi Password <span class="required">*</span>
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Masukkan ulang password"
                        required
                    >
                </div>

            </div>

            <!-- BUTTON -->
            <div class="button-container">

                <a href="{{ route('login') }}" class="login-link">
                    Sudah punya akun? Login
                </a>

                <button type="submit" class="btn-register">
                    Daftar Akun
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
