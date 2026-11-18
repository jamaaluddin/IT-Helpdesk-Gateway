@extends('layouts.itsupport')

@section('title', 'Dashboard IT Support')

@section('page-title', 'Dashboard IT Support')

@section('page-subtitle', 'Ringkasan aktivitas dan pemeliharaan IT Gateway')

@section('content')

<style>
    .welcome-card {
        padding: 25px 28px;
        margin-bottom: 25px;
        border-radius: 14px;
        background: linear-gradient(120deg, #4c1d95, #7c3aed);
        color: #fff;
        box-shadow: 0 5px 15px rgba(76, 29, 149, .15);
    }

    .welcome-card h2 {
        margin-bottom: 8px;
        font-size: 22px;
        font-weight: 700;
    }

    .welcome-card p {
        color: #ede9fe;
        font-size: 13px;
        line-height: 1.6;
    }

    .section-title {
        margin-bottom: 16px;
        color: #111827;
        font-size: 17px;
        font-weight: 700;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-height: 125px;
        padding: 19px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 2px 7px rgba(0, 0, 0, .035);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, .09);
    }

    .stat-card:active {
        transform: translateY(-1px);
    }

    .stat-label {
        margin-bottom: 13px;
        color: #6b7280;
        font-size: 12px;
        font-weight: 600;
    }

    .stat-value {
        color: #111827;
        font-size: 29px;
        font-weight: 700;
        line-height: 1;
    }

    .stat-description {
        margin-top: 9px;
        color: #9ca3af;
        font-size: 11px;
    }

    .stat-card.total {
        border-top: 3px solid #7c3aed;
    }

    .stat-card.open {
        border-top: 3px solid #f59e0b;
    }

    .stat-card.progress {
        border-top: 3px solid #3b82f6;
    }

    .stat-card.resolved {
        border-top: 3px solid #10b981;
    }

    .stat-card.reopened {
        border-top: 3px solid #ef4444;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(320px, .9fr);
        gap: 20px;
        align-items: start;
    }

    .dashboard-panel {
        min-width: 0;
        padding: 21px;
        border: 1px solid #e5e7eb;
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 2px 7px rgba(0, 0, 0, .035);
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 17px;
    }

    .panel-header h3 {
        color: #111827;
        font-size: 15px;
        font-weight: 700;
    }

    .panel-link {
        color: #7c3aed;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .panel-link:hover {
        color: #5b21b6;
        text-decoration: underline;
    }

    .ticket-list,
    .schedule-list {
        display: flex;
        flex-direction: column;
    }

    .ticket-item {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .ticket-item:first-child {
        padding-top: 0;
    }

    .ticket-item:last-child,
    .schedule-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .ticket-info {
        min-width: 0;
    }

    .ticket-number {
        margin-bottom: 5px;
        color: #7c3aed;
        font-size: 11px;
        font-weight: 700;
    }

    .ticket-subject {
        display: block;
        overflow-wrap: anywhere;
        color: #1f2937;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.5;
    }

    .ticket-date {
        margin-top: 5px;
        color: #9ca3af;
        font-size: 11px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        flex-shrink: 0;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 10px;
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

    .status-in_progress {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-resolved,
    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }

    .status-closed {
        background: #e5e7eb;
        color: #374151;
    }

    .status-scheduled {
        background: #ede9fe;
        color: #5b21b6;
    }

    .status-waiting_confirmation {
        background: #ffedd5;
        color: #9a3412;
    }

    .status-rescheduled {
        background: #fce7f3;
        color: #9d174d;
    }

    .schedule-item {
        padding: 14px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .schedule-item:first-child {
        padding-top: 0;
    }

    .schedule-name {
        margin-bottom: 6px;
        color: #1f2937;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.5;
    }

    .schedule-detail {
        display: flex;
        flex-wrap: wrap;
        gap: 7px 13px;
        margin-bottom: 9px;
        color: #9ca3af;
        font-size: 11px;
    }

    .schedule-status {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .empty-state {
        padding: 30px 15px;
        color: #9ca3af;
        font-size: 12px;
        text-align: center;
    }

    .empty-icon {
        margin-bottom: 9px;
        color: #c4b5fd;
        font-size: 28px;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .welcome-card {
            padding: 21px;
        }

        .welcome-card h2 {
            font-size: 19px;
        }

        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 11px;
        }

        .stat-card {
            min-height: 112px;
            padding: 15px;
        }

        .stat-value {
            font-size: 25px;
        }

        .dashboard-panel {
            padding: 16px;
        }

        .ticket-item {
            flex-direction: column;
            gap: 9px;
        }
    }

    @media (max-width: 360px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

{{-- WELCOME --}}
<div class="welcome-card">
    <h2>Selamat Datang, {{ auth()->user()->name }} 👋</h2>
    <p>
        Berikut ringkasan tiket bantuan dan jadwal pemeliharaan
        yang sedang dikelola oleh IT Support Gateway.
    </p>
</div>

{{-- STATISTIK TIKET --}}
<h3 class="section-title">Ringkasan Tiket</h3>

<div class="stats-grid">

    <a href="{{ route('it-support.tickets') }}" class="stat-card total">
        <span class="stat-label">Total Tiket</span>
        <span class="stat-value">{{ $totalTickets }}</span>
        <span class="stat-description">Seluruh tiket masuk</span>
    </a>

    <a href="{{ route('it-support.tickets', ['status' => 'open']) }}"
        class="stat-card open">
        <span class="stat-label">Tiket Menunggu</span>
        <span class="stat-value">{{ $openTickets }}</span>
        <span class="stat-description">Menunggu penanganan</span>
    </a>

    <a href="{{ route('it-support.tickets', ['status' => 'in_progress']) }}"
        class="stat-card progress">
        <span class="stat-label">Dalam Pengerjaan</span>
        <span class="stat-value">{{ $inProgressTickets }}</span>
        <span class="stat-description">Sedang ditangani</span>
    </a>

    <a href="{{ route('it-support.tickets', ['status' => 'resolved']) }}"
        class="stat-card resolved">
        <span class="stat-label">Selesai</span>
        <span class="stat-value">{{ $resolvedTickets }}</span>
        <span class="stat-description">Tiket telah diselesaikan</span>
    </a>

    <a href="{{ route('it-support.tickets', ['status' => 'reopened']) }}"
        class="stat-card reopened">
        <span class="stat-label">Perbaikan Ulang</span>
        <span class="stat-value">{{ $reopenedTickets }}</span>
        <span class="stat-description">Tiket dibuka kembali</span>
    </a>

</div>

{{-- TIKET DAN MAINTENANCE --}}
<div class="dashboard-grid">

    {{-- TIKET TERBARU --}}
    <section class="dashboard-panel">
        <div class="panel-header">
            <h3>Tiket Terbaru</h3>
            <a href="{{ route('it-support.tickets') }}" class="panel-link">
                Lihat Semua →
            </a>
        </div>

        <div class="ticket-list">
            @forelse ($latestTickets as $ticket)
                <a href="{{ route('it-support.tickets.show', $ticket->id) }}"
                    class="ticket-item">

                    <div class="ticket-info">
                        <div class="ticket-number">
                            {{ $ticket->ticket_number }}
                        </div>

                        <div class="ticket-subject">
                            {{ $ticket->subject }}
                        </div>

                        <div class="ticket-date">
                            {{ $ticket->created_at?->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <span class="status-badge status-{{ $ticket->status }}">
                        @switch($ticket->status)
                            @case('open')
                                Menunggu
                                @break
                            @case('assigned')
                                Ditugaskan
                                @break
                            @case('in_progress')
                                Dikerjakan
                                @break
                            @case('resolved')
                                Selesai
                                @break
                            @case('closed')
                                Ditutup
                                @break
                            @default
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        @endswitch
                    </span>

                </a>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">▤</div>
                    Belum ada tiket terbaru.
                </div>
            @endforelse
        </div>
    </section>

    {{-- JADWAL MAINTENANCE --}}
    <section class="dashboard-panel">
        <div class="panel-header">
            <h3>Jadwal Maintenance</h3>
            <a href="{{ route('it-support.maintenance.pc') }}" class="panel-link">
                Lihat Jadwal →
            </a>
        </div>

        <div class="schedule-list">
            @forelse ($maintenanceSchedules as $schedule)
                <div class="schedule-item">

                    <div class="schedule-name">
                        {{ optional($schedule->asset)->name ?? 'Maintenance Aset' }}
                    </div>

                    <div class="schedule-detail">
                        <span>
                            {{ optional($schedule->office)->name ?? 'Lokasi belum tersedia' }}
                        </span>

                        <span>
                            {{ $schedule->scheduled_date
                                ? \Carbon\Carbon::parse($schedule->scheduled_date)->format('d M Y')
                                : '-' }}
                        </span>
                    </div>

                    <div class="schedule-status">
                        <span class="status-badge status-{{ $schedule->status }}">
                            @switch($schedule->status)
                                @case('scheduled')
                                    Terjadwal
                                    @break
                                @case('waiting_confirmation')
                                    Menunggu Konfirmasi
                                    @break
                                @case('completed')
                                    Selesai
                                    @break
                                @case('rescheduled')
                                    Dijadwalkan Ulang
                                    @break
                                @default
                                    {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                            @endswitch
                        </span>
                    </div>

                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">▣</div>
                    Belum ada jadwal maintenance.
                </div>
            @endforelse
        </div>
    </section>

</div>

@endsection
