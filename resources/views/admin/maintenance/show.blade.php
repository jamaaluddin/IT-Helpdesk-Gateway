@extends('layouts.admin')

@section('title', 'Detail Maintenance')
@section('page-title', 'Detail Maintenance')
@section('page-subtitle', 'Informasi lengkap jadwal dan hasil pemeliharaan aset IT Gateway.')

@push('styles')
.maintenance-detail {
    width: 100%;
}

/* PAGE HEADING */
.maintenance-detail .page-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.maintenance-detail .page-heading h1 {
    margin: 0;
    font-size: 26px;
    color: #065f46;
}

.maintenance-detail .page-heading p {
    margin-top: 7px;
    color: #6b7280;
    font-size: 14px;
}

/* BACK BUTTON */
.maintenance-detail .back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 11px 17px;
    background: white;
    color: #065f46;
    border: 1px solid #a7f3d0;
    border-radius: 9px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
    transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
}

.maintenance-detail .back-btn:hover {
    background: #ecfdf5;
    transform: translateY(-3px);
    box-shadow: 0 5px 12px rgba(0, 0, 0, .12);
}

.maintenance-detail .back-btn:active {
    transform: translateY(-1px);
    box-shadow: none;
}

/* ALERT */
.maintenance-detail .success-alert {
    background: #dcfce7;
    border: 1px solid #86efac;
    color: #166534;
    padding: 13px 16px;
    border-radius: 9px;
    margin-bottom: 20px;
    font-size: 14px;
}

/* MAIN GRID */
.maintenance-detail .detail-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1.15fr);
    gap: 20px;
    align-items: start;
}

/* CARD */
.maintenance-detail .card {
    background: white;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, .06);
    overflow: hidden;
    min-width: 0;
}

.maintenance-detail .card-header {
    padding: 20px 22px;
    border-bottom: 1px solid #e5e7eb;
}

.maintenance-detail .card-header h3 {
    margin: 0;
    color: #065f46;
    font-size: 17px;
}

.maintenance-detail .card-header p {
    margin-top: 5px;
    color: #6b7280;
    font-size: 12px;
}

.maintenance-detail .card-body {
    padding: 22px;
}

/* SCHEDULE INFORMATION */
.maintenance-detail .info-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    padding: 13px 0;
    border-bottom: 1px solid #f3f4f6;
}

.maintenance-detail .info-row:first-child {
    padding-top: 0;
}

.maintenance-detail .info-row:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.maintenance-detail .info-label {
    color: #6b7280;
    font-size: 13px;
    flex-shrink: 0;
}

.maintenance-detail .info-value {
    color: #111827;
    font-size: 13px;
    font-weight: 600;
    text-align: right;
    overflow-wrap: anywhere;
    white-space: pre-line;
}

/* STATUS */
.maintenance-detail .badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.maintenance-detail .badge-scheduled {
    background: #dbeafe;
    color: #1d4ed8;
}

.maintenance-detail .badge-completed {
    background: #dcfce7;
    color: #166534;
}

.maintenance-detail .badge-cancelled {
    background: #fee2e2;
    color: #991b1b;
}

.maintenance-detail .badge-rescheduled {
    background: #fef3c7;
    color: #92400e;
}

.maintenance-detail .badge-default {
    background: #f3f4f6;
    color: #374151;
}

/* MAINTENANCE RECORD */
.maintenance-detail .record-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.maintenance-detail .record-card {
    border: 1px solid #e5e7eb;
    border-radius: 11px;
    overflow: hidden;
}

.maintenance-detail .record-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: #ecfdf5;
    border-bottom: 1px solid #d1fae5;
}

.maintenance-detail .record-title {
    color: #065f46;
    font-size: 14px;
    font-weight: 700;
}

.maintenance-detail .record-date {
    color: #6b7280;
    font-size: 11px;
    text-align: right;
}

.maintenance-detail .record-body {
    padding: 16px;
}

.maintenance-detail .record-item {
    margin-bottom: 13px;
}

.maintenance-detail .record-item:last-child {
    margin-bottom: 0;
}

.maintenance-detail .record-item strong {
    display: block;
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 5px;
}

