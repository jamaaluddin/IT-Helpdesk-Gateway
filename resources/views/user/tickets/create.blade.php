<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Tiket - IT Helpdesk Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f4f7fb 0%, #eef4ff 100%);
            color: #1f2937;
            min-height: 100vh;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            background: rgba(255, 255, 255, 0.97);
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow:
                0 4px 10px rgba(0, 0, 0, 0.04),
                0 10px 30px rgba(37, 99, 235, 0.08);
            border-bottom: 1px solid #e5e7eb;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand img {
            width: 120px;
            height: auto;
            display: block;
        }

        .brand-text h1 {
            font-size: 22px;
            color: #1f2937;
            font-weight: 700;
        }

        .brand-text p {
            margin-top: 5px;
            font-size: 13px;
            color: #6b7280;
        }

        .user-info {
            text-align: right;
            font-size: 14px;
            color: #1f2937;
            font-weight: 600;
        }

        .role {
            color: #6b7280;
            font-size: 12px;
            margin-top: 4px;
            font-weight: normal;
        }

        .logout-btn {
            margin-top: 8px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .logout-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        /* =========================
           CONTAINER
        ========================= */

        .container {
            max-width: 950px;
            margin: 35px auto;
            padding: 0 20px 50px;
        }

        /* =========================
           BACK BUTTON
        ========================= */

        .back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .back:hover {
            color: #1d4ed8;
            transform: translateX(-3px);
        }

        /* =========================
           MAIN CARD
        ========================= */

        .card {
            background: rgba(255, 255, 255, 0.98);
            padding: 35px;
            border-radius: 18px;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.03),
                0 8px 18px rgba(0, 0, 0, 0.05),
                0 20px 45px rgba(37, 99, 235, 0.10),
                0 30px 70px rgba(15, 23, 42, 0.06);

            border: 1px solid rgba(229, 231, 235, 0.9);
        }

        .card-header {
            padding-bottom: 25px;
            margin-bottom: 28px;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            box-shadow:
                0 4px 10px rgba(37, 99, 235, 0.12);
        }

        .card h2 {
            font-size: 23px;
            color: #111827;
            font-weight: 700;
        }

        .card-description {
            color: #6b7280;
            font-size: 14px;
            margin-top: 10px;
            line-height: 1.6;
        }

        /* =========================
           ERROR
        ========================= */

        .error {
            background: #fef2f2;
            color: #991b1b;
            padding: 15px 17px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            border: 1px solid #fecaca;

            box-shadow:
                0 5px 15px rgba(220, 38, 38, 0.07);
        }

        .error strong {
            display: block;
            margin-bottom: 5px;
        }

        /* =========================
           FORM
        ========================= */

        .form-group {
            margin-bottom: 23px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 9px;
        }

        .required {
            color: #dc2626;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #1f2937;
            background: #ffffff;
            outline: none;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.02),
                inset 0 1px 2px rgba(0, 0, 0, 0.02);

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                transform 0.2s ease;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9ca3af;
        }

        input:hover,
        select:hover,
        textarea:hover {
            border-color: #93c5fd;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10),
                0 5px 15px rgba(37, 99, 235, 0.06);
        }

        textarea {
            min-height: 145px;
            resize: vertical;
            line-height: 1.6;
        }

        /* =========================
           OTHER PROBLEM
        ========================= */

        .other-problem {
            display: none;
            margin-top: -5px;
            padding: 18px;
            background: #f8fbff;
            border: 1px solid #dbeafe;
            border-radius: 11px;

            box-shadow:
                0 5px 15px rgba(37, 99, 235, 0.05);
        }

        .other-problem textarea {
            background: white;
        }

        /* =========================
           HANDLING METHOD
        ========================= */

        .handling-method-group {
            display: none;
        }

        /* =========================
           REMOTE ACCESS
        ========================= */

        .remote-access {
            display: none;
            margin-top: -5px;
            padding: 18px;
            background: #f8fbff;
            border: 1px solid #dbeafe;
            border-radius: 11px;

            box-shadow:
                0 5px 15px rgba(37, 99, 235, 0.05);
        }

        .remote-access .form-group:last-child {
            margin-bottom: 0;
        }

        .remote-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 15px;
        }

        /* =========================
           FILE UPLOAD
        ========================= */

        .file-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 16px;
            border-radius: 10px;

            transition: 0.2s ease;
        }

        .file-box:hover {
            border-color: #93c5fd;
            background: #f8fbff;
        }

        .file-box input {
            background: white;
            box-shadow: none;
        }

        .help-text {
            color: #6b7280;
            font-size: 12px;
            margin-top: 7px;
            line-height: 1.5;
        }

        /* =========================
           PRIORITY
        ========================= */

        .priority-info {
            margin-top: 8px;
            font-size: 12px;
            color: #6b7280;
            line-height: 1.5;
        }

        /* =========================
           BUTTON
        ========================= */

        .button-area {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            border: none;
            padding: 12px 21px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;

            box-shadow:
                0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .btn-cancel:hover {
            background: #e5e7eb;
            transform: translateY(-2px);

            box-shadow:
                0 7px 15px rgba(0, 0, 0, 0.08);
        }

        .btn-submit {
            background: #2563eb;
            color: white;

            box-shadow:
                0 6px 15px rgba(37, 99, 235, 0.25),
                0 12px 25px rgba(37, 99, 235, 0.12);
        }

        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-2px);

            box-shadow:
                0 9px 20px rgba(37, 99, 235, 0.30),
                0 15px 30px rgba(37, 99, 235, 0.15);
        }

        .btn-submit:active,
        .btn-cancel:active {
            transform: translateY(0);
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 700px) {

            .header {
                padding: 16px 20px;
            }

            .brand img {
                width: 95px;
            }

            .brand-text h1 {
                font-size: 17px;
            }

            .brand-text p {
                font-size: 11px;
            }

            .user-info {
                display: none;
            }

            .container {
                margin: 25px auto;
                padding: 0 15px 35px;
            }

            .card {
                padding: 22px;
                border-radius: 14px;
            }

            .card h2 {
                font-size: 20px;
            }

            .button-area {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<header class="header">

    <div class="brand">

        <img
            src="{{ asset('images/gateway-logo.webp') }}"
            alt="Gateway Logo"
        >

        <div class="brand-text">

            <h1>
                IT Helpdesk Gateway
            </h1>

            <p>
                Buat Tiket Helpdesk
            </p>

        </div>

    </div>


    <div class="user-info">

        <div>
            {{ auth()->user()->name }}
        </div>

        <div class="role">
            User
        </div>

        <form
            action="{{ route('logout') }}"
            method="POST"
        >
            @csrf

            <button
                type="submit"
                class="logout-btn"
            >
                Logout
            </button>

        </form>

    </div>

</header>


<main class="container">

    <a
        href="{{ route('user.dashboard') }}"
        class="back"
    >
        ← Kembali ke Dashboard
    </a>


    <div class="card">

        <div class="card-header">

            <div class="card-title">

                <div class="title-icon">
                    🎫
                </div>

                <div>
                    <h2>
                        Laporkan Masalah IT
                    </h2>
                </div>

            </div>

            <p class="card-description">
                Isi informasi masalah yang Anda alami dengan lengkap agar tim IT
                dapat memahami dan menangani masalah Anda dengan lebih cepat.
            </p>

        </div>


        @if ($errors->any())

            <div class="error">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul style="margin-top: 8px; padding-left: 20px;">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('tickets.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <!-- JUDUL MASALAH -->

            <div class="form-group">

                <label>
                    Judul Masalah
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="subject"
                    value="{{ old('subject') }}"
                    placeholder="Contoh: Komputer tidak bisa menyala"
                    required
                >

            </div>


            <!-- KATEGORI -->

            <div class="form-group">

                <label>
                    Pilih Masalah
                    <span class="required">*</span>
                </label>

                <select
                    name="category_id"
                    id="category_id"
                    required
                >

                    <option value="">
                        -- Pilih kategori masalah --
                    </option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            data-name="{{ strtolower($category->name) }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

                <div class="help-text">
                    Pilih kategori yang paling sesuai dengan masalah yang Anda alami.
                </div>

            </div>


            <!-- MASALAH LAINNYA -->

            <div
                class="form-group other-problem"
                id="otherProblem"
            >

                <label>
                    Jelaskan Masalah Lainnya
                    <span class="required">*</span>
                </label>

                <textarea
                    name="other_problem"
                    placeholder="Tuliskan masalah IT yang Anda alami..."
                >{{ old('other_problem') }}</textarea>

                <div class="help-text">
                    Gunakan bagian ini jika masalah Anda tidak termasuk kategori
                    yang tersedia.
                </div>

            </div>


            <!-- DESKRIPSI -->

            <div class="form-group">

                <label>
                    Deskripsi Masalah
                    <span class="required">*</span>
                </label>

                <textarea
                    name="description"
                    placeholder="Jelaskan masalah secara detail, misalnya kapan terjadi, perangkat yang digunakan, pesan error, dan sebagainya."
                    required
                >{{ old('description') }}</textarea>

                <div class="help-text">
                    Semakin lengkap informasi yang diberikan, semakin mudah tim IT
                    melakukan pengecekan.
                </div>

            </div>


            <!-- METODE PENANGANAN -->

            <div
                class="form-group handling-method-group"
                id="handlingMethodGroup"
            >

                <label>
                    Metode Penanganan
                    <span class="required">*</span>
                </label>

                <select
                    name="handling_method"
                    id="handling_method"
                >

                    <option value="">
                        -- Pilih metode penanganan --
                    </option>

                    <option
                        value="in_person"
                        {{ old('handling_method') == 'in_person' ? 'selected' : '' }}
                    >
                        🏢 Offline
                    </option>

                    <option
                        value="remote"
                        {{ old('handling_method') == 'remote' ? 'selected' : '' }}
                    >
                        💻 Remote
                    </option>

                </select>

                <div class="help-text">
                    Pilih metode yang paling sesuai untuk membantu tim IT menangani masalah Anda.
                </div>

            </div>


            <!-- INFORMASI REMOTE -->

            <div
                class="remote-access"
                id="remoteAccess"
            >

                <div class="remote-title">
                    💻 Informasi Remote
                </div>


                <!-- APLIKASI REMOTE -->

                <div class="form-group">

                    <label>
                        Aplikasi Remote
                        <span class="required">*</span>
                    </label>

                    <select
                        name="remote_application"
                        id="remote_application"
                    >

                        <option value="">
                            -- Pilih aplikasi remote --
                        </option>

                        <option
                            value="anydesk"
                            {{ old('remote_application') == 'anydesk' ? 'selected' : '' }}
                        >
                            AnyDesk
                        </option>

                        <option
                            value="teamviewer"
                            {{ old('remote_application') == 'teamviewer' ? 'selected' : '' }}
                        >
                            TeamViewer
                        </option>

                        <option
                            value="ultraviewer"
                            {{ old('remote_application') == 'ultraviewer' ? 'selected' : '' }}
                        >
                            UltraViewer
                        </option>

                    </select>

                </div>


                <!-- REMOTE ADDRESS -->

                <div class="form-group">

                    <label>
                        Remote Address
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="remote_address"
                        id="remote_address"
                        value="{{ old('remote_address') }}"
                        placeholder="Masukkan Remote Address"
                    >

                    <div class="help-text">
                        Masukkan alamat atau ID remote yang dapat digunakan oleh IT Support.
                    </div>

                </div>


                <!-- REMOTE PASSWORD -->

                <div class="form-group">

                    <label>
                        Remote Password
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="remote_password"
                        id="remote_password"
                        value="{{ old('remote_password') }}"
                        placeholder="Masukkan password remote"
                    >

                    <div class="help-text">
                        Masukkan password remote yang diperlukan untuk koneksi.
                    </div>

                </div>

            </div>


            <!-- FOTO -->

            <div class="form-group">

                <label>
                    Foto / Bukti Masalah
                </label>

                <div class="file-box">

                    <input
                        type="file"
                        name="problem_image"
                        accept=".jpg,.jpeg,.png"
                    >

                    <div class="help-text">
                        Opsional. Format JPG, JPEG, PNG. Maksimal 2 MB.
                    </div>

                </div>

            </div>


            <!-- BUTTON -->

            <div class="button-area">

                <a
                    href="{{ route('user.dashboard') }}"
                    class="btn btn-cancel"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-submit"
                >
                    🎫 Kirim Tiket
                </button>

            </div>

        </form>

    </div>

</main>


<script>

    /* =========================
       ELEMENT
    ========================= */

    const categorySelect =
        document.getElementById('category_id');

    const otherProblem =
        document.getElementById('otherProblem');

    const handlingMethodGroup =
        document.getElementById('handlingMethodGroup');

    const handlingMethod =
        document.getElementById('handling_method');

    const remoteAccess =
        document.getElementById('remoteAccess');

    const remoteApplication =
        document.getElementById('remote_application');

    const remoteAddress =
        document.getElementById('remote_address');

    const remotePassword =
        document.getElementById('remote_password');


    /* =========================
       CEK KATEGORI LAINNYA
    ========================= */

    function checkCategory() {

        const selectedOption =
            categorySelect.options[
                categorySelect.selectedIndex
            ];

        let isOtherCategory = false;


        if (
            selectedOption &&
            selectedOption.dataset.name
        ) {

            isOtherCategory =
                selectedOption.dataset.name
                    .toLowerCase()
                    .includes('lainnya');

        }


        /* =========================
           MASALAH LAINNYA
        ========================= */

        if (isOtherCategory) {

            otherProblem.style.display = 'block';

        } else {

            otherProblem.style.display = 'none';

        }


        /* =========================
           METODE PENANGANAN
        ========================= */

        if (isOtherCategory) {

            handlingMethodGroup.style.display = 'block';

            handlingMethod.required = true;

        } else {

            handlingMethodGroup.style.display = 'none';

            handlingMethod.required = false;

            handlingMethod.value = '';

            hideRemoteAccess();

        }

    }


    /* =========================
       CEK METODE REMOTE
    ========================= */

    function checkHandlingMethod() {

        if (
            handlingMethod.value === 'remote'
        ) {

            remoteAccess.style.display = 'block';

            remoteApplication.required = true;
            remoteAddress.required = true;
            remotePassword.required = true;

        } else {

            hideRemoteAccess();

        }

    }


    /* =========================
       HIDE REMOTE
    ========================= */

    function hideRemoteAccess() {

        remoteAccess.style.display = 'none';

        remoteApplication.required = false;
        remoteAddress.required = false;
        remotePassword.required = false;

    }


    /* =========================
       EVENT
    ========================= */

    categorySelect.addEventListener(
        'change',
        checkCategory
    );


    handlingMethod.addEventListener(
        'change',
        checkHandlingMethod
    );


    /* =========================
       INITIAL CHECK
    ========================= */

    checkCategory();

    checkHandlingMethod();

</script>

</body>
</html>
