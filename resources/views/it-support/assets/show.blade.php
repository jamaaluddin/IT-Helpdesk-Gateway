
@extends('layouts.itsupport')

@section('title', 'Detail Aset')
@section('page-title', 'Detail Aset')
@section('page-subtitle', 'Informasi lengkap aset Gateway yang terdaftar dalam sistem')

@section('content')

<style>
    .container {
        max-width: 1400px;
        margin: auto;
        padding: 30px;
    }

    .page-heading {
        margin-bottom: 24px;
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

    .detail-card {
        background: white;
        border-radius: 17px;
        border: 1px solid #eef2f7;
        padding: 30px;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, 0.03),
            0 8px 18px rgba(0, 0, 0, 0.05),
            0 16px 35px rgba(0, 0, 0, 0.06),
            0 25px 50px rgba(124, 58, 237, 0.06);
    }

    .asset-summary {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 22px;
        background: #f5f3ff;
        border: 1px solid #ede9fe;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .asset-icon {
        width: 62px;
        height: 62px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 12px;
        font-size: 30px;
    }

    .asset-summary-info h3 {
        color: #172033;
        font-size: 20px;
        margin-bottom: 6px;
    }

    .asset-summary-info p {
        color: #7c3aed;
        font-size: 13px;
        font-weight: bold;
    }

    .detail-section {
        margin-bottom: 30px;
    }

    .detail-section:last-of-type {
        margin-bottom: 25px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 14px;
        margin-bottom: 22px;
        border-bottom: 1px solid #eef2f7;
    }

    .section-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #ede9fe;
        color: #7c3aed;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .section-heading h3 {
        font-size: 16px;
        color: #172033;
    }

    .section-heading p {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 3px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .detail-item {
        min-width: 0;
        padding: 15px;
        background: #fafafa;
        border: 1px solid #eef2f7;
        border-radius: 9px;
    }

    .detail-item.full {
        grid-column: 1 / -1;
    }

    .detail-label {
        display: block;
        color: #6b7280;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 9px;
    }

    .detail-value {
        display: block;
        color: #1f2937;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .detail-muted {
        color: #9ca3af;
        font-weight: normal;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .condition-good,
    .status-available {
        background: #dcfce7;
        color: #15803d;
    }

    .condition-minor,
    .status-maintenance {
        background: #fef3c7;
        color: #b45309;
    }

    .condition-major,
    .status-damaged {
        background: #ffedd5;
        color: #c2410c;
    }

    .condition-broken,
    .status-retired {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status-in-use {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .detail-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        padding-top: 22px;
        border-top: 1px solid #eef2f7;
    }

    .btn {
        min-width: 115px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-back {
        background: #f3f4f6;
        color: #4b5563;
    }

    .btn-back:hover {
        background: #e5e7eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .btn-edit {
        background: #7c3aed;
        color: white;
        box-shadow: 0 4px 10px rgba(124, 58, 237, 0.20);
    }

    .btn-edit:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(124, 58, 237, 0.25);
    }

    .btn:active {
        transform: translateY(1px);
    }

    /* RIWAYAT ASET */

    .history-card {
        background: white;
        border: 1px solid #eef2f7;
        border-radius: 17px;
        margin-top: 25px;
        padding: 25px 30px;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, 0.03),
            0 8px 18px rgba(0, 0, 0, 0.05),
            0 16px 35px rgba(0, 0, 0, 0.04);
    }

    .history-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 18px;
        border-bottom: 1px solid #eef2f7;
        margin-bottom: 10px;
    }

    .history-heading h3 {
        font-size: 17px;
        color: #172033;
    }

    .history-heading p {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 5px;
    }

    .history-count {
        background: #ede9fe;
        color: #6d28d9;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
    }

    .history-table-wrapper {
        width: 100%;
        max-height: 500px;
        overflow: auto;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 750px;
    }

    .history-table th {
        position: sticky;
        top: 0;
        z-index: 2;
        text-align: left;
        padding: 14px 12px;
        color: #6b7280;
        background: #fafafa;
        font-size: 12px;
        border-bottom: 1px solid #eef2f7;
        white-space: nowrap;
    }

    .history-table td {
        padding: 16px 12px;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: top;
        line-height: 1.6;
    }

    .history-table tr:last-child td {
        border-bottom: none;
    }

    .history-action {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .history-created {
        background: #dcfce7;
        color: #15803d;
    }

    .history-updated {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .history-empty {
        text-align: center;
        padding: 35px 15px;
        color: #9ca3af;
        font-size: 13px;
    }

    @media (max-width: 1200px) {
        .container {
            padding: 25px;
        }
    }

    @media (max-width: 900px) {
        .container {
            padding: 20px;
        }

        .detail-card {
            padding: 24px;
        }
    }

    @media (max-width: 700px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }

        .detail-item.full {
            grid-column: auto;
        }

        .history-card {
            padding: 20px 16px;
        }

        .history-heading {
            align-items: flex-start;
        }
    }

    @media (max-width: 550px) {
        .container {
            padding: 15px;
        }

        .detail-card {
            padding: 20px 16px;
        }

        .asset-summary {
            align-items: flex-start;
            padding: 16px;
        }

        .asset-summary-info h3 {
            font-size: 17px;
        }

        .detail-actions {
            flex-direction: column-reverse;
        }

        .detail-actions .btn {
            width: 100%;
        }
    }
</style>

<main class="container">

    <div class="page-heading">
        <h2>Detail Informasi Aset</h2>
        <p>
            Lihat informasi lengkap aset Gateway yang terdaftar dalam sistem.
        </p>
    </div>

    <div class="detail-card">

        <div class="asset-summary">
            <div class="asset-icon">💻</div>

            <div class="asset-summary-info">
                <h3>{{ $asset->name }}</h3>
                <p>{{ $asset->asset_code }}</p>
            </div>
        </div>

        {{-- INFORMASI ASET --}}
        <section class="detail-section">

            <div class="section-heading">
                <div class="section-icon">💻</div>

                <div>
                    <h3>Informasi Aset</h3>
                    <p>Identitas dan spesifikasi dasar aset.</p>
                </div>
            </div>

            <div class="detail-grid">

                <div class="detail-item">
                    <span class="detail-label">Kategori Aset</span>
                    <span class="detail-value">
                        {{ $asset->assetType?->name ?? '—' }}
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Kode Aset</span>
                    <span class="detail-value">
                        {{ $asset->asset_code }}
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Nama Aset</span>
                    <span class="detail-value">
                        {{ $asset->name }}
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Merek</span>
                    <span class="detail-value">
                        {{ $asset->brand ?: '—' }}
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Model</span>
                    <span class="detail-value">
                        {{ $asset->model ?: '—' }}
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Nomor Seri</span>
                    <span class="detail-value">
                        {{ $asset->serial_number ?: '—' }}
                    </span>
                </div>

            </div>
        </section>

        {{-- LOKASI ASET --}}
        <section class="detail-section">

            <div class="section-heading">
                <div class="section-icon">📍</div>

                <div>
                    <h3>Lokasi Aset</h3>
                    <p>Informasi kantor dan departemen pengguna aset.</p>
                </div>
            </div>

            <div class="detail-grid">

                <div class="detail-item">
                    <span class="detail-label">Kantor</span>
                    <span class="detail-value">
                        {{ $asset->office?->name ?? '—' }}
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Departemen</span>
                    <span class="detail-value">
                        {{ $asset->department?->name ?? '—' }}
                    </span>
                </div>

            </div>
        </section>

        {{-- INFORMASI PEMBELIAN --}}
        <section class="detail-section">

            <div class="section-heading">
                <div class="section-icon">🛒</div>

                <div>
                    <h3>Informasi Pembelian</h3>
                    <p>Data harga dan tanggal pembelian aset.</p>
                </div>
            </div>

            <div class="detail-grid">

                <div class="detail-item">
                    <span class="detail-label">Harga Pembelian</span>
                    <span class="detail-value">
                        @if ($asset->purchase_price !== null)
                            Rp {{ number_format((float) $asset->purchase_price, 0, ',', '.') }}
                        @else
                            —
                        @endif
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Tanggal Pembelian</span>
                    <span class="detail-value">
                        {{ $asset->purchase_date?->format('d-m-Y') ?? '—' }}
                    </span>
                </div>

            </div>
        </section>

        {{-- KONDISI DAN STATUS --}}
        <section class="detail-section">

            <div class="section-heading">
                <div class="section-icon">⚙️</div>

                <div>
                    <h3>Kondisi dan Status Aset</h3>
                    <p>Kondisi fisik dan status penggunaan aset saat ini.</p>
                </div>
            </div>

            <div class="detail-grid">

                <div class="detail-item">
                    <span class="detail-label">Kondisi</span>

                    <span class="detail-value">
                        @php
                            $conditionLabels = [
                                'good' => 'Baik',
                                'minor_damage' => 'Rusak Ringan',
                                'major_damage' => 'Rusak Berat',
                                'broken' => 'Tidak Berfungsi',
                            ];

                            $conditionClasses = [
                                'good' => 'condition-good',
                                'minor_damage' => 'condition-minor',
                                'major_damage' => 'condition-major',
                                'broken' => 'condition-broken',
                            ];
                        @endphp

                        <span class="status-badge {{ $conditionClasses[$asset->condition] ?? '' }}">
                            {{ $conditionLabels[$asset->condition] ?? $asset->condition }}
                        </span>
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Status</span>

                    <span class="detail-value">
                        @php
                            $statusLabels = [
                                'available' => 'Tersedia',
                                'in_use' => 'Digunakan',
                                'maintenance' => 'Dalam Maintenance',
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

                        <span class="status-badge {{ $statusClasses[$asset->status] ?? '' }}">
                            {{ $statusLabels[$asset->status] ?? $asset->status }}
                        </span>
                    </span>
                </div>

                <div class="detail-item full">
                    <span class="detail-label">Catatan Aset</span>

                    <span class="detail-value {{ $asset->notes ? '' : 'detail-muted' }}">
                        {{ $asset->notes ?: 'Belum ada catatan untuk aset ini.' }}
                    </span>
                </div>

            </div>
        </section>

        {{-- BUTTON --}}
        <div class="detail-actions">

            <a
                href="{{ route('it-support.assets.category', $asset->asset_type_id) }}"
                class="btn btn-back"
            >
                ← Kembali
            </a>

            <a
                href="{{ route('it-support.assets.edit', $asset->id) }}"
                class="btn btn-edit"
            >
                ✏️ Edit Aset
            </a>

        </div>

    </div>

    {{-- RIWAYAT ASET --}}
    <section class="history-card">

        <div class="history-heading">

            <div>
                <h3>📜 Riwayat Aset</h3>
                <p>Catatan aktivitas dan perubahan data aset.</p>
            </div>

            <span class="history-count">
                {{ $histories->count() }} Aktivitas
            </span>

        </div>

        @if ($histories->isNotEmpty())

            <div class="history-table-wrapper">

                <table class="history-table">

                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Aktivitas</th>
                            <th>Deskripsi</th>
                            <th>Petugas</th>
                            <th>Kantor</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($histories as $history)

                            <tr>

                                <td>
                                    {{ $history->action_date
                                        ? \Carbon\Carbon::parse($history->action_date)->format('d/m/Y')
                                        : '—' }}
                                </td>

                                <td>
                                    @php
                                        $actionLabels = [
                                            'created' => 'Ditambahkan',
                                            'updated' => 'Diperbarui',
                                        ];
                                    @endphp

                                    <span class="history-action {{ $history->action === 'created' ? 'history-created' : 'history-updated' }}">
                                        {{ $actionLabels[$history->action] ?? ucfirst($history->action) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $history->description ?: '—' }}
                                </td>

                                <td>
                                    {{ $history->user?->name ?? '—' }}
                                </td>

                                <td>
                                    {{ $history->office?->name ?? '—' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="history-empty">
                Belum ada riwayat aktivitas untuk aset ini.
            </div>

        @endif

    </section>

</main>

@endsection
