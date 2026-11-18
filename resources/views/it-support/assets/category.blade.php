@extends('layouts.itsupport')

@section('title', $assetType->name . ' - Aset Gateway')
@section('page-title', 'Aset Gateway')
@section('page-subtitle', 'IT Helpdesk Management System')

@section('content')

<style>
    .container {
        max-width: 1400px;
        margin: auto;
        padding: 30px;
    }

    .page-heading {
        margin-bottom: 22px;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #9ca3af;
        margin-bottom: 12px;
    }

    .breadcrumb a {
        color: #7c3aed;
        text-decoration: none;
        font-weight: bold;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .page-heading h2 {
        font-size: 24px;
        color: #172033;
        margin-bottom: 7px;
    }

    .page-heading p {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.6;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        background: #7c3aed;
        color: white;
        border: 1px solid #7c3aed;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 22px;
        transition: 0.2s ease;
    }

    .back-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
    }

    .content-card {
        background: white;
        border-radius: 14px;
        padding: 24px;
        border: 1px solid #eef2f7;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, 0.03),
            0 8px 18px rgba(0, 0, 0, 0.04),
            0 16px 35px rgba(124, 58, 237, 0.04);
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 22px;
    }

    .section-header h3 {
        font-size: 17px;
        color: #172033;
        margin-bottom: 6px;
    }

    .section-header p {
        font-size: 12px;
        color: #6b7280;
    }

    .section-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .asset-count {
        background: #f3e8ff;
        color: #7c3aed;
        padding: 9px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 11px 15px;
        background: #7c3aed;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
        transition: 0.2s ease;
        box-shadow: 0 4px 10px rgba(98, 28, 220, 0.18);
    }

    .btn-add:hover {
        background: #6d28d9;
        transform: translateY(-2px);
    }

    .table-scroll {
        width: 100%;
        max-height: 500px;
        overflow: auto;
        border: 1px solid #eef2f7;
        border-radius: 10px;
    }

    table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .table-scroll thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #f8fafc;
    }

    table th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: bold;
        text-align: left;
        padding: 15px 14px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    table td {
        padding: 15px 14px;
        font-size: 12px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    table tbody tr:last-child td {
        border-bottom: none;
    }

    table tbody tr:hover {
        background: #faf7ff;
    }

    .number-cell {
        color: #9ca3af;
        width: 55px;
    }

    .asset-code {
        color: #6d28d9;
        font-weight: bold;
        white-space: nowrap;
    }

    .asset-name {
        font-weight: bold;
        color: #1f2937;
    }

    .sub-text {
        display: block;
        color: #9ca3af;
        font-size: 11px;
        margin-top: 4px;
    }

    .condition-badge,
    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .condition-good {
        background: #dcfce7;
        color: #15803d;
    }

    .condition-minor {
        background: #fef3c7;
        color: #b45309;
    }

    .condition-major {
        background: #ffedd5;
        color: #c2410c;
    }

    .condition-broken {
        background: #fee2e2;
        color: #b91c1c;
    }

    .condition-default {
        background: #f3f4f6;
        color: #4b5563;
    }

    .status-available {
        background: #dcfce7;
        color: #15803d;
    }

    .status-in-use {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-maintenance {
        background: #fef3c7;
        color: #b45309;
    }

    .status-damaged {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status-retired {
        background: #f3f4f6;
        color: #6b7280;
    }

    .status-default {
        background: #f3f4f6;
        color: #4b5563;
    }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 12px;
        background: #ede9fe;
        color: #6d28d9;
        border: 1px solid #e5e7eb;
        border-radius: 7px;
        text-decoration: none;
        font-size: 11px;
        font-weight: bold;
        transition: 0.2s ease;
    }

    .btn-detail:hover {
        background: #7c3aed;
        color: white;
        border-color: #7c3aed;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(124, 58, 237, 0.15);
    }

    .action-cell {
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        background: #f3e8ff;
        color: #7c3aed;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin: 0 auto 17px;
    }

    .empty-state h3 {
        font-size: 16px;
        color: #172033;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.6;
    }

    .alert-success {
        padding: 13px 16px;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: #166534;
        border-radius: 9px;
        font-size: 13px;
        margin-bottom: 20px;
    }

    @media (max-width: 1100px) {
        .container {
            padding: 25px 20px;
        }

        .content-card {
            padding: 20px;
        }
    }

    @media (max-width: 800px) {
        .container {
            padding: 20px;
        }
    }

    @media (max-width: 600px) {
        .container {
            padding: 18px 12px;
        }

        .page-heading h2 {
            font-size: 20px;
        }

        .content-card {
            padding: 16px;
        }

        .section-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .section-actions {
            width: 100%;
            justify-content: space-between;
        }

        .btn-add {
            padding: 10px 12px;
        }
    }
</style>

<div class="container">

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-heading">

        <div class="breadcrumb">
            <a href="{{ route('it-support.assets.index') }}">
                Aset Gateway
            </a>

            <span>/</span>

            <span>{{ $assetType->name }}</span>
        </div>

        <h2>{{ $assetType->name }}</h2>

        <p>
            Daftar dan informasi inventaris aset Gateway
            berdasarkan kategori {{ strtolower($assetType->name) }}.
        </p>

    </div>

    <a
        href="{{ route('it-support.assets.index') }}"
        class="back-btn"
    >
        ← Kembali ke Kategori Aset
    </a>

    <section class="content-card">

        <div class="section-header">

            <div>
                <h3>Daftar {{ $assetType->name }}</h3>

                <p>
                    Informasi aset yang terdaftar dalam kategori ini.
                </p>
            </div>

            <div class="section-actions">

                <div class="asset-count">
                    {{ $assets->count() }} Aset
                </div>

                <a
                    href="{{ route('it-support.assets.create') }}"
                    class="btn-add"
                >
                    + Tambah Aset
                </a>

            </div>

        </div>

        @if ($assets->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">📦</div>

                <h3>Belum Ada Aset</h3>

                <p>
                    Belum terdapat data aset pada kategori
                    {{ $assetType->name }}.
                    <br>
                    Silakan tambahkan aset untuk mulai mengisi inventaris.
                </p>

            </div>

        @else

            <div class="table-scroll">

                <table>

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Aset</th>
                            <th>Nama Aset</th>
                            <th>Merek / Model</th>
                            <th>Kantor</th>
                            <th>Departemen</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($assets as $asset)

                            @php
                                $condition = strtolower($asset->condition ?? '');
                                $status = strtolower($asset->status ?? '');

                                $conditionLabels = [
                                    'good' => 'Baik',
                                    'minor_damage' => 'Rusak Ringan',
                                    'major_damage' => 'Rusak Berat',
                                    'broken' => 'Rusak Total',
                                ];

                                $conditionClasses = [
                                    'good' => 'condition-good',
                                    'minor_damage' => 'condition-minor',
                                    'major_damage' => 'condition-major',
                                    'broken' => 'condition-broken',
                                ];

                                $statusLabels = [
                                    'available' => 'Tersedia',
                                    'in_use' => 'Digunakan',
                                    'maintenance' => 'Maintenance',
                                    'damaged' => 'Rusak',
                                    'retired' => 'Dipensiunkan',
                                ];

                                $statusClasses = [
                                    'available' => 'status-available',
                                    'in_use' => 'status-in-use',
                                    'maintenance' => 'status-maintenance',
                                    'damaged' => 'status-damaged',
                                    'retired' => 'status-retired',
                                ];
                            @endphp

                            <tr>

                                <td class="number-cell">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <span class="asset-code">
                                        {{ $asset->asset_code }}
                                    </span>
                                </td>

                                <td>
                                    <span class="asset-name">
                                        {{ $asset->name }}
                                    </span>
                                </td>

                                <td>
                                    {{ $asset->brand ?: '—' }}

                                    @if ($asset->model)
                                        <span class="sub-text">
                                            {{ $asset->model }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $asset->office->name ?? '—' }}
                                </td>

                                <td>
                                    {{ $asset->department->name ?? '—' }}
                                </td>

                                <td>
                                    <span class="condition-badge {{ $conditionClasses[$condition] ?? 'condition-default' }}">
                                        {{ $conditionLabels[$condition] ?? ($asset->condition ?: '—') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="status-badge {{ $statusClasses[$status] ?? 'status-default' }}">
                                        {{ $statusLabels[$status] ?? ($asset->status ?: '—') }}
                                    </span>
                                </td>

                                <td class="action-cell">

                                    <a
                                        href="{{ route('it-support.assets.show', $asset->id) }}"
                                        class="btn-detail"
                                    >
                                        👁️ Detail
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </section>

</div>

@endsection
