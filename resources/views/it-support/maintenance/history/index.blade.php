@extends('layouts.itsupport')

@section('title', 'Riwayat Maintenance')

@section('page-title', 'Riwayat Maintenance')

@section('page-subtitle', 'Riwayat pekerjaan maintenance IT Gateway')

@section('content')

<style>
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
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        color: #7c3aed;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 20px;
        transition: .2s ease;
    }

    .back-button:hover {
        color: #6d28d9;
        transform: translateX(-2px);
    }

    .section {
        background: white;
        border-radius: 18px;
        padding: 28px;
        border: 1px solid #eef2f7;
        box-shadow:
            0 3px 7px rgba(0,0,0,.03),
            0 8px 18px rgba(0,0,0,.05),
            0 16px 35px rgba(0,0,0,.06),
            0 25px 60px rgba(124,58,237,.07);
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-header h3 {
        font-size: 19px;
        color: #172033;
    }

    .total {
        color: #6b7280;
        font-size: 13px;
        white-space: nowrap;
    }

    .table-wrapper {
        max-height: 500px;
        overflow: auto;
        border-radius: 12px;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 850px;
    }

    th {
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

    td {
        padding: 16px 14px;
        font-size: 13px;
        border-bottom: 1px solid #eef2f7;
        background: white;
    }

    tbody tr:hover td {
        background: #fcfaff;
    }

    .asset-name {
        font-weight: bold;
        color: #172033;
    }

    .asset-code {
        color: #7c3aed;
        font-size: 12px;
        margin-top: 3px;
        font-weight: bold;
    }

    .date {
        color: #374151;
        font-weight: 600;
        white-space: nowrap;
    }

    .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .status-completed {
        background: #dcfce7;
        color: #16a34a;
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
        font-size: 30px;
        margin-bottom: 10px;
    }

    @media (max-width: 550px) {
        .section {
            padding: 20px;
        }

        .section-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

{{-- KEMBALI --}}
<a
    href="{{ route('it-support.dashboard') }}"
    class="back-button"
>
    ← Kembali ke Dashboard
</a>

{{-- PAGE HEADING --}}
<div class="welcome">
    <h2>📋 Riwayat Maintenance</h2>

    <p>
        Daftar pekerjaan maintenance yang telah dilakukan oleh IT Support.
    </p>
</div>

{{-- PC MAINTENANCE --}}
<section class="section">

    <div class="section-header">
        <h3>💻 PC / Asset Maintenance</h3>

        <span class="total">
            Total: {{ $pcRecords->count() }} pekerjaan
        </span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Aset</th>
                    <th>Kantor</th>
                    <th>Tanggal</th>
                    <th>Dilakukan Oleh</th>
                    <th>Kondisi Setelah</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pcRecords as $record)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <div class="asset-name">
                                {{ $record->asset->name ?? '-' }}
                            </div>

                            <div class="asset-code">
                                {{ $record->asset->asset_code ?? '-' }}
                            </div>
                        </td>

                        <td>
                            {{ $record->maintenanceSchedule->office->name ?? '-' }}
                        </td>

                        <td>
                            <span class="date">
                                {{ $record->performed_at?->format('d/m/Y H:i') ?? '-' }}
                            </span>
                        </td>

                        <td>
                            {{ $record->performedBy->name ?? '-' }}
                        </td>

                        <td>
                            {{ $record->condition_after ?? '-' }}
                        </td>

                        <td>
                            <span class="status status-completed">
                                Selesai
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">
                                <div class="empty-icon">🔧</div>
                                Belum ada riwayat PC maintenance.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</section>

{{-- SERVER MAINTENANCE --}}
<section class="section">

    <div class="section-header">
        <h3>🌐 Internet / Server Maintenance</h3>

        <span class="total">
            Total: {{ $serverRecords->count() }} pekerjaan
        </span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kantor</th>
                    <th>Tanggal</th>
                    <th>Dilakukan Oleh</th>
                    <th>IP Address</th>
                    <th>Security</th>
                    <th>Bandwidth</th>
                </tr>
            </thead>

            <tbody>
                @forelse($serverRecords as $record)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $record->office->name ?? '-' }}
                        </td>

                        <td>
                            <span class="date">
                                {{ $record->maintenance_date?->format('d/m/Y') ?? '-' }}
                            </span>
                        </td>

                        <td>
                            {{ $record->performedBy->name ?? '-' }}
                        </td>

                        <td>
                            {{ $record->ip_address ?? '-' }}
                        </td>

                        <td>
                            {{ $record->security ?? '-' }}
                        </td>

                        <td>
                            {{ $record->bandwidth ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">
                                <div class="empty-icon">🌐</div>
                                Belum ada riwayat Internet / Server maintenance.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</section>

@endsection
