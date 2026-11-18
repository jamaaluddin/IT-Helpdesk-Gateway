@extends('layouts.admin')

@section('title', 'Laporan Sistem')
@section('page-title', 'Laporan Sistem IT Helpdesk')
@section('page-subtitle', 'Kelola dan pantau performa operasional IT Helpdesk PT Gateway')

@section('content')

<style>
.report-page {
    width: 100%;
    padding-bottom: 25px;
    color: #1f2937;
}

.report-page * {
    box-sizing: border-box;
}

/* HEADER */

.report-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 22px 24px;
    margin-bottom: 16px;
    background: #fff;
    border: 1px solid #e5eaf0;
    border-radius: 12px;
}

.report-eyebrow,
.section-eyebrow {
    display: block;
    margin-bottom: 7px;
    color: #059669;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 1px;
}

.report-header h1 {
    margin: 0 0 5px;
    color: #172033;
    font-size: 24px;
    font-weight: 800;
}

.report-header p,
.section-heading p {
    margin: 0;
    color: #8491a3;
    font-size: 11px;
}

.header-actions,
.filter-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

/* BUTTON */

.report-page .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-height: 36px;
    padding: 8px 12px;
    border: 1px solid transparent;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: .2s ease;
}

.report-page .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(15, 23, 42, .08);
}

.report-page .btn:active {
    transform: translateY(1px);
    box-shadow: none;
}

.report-page .btn-primary {
    background: #059669;
    color: #fff;
}

.report-page .btn-primary:hover {
    background: #047857;
}

.report-page .btn-outline {
    background: #fff;
    border-color: #dce3eb;
    color: #475569;
}

.report-page .btn-outline:hover {
    background: #f0fdf4;
    border-color: #a7f3d0;
    color: #047857;
}

/* PANEL */

.report-panel {
    min-width: 0;
    padding: 17px;
    background: #fff;
    border: 1px solid #e5eaf0;
    border-radius: 10px;
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
}

.panel-heading h3,
.table-info h3 {
    margin: 0 0 4px;
    color: #263449;
    font-size: 13px;
    font-weight: 750;
}

.panel-heading p,
.table-info p {
    margin: 0;
    color: #94a3b8;
    font-size: 10px;
    line-height: 1.5;
}

/* FILTER */

.filter-panel {
    margin-bottom: 18px;
}

.filter-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.filter-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: #ecfdf5;
    color: #059669;
}

.filter-heading h2 {
    margin: 0 0 3px;
    color: #263449;
    font-size: 13px;
    font-weight: 750;
}

.filter-heading p {
    margin: 0;
    color: #94a3b8;
    font-size: 10px;
}

.filter-form {
    display: grid;
    grid-template-columns: repeat(4, minmax(110px, 1fr)) auto;
    align-items: end;
    gap: 10px;
}

.filter-field label {
    display: block;
    margin-bottom: 6px;
    color: #475569;
    font-size: 10px;
    font-weight: 700;
}

.filter-field input,
.filter-field select {
    width: 100%;
    height: 37px;
    padding: 0 9px;
    border: 1px solid #dce3eb;
    border-radius: 7px;
    background: #fff;
    color: #334155;
    font-size: 11px;
}

.filter-field input:focus,
.filter-field select:focus {
    outline: none;
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, .09);
}

/* SECTION */

.report-section {
    margin-top: 18px;
    padding: 19px;
    background: #fff;
    border: 1px solid #e5eaf0;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
}

.section-heading {
    margin-bottom: 17px;
}

.section-heading h2 {
    margin: 0 0 5px;
    color: #1e293b;
    font-size: 16px;
    font-weight: 800;
}

.section-heading-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

/* PERFORMANCE CARDS */

.performance-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 11px;
}

.performance-card {
    min-width: 0;
    padding: 14px;
    border: 1px solid #e5eaf0;
    border-radius: 9px;
    background: #fff;
    transition: .2s ease;
}

.performance-card:hover {
    transform: translateY(-2px);
    border-color: #a7f3d0;
    box-shadow: 0 5px 13px rgba(15, 23, 42, .05);
}

.metric-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 6px;
    margin-bottom: 12px;
}

.metric-top > span {
    color: #64748b;
    font-size: 10px;
    font-weight: 650;
}

