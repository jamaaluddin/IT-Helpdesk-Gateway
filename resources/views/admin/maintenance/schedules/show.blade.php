<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Maintenance - Admin Gateway</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f0fdf4;
            color: #1f2937;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #064e3b;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 18px;
            color: white;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 35px;
        }

        .brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            background: white;
            border-radius: 10px;
            padding: 5px;
        }

        .brand-text h3 {
            font-size: 16px;
            margin-bottom: 3px;
        }

        .brand-text p {
            font-size: 12px;
            color: #a7f3d0;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d1fae5;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 9px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #047857;
            color: white;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
        }

        .logout {
            position: absolute;
            bottom: 24px;
            left: 18px;
            right: 18px;
        }

        .logout form {
            width: 100%;
        }

        .logout button {
            width: 100%;
            border: none;
            background: #dc2626;
            color: white;
            padding: 11px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout button:hover {
            background: #b91c1c;
        }

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 80px;
            background: white;
            border-bottom: 1px solid #d1fae5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 30px;
        }

        .topbar-left h2 {
            font-size: 22px;
            color: #064e3b;
            margin-bottom: 4px;
        }

        .topbar-left p {
            font-size: 13px;
            color: #6b7280;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #059669;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .admin-text strong {
            display: block;
            font-size: 14px;
        }

        .admin-text span {
            font-size: 12px;
            color: #6b7280;
        }

        .content {
            padding: 30px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .page-heading h1 {
            font-size: 28px;
            color: #064e3b;
            margin-bottom: 6px;
        }

        .page-heading p {
            color: #6b7280;
            font-size: 14px;
        }

        .back-btn {
            display: inline-block;
            background: white;
            color: #065f46;
            border: 1px solid #a7f3d0;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #ecfdf5;
        }

        .success-alert {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-header h3 {
            color: #064e3b;
            font-size: 18px;
        }

        .card-body {
            padding: 22px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6b7280;
            font-size: 13px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            text-align: right;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-scheduled {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-completed {
            background: #dcfce7;
            color: #166534;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-rescheduled {
            background: #fef3c7;
            color: #92400e;
        }

        .record-card {
            margin-bottom: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px;
        }

        .record-card:last-child {
            margin-bottom: 0;
        }

        .record-title {
            color: #064e3b;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .record-item {
            margin-bottom: 10px;
        }

        .record-item:last-child {
            margin-bottom: 0;
        }

        .record-item strong {
            display: block;
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .record-item span {
            font-size: 14px;
            line-height: 1.5;
        }

        .empty-record {
            text-align: center;
            color: #6b7280;
            padding: 20px;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }

            .grid {
                grid-template-columns: 1fr;
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

            .logout {
                position: static;
                margin-top: 20px;
            }

            .topbar {
                height: auto;
                gap: 15px;
                align-items: flex-start;
            }

            .content {
                padding: 20px;
            }

            .page-heading {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .topbar {
                flex-direction: column;
            }

            .admin-info {
                width: 100%;
            }

            .info-row {
                flex-direction: column;
                gap: 5px;
            }

            .info-value {
                text-align: left;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <img src="{{ asset('images/gateway-logo.webp') }}" alt="Gateway Logo">

            <div class="brand-text">
                <h3>IT Helpdesk</h3>
                <p>Gateway Admin</p>
            </div>
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

            <a href="{{ route('admin.maintenance.schedules.index') }}" class="active">
                <span class="menu-icon">🔧</span>
                <span>Maintenance</span>
            </a>

            <a href="#">
                <span class="menu-icon">📊</span>
                <span>Reports</span>
            </a>

        </nav>

        <div class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit">
                    Logout
                </button>
            </form>
        </div>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="topbar-left">
                <h2>Detail Maintenance</h2>
                <p>Informasi lengkap jadwal dan hasil maintenance aset</p>
            </div>

            <div class="admin-info">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="admin-text">
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>Administrator</span>
                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <section class="content">

            <div class="page-heading">

                <div>
                    <h1>🔧 Detail Maintenance</h1>
                    <p>
                        Informasi jadwal maintenance untuk aset IT Gateway.
                    </p>
                </div>

                <a
                    href="{{ route('admin.maintenance.schedules.index') }}"
                    class="back-btn"
                >
                    ← Kembali
                </a>

            </div>


            @if(session('success'))
                <div class="success-alert">
                    {{ session('success') }}
                </div>
            @endif


            <div class="grid">

                <!-- INFORMASI JADWAL -->
                <div class="card">

                    <div class="card-header">
                        <h3>Informasi Jadwal</h3>
                    </div>

                    <div class="card-body">

                        <div class="info-row">
                            <span class="info-label">Aset</span>

                            <span class="info-value">
                                {{ $maintenanceSchedule->asset->name ?? '-' }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Kode Aset</span>

                            <span class="info-value">
                                {{ $maintenanceSchedule->asset->asset_code ?? '-' }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Kantor</span>

                            <span class="info-value">
                                {{ $maintenanceSchedule->office->name ?? '-' }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Tanggal Jadwal</span>

                            <span class="info-value">
                                {{ $maintenanceSchedule->scheduled_date
                                    ? $maintenanceSchedule->scheduled_date->format('d-m-Y')
                                    : '-'
                                }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Tanggal Pelaksanaan</span>

                            <span class="info-value">
                                {{ $maintenanceSchedule->actual_date
                                    ? $maintenanceSchedule->actual_date->format('d-m-Y')
                                    : '-'
                                }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Status</span>

                            <span class="info-value">

                                @if($maintenanceSchedule->status === 'scheduled')
                                    <span class="badge badge-scheduled">
                                        Terjadwal
                                    </span>

                                @elseif($maintenanceSchedule->status === 'completed')
                                    <span class="badge badge-completed">
                                        Selesai
                                    </span>

                                @elseif($maintenanceSchedule->status === 'cancelled')
                                    <span class="badge badge-cancelled">
                                        Dibatalkan
                                    </span>

                                @elseif($maintenanceSchedule->status === 'rescheduled')
                                    <span class="badge badge-rescheduled">
                                        Dijadwalkan Ulang
                                    </span>

                                @else
                                    <span class="badge">
                                        {{ $maintenanceSchedule->status }}
                                    </span>
                                @endif

                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Dibuat Oleh</span>

                            <span class="info-value">
                                {{ $maintenanceSchedule->scheduledBy->name ?? '-' }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Catatan</span>

                            <span class="info-value">
                                {{ $maintenanceSchedule->remarks ?: '-' }}
                            </span>
                        </div>

                    </div>

                </div>


                <!-- HASIL MAINTENANCE -->
                <div class="card">

                    <div class="card-header">
                        <h3>Hasil Maintenance</h3>
                    </div>

                    <div class="card-body">

                        @forelse($maintenanceSchedule->records as $record)

                            <div class="record-card">

                                <div class="record-title">
                                    Maintenance #{{ $record->id }}
                                </div>

                                <div class="record-item">
                                    <strong>IT Support</strong>

                                    <span>
                                        {{ $record->performedBy->name ?? '-' }}
                                    </span>
                                </div>

                                <div class="record-item">
                                    <strong>Waktu Pelaksanaan</strong>

                                    <span>
                                        {{ $record->performed_at
                                            ? $record->performed_at->format('d-m-Y H:i')
                                            : '-'
                                        }}
                                    </span>
                                </div>

                                <div class="record-item">
                                    <strong>Analisis</strong>

                                    <span>
                                        {{ $record->analysis ?: '-' }}
                                    </span>
                                </div>

                                <div class="record-item">
                                    <strong>Tindakan</strong>

                                    <span>
                                        {{ $record->action ?: '-' }}
                                    </span>
                                </div>

                                <div class="record-item">
                                    <strong>Hasil</strong>

                                    <span>
                                        {{ $record->result ?: '-' }}
                                    </span>
                                </div>

                                <div class="record-item">
                                    <strong>Kondisi Setelah Maintenance</strong>

                                    <span>
                                        @switch($record->condition_after)

                                            @case('good')
                                                Baik
                                                @break

                                            @case('minor_damage')
                                                Kerusakan Ringan
                                                @break

                                            @case('major_damage')
                                                Kerusakan Berat
                                                @break

                                            @case('broken')
                                                Rusak
                                                @break

                                            @default
                                                -
                                        @endswitch
                                    </span>
                                </div>

                                <div class="record-item">
                                    <strong>Catatan</strong>

                                    <span>
                                        {{ $record->remarks ?: '-' }}
                                    </span>
                                </div>

                            </div>

                        @empty

                            <div class="empty-record">
                                Belum ada hasil maintenance dari IT Support.
                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </section>

    </main>

</body>
</html>
