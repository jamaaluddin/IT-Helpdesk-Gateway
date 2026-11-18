@extends('layouts.admin')

@section('title', 'Riwayat Maintenance')
@section('page-title', 'Riwayat Maintenance')
@section('page-subtitle', 'Monitoring riwayat pemeliharaan PC, aset, internet, dan server PT Gateway.')

@push('styles')

.maintenance-page {
    width: 100%;
}

.maintenance-page .page-heading {
    margin-bottom: 25px;
}

.maintenance-page .page-heading h1 {
    margin: 0;
    font-size: 26px;
    color: #065f46;
}

.maintenance-page .page-heading p {
    margin-top: 7px;
    color: #6b7280;
    font-size: 14px;
}

/* =========================
   SECTION CARD
========================= */

.maintenance-page .maintenance-section {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    margin-bottom: 25px;
}

.maintenance-page .section-header {
    padding: 20px 22px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.maintenance-page .section-title h3 {
    margin: 0;
    font-size: 17px;
    color: #111827;
}

.maintenance-page .section-title p {
    margin: 6px 0 0;
    font-size: 12px;
    color: #6b7280;
}

.maintenance-page .section-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.maintenance-page .total-badge {
    background: #d1fae5;
    color: #065f46;
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

/* =========================
   PRINT BUTTON
========================= */

.maintenance-page .print-btn {
    padding: 9px 15px;
    border: 1px solid #059669;
    border-radius: 8px;
    background: #059669;
    color: white;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease,
                background 0.2s ease;
}

.maintenance-page .print-btn:hover {
    background: #047857;
    transform: translateY(-3px);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
}

.maintenance-page .print-btn:active {
    transform: translateY(-1px);
    box-shadow: none;
}

/* =========================
   FILTER
========================= */

.maintenance-page .filter-area {
    padding: 18px 22px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.maintenance-page .filter-title {
    font-size: 12px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 12px;
}

.maintenance-page .filter-group {
    display: flex;
    flex-wrap: wrap;
    align-items: end;
    gap: 12px;
}

.maintenance-page .filter-form {
    display: flex;
    align-items: end;
    gap: 7px;
    flex-wrap: wrap;
}

.maintenance-page .filter-field {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.maintenance-page .filter-field label {
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
}

.maintenance-page .filter-field input {
    min-width: 145px;
    padding: 9px 10px;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    background: white;
    font-size: 12px;
    color: #374151;
}

.maintenance-page .filter-btn {
    padding: 9px 13px;
    border: none;
    border-radius: 7px;
    background: #059669;
    color: white;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.maintenance-page .filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 9px rgba(0, 0, 0, 0.12);
}

.maintenance-page .reset-btn {
    display: inline-block;
    padding: 9px 12px;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    background: white;
    color: #374151;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
}

/* =========================
   TABLE
========================= */

.maintenance-page .table-wrapper {
    width: 100%;
    max-height: 500px;
    overflow: auto;
}

.maintenance-page table {
    width: 100%;
    min-width: 950px;
    border-collapse: separate;
    border-spacing: 0;
}

.maintenance-page thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    background: #ecfdf5;
    color: #065f46;
    padding: 13px 14px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.maintenance-page tbody td {
    padding: 14px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 13px;
    color: #374151;
    vertical-align: middle;
}

.maintenance-page tbody tr:hover {
    background: #f9fafb;
}

.maintenance-page .asset-name {
    font-weight: 700;
    color: #111827;
}

.maintenance-page .asset-code {
    display: inline-block;
    margin-top: 4px;
    font-size: 11px;
    font-weight: 700;
    color: #047857;
}

.maintenance-page .condition-badge {
    display: inline-block;
    padding: 6px 9px;
    border-radius: 20px;
    background: #f3f4f6;
    color: #374151;
    font-size: 10px;
    font-weight: 700;
}

.maintenance-page .status-badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 20px;
    background: #dcfce7;
    color: #166534;
    font-size: 10px;
    font-weight: 700;
}

.maintenance-page .empty {
    text-align: center;
    padding: 45px 20px !important;
    color: #6b7280;
}

.maintenance-page .empty-icon {
    font-size: 35px;
    margin-bottom: 10px;
}

.maintenance-page .empty-title {
    font-size: 14px;
    font-weight: 700;
    color: #374151;
}

.maintenance-page .empty-text {
    margin-top: 5px;
    font-size: 12px;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 700px) {
    .maintenance-page .section-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .maintenance-page .section-actions {
        width: 100%;
        justify-content: space-between;
    }

    .maintenance-page .filter-form {
        width: 100%;
    }

    .maintenance-page .filter-field {
        flex: 1;
    }

    .maintenance-page .filter-field input {
        width: 100%;
        min-width: 0;
    }

    .maintenance-page .page-heading h1 {
        font-size: 23px;
    }
}

/* =========================
   PRINT
========================= */

@media print {

    body * {
        visibility: hidden !important;
    }

    body[data-print-target="pc-print-area"] #pc-print-area,
    body[data-print-target="pc-print-area"] #pc-print-area * {
        visibility: visible !important;
    }

    body[data-print-target="server-print-area"] #server-print-area,
    body[data-print-target="server-print-area"] #server-print-area * {
        visibility: visible !important;
    }

    body[data-print-target="pc-print-area"] #pc-print-area,
    body[data-print-target="server-print-area"] #server-print-area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        margin: 0;
        box-shadow: none;
        border: none;
    }

    .no-print {
        display: none !important;
    }

    .maintenance-page .table-wrapper {
        max-height: none;
        overflow: visible;
    }

    .maintenance-page table {
        min-width: 0;
        width: 100%;
    }

    .maintenance-page thead th {
        position: static;
        background: #ecfdf5 !important;
        print-color-adjust: exact;
        -webkit-print-color-adjust: exact;
    }

    .maintenance-page tbody tr {
        break-inside: avoid;
    }
}