.metric-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    flex: 0 0 30px;
    border-radius: 8px;
}

.metric-icon.blue {
    background: #dbeafe;
    color: #2563eb;
}

.metric-icon.orange {
    background: #ffedd5;
    color: #ea580c;
}

.metric-icon.green {
    background: #d1fae5;
    color: #059669;
}

.metric-icon.teal {
    background: #ccfbf1;
    color: #0f766e;
}

.metric-icon.purple {
    background: #ede9fe;
    color: #7c3aed;
}

.performance-card > strong {
    display: block;
    overflow-wrap: anywhere;
    color: #172033;
    font-size: 25px;
    font-weight: 800;
    letter-spacing: -.6px;
}

.performance-card > small {
    display: block;
    min-height: 25px;
    margin-top: 5px;
    color: #94a3b8;
    font-size: 9px;
    line-height: 1.5;
}

/* CHARTS */

.chart-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px;
}

.chart-wide {
    grid-column: 1 / -1;
}

.chart-container {
    position: relative;
    width: 100%;
    height: 220px;
}

.chart-container.chart-large {
    height: 260px;
}

.chart-container.chart-maintenance {
    height: 210px;
}

.chart-note {
    margin: 10px 0 0;
    color: #94a3b8;
    font-size: 9px;
    line-height: 1.5;
}

/* TABLE */

.maintenance-panel {
    padding: 0;
    overflow: hidden;
}

.table-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 15px 16px;
}

.record-count {
    padding: 5px 9px;
    border-radius: 20px;
    background: #ecfdf5;
    color: #047857;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.table-scroll {
    width: 100%;
    max-height: 500px;
    overflow: auto;
    border-top: 1px solid #e5eaf0;
}

.report-page table {
    width: 100%;
    min-width: 600px;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 10px;
}

.report-page thead th {
    position: sticky;
    top: 0;
    z-index: 2;
    padding: 12px 13px;
    background: #f8fafc;
    color: #64748b;
    text-align: left;
    font-size: 9px;
    font-weight: 800;
    white-space: nowrap;
}

.report-page th,
.report-page td {
    padding: 11px 13px;
    border-bottom: 1px solid #edf1f5;
    text-align: left;
}

.report-page tbody td {
    color: #475569;
}

.report-page tbody tr:hover {
    background: #f8fdfb;
}

.report-page tbody tr:last-child td {
    border-bottom: 0;
}

.empty-state {
    padding: 28px !important;
    text-align: center !important;
    color: #94a3b8 !important;
}

.empty-state i {
    display: block;
    margin-bottom: 7px;
    color: #cbd5e1;
    font-size: 20px;
}

/* PAGINATION */

.pagination-wrapper {
    padding: 12px 15px;
    border-top: 1px solid #edf1f5;
}

.pagination-wrapper nav {
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 10px;
}

.pagination-wrapper nav > div:first-child {
    display: none !important;
}

.pagination-wrapper nav > div:last-child {
    display: flex !important;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
    width: 100%;
}

.pagination-wrapper nav svg {
    width: 16px !important;
    height: 16px !important;
}

.pagination-wrapper nav a,
.pagination-wrapper nav span {
    font-size: 10px !important;
}

.pagination-wrapper nav a {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    min-height: 30px;
    padding: 5px 9px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    text-decoration: none;
}

.pagination-wrapper nav span[aria-current="page"] {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    min-width: 30px;
    min-height: 30px;
    padding: 5px 9px;
    border-radius: 6px;
    background: #059669;
    color: #fff;
}

/* FOOTER */

.report-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-top: 20px;
    padding: 13px 2px 0;
    border-top: 1px solid #e5eaf0;
    color: #94a3b8;
    font-size: 9px;
}

.report-footer strong,
.report-footer span {
    display: block;
}

.report-footer strong {
    margin-bottom: 3px;
    color: #64748b;
    font-size: 10px;
}

/* RESPONSIVE */