.maintenance-detail .record-item span {
    display: block;
    color: #374151;
    font-size: 13px;
    line-height: 1.6;
    overflow-wrap: anywhere;
    white-space: pre-line;
}

/* EMPTY RECORD */
.maintenance-detail .empty-record {
    text-align: center;
    padding: 45px 20px;
    color: #6b7280;
}

.maintenance-detail .empty-icon {
    font-size: 35px;
    margin-bottom: 10px;
}

.maintenance-detail .empty-title {
    color: #374151;
    font-size: 14px;
    font-weight: 700;
}

.maintenance-detail .empty-text {
    margin-top: 5px;
    font-size: 12px;
    line-height: 1.6;
}

/* RESPONSIVE */
@media (max-width: 1000px) {
    .maintenance-detail .detail-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 700px) {
    .maintenance-detail .page-heading {
        flex-direction: column;
        align-items: flex-start;
    }

    .maintenance-detail .page-heading h1 {
        font-size: 23px;
    }

    .maintenance-detail .card-header {
        padding: 17px;
    }

    .maintenance-detail .card-body {
        padding: 17px;
    }
}

@media (max-width: 480px) {
    .maintenance-detail .info-row {
        flex-direction: column;
        gap: 6px;
    }

    .maintenance-detail .info-value {
        text-align: left;
    }

    .maintenance-detail .record-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .maintenance-detail .record-date {
        text-align: left;
    }
}
@endpush

@section('content')
<div class="maintenance-detail">

    {{-- PAGE HEADING --}}
    <div class="page-heading">
        <div>
            <h1>🔧 Detail Maintenance</h1>
            <p>
                Informasi jadwal dan dokumentasi hasil pemeliharaan aset IT Gateway.
            </p>
        </div>

        <a
            href="{{ route('admin.maintenance.schedules.index') }}"
            class="back-btn"
        >
            ← Kembali
        </a>
    </div>

    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="success-alert">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="detail-grid">

        {{-- INFORMASI JADWAL --}}
        <div class="card">

            <div class="card-header">
                <h3>Informasi Jadwal</h3>
                <p>Informasi dasar jadwal pemeliharaan aset.</p>
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
                        @if ($maintenanceSchedule->status === 'scheduled')
                            <span class="badge badge-scheduled">
                                Terjadwal
                            </span>
                        @elseif ($maintenanceSchedule->status === 'completed')
                            <span class="badge badge-completed">
                                Selesai
                            </span>
                        @elseif ($maintenanceSchedule->status === 'cancelled')
                            <span class="badge badge-cancelled">
                                Dibatalkan
                            </span>
                        @elseif ($maintenanceSchedule->status === 'rescheduled')
                            <span class="badge badge-rescheduled">
                                Dijadwalkan Ulang
                            </span>
                        @else
                            <span class="badge badge-default">
                                {{ ucfirst(str_replace('_', ' ', $maintenanceSchedule->status ?? 'Tidak diketahui')) }}
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

        {{-- HASIL MAINTENANCE --}}
        <div class="card">

            <div class="card-header">
                <h3>Hasil Maintenance</h3>
                <p>Dokumentasi pemeriksaan dan tindakan yang dilakukan IT Support.</p>
            </div>

            <div class="card-body">

                @forelse ($maintenanceSchedule->records as $record)

                    <div class="record-list">

                        <div class="record-card">

                            <div class="record-header">
                                <div class="record-title">
                                    Maintenance #{{ $record->id }}
                                </div>

                                <div class="record-date">
                                    {{ $record->performed_at
                                        ? $record->performed_at->format('d-m-Y H:i')
                                        : '-'
                                    }}
                                </div>
                            </div>

                            <div class="record-body">

                                <div class="record-item">
                                    <strong>IT Support</strong>
                                    <span>
                                        {{ $record->performedBy->name ?? '-' }}
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
                        </div>

                    </div>

                @empty

                    <div class="empty-record">
                        <div class="empty-icon">📋</div>

                        <div class="empty-title">
                            Belum Ada Hasil Maintenance
                        </div>

                        <div class="empty-text">
                            Dokumentasi pemeriksaan dari IT Support akan ditampilkan di sini setelah maintenance dilakukan.
                        </div>
                    </div>

                @endforelse

            </div>
        </div>

    </div>
</div>
@endsection
