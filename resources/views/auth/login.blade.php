<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - IT Helpdesk Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(59, 130, 246, 0.10), transparent 35%),
                radial-gradient(circle at bottom right, rgba(37, 99, 235, 0.10), transparent 35%),
                #f5f8ff;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        /* =========================
           LOGO WATERMARK BACKGROUND
        ========================= */

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;

            transform: translate(-50%, -50%);

            width: min(850px, 85vw);

            opacity: 0.055;

            z-index: 0;

            pointer-events: none;

            filter: grayscale(20%);
        }

        .watermark img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Decorative background */

        .circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .circle.one {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -100px;
            background: rgba(37, 99, 235, 0.07);
        }

        .circle.two {
            width: 400px;
            height: 400px;
            bottom: -220px;
            right: -120px;
            background: rgba(37, 99, 235, 0.06);
        }

        /* =========================
           LOGIN CONTAINER
        ========================= */

        .login-container {
            width: 100%;
            max-width: 470px;

            background: rgba(255, 255, 255, 0.97);

            border-radius: 20px;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, 0.12),
                0 5px 15px rgba(37, 99, 235, 0.05);

            overflow: hidden;

            position: relative;
            z-index: 2;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            background: linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            color: white;

            padding: 30px 35px;

            text-align: center;

            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.08);

            top: -130px;
            left: -70px;
        }

        .header::after {
            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.06);

            bottom: -180px;
            right: -80px;
        }

        .logo {
            width: 230px;
            max-width: 75%;

            height: auto;

            display: block;

            margin: 0 auto 18px;

            position: relative;
            z-index: 2;

            background: white;

            padding: 6px 10px;

            border-radius: 8px;

            object-fit: contain;
        }

        .header h1 {
            font-size: 25px;

            margin-bottom: 7px;

            font-weight: 700;

            position: relative;
            z-index: 2;
        }

        .header p {
            font-size: 14px;

            opacity: 0.9;

            position: relative;
            z-index: 2;
        }

        /* =========================
           FORM
        ========================= */

        .form-container {
            padding: 35px 40px 38px;
        }

        .welcome {
            text-align: center;

            margin-bottom: 25px;
        }

        .welcome h2 {
            color: #172554;

            font-size: 21px;

            margin-bottom: 7px;
        }

        .welcome p {
            color: #64748b;

            font-size: 13px;
        }

        /* =========================
           ALERT
        ========================= */

        .success-box {
            margin-bottom: 20px;

            padding: 13px 15px;

            background: #ecfdf5;

            border: 1px solid #a7f3d0;

            border-radius: 10px;

            color: #047857;

            font-size: 13px;

            line-height: 1.5;
        }

        .error-box {
            margin-bottom: 20px;

            padding: 13px 15px;

            background: #fef2f2;

            border: 1px solid #fecaca;

            border-radius: 10px;

            color: #b91c1c;

            font-size: 13px;

            line-height: 1.5;
        }

        /* =========================
           INPUT
        ========================= */

        .form-group {
            display: flex;

            flex-direction: column;

            margin-bottom: 20px;
        }

        label {
            font-size: 13px;

            font-weight: 700;

            margin-bottom: 8px;

            color: #1e3a8a;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 14px;
            top: 50%;

            transform: translateY(-50%);

            color: #64748b;

            font-size: 16px;

            pointer-events: none;
        }

        input {
            width: 100%;

            padding: 13px 14px 13px 42px;

            border: 1px solid #d7dfec;

            border-radius: 10px;

            font-size: 14px;

            outline: none;

            background: #fbfdff;

            color: #1e293b;

            transition: 0.2s;
        }

        input::placeholder {
            color: #94a3b8;
        }

        input:focus {
            border-color: #2563eb;

            background: white;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        /* =========================
           BUTTON
        ========================= */

        .btn-login {
            width: 100%;

            border: none;

            background: linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            color: white;

            padding: 14px 20px;

            border-radius: 10px;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            margin-top: 5px;

            box-shadow:
                0 8px 18px rgba(37, 99, 235, 0.20);

            transition: 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-1px);

            box-shadow:
                0 10px 22px rgba(37, 99, 235, 0.28);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* =========================
           REGISTER LINK
        ========================= */

        .register-link {
            display: block;

            text-align: center;

            margin-top: 22px;

            color: #2563eb;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .required {
            color: #dc2626;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer-text {
            text-align: center;

            margin-top: 24px;

            font-size: 11px;

            color: #94a3b8;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 500px) {

            body {
                padding: 18px;
            }

            .login-container {
                border-radius: 17px;
            }

            .header {
                padding: 25px 25px;
            }

            .logo {
                width: 190px;

                margin-bottom: 15px;
            }

            .header h1 {
                font-size: 21px;
            }

            .header p {
                font-size: 13px;
            }

            .form-container {
                padding: 28px 25px 30px;
            }

            .welcome h2 {
                font-size: 19px;
            }

            .watermark {
                width: 700px;

                opacity: 0.045;
            }
        }
    </style>
</head>

<body>

<!-- LOGO BESAR TRANSPARAN DI BELAKANG -->
<div class="watermark">
    <img
        src="{{ asset('images/gateway-logo.webp') }}"
        alt=""
    >
</div>

<!-- BACKGROUND DECORATION -->
<div class="circle one"></div>
<div class="circle two"></div>


<!-- LOGIN CARD -->
<div class="login-container">

    <!-- HEADER -->
    <div class="header">

        <img
            src="{{ asset('images/gateway-logo.webp') }}"
            alt="Gateway Global Standard Service"
            class="logo"
        >

        <h1>IT Helpdesk Gateway</h1>

        <p>Login ke Sistem Helpdesk</p>

    </div>


    <!-- FORM -->
    <div class="form-container">

        <div class="welcome">

            <h2>Selamat Datang 👋</h2>

            <p>
                Silakan login untuk mengakses sistem IT Helpdesk.
            </p>

        </div>


        @if (session('success'))

            <div class="success-box">
                {{ session('success') }}
            </div>

        @endif


        @if ($errors->any())

            <div class="error-box">
                {{ $errors->first() }}
            </div>

        @endif


        <form action="{{ route('login.process') }}" method="POST">

            @csrf


            <!-- EMAIL -->
            <div class="form-group">

                <label for="email">
                    Email <span class="required">*</span>
                </label>

                <div class="input-wrapper">

                    <span class="input-icon">✉</span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@gateway.co.id"
                        required
                    >

                </div>

            </div>


            <!-- PASSWORD -->
            <div class="form-group">

                <label for="password">
                    Password <span class="required">*</span>
                </label>

                <div class="input-wrapper">

                    <span class="input-icon">🔒</span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                </div>

            </div>


            <!-- LOGIN BUTTON -->
            <button type="submit" class="btn-login">
                Login →
            </button>

        </form>


        <!-- REGISTER -->
        <a
            href="{{ route('register') }}"
            class="register-link"
        >
            Belum punya akun? Daftar di sini
        </a>


        <div class="footer-text">
            IT Helpdesk Gateway · Internal System
        </div>

    </div>

</div>

</body>
</html>
