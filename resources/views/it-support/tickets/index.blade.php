@extends('layouts.itsupport')

@section('title', 'Semua Tiket - IT Support Gateway')
@section('page-title', 'Semua Tiket IT Support')
@section('page-subtitle', 'Kelola dan pantau seluruh tiket yang masuk ke sistem IT Helpdesk Gateway')

@section('content')

<style>
    .ticket-page {
        max-width: 1400px;
        margin: auto;
        padding: 30px;
        font-family: Arial, sans-serif;
        color: #1f2937;
    }

    .top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .top h2 {
        font-size: 23px;
        color: #172033;
        margin-bottom: 7px;
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
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .back-btn:hover {
        background: #ddd6fe;
        transform: translateY(-2px);
        box-shadow:
            0 5px 10px rgba(124, 58, 237, 0.12),
            0 12px 22px rgba(124, 58, 237, 0.09);
    }

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

    .table-scroll {
        width: 100%;
        height: auto;
        max-height: 350px;
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

    .ticket-page table {
        width: 100%;
        min-width: 1050px;
        table-layout: fixed;
        border-collapse: separate;
        border-spacing: 0;
    }

    .ticket-page table th:nth-child(1),
    .ticket-page table td:nth-child(1) { width: 15%; }

    .ticket-page table th:nth-child(2),
    .ticket-page table td:nth-child(2) { width: 11%; }

    .ticket-page table th:nth-child(3),
    .ticket-page table td:nth-child(3) { width: 15%; }

    .ticket-page table th:nth-child(4),
    .ticket-page table td:nth-child(4) { width: 12%; }

    .ticket-page table th:nth-child(5),
    .ticket-page table td:nth-child(5) { width: 9%; }

    .ticket-page table th:nth-child(6),
    .ticket-page table td:nth-child(6) { width: 11%; }

    .ticket-page table th:nth-child(7),
    .ticket-page table td:nth-child(7) { width: 14%; }

    .ticket-page table th:nth-child(8),
    .ticket-page table td:nth-child(8) { width: 13%; }

    .ticket-page thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        text-align: left;
        padding: 13px 12px;
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .ticket-page thead th:first-child {
        border-top-left-radius: 10px;
    }

    .ticket-page thead th:last-child {
        border-top-right-radius: 10px;
    }

    .ticket-page tbody td {
        padding: 14px 12px;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #eef2f7;
        background: white;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
        transition: background 0.2s ease;
    }

    .ticket-page tbody tr:hover td {
        background: #fcfaff;
    }

    .ticket-page tbody tr:last-child td {
        border-bottom: none;
    }

    .ticket-page thead th:last-child,
    .ticket-page tbody td:last-child {
        text-align: center;
    }

    .ticket-number {
        color: #7c3aed;
        font-weight: bold;
        white-space: nowrap;
    }

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

    .status-open {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-assigned {
        background: #ede9fe;
        color: #7c3aed;
    }

    .status-process {
        background: #fef3c7;
        color: #d97706;
    }

    .status-waiting {
        background: #e0f2fe;
        color: #0284c7;
    }

    .status-closed {
        background: #dcfce7;
        color: #16a34a;
    }

    .view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 120px;
        min-width: 120px;
        min-height: 36px;
        padding: 8px 10px;
        text-decoration: none;
        background: #7c3aed;
        color: white;
        border: 1px solid #ddd6fe;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
        cursor: pointer;
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

    .action-buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-buttons form {
        margin: 0;
    }

    .empty {
        text-align: center;
        padding: 55px 25px;
        color: #6b7280;
        background: #f9fafb;
        border: 1px dashed #dbe2ea;
        border-radius: 12px;
        font-size: 14px;
    }

    .queue-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 16px;
    }

    .queue-heading h3 {
        font-size: 17px;
        color: #172033;
        margin-bottom: 6px;
    }

    .queue-heading p {
        font-size: 13px;
        color: #6b7280;
    }

    .queue-heading-second {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #eef2f7;
    }

    @media (max-width: 900px) {
        .ticket-page {
            padding: 22px;
        }

        .section {
            padding: 20px;
        }

        .table-scroll {
            max-height: 350px;
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
        .ticket-page {
            padding: 15px;
        }

        .section {
            padding: 15px;
        }

        .top h2 {
            font-size: 21px;
        }

        .queue-heading h3 {
            font-size: 15px;
        }
    }
</style>

<main class="ticket-page">

    <div class="top">

        <div>

            <div class="top-title-row">

                <h2>🎫 Semua Tiket</h2>

                <span class="total">
                    Total: {{ $pendingPriorityTickets->count() + $priorityQueueTickets->count() + $inProgressTickets->count() }} tiket
                </span>

            </div>

            <p>
                Daftar tiket yang masih aktif dan perlu ditangani oleh IT Support.
            </p>

            <div class="ticket-filter-wrapper">

                <div class="ticket-filters">

                    <a
                        href="{{ route('it-support.tickets', ['period' => 'today']) }}"
                        class="filter-btn {{ $period === 'today' ? 'active' : '' }}"
                    >
                        Hari Ini
                    </a>

                    <a
                        href="{{ route('it-support.tickets', ['period' => 'this_week']) }}"
                        class="filter-btn {{ $period === 'this_week' ? 'active' : '' }}"
                    >
                        Minggu Ini
                    </a>

                    <a
                        href="{{ route('it-support.tickets', [
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
                            href="{{ route('it-support.tickets', [
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
                                href="{{ route('it-support.tickets', [
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

        <a
            href="{{ route('it-support.dashboard') }}"
            class="back-btn"
        >
            ← Dashboard
        </a>

    </div>


    <div class="section">

        {{-- ANTREAN 1: MENUNGGU PENILAIAN --}}

        <div class="queue-heading">

            <div>
                <h3>Menunggu Penilaian Prioritas</h3>
                <p>Tiket baru yang belum ditentukan tingkat prioritasnya.</p>
            </div>

            <span class="total">
                {{ $pendingPriorityTickets->count() }} tiket
            </span>

        </div>

        @if ($pendingPriorityTickets->count() > 0)

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

                        @foreach ($pendingPriorityTickets as $ticket)

                            <tr>

                                <td>
                                    <span class="ticket-number">
                                        {{ $ticket->ticket_number }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ticket->user->name ?? '-' }}
                                </td>

                                <td title="{{ $ticket->subject }}">
                                    {{ $ticket->subject }}
                                </td>

                                <td>
                                    {{ $ticket->category->name ?? '-' }}
                                </td>

                                <td>
                                    <span class="badge status-waiting">
                                        Belum Dinilai
                                    </span>
                                </td>

                                <td>
                                    <span class="badge status-waiting">
                                        Menunggu Penilaian
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
                                        Nilai Prioritas
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">
                Semua tiket baru sudah memiliki prioritas.
            </div>

        @endif


        {{-- ANTREAN 2: BERDASARKAN PRIORITAS --}}

        <div class="queue-heading queue-heading-second">

            <div>
                <h3>Antrean Tiket Berdasarkan Prioritas</h3>
                <p>Prioritas tertinggi ditangani terlebih dahulu.</p>
            </div>

            <span class="total">
                {{ $priorityQueueTickets->count() }} tiket
            </span>

        </div>

        @if ($priorityQueueTickets->count() > 0)

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

                        @foreach ($priorityQueueTickets as $ticket)

                            <tr>

                                <td>
                                    <span class="ticket-number">
                                        {{ $ticket->ticket_number }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ticket->user->name ?? '-' }}
                                </td>

                                <td title="{{ $ticket->subject }}">
                                    {{ $ticket->subject }}
                                </td>

                                <td>
                                    {{ $ticket->category->name ?? '-' }}
                                </td>

                                <td>
                                    <span class="priority-{{ $ticket->priority }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>

                                <td>

                                    @php
                                        if (
                                            $ticket->status === 'in_progress'
                                            && $ticket->reopen_reason
                                        ) {
                                            $statusClass = 'status-process';
                                            $statusLabel = 'Perbaikan Ulang';
                                        } else {
                                            $statusClass = match ($ticket->status) {
                                                'open' => 'status-open',
                                                'assigned' => 'status-assigned',
                                                'in_progress' => 'status-process',
                                                'waiting' => 'status-waiting',
                                                default => 'status-closed',
                                            };

                                            $statusLabel = match ($ticket->status) {
                                                'open' => 'Baru',
                                                'assigned' => 'Diambil',
                                                'in_progress' => 'Diproses',
                                                'waiting' => 'Menunggu',
                                                default => ucfirst(
                                                    str_replace('_', ' ', $ticket->status)
                                                ),
                                            };
                                        }
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
                Belum ada tiket dalam antrean prioritas.
            </div>

        @endif


        {{-- ANTREAN 3: SEDANG DIKERJAKAN --}}

        <div class="queue-heading queue-heading-second">

            <div>
                <h3>Sedang Dikerjakan</h3>
                <p>Tiket yang sedang ditangani IT Support, termasuk perbaikan ulang.</p>
            </div>

            <span class="total">
                {{ $inProgressTickets->count() }} tiket
            </span>

        </div>

        @if ($inProgressTickets->count() > 0)

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

                        @foreach ($inProgressTickets as $ticket)

                            <tr>

                                <td>
                                    <span class="ticket-number">
                                        {{ $ticket->ticket_number }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ticket->user->name ?? '-' }}
                                </td>

                                <td title="{{ $ticket->subject }}">
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
                                            style="background:#f3f4f6;color:#6b7280;"
                                        >
                                            Belum Ditentukan
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if ($ticket->reopen_reason)

                                        <span class="badge status-process">
                                            Perbaikan Ulang
                                        </span>

                                    @else

                                        <span class="badge status-process">
                                            Diproses
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td>

                                    <div class="action-buttons">

                                        @if (in_array($ticket->status, ['open', 'assigned']))

                                            <form
                                                action="{{ route('it-support.tickets.start', $ticket) }}"
                                                method="POST"
                                                onsubmit="return confirm('Mulai menangani tiket {{ $ticket->ticket_number }}?');"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="view-btn"
                                                    style="border: none;"
                                                >
                                                    🔧 Mulai Penanganan
                                                </button>

                                            </form>

                                        @endif

                                        <a
                                            href="{{ route('it-support.tickets.show', $ticket) }}"
                                            class="view-btn"
                                        >
                                            Lihat Detail
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">
                Belum ada tiket yang sedang dikerjakan.
            </div>

        @endif

    </div>

</main>

@endsection
