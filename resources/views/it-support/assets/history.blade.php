@extends('layouts.itsupport')

@section('title', 'Riwayat Aset')
@section('page-title', 'Riwayat Aset')
@section('page-subtitle', 'Catatan aktivitas dan perubahan data aset Gateway')

@section('content')

<style>
    .history-card {
        background: white;
        border-radius: 17px;
        border: 1px solid #eef2f7;
        padding: 30px;
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.03),
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

    .table-wrapper {
        width: 100%;
        max-height: 500px;
        overflow: auto;
        border-radius: 8px;
    }

    .history-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .history-table thead {
        background: #f5f3ff;
    }

    .history-table th {
        position: sticky;
        top: 0;
        z-index: 2;
        padding: 15px 16px;
        text-align: left;
        color: #5b21b6;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
        border-bottom: 1px solid #ede9fe;
        background: #f5f3ff;
    }

    .history-table td {
        padding: 17px 16px;
        font-size: 13px;
        color: #4b5563;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: top;
        line-height: 1.6;
    }

    .history-table tbody tr:hover {
        background: #fafaff;
    }

    .history-table tbody tr:last-child td {
        border-bottom: none;
    }

    .action-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .action-created {
        background: #dcfce7;
        color: #15803d;
    }

    .action-updated {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .description {
        max-width: 380px;
        overflow-wrap: anywhere;
    }

    .user-name {
        color: #1f2937;
        font-weight: bold;
    }

    .date-text {
        white-space: nowrap;
        font-weight: bold;
        color: #374151;
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
    }

    .empty-icon {
        font-size: 42px;
        margin-bottom: 15px;
    }

    .empty-state h4 {
        font-size: 16px;
        color: #374151;
        margin-bottom: 7px;
    }

    .empty-state p {
        font-size: 13px;
        color: #9ca3af;
        line-height: 1.6;
    }

    .history-actions {
        display: flex;
        justify-content: flex-end;
        padding-top: 22px;
        margin-top: 20px;
        border-top: 1px solid #eef2f7;
    }

    .btn-back {
        min-width: 115px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        background: #f3f4f6;
        color: #4b5563;
        font-size: 13px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-back:hover {
        background: #e5e7eb;
        transform: translateY(-2px);
    }

    .btn-back:active {
        transform: translateY(0);
    }

    @media (max-width: 900px) {
        .history-card {
            padding: 24px;
        }
    }

    @media (max-width: 550px) {
        .history-card {
            padding: 20px 16px;
        }

        .asset-summary {
            align-items: flex-start;
            padding: 16px;
        }

        .asset-summary-info h3 {
            font-size: 17px;
        }

        .history-actions .btn-back {
            width: 100%;
        }
    }
</style>

<div class="history-card">

    {{-- RINGKASAN ASET --}}
    <div class="asset-summary">

        <div class="asset-icon">
            💻
        </div>

        <div class="asset-summary-info">
            <h3>{{ $asset->name }}</h3>
            <p>{{ $asset->asset_code }}</p>
        </div>

    </div>

    {{-- RIWAYAT AKTIVITAS --}}
    <section>

        <div class="section-heading">

            <div class="section-icon">📜</div>

            <div>
                <h3>Catatan Aktivitas</h3>
                <p>Daftar perubahan yang tercatat pada aset ini.</p>
            </div>

        </div>

        @if ($histories->isNotEmpty())

            <div class="table-wrapper">

                <table class="history-table">

                    <thead>
                        <tr>
                            <th>No.</th>
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

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="date-text">
                                        {{ $history->action_date?->format('d-m-Y') ?? '—' }}
                                    </span>
                                </td>

                                <td>

                                    @if ($history->action === 'created')
                                        <span class="action-badge action-created">
                                            Aset Ditambahkan
                                        </span>
                                    @elseif ($history->action === 'updated')
                                        <span class="action-badge action-updated">
                                            Data Diperbarui
                                        </span>
                                    @else
                                        <span class="action-badge">
                                            {{ ucfirst($history->action) }}
                                        </span>
                                    @endif

                                </td>

                                <td>
                                    <div class="description">
                                        {{ $history->description ?: 'Tidak ada deskripsi.' }}
                                    </div>
                                </td>

                                <td>
                                    <span class="user-name">
                                        {{ $history->user?->name ?? '—' }}
                                    </span>
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

            <div class="empty-state">

                <div class="empty-icon">📋</div>

                <h4>Belum Ada Riwayat Aktivitas</h4>

                <p>
                    Belum terdapat catatan aktivitas untuk aset ini.
                    <br>
                    Riwayat akan muncul ketika data aset ditambahkan atau diperbarui.
                </p>

            </div>

        @endif

    </section>

    {{-- BUTTON --}}
    <div class="history-actions">

        <a
            href="{{ route('it-support.assets.show', $asset->id) }}"
            class="btn-back"
        >
            ← Kembali ke Detail
        </a>

    </div>

</div>

@endsection
