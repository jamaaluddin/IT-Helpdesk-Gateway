
@extends('layouts.admin')

@section('title', 'Detail Aset - Gateway Admin')
@section('page-title', 'Asset Management')
@section('page-subtitle', 'Informasi lengkap aset IT Gateway')

@push('styles')

/* =========================
   PAGE HEADING
========================= */

.page-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.page-heading h1 {
    margin: 0;
    font-size: 28px;
    color: #064e3b;
}

.page-heading p {
    margin: 7px 0 0;
    color: #6b7280;
    font-size: 14px;
}

/* =========================
   BACK BUTTON
========================= */

.back-btn {
    display: inline-block;
    margin-bottom: 18px;
    color: #047857;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}

.back-btn:hover {
    text-decoration: underline;
}

/* =========================
   CARD
========================= */

.asset-detail-card {
    background: white;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    overflow: hidden;
    margin-bottom: 24px;
}

.asset-card-header {
    padding: 20px 22px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.asset-card-header h3 {
    margin: 0;
    font-size: 18px;
    color: #111827;
    overflow-wrap: anywhere;
}

.asset-code {
    margin-top: 5px;
    font-size: 12px;
    color: #6b7280;
}

/* =========================
   HEADER ACTIONS
========================= */

.header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.header-actions form {
    margin: 0;
}

.edit-btn,
.retire-btn,
.delete-btn {
    display: inline-block;
    padding: 10px 16px;
    border: none;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
}

.edit-btn {
    background: #059669;
    color: white;
}

.edit-btn:hover {
    background: #047857;
}

.retire-btn {
    background: #dc2626;
    color: white;
}

.retire-btn:hover {
    background: #b91c1c;
}

.delete-btn {
    background: #991b1b;
    color: white;
}

.delete-btn:hover {
    background: #7f1d1d;
}

/* =========================
   EFEK INTERAKSI TOMBOL
========================= */

.edit-btn,
.retire-btn,
.delete-btn,
.back-btn {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.edit-btn:hover,
.retire-btn:hover,
.delete-btn:hover,
.back-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
}

.edit-btn:active,
.retire-btn:active,
.delete-btn:active,
.back-btn:active {
    transform: translateY(-1px);
    box-shadow: none;
}

/* =========================
   DETAIL INFORMATION
========================= */

.details {
    padding: 22px;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.detail-item {
    min-width: 0;
    padding: 14px;
    background: #f9fafb;
    border: 1px solid #f0f0f0;
    border-radius: 10px;
}

.detail-label {
    font-size: 11px;
    color: #6b7280;
    margin-bottom: 6px;
}

.detail-value {
    font-size: 14px;
    font-weight: 600;
    color: #111827;
    overflow-wrap: anywhere;
    line-height: 1.5;
}

.notes {
    grid-column: 1 / -1;
}

/* =========================
   BADGES
========================= */

.badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.condition-good,
.status-available {
    background: #dcfce7;
    color: #166534;
}

.condition-minor {
    background: #fef3c7;
    color: #92400e;
}

.condition-major,
.status-maintenance {
    background: #ffedd5;
    color: #9a3412;
}

.condition-broken,
.status-damaged {
    background: #fee2e2;
    color: #991b1b;
}

.status-in-use {
    background: #dbeafe;
    color: #1d4ed8;
}

.status-retired {
    background: #e5e7eb;
    color: #374151;
}

/* =========================
   HISTORY
========================= */

.history-header {
    padding: 20px 22px;
    border-bottom: 1px solid #e5e7eb;
}

.history-header h3 {
    margin: 0;
    font-size: 17px;
    color: #111827;
}

.history-list {
    padding: 10px 22px 22px;
}

.history-item {
    padding: 16px 0;
    border-bottom: 1px solid #f0f0f0;
}

.history-item:last-child {
    border-bottom: none;
}

.history-top {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 6px;
}

.history-action {
    font-size: 13px;
    font-weight: 700;
    color: #047857;
    overflow-wrap: anywhere;
}

.history-date {
    font-size: 11px;
    color: #6b7280;
    white-space: nowrap;
}

.history-description {
    font-size: 13px;
    color: #4b5563;
    line-height: 1.5;
    overflow-wrap: anywhere;
}

.history-empty {
    padding: 40px 20px;
    text-align: center;
    color: #6b7280;
    font-size: 13px;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 900px) {

    .page-heading h1 {
        font-size: 25px;
    }

    .asset-card-header {
        align-items: flex-start;
    }

    .header-actions {
        justify-content: flex-end;
    }

}

@media (max-width: 700px) {

    .page-heading {
        align-items: flex-start;
        flex-direction: column;
    }

    .asset-card-header {
        flex-direction: column;
    }

    .header-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .details {
        grid-template-columns: 1fr;
        padding: 18px;
    }

    .notes {
        grid-column: auto;
    }

}

@media (max-width: 480px) {

    .page-heading h1 {
        font-size: 23px;
    }

    .asset-card-header {
        padding: 18px;
    }

    .header-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .header-actions form {
        width: 100%;
    }

    .edit-btn,
    .retire-btn,
    .delete-btn {
        display: block;
        width: 100%;
    }

    .details {
        padding: 15px;
        gap: 12px;
    }

    .history-header {
        padding: 18px;
    }

    .history-list {
        padding: 8px 18px 18px;
    }

    .history-top {
        flex-direction: column;
        gap: 5px;
    }

    .history-date {
        white-space: normal;
    }

}

@endpush

@section('content')

<div class="page-heading">
    <div>
        <h1>Detail Aset</h1>
        <p>Informasi lengkap aset yang terdaftar di sistem.</p>
    </div>
</div>

<a href="{{ route('admin.assets.index') }}" class="back-btn">
    ← Kembali ke Asset Management
</a>

{{-- DETAIL ASET --}}

<div class="asset-detail-card">

    <div class="asset-card-header">

        <div>
            <h3>{{ $asset->name }}</h3>

            <div class="asset-code">
                Kode Aset: {{ $asset->asset_code }}
            </div>
        </div>

        <div class="header-actions">

            <a
                href="{{ route('admin.assets.edit', $asset) }}"
                class="edit-btn"
            >
                Edit Aset
            </a>

            @if($asset->status !== 'retired')

                <form
                    action="{{ route('admin.assets.retire', $asset) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin mempensiunkan aset ini?');"
                >
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="retire-btn">
                        Pensiunkan Aset
                    </button>
                </form>

            @endif

            <form
                action="{{ route('admin.assets.destroy', $asset) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus aset ini? Data aset dan riwayatnya akan dihapus permanen.');"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="delete-btn">
                    Hapus Aset
                </button>
            </form>

        </div>

    </div>

    <div class="details">

        <div class="detail-item">
            <div class="detail-label">Jenis Aset</div>
            <div class="detail-value">
                {{ $asset->assetType->name ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Merek</div>
            <div class="detail-value">
                {{ $asset->brand ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Model</div>
            <div class="detail-value">
                {{ $asset->model ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Serial Number</div>
            <div class="detail-value">
                {{ $asset->serial_number ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Office / Lokasi</div>
            <div class="detail-value">
                {{ $asset->office->name ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Departemen</div>
            <div class="detail-value">
                {{ $asset->department->name ?? '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Harga Pembelian</div>
            <div class="detail-value">
                @if($asset->purchase_price !== null)
                    Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}
                @else
                    -
                @endif
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Tanggal Pembelian</div>
            <div class="detail-value">
                {{ $asset->purchase_date ? $asset->purchase_date->format('d/m/Y') : '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Kondisi</div>
            <div class="detail-value">

                @switch($asset->condition)

                    @case('good')
                        <span class="badge condition-good">Baik</span>
                        @break

                    @case('minor_damage')
                        <span class="badge condition-minor">Rusak Ringan</span>
                        @break

                    @case('major_damage')
                        <span class="badge condition-major">Rusak Berat</span>
                        @break

                    @case('broken')
                        <span class="badge condition-broken">Rusak</span>
                        @break

                    @default
                        -

                @endswitch

            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Status</div>
            <div class="detail-value">

                @switch($asset->status)

                    @case('available')
                        <span class="badge status-available">Tersedia</span>
                        @break

                    @case('in_use')
                        <span class="badge status-in-use">Digunakan</span>
                        @break

                    @case('maintenance')
                        <span class="badge status-maintenance">Maintenance</span>
                        @break

                    @case('damaged')
                        <span class="badge status-damaged">Rusak</span>
                        @break

                    @case('retired')
                        <span class="badge status-retired">Dipensiunkan</span>
                        @break

                    @default
                        -

                @endswitch

            </div>
        </div>

        <div class="detail-item notes">
            <div class="detail-label">Catatan</div>
            <div class="detail-value">
                {{ $asset->notes ?? '-' }}
            </div>
        </div>

    </div>

</div>

{{-- RIWAYAT ASET --}}

<div class="asset-detail-card">

    <div class="history-header">
        <h3>📜 Riwayat Aset</h3>
    </div>

    @if($asset->histories->count() > 0)

        <div class="history-list">

            @foreach($asset->histories->sortByDesc('action_date') as $history)

                <div class="history-item">

                    <div class="history-top">

                        <div class="history-action">
                            {{ $history->action }}
                        </div>

                        <div class="history-date">
                            {{ $history->action_date ? $history->action_date->format('d/m/Y') : '-' }}
                        </div>

                    </div>

                    <div class="history-description">
                        {{ $history->description ?? '-' }}
                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="history-empty">
            Belum ada riwayat untuk aset ini.
        </div>

    @endif

</div>

@endsection