@endpush

@section('content')

<div class="maintenance-page">

    <div class="page-heading">
        <h1>🔧 Riwayat Maintenance</h1>

        <p>
            Riwayat pelaksanaan pemeliharaan PC, aset, internet, dan server PT Gateway.
        </p>
    </div>

    {{-- =====================================================
         1. PC / ASSET MAINTENANCE
    ====================================================== --}}

    <section class="maintenance-section" id="pc-print-area">

        <div class="section-header">

            <div class="section-title">
                <h3>🖥️ PC / Asset Maintenance</h3>

                <p>
                    Riwayat pemeliharaan komputer dan aset IT.
                </p>
            </div>

            <div class="section-actions no-print">

                <span class="total-badge">
                    Total: {{ $pcRecords->count() }} data
                </span>

                <button
                    type="button"
                    class="print-btn"
                    onclick="printMaintenance('pc-print-area')"
                >
                    🖨️ Print
                </button>

            </div>

            <div class="section-actions print-only" style="display:none;">
                <strong>
                    Total: {{ $pcRecords->count() }} data
                </strong>
            </div>

        </div>

        {{-- FILTER PC --}}

        <div class="filter-area no-print">

            <div class="filter-title">
                Filter Riwayat PC / Asset
            </div>

            <div class="filter-group">

                {{-- FILTER HARI --}}

                <form method="GET"
                    action="{{ route('admin.maintenance.history') }}"
                    class="filter-form">

                    @foreach (['server_filter', 'server_date', 'server_month', 'server_year'] as $key)
                        @if (request()->filled($key))
                            <input type="hidden" name="{{ $key }}" value="{{ request($key) }}">
                        @endif
                    @endforeach

                    <input type="hidden" name="pc_filter" value="day">

                    <div class="filter-field">
                        <label>Hari</label>
                        <input
                            type="date"
                            name="pc_date"
                            value="{{ request('pc_date') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="filter-btn">
                        Terapkan
                    </button>

                </form>

                {{-- FILTER BULAN --}}

                <form method="GET"
                    action="{{ route('admin.maintenance.history') }}"
                    class="filter-form">

                    @foreach (['server_filter', 'server_date', 'server_month', 'server_year'] as $key)
                        @if (request()->filled($key))
                            <input type="hidden" name="{{ $key }}" value="{{ request($key) }}">
                        @endif
                    @endforeach

                    <input type="hidden" name="pc_filter" value="month">

                    <div class="filter-field">
                        <label>Bulan</label>
                        <input
                            type="month"
                            name="pc_month"
                            value="{{ request('pc_month') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="filter-btn">
                        Terapkan
                    </button>

                </form>

                {{-- FILTER TAHUN --}}

                <form method="GET"
                    action="{{ route('admin.maintenance.history') }}"
                    class="filter-form">

                    @foreach (['server_filter', 'server_date', 'server_month', 'server_year'] as $key)
                        @if (request()->filled($key))
                            <input type="hidden" name="{{ $key }}" value="{{ request($key) }}">
                        @endif
                    @endforeach

                    <input type="hidden" name="pc_filter" value="year">

                    <div class="filter-field">
                        <label>Tahun</label>
                        <input
                            type="number"
                            name="pc_year"
                            min="2000"
                            max="2100"
                            placeholder="Contoh: 2026"
                            value="{{ request('pc_year') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="filter-btn">
                        Terapkan
                    </button>

                </form>

                <a
                    href="{{ route('admin.maintenance.history', request()->except(['pc_filter', 'pc_date', 'pc_month', 'pc_year'])) }}"
                    class="reset-btn"
                >
                    Tampilkan Semua
                </a>

            </div>

        </div>

        {{-- TABEL PC --}}

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Aset</th>
                        <th>Kantor</th>
                        <th>Tanggal Maintenance</th>
                        <th>Dilakukan Oleh</th>
                        <th>Kondisi Setelah</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pcRecords as $record)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="asset-name">
                                    {{ $record->asset->name ?? '-' }}
                                </span>

                                <br>

                                <span class="asset-code">
                                    {{ $record->asset->asset_code ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $record->maintenanceSchedule?->office?->name ?? '-' }}
                            </td>

                            <td>
                                {{ $record->performed_at?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td>
                                {{ $record->performedBy->name ?? '-' }}
                            </td>

                            <td>
                                <span class="condition-badge">
                                    {{ $record->condition_after
                                        ? ucfirst(str_replace('_', ' ', $record->condition_after))
                                        : '-' }}
                                </span>
                            </td>

                            <td>
                                <span class="status-badge">
                                    Selesai
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="empty">

                                <div class="empty-icon">🖥️</div>

                                <div class="empty-title">
                                    Belum Ada Riwayat PC / Asset Maintenance
                                </div>

                                <div class="empty-text">
                                    Data pemeliharaan PC dan aset akan ditampilkan di sini.
                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>


    {{-- =====================================================
         2. INTERNET / SERVER MAINTENANCE
    ====================================================== --}}

    <section class="maintenance-section" id="server-print-area">

        <div class="section-header">

            <div class="section-title">
                <h3>🌐 Internet / Server Maintenance</h3>

                <p>
                    Riwayat pemeriksaan jaringan internet dan server kantor.
                </p>
            </div>

            <div class="section-actions no-print">

                <span class="total-badge">
                    Total: {{ $serverRecords->count() }} data
                </span>

                <button
                    type="button"
                    class="print-btn"
                    onclick="printMaintenance('server-print-area')"
                >
                    🖨️ Print
                </button>

            </div>

            <div class="section-actions print-only" style="display:none;">
                <strong>
                    Total: {{ $serverRecords->count() }} data
                </strong>
            </div>

        </div>

        {{-- FILTER SERVER --}}

        <div class="filter-area no-print">

            <div class="filter-title">
                Filter Riwayat Internet / Server
            </div>

            <div class="filter-group">

                {{-- FILTER HARI --}}

                <form method="GET"
                    action="{{ route('admin.maintenance.history') }}"
                    class="filter-form">

                    @foreach (['pc_filter', 'pc_date', 'pc_month', 'pc_year'] as $key)
                        @if (request()->filled($key))
                            <input type="hidden" name="{{ $key }}" value="{{ request($key) }}">
                        @endif
                    @endforeach

                    <input type="hidden" name="server_filter" value="day">

                    <div class="filter-field">
                        <label>Hari</label>
                        <input
                            type="date"
                            name="server_date"
                            value="{{ request('server_date') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="filter-btn">
                        Terapkan
                    </button>

                </form>

                {{-- FILTER BULAN --}}

                <form method="GET"
                    action="{{ route('admin.maintenance.history') }}"
                    class="filter-form">

                    @foreach (['pc_filter', 'pc_date', 'pc_month', 'pc_year'] as $key)
                        @if (request()->filled($key))
                            <input type="hidden" name="{{ $key }}" value="{{ request($key) }}">
                        @endif
                    @endforeach

                    <input type="hidden" name="server_filter" value="month">

                    <div class="filter-field">
                        <label>Bulan</label>
                        <input
                            type="month"
                            name="server_month"
                            value="{{ request('server_month') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="filter-btn">
                        Terapkan
                    </button>

                </form>

                {{-- FILTER TAHUN --}}

                <form method="GET"
                    action="{{ route('admin.maintenance.history') }}"
                    class="filter-form">

                    @foreach (['pc_filter', 'pc_date', 'pc_month', 'pc_year'] as $key)
                        @if (request()->filled($key))
                            <input type="hidden" name="{{ $key }}" value="{{ request($key) }}">
                        @endif
                    @endforeach

                    <input type="hidden" name="server_filter" value="year">

                    <div class="filter-field">
                        <label>Tahun</label>
                        <input
                            type="number"
                            name="server_year"
                            min="2000"
                            max="2100"
                            placeholder="Contoh: 2026"
                            value="{{ request('server_year') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="filter-btn">
                        Terapkan
                    </button>

                </form>

                <a
                    href="{{ route('admin.maintenance.history', request()->except(['server_filter', 'server_date', 'server_month', 'server_year'])) }}"
                    class="reset-btn"
                >
                    Tampilkan Semua
                </a>

            </div>

        </div>

        {{-- TABEL SERVER --}}

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kantor</th>
                        <th>Tanggal Maintenance</th>
                        <th>Dilakukan Oleh</th>
                        <th>IP Address</th>
                        <th>Security</th>
                        <th>Bandwidth</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($serverRecords as $record)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $record->office->name ?? '-' }}
                            </td>

                            <td>
                                {{ $record->maintenance_date?->format('d/m/Y') ?? '-' }}
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
                            <td colspan="7" class="empty">

                                <div class="empty-icon">🌐</div>

                                <div class="empty-title">
                                    Belum Ada Riwayat Internet / Server Maintenance
                                </div>

                                <div class="empty-text">
                                    Data pemeliharaan internet dan server akan ditampilkan di sini.
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

@push('scripts')
<script>
    function printMaintenance(sectionId) {
        document.body.setAttribute('data-print-target', sectionId);

        window.onafterprint = function () {
            document.body.removeAttribute('data-print-target');
        };

        window.print();
    }
</script>
@endpush
