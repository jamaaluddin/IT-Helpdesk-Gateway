@extends('layouts.admin')

@section('title', 'Dashboard Admin - IT Helpdesk Gateway')
@section('page-title', 'Dashboard Admin')
@section('page-subtitle', 'IT Helpdesk Management System')

@php
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Schema;

    // Statistik tiket dari AdminController
    $totalTickets = $totalTickets ?? 0;
    $openTickets = $openTickets ?? 0;
    $inProgressTickets = $inProgressTickets ?? 0;
    $resolvedTickets = $resolvedTickets ?? 0;
    $closedTickets = $closedTickets ?? 0;

    // Mengambil 5 aktivitas tiket terbaru
    $latestTickets = \App\Models\Ticket::latest()
        ->take(5)
        ->get();

    // Ringkasan aset dan maintenance
    $totalAssets = Schema::hasTable('assets')
        ? DB::table('assets')->count()
        : 0;

    $totalMaintenanceSchedules = Schema::hasTable('maintenance_schedules')
        ? DB::table('maintenance_schedules')->count()
        : 0;

    $totalServerMaintenance = Schema::hasTable('server_maintenance')
        ? DB::table('server_maintenance')->count()
        : 0;

    // Persentase grafik tiket
    $chartTotal = max((int) $totalTickets, 1);

    $openPercent = round(($openTickets / $chartTotal) * 100, 1);
    $progressPercent = round(($inProgressTickets / $chartTotal) * 100, 1);
    $resolvedPercent = round(($resolvedTickets / $chartTotal) * 100, 1);
    $closedPercent = round(($closedTickets / $chartTotal) * 100, 1);
@endphp