@media (max-width: 1200px) {
    .performance-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .filter-form {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .filter-actions {
        grid-column: 1 / -1;
    }
}

@media (max-width: 760px) {
    .report-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .header-actions {
        width: 100%;
    }

    .header-actions .btn {
        flex: 1;
    }

    .chart-grid {
        grid-template-columns: 1fr;
    }

    .chart-wide {
        grid-column: auto;
    }

    .performance-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .report-section {
        padding: 14px;
    }
}

@media (max-width: 480px) {
    .filter-form {
        grid-template-columns: 1fr;
    }

    .filter-actions {
        grid-column: auto;
    }

    .performance-grid {
        grid-template-columns: 1fr;
    }

    .section-heading-row {
        align-items: flex-start;
        flex-direction: column;
    }

    .report-footer {
        align-items: flex-start;
        flex-direction: column;
    }
}

/* PRINT / PDF */

@media print {
    @page {
        size: A4 landscape;
        margin: 10mm;
    }

    body {
        background: #fff !important;
    }

    .report-page {
        padding: 0;
    }

    .report-header {
        padding: 0 0 12px;
        border: 0;
    }

    .header-actions,
    .filter-panel,
    .pagination-wrapper,
    .btn-export {
        display: none !important;
    }

    .report-section {
        margin-top: 12px;
        padding: 12px;
        box-shadow: none;
        break-inside: auto;
    }

    .performance-card,
    .report-panel {
        box-shadow: none !important;
        break-inside: avoid;
    }

    .table-scroll {
        max-height: none;
        overflow: visible;
    }

    .report-page table {
        min-width: 0;
        font-size: 8px;
    }

    .report-page th,
    .report-page td {
        padding: 6px;
    }

    .report-page thead th {
        position: static;
    }

    .chart-container {
        break-inside: avoid;
    }
}
</style>

<div class="report-page">

    {{-- HEADER --}}
    <div class="report-header">
        <div>
            <span class="report-eyebrow">
                <i class="fas fa-chart-line"></i> IT HELPDESK REPORT
            </span>
            <h1>Laporan Sistem</h1>
            <p>Monitoring performa IT Helpdesk PT Gateway</p>
        </div>

        <div class="header-actions">
            <button type="button" class="btn btn-outline" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak / PDF
            </button>

            <button type="button" class="btn btn-primary" onclick="exportReportCSV()">
                <i class="fas fa-download"></i> Export CSV
            </button>
        </div>
    </div>

    {{-- FILTER --}}
    <section class="report-panel filter-panel">
        <div class="filter-heading">
            <div class="filter-icon">
                <i class="fas fa-filter"></i>
            </div>
            <div>
                <h2>Filter Laporan</h2>
                <p>Atur periode dan cakupan data yang ingin ditampilkan</p>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.reports.index') }}" class="filter-form">
            <div class="filter-field">
                <label for="start_date">Dari Tanggal</label>
                <input type="date" id="start_date" name="start_date"
                       value="{{ $startDate }}">
            </div>

            <div class="filter-field">
                <label for="end_date">Sampai Tanggal</label>
                <input type="date" id="end_date" name="end_date"
                       value="{{ $endDate }}">
            </div>

            <div class="filter-field">
                <label for="office_id">Kantor</label>
                <select name="office_id" id="office_id">
                    <option value="">Semua Kantor</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}"
                            {{ (string) $officeId === (string) $office->id ? 'selected' : '' }}>
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-field">
                <label for="department_id">Departemen</label>
                <select name="department_id" id="department_id">
                    <option value="">Semua Departemen</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ (string) $departmentId === (string) $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Terapkan
                </button>

                <a href="{{ route('admin.reports.index') }}" class="btn btn-outline">
                    Reset
                </a>
            </div>
        </form>
    </section>

    {{-- 01. PERFORMA IT HELPDESK --}}
    <section class="report-section">
        <div class="section-heading">
            <div>
                <span class="section-eyebrow">OVERVIEW</span>
                <h2>Performa IT Helpdesk</h2>
                <p>Ringkasan pencapaian dan kondisi penanganan tiket</p>
            </div>
        </div>

        <div class="performance-grid">
            <div class="performance-card" data-label="Total Tiket"
                 data-value="{{ $totalTickets }}">
                <div class="metric-top">
                    <span>Total Tiket</span>
                    <div class="metric-icon blue">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
                <strong>{{ number_format($totalTickets) }}</strong>
                <small>Seluruh tiket tercatat</small>
            </div>

            <div class="performance-card" data-label="Tiket Aktif"
                 data-value="{{ $activeTickets }}">
                <div class="metric-top">
                    <span>Tiket Aktif</span>
                    <div class="metric-icon orange">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <strong>{{ number_format($activeTickets) }}</strong>
                <small>Masih dalam penanganan</small>
            </div>

            <div class="performance-card" data-label="Tiket Selesai"
                 data-value="{{ $resolvedTickets }}">
                <div class="metric-top">
                    <span>Tiket Selesai</span>
                    <div class="metric-icon green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <strong>{{ number_format($resolvedTickets) }}</strong>
                <small>Telah diselesaikan</small>
            </div>

            <div class="performance-card" data-label="Efektivitas Penyelesaian"
                 data-value="{{ number_format($effectivenessPercentage, 1, ',', '.') }}%">
                <div class="metric-top">
                    <span>Efektivitas Penyelesaian</span>
                    <div class="metric-icon teal">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
                <strong>{{ number_format($effectivenessPercentage, 1) }}%</strong>
                <small>
                    {{ number_format($effectiveConfirmations) }} konfirmasi efektif
                    dari {{ number_format($effectiveConfirmations + $ineffectiveConfirmations) }}
                    konfirmasi
                </small>
            </div>

            <div class="performance-card" data-label="Tiket Ditangani IT Support"
                 data-value="{{ $totalHandledTickets }}">
                <div class="metric-top">
                    <span>Tiket Ditangani</span>
                    <div class="metric-icon purple">
                        <i class="fas fa-headset"></i>
                    </div>
                </div>
                <strong>{{ number_format($totalHandledTickets) }}</strong>
                <small>Jumlah tiket yang ditangani IT Support</small>
            </div>
        </div>
    </section>

    {{-- 02. DIAGRAM PERFORMA --}}
    <section class="report-section">
        <div class="section-heading">
            <div>
                <span class="section-eyebrow">ANALYTICS</span>
                <h2>Diagram Performa</h2>
                <p>Visualisasi perkembangan tiket dan aktivitas maintenance</p>
            </div>
        </div>

        <div class="chart-grid">
            <div class="report-panel chart-wide">
                <div class="panel-heading">
                    <div>
                        <h3>Tren Tiket</h3>
                        <p>Perbandingan jumlah tiket masuk dan tiket selesai setiap bulan</p>
                    </div>
                </div>
                <div class="chart-container chart-large">
                    <canvas id="ticketTrendChart"></canvas>
                </div>
            </div>

            <div class="report-panel">
                <div class="panel-heading">
                    <div>
                        <h3>Status Tiket</h3>
                        <p>Distribusi tiket berdasarkan tahapan penanganan</p>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="ticketStatusChart"></canvas>
                </div>
            </div>

            <div class="report-panel">
                <div class="panel-heading">
                    <div>
                        <h3>Prioritas Tiket</h3>
                        <p>Distribusi tiket berdasarkan tingkat urgensi</p>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="ticketPriorityChart"></canvas>
                </div>
                <p class="chart-note">
                    Tiket yang belum memiliki prioritas tetap ditampilkan sebagai kategori tersendiri.
                </p>
            </div>


            <div class="report-panel">
                <div class="panel-heading">
                    <div>
                        <h3>Diagram Aset Maintenance</h3>
                        <p>Distribusi jadwal maintenance aset berdasarkan status pelaksanaan</p>
                    </div>
                </div>

                <div class="chart-container chart-maintenance">
                    <canvas id="assetMaintenanceChart"></canvas>
                </div>
            </div>

            <div class="report-panel">
                <div class="panel-heading">
                    <div>
                        <h3>Diagram Server Maintenance</h3>
                        <p>Distribusi hasil pelaksanaan maintenance internet dan server</p>
                    </div>
                </div>

                <div class="chart-container chart-maintenance">
                    <canvas id="serverMaintenanceChart"></canvas>
                </div>
            </div>

        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="report-footer">
        <div>
            <strong>Laporan Sistem IT Helpdesk PT Gateway</strong>
            <span>Dokumen monitoring operasional</span>
        </div>
        <span>Dicetak pada {{ now()->format('d/m/Y H:i') }}</span>
    </footer>

