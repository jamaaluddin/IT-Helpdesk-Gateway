<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - IT Helpdesk Gateway</title>

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

        button,
        input {
            font-family: inherit;
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
            z-index: 10;
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
            transition: 0.2s;
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
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #d1fae5;
            color: #065f46;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
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

        /* =========================
           CONTENT
        ========================== */

        .content {
            padding: 30px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .welcome h2 {
            margin: 0;
            font-size: 28px;
            color: #064e3b;
        }

        .welcome p {
            margin-top: 7px;
            font-size: 14px;
            color: #6b7280;
        }

        /* =========================
           STAT CARDS
        ========================== */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-label {
            font-size: 13px;
            color: #6b7280;
            max-width: 75%;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #d1fae5;
            color: #059669;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
        }

        .pending-number {
            color: #d97706;
        }

        .stat-footer {
            margin-top: 8px;
            font-size: 11px;
            color: #9ca3af;
        }

        /* =========================
           SECTION CARD
        ========================== */

        .section {
            background: white;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .section-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header h3 {
            margin: 0;
            font-size: 17px;
            color: #111827;
        }

        .section-header span {
            font-size: 12px;
            color: #6b7280;
        }

        /* =========================
           TABLE
        ========================== */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #ecfdf5;
            color: #065f46;
            padding: 13px 14px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
            color: #374151;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .user-name {
            font-weight: 700;
            color: #111827;
        }

        .email {
            color: #4b5563;
        }

        .office,
        .department {
            color: #6b7280;
        }

        /* =========================
           STATUS BADGE
        ========================== */

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #fef3c7;
            color: #92400e;
            font-size: 10px;
            font-weight: 700;
        }

        /* =========================
           ACTION BUTTON
        ========================== */

        .action-buttons {
            display: flex;
            gap: 7px;
        }

        .btn {
            border: none;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-approve {
            background: #d1fae5;
            color: #047857;
        }

        .btn-approve:hover {
            background: #a7f3d0;
        }

        .btn-reject {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-reject:hover {
            background: #fecaca;
        }

        /* =========================
           EMPTY STATE
        ========================== */

        .empty {
            text-align: center;
            padding: 55px 20px;
            color: #6b7280;
        }

        .empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: #d1fae5;
            color: #059669;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .empty-title {
            font-size: 14px;
            font-weight: 700;
            color: #374151;
        }

        .empty-text {
            margin-top: 5px;
            font-size: 12px;
            color: #9ca3af;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 1000px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .stats {
                grid-template-columns: 1fr;
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

            .welcome h2 {
                font-size: 23px;
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

            .admin-info {
                width: 100%;
            }

            .welcome h2 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- =========================
         SIDEBAR
    ========================== -->

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

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="active"
                >
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

                <a href="{{ route('admin.maintenance.schedules.index') }}">
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


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-left">

                <h1>
                    Dashboard Admin
                </h1>

                <p>
                    IT Helpdesk Management System
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

            <!-- WELCOME -->

            <div class="welcome">

                <h2>
                    Selamat Datang, {{ auth()->user()->name ?? 'Administrator' }} 👋
                </h2>

                <p>
                    Kelola pengguna, aset, maintenance, dan aktivitas IT Helpdesk Gateway.
                </p>

            </div>


            <!-- =========================
                 STATISTICS
            ========================== -->

            <div class="stats">

                <!-- PENDING USER -->

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            User Menunggu Persetujuan
                        </span>

                        <div class="stat-icon">
                            👤
                        </div>

                    </div>

                    <div class="stat-number pending-number">
                        {{ $pendingUsers->count() }}
                    </div>

                    <div class="stat-footer">
                        Membutuhkan tindakan admin
                    </div>

                </div>


                <!-- TOTAL USER -->

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            Total User
                        </span>

                        <div class="stat-icon">
                            👥
                        </div>

                    </div>

                    <div class="stat-number">
                        {{ \App\Models\User::where('role_id', 1)->count() }}
                    </div>

                    <div class="stat-footer">
                        Pengguna sistem
                    </div>

                </div>


                <!-- ADMIN / IT SUPPORT -->

                <div class="stat-card">

                    <div class="stat-top">

                        <span class="stat-label">
                            Total Admin / IT Support
                        </span>

                        <div class="stat-icon">
                            🛠️
                        </div>

                    </div>

                    <div class="stat-number">
                        {{ \App\Models\User::whereIn('role_id', [2, 3])->count() }}
                    </div>

                    <div class="stat-footer">
                        Pengelola IT Helpdesk
                    </div>

                </div>

            </div>


            <!-- =========================
                 USER APPROVAL
            ========================== -->

            <div class="section">

                <div class="section-header">

                    <div>

                        <h3>
                            User Menunggu Persetujuan
                        </h3>

                    </div>

                    <span>
                        {{ $pendingUsers->count() }} user pending
                    </span>

                </div>


                @if ($pendingUsers->count() > 0)

                    <div class="table-wrapper">

                        <table>

                            <thead>

                                <tr>

                                    <th>
                                        Nama
                                    </th>

                                    <th>
                                        Email
                                    </th>

                                    <th>
                                        Office
                                    </th>

                                    <th>
                                        Department
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($pendingUsers as $user)

                                    <tr>

                                        <td>

                                            <span class="user-name">
                                                {{ $user->name }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="email">
                                                {{ $user->email }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="office">
                                                {{ $user->office_id }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="department">
                                                {{ $user->department_id }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="status">
                                                Pending
                                            </span>

                                        </td>

                                        <td>

                                            <div class="action-buttons">

                                                <!-- APPROVE -->

                                                <form
                                                    action="{{ route('admin.users.approve', $user->id) }}"
                                                    method="POST"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="btn btn-approve"
                                                    >
                                                        ✓ Approve
                                                    </button>

                                                </form>


                                                <!-- REJECT -->

                                                <form
                                                    action="{{ route('admin.users.reject', $user->id) }}"
                                                    method="POST"
                                                >
                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="btn btn-reject"
                                                    >
                                                        ✕ Reject
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="empty">

                        <div class="empty-icon">
                            ✓
                        </div>

                        <div class="empty-title">
                            Semua user sudah diproses
                        </div>

                        <div class="empty-text">
                            Tidak ada user yang menunggu persetujuan saat ini.
                        </div>

                    </div>

                @endif

            </div>

        </section>

    </main>

</div>

</body>
</html>
