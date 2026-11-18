@extends('layouts.itsupport')

@section('title', 'PC Maintenance')

@section('page-title', 'PC Maintenance')

@section('page-subtitle', 'Jadwal dan pemeliharaan komputer IT Gateway')

@section('content')

<style>
    .pc-maintenance-page {
        max-width: 1400px;
        margin: auto;
    }

    .page-heading {
        margin-bottom: 27px;
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

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 15px;
        background: #ede9fe;
        color: #7c3aed;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: bold;
        transition: background .2s ease, transform .2s ease;
    }

    .back-button:hover {
        background: #ddd6fe;
        transform: translateY(-2px);
    }

    .section {
        background: white;
        border-radius: 18px;
        padding: 28px;
        border: 1px solid #eef2f7;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, .03),
            0 8px 18px rgba(0, 0, 0, .05),
            0 16px 35px rgba(0, 0, 0, .06),
            0 25px 60px rgba(124, 58, 237, .07);
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title h3 {
        font-size: 19px;
        color: #172033;
    }

    .total {
        color: #7c3aed;
        background: #ede9fe;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #7c3aed;
        color: white;
        text-decoration: none;
        padding: 11px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: bold;
        white-space: nowrap;
        box-shadow:
            0 4px 9px rgba(124, 58, 237, .22),
            0 10px 20px rgba(124, 58, 237, .13);
        transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .btn-primary:hover {
        background: #6d28d9;
        color: white;
        transform: translateY(-2px);
        box-shadow:
            0 5px 12px rgba(124, 58, 237, .25),
            0 12px 24px rgba(124, 58, 237, .15);
    }

    .btn-primary:active,
    .detail-button:active {
        transform: translateY(0);
    }

    .table-wrapper {
        max-height: 500px;
        overflow: auto;
        border-radius: 12px;
    }

    .table-wrapper table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .table-wrapper th {
        position: sticky;
        top: 0;
        z-index: 2;
        text-align: left;
        padding: 14px;
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .table-wrapper td {
        padding: 16px 14px;
        font-size: 13px;
        border-bottom: 1px solid #eef2f7;
        background: white;
        vertical-align: top;
    }

    .table-wrapper tbody tr:hover td {
        background: #fcfaff;
    }

    .table-wrapper tbody tr:last-child td {
        border-bottom: none;
    }

    .asset-name {
        font-weight: bold;
        color: #172033;
        margin-bottom: 4px;
    }

    .asset-code {
        color: #7c3aed;
        font-size: 12px;
        font-weight: bold;
    }

    .office-name {
        font-weight: bold;
        color: #1f2937;
    }

    .date {
        white-space: nowrap;
    }

    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .badge-scheduled {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-completed {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-cancelled {
        background: #fee2e2;
        color: #dc2626;
    }

    .badge-rescheduled {
        background: #e0f2fe;
        color: #0284c7;
    }

    .badge-default {
        background: #f3f4f6;
        color: #6b7280;
    }

    .detail-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 8px 15px;
        background: #7c3aed;
        color: white;
        border-radius: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        box-shadow: 0 4px 9px rgba(124, 58, 237, .18);
        transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
    }

    .detail-button:hover {
        background: #6d28d9;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 7px 15px rgba(124, 58, 237, .25);
    }

    .empty {
        text-align: center;
        padding: 35px;
        color: #6b7280;
        background: #f9fafb;
        border: 1px dashed #dbe2ea;
        border-radius: 10px;
        font-size: 14px;
    }

    .empty-icon {
        font-size: 35px;
        margin-bottom: 10px;
    }

    .empty h3 {
        color: #374151;
        margin-bottom: 6px;
        font-size: 17px;
    }

    .empty p {
        font-size: 13px;
    }

    @media (max-width: 600px) {
        .section-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .section-title {
            width: 100%;
            justify-content: space-between;
        }

        .btn-primary {
            width: 100%;
        }
    }

    @media (max-width: 550px) {
        .section {
            padding: 18px;
        }

        .section-title {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
        }
    }
</style>

<div class="pc-maintenance-page">

    <div class="page-heading">

        <h2>💻 PC Maintenance</h2>

        <p>
            Lihat jadwal maintenance komputer yang perlu ditangani.
        </p>

        <a
            href="{{ route('it-support.dashboard') }}"
            class="back-button"
        >
            ← Kembali ke Dashboard
        </a>

    </div>

    <section class="section">

        <div class="section-header">

            <div class="section-title">

                <h3>Jadwal Maintenance</h3>

                <span class="total">
                    Total: {{ $schedules->count() }} jadwal
                </span>

            </div>

            <a
                href="{{ route('it-support.maintenance.schedules.create') }}"
                class="btn-primary"
            >
                + Buat Jadwal
            </a>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Aset</th>
                        <th>Kantor</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($schedules as $schedule)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="asset-name">
                                    {{ $schedule->asset->name ?? '-' }}
                                </div>

                                <div class="asset-code">
                                    {{ $schedule->asset->asset_code ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <div class="office-name">
                                    {{ $schedule->office->name ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="date">
                                    {{ $schedule->scheduled_date?->format('d/m/Y') ?? '-' }}
                                </span>
                            </td>

                            <td>

                                @if ($schedule->status === 'scheduled')

                                    <span class="badge badge-scheduled">
                                        Terjadwal
                                    </span>

                                @elseif ($schedule->status === 'waiting_confirmation')

                                    <span class="badge badge-rescheduled">
                                        Menunggu Konfirmasi User
                                    </span>

                                @elseif ($schedule->status === 'completed')

                                    <span class="badge badge-completed">
                                        Selesai
                                    </span>

                                @elseif ($schedule->status === 'rescheduled')

                                    <span class="badge badge-rescheduled">
                                        Dijadwalkan Ulang
                                    </span>

                                @else

                                    <span class="badge badge-default">
                                        {{ ucfirst(str_replace('_', ' ', $schedule->status)) }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $schedule->scheduledBy->name ?? '-' }}
                            </td>

                            <td>
                                <a
                                    href="{{ route('it-support.maintenance.pc.show', $schedule) }}"
                                    class="detail-button"
                                >
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">
                                <div class="empty">
                                    <div class="empty-icon">🔧</div>

                                    <h3>Belum Ada Jadwal Maintenance</h3>

                                    <p>
                                        Saat ini belum ada jadwal PC maintenance yang tersedia.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection
