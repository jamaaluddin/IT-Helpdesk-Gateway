@extends('layouts.itsupport')

@section('title', 'Riwayat Tiket - IT Support Gateway')
@section('page-title', 'Riwayat Tiket')
@section('page-subtitle', 'IT Helpdesk Management System')

<style>
    /* =====================================================
       CONTENT
    ===================================================== */

    .container {
        max-width: 1400px;
        margin: auto;
        padding: 30px;
    }

    /* =====================================================
       TOP
    ===================================================== */

    .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        gap: 20px;
    }

    .top h2 {
        font-size: 23px;
        margin-bottom: 7px;
        color: #172033;
    }

    .top-title-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 7px;
    }

    .top-title-row h2 {
        margin-bottom: 0;
    }

    .total {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 11px;
        border-radius: 20px;
        background: #ede9fe;
        color: #7c3aed;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
        border: 1px solid #ddd6fe;
    }

    .top p {
        color: #6b7280;
        font-size: 14px;
    }

    /* =====================================================
       FILTER TIKET
    ===================================================== */

    .ticket-filter-wrapper {
        margin-top: 16px;
    }

    .ticket-filters {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 15px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #64748b;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        transition: 0.2s ease;
    }

    .filter-btn:hover {
        background: #f5f3ff;
        color: #7c3aed;
        border-color: #ddd6fe;
    }

    .filter-btn.active {
        background: #7c3aed;
        color: white;
        border-color: #7c3aed;
        box-shadow: 0 3px 8px rgba(124, 58, 237, 0.16);
    }

    /* NAVIGASI BULAN */

    .month-navigation {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 13px;
    }

    .month-label {
        color: #172033;
        font-size: 14px;
        font-weight: bold;
        min-width: 125px;
        text-align: center;
    }

    .month-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 29px;
        height: 29px;
        border-radius: 7px;
        border: 1px solid #ddd6fe;
        background: #f5f3ff;
        color: #7c3aed;
        text-decoration: none;
        font-size: 11px;
        transition: 0.2s ease;
    }

    .month-arrow:hover {
        background: #7c3aed;
        color: white;
    }

    .month-arrow.disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }

    /* =====================================================
       ACTION BUTTONS
    ===================================================== */

    .top-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        background: #ede9fe;
        color: #7c3aed;
        padding: 11px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: bold;
        border: 1px solid #ddd6fe;
        box-shadow:
            0 3px 6px rgba(124, 58, 237, 0.08),
            0 8px 16px rgba(124, 58, 237, 0.06);
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .back-btn:hover {
        background: #ddd6fe;
        transform: translateY(-2px);
        box-shadow:
            0 5px 10px rgba(124, 58, 237, 0.12),
            0 12px 22px rgba(124, 58, 237, 0.09);
    }

    .print-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        background: #7c3aed;
        color: white;
        padding: 11px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: bold;
        border: 1px solid #7c3aed;
        transition: 0.2s ease;
    }

    .print-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
    }

    .back-btn:active,
    .print-btn:active {
        transform: translateY(0);
    }

    /* =====================================================
       MAIN CARD
    ===================================================== */

    .section {
        background: white;
        border-radius: 18px;
        padding: 25px;
        border: 1px solid #eef2f7;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, 0.03),
            0 8px 18px rgba(0, 0, 0, 0.05),
            0 16px 35px rgba(0, 0, 0, 0.06),
            0 25px 55px rgba(124, 58, 237, 0.07);
    }

    /* =====================================================
       TABLE AREA
    ===================================================== */

    .table-scroll {
        height: 500px;
        overflow-y: auto;
        overflow-x: auto;
        border-radius: 13px;
        border: 1px solid #eef2f7;
        box-shadow:
            inset 0 0 0 1px rgba(226, 232, 240, 0.5),
            0 4px 12px rgba(0, 0, 0, 0.025);
    }

    .table-scroll::-webkit-scrollbar {
        width: 7px;
        height: 7px;
    }

    .table-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .table-scroll::-webkit-scrollbar-thumb {
        background: #c4b5fd;
        border-radius: 10px;
    }

    .table-scroll::-webkit-scrollbar-thumb:hover {
        background: #a78bfa;
    }

    .table-scroll table {
        width: 100%;
        min-width: 1050px;
        border-collapse: separate;
        border-spacing: 0;
    }

    /* =====================================================
       TABLE HEADER
    ===================================================== */

    .table-scroll thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        text-align: left;
        padding: 15px 14px;
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .table-scroll thead th:first-child {
        border-top-left-radius: 10px;
    }

    .table-scroll thead th:last-child {
        border-top-right-radius: 10px;
    }

    /* =====================================================
       TABLE BODY
    ===================================================== */

    .table-scroll tbody td {
        padding: 16px 14px;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #eef2f7;
        background: white;
        transition:
            background 0.2s ease,
            box-shadow 0.2s ease;
    }

    .table-scroll tbody tr:hover td {
        background: #fcfaff;
    }

    .table-scroll tbody tr:last-child td {
        border-bottom: none;
    }

    /* =====================================================
       TICKET NUMBER
    ===================================================== */

    .ticket-number {
        color: #7c3aed;
        font-weight: bold;
        white-space: nowrap;
    }

    /* =====================================================
       PRIORITY
    ===================================================== */

    .priority-low,
    .priority-medium,
    .priority-high,
    .priority-critical {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .priority-low {
        color: #0284c7;
        background: #e0f2fe;
    }

    .priority-medium {
        color: #d97706;
        background: #fef3c7;
    }

    .priority-high {
        color: #dc2626;
        background: #fee2e2;
    }

    .priority-critical {
        color: #991b1b;
        background: #fecaca;
    }

    /* =====================================================
       BADGE
    ===================================================== */

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .status-resolved,
    .status-closed {
        background: #dcfce7;
        color: #16a34a;
    }

    /* =====================================================
       VIEW BUTTON
    ===================================================== */

    .view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 62px;
        padding: 8px 13px;
        text-decoration: none;
        background: #7c3aed;
        color: white;
        border: 1px solid #ddd6fe;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .view-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow:
            0 5px 10px rgba(124, 58, 237, 0.13),
            0 11px 20px rgba(124, 58, 237, 0.09);
    }

    .view-btn:active {
        transform: translateY(0);
    }

    /* =====================================================
       EMPTY STATE
    ===================================================== */

    .empty {
        text-align: center;
        padding: 55px 25px;
        color: #6b7280;
        background: #f9fafb;
        border: 1px dashed #dbe2ea;
        border-radius: 12px;
        font-size: 14px;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 900px) {
        .container {
            padding: 22px;
        }

        .section {
            padding: 20px;
        }

        .table-scroll {
            height: 470px;
        }
    }

    @media (max-width: 700px) {
        .top {
            flex-direction: column;
            align-items: flex-start;
        }

        .back-btn {
            width: 100%;
        }
    }

    @media (max-width: 550px) {
        .container {
            padding: 15px;
        }

        .section {
            padding: 15px;
        }

        .top h2 {
            font-size: 21px;
        }

        .top-actions {
            width: 100%;
        }

        .top-actions a {
            flex: 1;
        }

        .table-scroll {
            height: 420px;
        }
    }
</style>

@section('content')

<main class="container">

    <!-- TOP -->
    <div class="top">

        <div>

            <div class="top-title-row">

                <h2>📜 Riwayat Tiket</h2>

                <span class="total">
                    Total: {{ $tickets->count() }} tiket
                </span>

            </div>

            <p>
                Daftar tiket yang telah selesai ditangani oleh IT Support.
            </p>

            <!-- FILTER PERIODE -->
            <div class="ticket-filter-wrapper">

                <div class="ticket-filters">

                    <a
                        href="{{ route('it-support.tickets.history', ['period' => 'today']) }}"
                        class="filter-btn {{ $period === 'today' ? 'active' : '' }}"
                    >
                        Hari Ini
                    </a>

                    <a
                        href="{{ route('it-support.tickets.history', ['period' => 'this_week']) }}"
                        class="filter-btn {{ $period === 'this_week' ? 'active' : '' }}"
                    >
                        Minggu Ini
                    </a>

                    <a
                        href="{{ route('it-support.tickets.history', [
                            'period' => 'month',
                            'month' => $monthValue
                        ]) }}"
                        class="filter-btn {{ $period === 'month' ? 'active' : '' }}"
                    >
                        Bulanan
                    </a>

                </div>

                @if ($period === 'month')

                    <div class="month-navigation">

                        <a
                            href="{{ route('it-support.tickets.history', [
                                'period' => 'month',
                                'month' => $previousMonth
                            ]) }}"
                            class="month-arrow"
                        >
                            &#10094;
                        </a>

                        <span class="month-label">
                            {{ $monthLabel }}
                        </span>

                        @if ($canGoNextMonth)

                            <a
                                href="{{ route('it-support.tickets.history', [
                                    'period' => 'month',
                                    'month' => $nextMonth
                                ]) }}"
                                class="month-arrow"
                            >
                                &#10095;
                            </a>

                        @else

                            <span class="month-arrow disabled">
                                &#10095;
                            </span>

                        @endif

                    </div>

                @endif

            </div>

        </div>

        <div class="top-actions">

            <a href="#" class="print-btn">
                🖨 Cetak Laporan
            </a>

            <a
                href="{{ route('it-support.dashboard') }}"
                class="back-btn"
            >
                ← Dashboard
            </a>

        </div>

    </div>

    <!-- TICKET TABLE -->
    <div class="section">

        @if($tickets->count() > 0)

            <div class="table-scroll">

                <table>

                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Pelapor</th>
                            <th>Masalah</th>
                            <th>Kategori</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($tickets as $ticket)

                            <tr>

                                <td>
                                    <span class="ticket-number">
                                        {{ $ticket->ticket_number }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ticket->user->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $ticket->subject }}
                                </td>

                                <td>
                                    {{ $ticket->category->name ?? '-' }}
                                </td>

                                <td>

                                    @if ($ticket->priority)

                                        <span class="priority-{{ $ticket->priority }}">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>

                                    @else

                                        <span
                                            class="badge"
                                            style="background:#f3f4f6; color:#6b7280;"
                                        >
                                            Belum Ditentukan
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @php
                                        $statusClass = match($ticket->status) {
                                            'resolved' => 'status-resolved',
                                            'closed' => 'status-closed',
                                            default => 'status-closed',
                                        };

                                        $statusLabel = match($ticket->status) {
                                            'resolved' => 'Selesai',
                                            'closed' => 'Ditutup',
                                            default => ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $ticket->status
                                                )
                                            ),
                                        };
                                    @endphp

                                    <span class="badge {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>

                                </td>

                                <td>
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td>

                                    <a
                                        href="{{ route('it-support.tickets.show', $ticket->id) }}"
                                        class="view-btn"
                                    >
                                        Lihat
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">
                📜 Belum ada riwayat tiket.
            </div>

        @endif

    </div>

</main>

@endsection