</div>
@endsection


{{-- ==========================================
     DATA DAN JAVASCRIPT
========================================== --}}

@push('scripts')

@php
    $reportChartData = [
        'ticketStatus' => $ticketStatusStats,
        'ticketPriority' => $ticketPriorityStats,
        'maintenanceStatuses' => $maintenanceStatusStats,
        'serverMaintenanceStatuses' => $serverMaintenanceStats,
        'monthlyLabels' => $monthlyLabels,
        'monthlyIncoming' => $monthlyIncoming,
        'monthlyResolved' => $monthlyResolved,
    ];
@endphp

<script type="application/json" id="report-chart-data">
    @json($reportChartData)
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const dataElement = document.getElementById('report-chart-data');

    if (!dataElement) {
        console.error('Elemen data laporan tidak ditemukan.');
        return;
    }

    let reportData;

    try {
        reportData = JSON.parse(dataElement.textContent.trim());
    } catch (error) {
        console.error('Data laporan gagal dibaca:', error);
        return;
    }

    if (typeof Chart === 'undefined') {
        console.error('Chart.js gagal dimuat.');
        return;
    }

    // ==========================================
    // PENGATURAN CHART
    // ==========================================

    Chart.defaults.font.family = 'Arial, sans-serif';
    Chart.defaults.font.size = 10;
    Chart.defaults.color = '#64748b';
    Chart.defaults.plugins.legend.labels.usePointStyle = true;
    Chart.defaults.plugins.legend.labels.boxWidth = 8;
    Chart.defaults.plugins.legend.labels.padding = 14;

    const colors = [
        '#059669',
        '#2563eb',
        '#f59e0b',
        '#7c3aed',
        '#dc2626',
        '#0891b2',
        '#64748b',
        '#84cc16'
    ];

    // ==========================================
    // FUNGSI FORMAT DATA
    // ==========================================

    function getCollection(collection) {

        if (!collection) {
            return {
                labels: [],
                values: []
            };
        }

        if (Array.isArray(collection)) {
            return {
                labels: collection.map(item =>
                    item.label ?? item.name ?? ''
                ),
                values: collection.map(item =>
                    Number(item.value ?? item.total ?? 0)
                )
            };
        }

        return {
            labels: Object.keys(collection),
            values: Object.values(collection).map(Number)
        };
    }

    function formatLabel(value) {
        return String(value)
            .replaceAll('_', ' ')
            .replace(/\b\w/g, character =>
                character.toUpperCase()
            );
    }

    // ==========================================
    // FUNGSI MEMBUAT DIAGRAM
    // ==========================================

    function createChart(id, type, labels, datasets, options = {}) {

        const canvas = document.getElementById(id);

        if (!canvas) {
            console.error('Canvas tidak ditemukan:', id);
            return;
        }

        if (!Array.isArray(labels) || labels.length === 0) {

            canvas.parentElement.innerHTML = `
                <div class="empty-state">
                    Belum ada data untuk ditampilkan.
                </div>
            `;

            return;
        }

        new Chart(canvas, {
            type: type,

            data: {
                labels: labels,
                datasets: datasets
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        position:
                            type === 'bar' || type === 'line'
                                ? 'top'
                                : 'bottom'
                    }
                },

                ...options
            }
        });
    }

    // ==========================================
    // 1. TREN TIKET
    // ==========================================

    createChart(
        'ticketTrendChart',
        'line',
        reportData.monthlyLabels || [],
        [
            {
                label: 'Tiket Masuk',
                data: reportData.monthlyIncoming || [],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, .08)',
                fill: true,
                tension: .35,
                borderWidth: 2,
                pointRadius: 3
            },
            {
                label: 'Tiket Selesai',
                data: reportData.monthlyResolved || [],
                borderColor: '#059669',
                backgroundColor: 'rgba(5, 150, 105, .08)',
                fill: true,
                tension: .35,
                borderWidth: 2,
                pointRadius: 3
            }
        ],
        {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    );

    // ==========================================
    // 2. STATUS TIKET
    // ==========================================

    const status = getCollection(reportData.ticketStatus);

    createChart(
        'ticketStatusChart',
        'doughnut',
        status.labels.map(formatLabel),
        [
            {
                data: status.values,
                backgroundColor: colors,
                borderColor: '#fff',
                borderWidth: 2
            }
        ]
    );

    // ==========================================
    // 3. PRIORITAS TIKET
    // ==========================================

    const priority = getCollection(reportData.ticketPriority);

    createChart(
        'ticketPriorityChart',
        'bar',
        priority.labels.map(formatLabel),
        [
            {
                label: 'Jumlah Tiket',
                data: priority.values,
                backgroundColor: colors,
                borderRadius: 5,
                barThickness: 18
            }
        ],
        {
            indexAxis: 'y',

            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },

            plugins: {
                legend: {
                    display: false
                }
            }
        }
    );

    // ==========================================
    // 4. DIAGRAM ASET MAINTENANCE
    // ==========================================

    const assetMaintenance = getCollection(
        reportData.maintenanceStatuses
    );

    createChart(
        'assetMaintenanceChart',
        'doughnut',
        assetMaintenance.labels.map(formatLabel),
        [
            {
                label: 'Jumlah Jadwal Maintenance Aset',
                data: assetMaintenance.values,
                backgroundColor: colors,
                borderColor: '#fff',
                borderWidth: 2
            }
        ]
    );

    // ==========================================
    // 5. DIAGRAM SERVER MAINTENANCE
    // ==========================================

    const serverMaintenance = getCollection(
        reportData.serverMaintenanceStatuses
    );

    createChart(
        'serverMaintenanceChart',
        'doughnut',
        serverMaintenance.labels.map(formatLabel),
        [
            {
                label: 'Jumlah Maintenance Server',
                data: serverMaintenance.values,
                backgroundColor: colors,
                borderColor: '#fff',
                borderWidth: 2
            }
        ]
    );

}); // PENUTUP DOMContentLoaded


