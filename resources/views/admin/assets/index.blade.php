
@extends('layouts.admin')

@section('title', 'Asset Management - Gateway Admin')
@section('page-title', 'Asset Management')
@section('page-subtitle', 'Kelola dan pantau aset IT Gateway')

@push('styles')

    /* =========================
       PAGE HEADING
    ========================== */

    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .page-heading h2 {
        font-size: 28px;
        line-height: 1.3;
        color: #064e3b;
    }

    .page-heading p {
        margin-top: 7px;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.5;
    }

    .page-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* =========================
       BUTTON
    ========================== */

   .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 11px 16px;
        border: 1px solid transparent;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    }

    .btn:active {
        transform: translateY(-1px);
        box-shadow: none;
    }

    .btn-primary {
        background: #059669;
        color: white;
    }

    .btn-primary:hover {
        background: #047857;
    }

    .btn-secondary {
        background: white;
        color: #047857;
        border-color: #a7f3d0;
    }

    .btn-secondary:hover {
        background: #ecfdf5;
    }

    /* =========================
       CARD
    ========================== */

    .card {
        width: 100%;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header {
        padding: 15px 18px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .card-header h3 {
        font-size: 16px;
        color: #111827;
    }

    .card-header span {
        font-size: 12px;
        color: #6b7280;
        white-space: nowrap;
    }

    /* =========================
       TABLE
    ========================== */

    .table-wrapper {
        width: 100%;
        max-height: 500px;
        overflow: auto;
    }

    .table-wrapper table {
        width: 100%;
        min-width: 1100px;
        border-collapse: collapse;
    }

    .table-wrapper thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        padding: 13px 12px;
        background: #ecfdf5;
        color: #065f46;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table-wrapper tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
        color: #374151;
        vertical-align: middle;
    }

    .table-wrapper tbody tr:last-child td {
        border-bottom: none;
    }

    .table-wrapper tbody tr:hover {
        background: #f9fafb;
    }

    .asset-code {
        color: #047857;
        font-weight: 700;
        white-space: nowrap;
    }

    .asset-name {
        display: inline-block;
        color: #111827;
        font-weight: 600;
        min-width: 130px;
    }

    .price {
        font-weight: 600;
        white-space: nowrap;
    }

    .action-cell {
        white-space: nowrap;
    }

   .detail-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 9px 15px;
        background: #059669;
        color: white;
        border: 1px solid transparent;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .detail-btn:hover {
        background: #047857;
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    }

    .detail-btn:active {
        transform: translateY(-1px);
        box-shadow: none;
    }
    /* =========================
       CONDITION AND STATUS
    ========================== */

    .badge {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .condition-good {
        background: #dcfce7;
        color: #166534;
    }

    .condition-minor {
        background: #fef3c7;
        color: #92400e;
    }

    .condition-major {
        background: #ffedd5;
        color: #9a3412;
    }

    .condition-broken {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-available {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-in-use {
        background: #dcfce7;
        color: #166534;
    }

    .status-maintenance {
        background: #fef3c7;
        color: #92400e;
    }

    .status-damaged {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-retired {
        background: #e5e7eb;
        color: #374151;
    }

    /* =========================
       EMPTY STATE
    ========================== */

    .empty {
        text-align: center;
        padding: 50px 20px !important;
        color: #6b7280;
    }

    .empty-icon {
        margin-bottom: 10px;
        font-size: 38px;
    }

    .empty-title {
        font-size: 15px;
        font-weight: 700;
        color: #374151;
    }

    .empty-text {
        margin-top: 5px;
        font-size: 12px;
        line-height: 1.6;
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 1000px) {
        .page-heading h2 {
            font-size: 25px;
        }
    }

    @media (max-width: 700px) {
        .page-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-heading h2 {
            font-size: 24px;
        }

        .page-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .page-actions .btn {
            flex: 1;
        }

        .card-header {
            padding: 14px;
        }
    }

    @media (max-width: 480px) {
        .page-heading h2 {
            font-size: 22px;
        }

        .page-actions {
            display: grid;
            grid-template-columns: 1fr;
        }

        .page-actions .btn {
            width: 100%;
        }

        .card-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 6px;
        }
    }

@endpush

@section('content')

    <!-- PAGE HEADING -->
    <div class="page-heading">

        <div>
            <h2>💻 Asset Management</h2>

            <p>
                Daftar aset IT yang terdaftar di sistem.
            </p>
        </div>

        <div class="page-actions">

            <a
                href="{{ route('admin.asset-types.index') }}"
                class="btn btn-secondary"
            >
                Kelola Jenis Aset
            </a>

            <a
                href="{{ route('admin.assets.create') }}"
                class="btn btn-primary"
            >
                + Tambah Aset
            </a>

        </div>

    </div>

    <!-- ASSET TABLE -->
    <section class="card">

        <div class="card-header">

            <h3>Daftar Aset</h3>

            <span>
                Total: {{ $assets->count() }} aset
            </span>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>Kode Aset</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Model</th>
                        <th>Serial Number</th>
                        <th>Lokasi</th>
                        <th>Harga</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($assets as $asset)

                        <tr>

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
                                {{ $asset->assetType->name ?? '-' }}
                            </td>

                            <td>
                                {{ $asset->brand ?? '-' }}
                            </td>

                            <td>
                                {{ $asset->model ?? '-' }}
                            </td>

                            <td>
                                {{ $asset->serial_number ?? '-' }}
                            </td>

                            <td>
                                {{ $asset->office->name ?? '-' }}
                            </td>

                            <td>
                                @if ($asset->purchase_price !== null)
                                    <span class="price">
                                        Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if ($asset->condition === 'good')
                                    <span class="badge condition-good">
                                        Baik
                                    </span>
                                @elseif ($asset->condition === 'minor_damage')
                                    <span class="badge condition-minor">
                                        Rusak Ringan
                                    </span>
                                @elseif ($asset->condition === 'major_damage')
                                    <span class="badge condition-major">
                                        Rusak Berat
                                    </span>
                                @elseif ($asset->condition === 'broken')
                                    <span class="badge condition-broken">
                                        Rusak
                                    </span>
                                @else
                                    <span class="badge">
                                        {{ $asset->condition ?? '-' }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($asset->status === 'available')
                                    <span class="badge status-available">
                                        Tersedia
                                    </span>
                                @elseif ($asset->status === 'in_use')
                                    <span class="badge status-in-use">
                                        Digunakan
                                    </span>
                                @elseif ($asset->status === 'maintenance')
                                    <span class="badge status-maintenance">
                                        Maintenance
                                    </span>
                                @elseif ($asset->status === 'damaged')
                                    <span class="badge status-damaged">
                                        Rusak
                                    </span>
                                @elseif ($asset->status === 'retired')
                                    <span class="badge status-retired">
                                        Tidak Digunakan
                                    </span>
                                @else
                                    <span class="badge">
                                        {{ $asset->status ?? '-' }}
                                    </span>
                                @endif
                            </td>

                            <td class="action-cell">
                                <a
                                    href="{{ route('admin.assets.show', $asset) }}"
                                    class="detail-btn"
                                >
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="11" class="empty">

                                <div class="empty-icon">💻</div>

                                <div class="empty-title">
                                    Belum ada data aset
                                </div>

                                <div class="empty-text">
                                    Tambahkan aset IT Gateway untuk mulai mengelola inventaris.
                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

@endsection
