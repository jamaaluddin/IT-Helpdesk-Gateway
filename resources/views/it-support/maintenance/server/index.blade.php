@extends('layouts.itsupport')

@section('title', 'Internet / Server Maintenance')

@section('page-title', 'Internet / Server Maintenance')

@section('page-subtitle', 'Daftar laporan maintenance jaringan dan server IT Gateway')

@section('content')

<style>
    .server-maintenance-page {
        max-width: 1400px;
        margin: auto;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        color: #7c3aed;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 24px;
        transition: .2s ease;
    }

    .back-button:hover {
        color: #5b21b6;
        transform: translateX(-3px);
    }

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
        line-height: 1.6;
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

    .btn-primary:active {
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

    .office-name {
        font-weight: bold;
        color: #1f2937;
    }

    .date {
        white-space: nowrap;
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
        font-size: 32px;
        margin-bottom: 12px;
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

<div class="server-maintenance-page">

    <a href="{{ route('it-support.dashboard') }}" class="back-button">
        ← Kembali ke Dashboard
    </a>

    <div class="welcome">
        <h2>🌐 Internet / Server Maintenance</h2>
        <p>
            Lihat laporan pekerjaan maintenance Internet dan Server
            yang telah dicatat oleh IT Support.
        </p>
    </div>

    <section class="section">

        <div class="section-header">

            <div class="section-title">
                <h3>Daftar Maintenance</h3>

                <span class="total">
                    Total: {{ $serverMaintenances->count() }} laporan
                </span>
            </div>

            <a
                href="{{ route('it-support.maintenance.server.create') }}"
                class="btn-primary"
            >
                + Buat Laporan
            </a>

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
                        <th>Hasil</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($serverMaintenances as $maintenance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="office-name">
                                    {{ $maintenance->office->name ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="date">
                                    {{ $maintenance->maintenance_date?->format('d/m/Y') ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $maintenance->performedBy->name ?? '-' }}
                            </td>

                            <td>{{ $maintenance->ip_address ?? '-' }}</td>

                            <td>{{ $maintenance->security ?? '-' }}</td>

                            <td>{{ $maintenance->bandwidth ?? '-' }}</td>

                            <td>{{ $maintenance->result ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty">
                                    <div class="empty-icon">🌐</div>
                                    Belum ada laporan Internet / Server Maintenance.
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