// ==========================================
// EXPORT LAPORAN KE CSV
// ==========================================

function downloadCSV(rows, filename) {

    const csv = '\uFEFF' + rows.map(row =>
        row.map(value =>
            '"' + String(value ?? '').replace(/"/g, '""') + '"'
        ).join(',')
    ).join('\r\n');

    const blob = new Blob([csv], {
        type: 'text/csv;charset=utf-8;'
    });

    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');

    link.href = url;
    link.download = filename + '.csv';

    document.body.appendChild(link);

    link.click();

    document.body.removeChild(link);

    setTimeout(() => {
        URL.revokeObjectURL(url);
    }, 1000);
}


// ==========================================
// EXPORT RINGKASAN PERFORMA DAN DIAGRAM
// ==========================================

window.exportReportCSV = function () {

    const rows = [
        ['LAPORAN SISTEM IT HELPDESK PT GATEWAY'],
        ['Tanggal Export', new Date().toLocaleString('id-ID')],
        [],
        ['RINGKASAN PERFORMA'],
        ['Indikator', 'Nilai']
    ];

    // Data kartu performa
    document.querySelectorAll('.performance-card').forEach(card => {

        rows.push([
            card.dataset.label,
            card.dataset.value
        ]);

    });

    // Ambil data diagram
    const dataElement = document.getElementById('report-chart-data');

    if (dataElement) {

        try {

            const reportData = JSON.parse(dataElement.textContent.trim());

            function addChartData(title, collection) {

                rows.push([]);
                rows.push([title]);
                rows.push(['Kategori', 'Jumlah']);

                if (!collection) {
                    rows.push(['Tidak ada data', 0]);
                    return;
                }

                Object.entries(collection).forEach(([label, total]) => {

                    rows.push([
                        String(label).replaceAll('_', ' '),
                        total
                    ]);

                });

            }

            addChartData(
                'STATUS TIKET',
                reportData.ticketStatus
            );

            addChartData(
                'PRIORITAS TIKET',
                reportData.ticketPriority
            );

            addChartData(
                'DIAGRAM ASET MAINTENANCE',
                reportData.maintenanceStatuses
            );

            addChartData(
                'DIAGRAM SERVER MAINTENANCE',
                reportData.serverMaintenanceStatuses
            );

            rows.push([]);
            rows.push(['TREN TIKET']);
            rows.push([
                'Bulan',
                'Tiket Masuk',
                'Tiket Selesai'
            ]);

            (reportData.monthlyLabels || []).forEach((month, index) => {

                rows.push([
                    month,
                    reportData.monthlyIncoming?.[index] ?? 0,
                    reportData.monthlyResolved?.[index] ?? 0
                ]);

            });

        } catch (error) {

            console.error('Gagal mengambil data export:', error);

        }

    }

    downloadCSV(rows, 'laporan-it-helpdesk');

};

</script>

@endpush