<style>
    .dashboard-content {
        width: 100%;
    }

    .welcome {
        margin-bottom: 25px;
    }

    .welcome h2 {
        color: #1f2937;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .welcome p {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Statistik Tiket */

    .ticket-stats {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        min-width: 0;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, .07);
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 17px;
    }

    .stat-label {
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    .icon-green {
        color: #059669;
        background: #d1fae5;
    }

    .icon-orange {
        color: #d97706;
        background: #fef3c7;
    }

    .icon-blue {
        color: #2563eb;
        background: #dbeafe;
    }

    .icon-purple {
        color: #7c3aed;
        background: #ede9fe;
    }

    .icon-gray {
        color: #4b5563;
        background: #f3f4f6;
    }

    .stat-number {
        color: #111827;
        font-size: 29px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 7px;
    }

    .stat-footer {
        color: #9ca3af;
        font-size: 12px;
    }

    /* Section */

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(0, .85fr);
        gap: 20px;
        margin-bottom: 25px;
    }

    .section {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 22px;
        min-width: 0;
        margin-bottom: 25px;
    }

    .dashboard-grid .section {
        margin-bottom: 0;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-header h3 {
        color: #1f2937;
        font-size: 16px;
        font-weight: 700;
    }

    .section-description {
        color: #9ca3af;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Grafik Status Tiket */

    .chart-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .chart-item {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .chart-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        font-size: 13px;
    }

    .chart-name {
        color: #4b5563;
        font-weight: 600;
    }

    .chart-value {
        color: #111827;
        font-weight: 700;
    }

    .chart-track {
        width: 100%;
        height: 10px;
        background: #f3f4f6;
        border-radius: 20px;
        overflow: hidden;
    }

    .chart-bar {
        height: 100%;
        border-radius: 20px;
        transition: width .4s ease;
    }

    .bar-open {
        background: #f59e0b;
    }

    .bar-progress {
        background: #3b82f6;
    }

    .bar-resolved {
        background: #059669;
    }

    .bar-closed {
        background: #6b7280;
    }

    /* Ringkasan Aset */

    .overview-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .overview-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 13px;
        border: 1px solid #f0f0f0;
        border-radius: 10px;
    }

    .overview-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
    }

    .overview-info {
        flex: 1;
        min-width: 0;
    }

    .overview-info p {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .overview-info h4 {
        color: #111827;
        font-size: 19px;
        font-weight: 700;
    }

    /* Tabel Aktivitas */

    .table-wrapper {
        width: 100%;
        max-height: 500px;
        overflow: auto;
        border: 1px solid #e5e7eb;
        border-radius: 9px;
    }

    .activity-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .activity-table th {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #f9fafb;
        color: #4b5563;
        font-size: 12px;
        font-weight: 700;
        text-align: left;
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .activity-table td {
        padding: 14px 16px;
        color: #4b5563;
        font-size: 13px;
        border-bottom: 1px solid #f1f1f1;
        vertical-align: middle;
    }

    .activity-table tbody tr:last-child td {
        border-bottom: none;
    }

    .activity-table tbody tr:hover {
        background: #f9fafb;
    }

    .ticket-number {
        color: #059669;
        font-weight: 700;
        white-space: nowrap;
    }

    .ticket-subject {
        color: #1f2937;
        font-weight: 600;
    }

    .status {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-open {
        background: #fef3c7;
        color: #92400e;
    }

    .status-assigned {
        background: #e0e7ff;
        color: #3730a3;
    }

    .status-progress {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-resolved {
        background: #d1fae5;
        color: #065f46;
    }

    .status-closed {
        background: #f3f4f6;
        color: #4b5563;
    }

    .empty {
        text-align: center;
        padding: 35px 20px;
        color: #9ca3af;
        font-size: 13px;
    }

    .empty-icon {
        font-size: 30px;
        margin-bottom: 10px;
    }

    /* Responsive */

    @media (max-width: 1200px) {
        .ticket-stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .ticket-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .stat-card {
            padding: 15px;
        }

        .stat-number {
            font-size: 25px;
        }

        .section {
            padding: 16px;
        }

        .welcome h2 {
            font-size: 19px;
        }
    }

    @media (max-width: 380px) {
        .ticket-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

@section('content')

<div class="dashboard-content">

    {{-- Sambutan Dashboard --}}
    <div class="welcome">
        <h2>Selamat Datang, Admin!</h2>
        <p>
            Pantau aktivitas tiket, aset, dan pemeliharaan
            IT Helpdesk PT Gateway melalui halaman Dashboard.
        </p>
    </div>

    {{-- Statistik Tiket --}}
    <div class="ticket-stats">

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Total Tiket</span>
                <div class="stat-icon icon-green">🎫</div>
            </div>
            <div class="stat-number">{{ $totalTickets }}</div>
            <div class="stat-footer">Seluruh tiket terdaftar</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Tiket Terbuka</span>
                <div class="stat-icon icon-orange">📩</div>
            </div>
            <div class="stat-number">{{ $openTickets }}</div>
            <div class="stat-footer">Menunggu penanganan</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Sedang Diproses</span>
                <div class="stat-icon icon-blue">⚙️</div>
            </div>
            <div class="stat-number">{{ $inProgressTickets }}</div>
            <div class="stat-footer">Dalam penanganan IT Support</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Tiket Selesai</span>
                <div class="stat-icon icon-green">✓</div>
            </div>
            <div class="stat-number">{{ $resolvedTickets }}</div>
            <div class="stat-footer">Penanganan telah selesai</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Tiket Ditutup</span>
                <div class="stat-icon icon-gray">🔒</div>
            </div>
            <div class="stat-number">{{ $closedTickets }}</div>
            <div class="stat-footer">Tiket telah ditutup</div>
        </div>

    </div>

    {{-- Grafik dan Ringkasan --}}
    <div class="dashboard-grid">

        {{-- Grafik Status Tiket --}}
        <div class="section">

            <div class="section-header">
                <div>
                    <h3>Ringkasan Status Tiket</h3>
                    <p class="section-description">
                        Perbandingan tiket berdasarkan status
                    </p>
                </div>
            </div>

            <div class="chart-list">

                <div class="chart-item">
                    <div class="chart-info">
                        <span class="chart-name">Tiket Terbuka</span>
                        <span class="chart-value">{{ $openTickets }}</span>
                    </div>
                    <div class="chart-track">
                        <div class="chart-bar bar-open"
                            @style(['width: ' . $openPercent . '%'])>
                        </div>
                    </div>
                </div>

                <div class="chart-item">
                    <div class="chart-info">
                        <span class="chart-name">Sedang Diproses</span>
                        <span class="chart-value">{{ $inProgressTickets }}</span>
                    </div>
                    <div class="chart-track">
                        <div class="chart-bar bar-progress"
                            @style(['width: ' . $progressPercent . '%'])>
                        </div>
                    </div>
                </div>

                <div class="chart-item">
                    <div class="chart-info">
                        <span class="chart-name">Tiket Selesai</span>
                        <span class="chart-value">{{ $resolvedTickets }}</span>
                    </div>
                    <div class="chart-track">
                        <div class="chart-bar bar-resolved"
                            @style(['width: ' . $resolvedPercent . '%'])>
                        </div>
                    </div>
                </div>

                <div class="chart-item">
                    <div class="chart-info">
                        <span class="chart-name">Tiket Ditutup</span>
                        <span class="chart-value">{{ $closedTickets }}</span>
                    </div>
                    <div class="chart-track">
                        <div class="chart-bar bar-closed"
                            @style(['width: ' . $closedPercent . '%'])>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Ringkasan Aset dan Maintenance --}}
        <div class="section">

            <div class="section-header">
                <div>
                    <h3>Ringkasan Operasional</h3>
                    <p class="section-description">
                        Informasi aset dan pemeliharaan
                    </p>
                </div>
            </div>

            <div class="overview-list">

                <div class="overview-item">
                    <div class="overview-icon icon-green">💻</div>
                    <div class="overview-info">
                        <p>Total Aset Terdaftar</p>
                        <h4>{{ number_format($totalAssets) }}</h4>
                    </div>
                </div>

                <div class="overview-item">
                    <div class="overview-icon icon-blue">📅</div>
                    <div class="overview-info">
                        <p>Total Jadwal Maintenance</p>
                        <h4>{{ number_format($totalMaintenanceSchedules) }}</h4>
                    </div>
                </div>

                <div class="overview-item">
                    <div class="overview-icon icon-purple">🖥️</div>
                    <div class="overview-info">
                        <p>Total Data Maintenance Server</p>
                        <h4>{{ number_format($totalServerMaintenance) }}</h4>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- Aktivitas Tiket Terbaru --}}
    <div class="section">

        <div class="section-header">
            <div>
                <h3>Aktivitas Tiket Terbaru</h3>
                <p class="section-description">
                    Daftar lima tiket terbaru yang masuk ke sistem
                </p>
            </div>
        </div>

        <div class="table-wrapper">

            <table class="activity-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Tiket</th>
                        <th>Subjek Tiket</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($latestTickets as $index => $ticket)

                        @php
                            $statusLabels = [
                                'open' => 'Terbuka',
                                'assigned' => 'Ditugaskan',
                                'in_progress' => 'Diproses',
                                'resolved' => 'Selesai',
                                'closed' => 'Ditutup',
                            ];

                            $statusClasses = [
                                'open' => 'status-open',
                                'assigned' => 'status-assigned',
                                'in_progress' => 'status-progress',
                                'resolved' => 'status-resolved',
                                'closed' => 'status-closed',
                            ];

                            $ticketStatus = $ticket->status ?? 'open';
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <span class="ticket-number">
                                    {{ $ticket->ticket_number ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <span class="ticket-subject">
                                    {{ $ticket->subject ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $ticket->category->name ?? '-' }}
                            </td>

                            <td>
                                <span class="status {{ $statusClasses[$ticketStatus] ?? 'status-closed' }}">
                                    {{ $statusLabels[$ticketStatus] ?? ucfirst(str_replace('_', ' ', $ticketStatus)) }}
                                </span>
                            </td>

                            <td>
                                {{ $ticket->created_at
                                    ? $ticket->created_at->format('d/m/Y H:i')
                                    : '-' }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                <div class="empty">
                                    <div class="empty-icon">🎫</div>
                                    Belum ada aktivitas tiket.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
