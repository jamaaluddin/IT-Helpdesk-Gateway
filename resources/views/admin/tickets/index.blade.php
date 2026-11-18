
@extends('layouts.admin')

@section('title', 'Monitoring Tiket - Gateway Admin')
@section('page-title', 'Monitoring Tiket')
@section('page-subtitle', 'IT Helpdesk Management System')

@push('styles')

/* CONTENT */
.welcome {
    margin-bottom: 25px;
}

.welcome h2 {
    margin: 0;
    font-size: 26px;
    color: #064e3b;
}

.welcome p {
    margin-top: 7px;
    font-size: 14px;
    color: #6b7280;
}

/* STATISTIK */
.stats {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 22px;
}

.stat-card {
    display: block;
    min-width: 0;
    background: white;
    border-radius: 12px;
    padding: 15px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 3px 12px rgba(0,0,0,0.045);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 7px 18px rgba(0,0,0,0.09);
}

.stat-card:active {
    transform: translateY(-1px);
}

.stat-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 7px;
    margin-bottom: 10px;
}

.stat-label {
    font-size: 11px;
    line-height: 1.4;
    color: #6b7280;
}

.stat-icon {
    flex: 0 0 32px;
    width: 32px;
    height: 32px;
    border-radius: 9px;
    background: #d1fae5;
    color: #059669;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.stat-number {
    font-size: 26px;
    line-height: 1.2;
    font-weight: 700;
    color: #111827;
}

.stat-footer {
    margin-top: 6px;
    font-size: 10px;
    line-height: 1.4;
    color: #9ca3af;
}

/* SECTION */
.section {
    background: white;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 18px rgba(0,0,0,0.04);
    overflow: hidden;
}

.section-header {
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}

.section-header h3 {
    font-size: 17px;
    color: #111827;
}

.section-header p {
    margin-top: 5px;
    font-size: 12px;
    color: #6b7280;
}

.total-badge {
    background: #d1fae5;
    color: #047857;
    padding: 7px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

/* FILTER */
.filter-form {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
    min-width: 200px;
    height: 40px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 0 12px;
}

.search-icon {
    font-size: 19px;
    color: #6b7280;
}

.search-box input {
    border: none;
    outline: none;
    width: 100%;
    min-width: 0;
    font-size: 12px;
    background: transparent;
}

.filter-form select {
    height: 40px;
    min-width: 150px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 0 10px;
    color: #374151;
    background: white;
    font-size: 12px;
}

/* BUTTON */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    padding: 0 15px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 12px rgba(0,0,0,0.12);
}

.btn:active {
    transform: translateY(-1px);
    box-shadow: none;
}

.btn:focus-visible {
    outline: 3px solid rgba(5,150,105,0.25);
    outline-offset: 3px;
}

.btn-search {
    border: 1px solid #059669;
    background: #059669;
    color: white;
}

.btn-search:hover {
    background: #047857;
}

.btn-reset {
    border: 1px solid #d1d5db;
    background: white;
    color: #374151;
}

.btn-reset:hover {
    background: #f9fafb;
}

/* TABLE */
.table-wrapper {
    width: 100%;
    max-height: 500px;
    overflow: auto;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    min-width: 1100px;
}

th {
    position: sticky;
    top: 0;
    z-index: 2;
    background: #ecfdf5;
    color: #065f46;
    padding: 13px 14px;
    text-align: left;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

td {
    padding: 14px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 12px;
    color: #374151;
    vertical-align: middle;
    background: white;
}

tbody tr:hover td {
    background: #f9fafb;
}

.ticket-number {
    color: #047857;
    font-weight: 700;
    white-space: nowrap;
}

.subject {
    display: inline-block;
    max-width: 190px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    vertical-align: middle;
    font-weight: 600;
    color: #111827;
}

/* STATUS */
.status,
.priority {
    display: inline-block;
    padding: 6px 9px;
    border-radius: 999px;
    font-size: 10px;
    font-weight: 700;
    white-space: nowrap;
}

.status-open {
    background: #dbeafe;
    color: #1d4ed8;
}

.status-assigned {
    background: #fef3c7;
    color: #92400e;
}

.status-in_progress {
    background: #ede9fe;
    color: #6d28d9;
}

.status-resolved {
    background: #d1fae5;
    color: #047857;
}

.status-closed {
    background: #e5e7eb;
    color: #374151;
}

.priority-low {
    background: #f3f4f6;
    color: #4b5563;
}

.priority-medium {
    background: #dbeafe;
    color: #1d4ed8;
}

.priority-high {
    background: #ffedd5;
    color: #c2410c;
}

.priority-critical {
    background: #fee2e2;
    color: #b91c1c;
}

/* KOSONG */
.empty {
    text-align: center;
    padding: 45px 20px;
    color: #6b7280;
}

.empty-icon {
    font-size: 30px;
    margin-bottom: 10px;
}

.empty-title {
    font-size: 14px;
    font-weight: 700;
    color: #374151;
}

.empty-text {
    margin-top: 6px;
    font-size: 12px;
    color: #9ca3af;
}

/* PAGINATION */
.pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    padding: 16px 20px;
    border-top: 1px solid #e5e7eb;
}

.pagination-info {
    font-size: 12px;
    color: #6b7280;
}

.pagination-wrapper nav {
    display: flex;
    align-items: center;
}

.pagination-wrapper nav > div:first-child {
    display: none;
}

.pagination-wrapper nav > div:last-child {
    display: flex;
    align-items: center;
    gap: 4px;
}

.pagination-wrapper nav a,
.pagination-wrapper nav span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 9px;
    border-radius: 6px;
    font-size: 12px;
    line-height: 1;
}

.pagination-wrapper nav svg {
    width: 16px !important;
    height: 16px !important;
    max-width: 16px;
    max-height: 16px;
}

.pagination-wrapper nav a {
    color: #047857;
    border: 1px solid #d1d5db;
    background: white;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}

.pagination-wrapper nav a:hover {
    background: #ecfdf5;
    transform: translateY(-2px);
    box-shadow: 0 4px 9px rgba(0,0,0,0.10);
}

.pagination-wrapper nav a:active {
    transform: translateY(-1px);
    box-shadow: none;
}

.pagination-wrapper nav span[aria-current="page"] {
    background: #059669;
    color: white;
    border: 1px solid #059669;
}

.pagination-wrapper nav span[aria-disabled="true"] {
    color: #9ca3af;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
}

.footer-note {
    margin-top: 18px;
    color: #6b7280;
    font-size: 11px;
}

.footer-note span {
    color: #059669;
    margin-right: 5px;
}

/* RESPONSIVE */
@media (max-width: 1300px) {
    .stats {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}

@media (max-width: 1000px) {
    .stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 700px) {
    .stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .section-header {
        align-items: flex-start;
    }

    .filter-form {
        align-items: stretch;
    }

    .search-box {
        flex-basis: 100%;
    }

    .filter-form select {
        flex: 1;
    }
}

@media (max-width: 480px) {
    .stats {
        grid-template-columns: 1fr;
    }

    .welcome h2 {
        font-size: 22px;
    }

    .section-header {
        flex-direction: column;
    }

    .filter-form > * {
        width: 100%;
    }

    .search-box {
        min-width: 0;
    }

    .filter-form select {
        min-width: 0;
    }

    .pagination-wrapper {
        align-items: flex-start;
        flex-direction: column;
    }

    .pagination-wrapper nav {
        max-width: 100%;
        overflow-x: auto;
    }
}

@endpush

@section('content')

<div class="welcome">
    <h2>Monitoring Tiket IT 🎫</h2>
    <p>
        Pantau seluruh tiket, mulai dari laporan masuk hingga
        penyelesaian oleh IT Support.
    </p>
</div>

{{-- STATISTIK --}}
<div class="stats">

    <a href="{{ route('admin.tickets.index') }}" class="stat-card">
        <div class="stat-top">
            <span class="stat-label">Total Tiket</span>
            <div class="stat-icon">🎫</div>
        </div>
        <div class="stat-number">{{ $totalTickets }}</div>
        <div class="stat-footer">Seluruh tiket dalam sistem</div>
    </a>

    <a href="{{ route('admin.tickets.index', ['status' => 'open']) }}"
       class="stat-card">
        <div class="stat-top">
            <span class="stat-label">Tiket Terbuka</span>
            <div class="stat-icon">📩</div>
        </div>
        <div class="stat-number">{{ $openTickets }}</div>
        <div class="stat-footer">Menunggu penanganan</div>
    </a>

    <a href="{{ route('admin.tickets.index', ['status' => 'in_progress']) }}"
       class="stat-card">
        <div class="stat-top">
            <span class="stat-label">Sedang Diproses</span>
            <div class="stat-icon">🛠️</div>
        </div>
        <div class="stat-number">{{ $inProgressTickets }}</div>
        <div class="stat-footer">Sedang ditangani IT Support</div>
    </a>

    <a href="{{ route('admin.tickets.index', ['status' => 'resolved']) }}"
       class="stat-card">
        <div class="stat-top">
            <span class="stat-label">Tiket Selesai</span>
            <div class="stat-icon">✅</div>
        </div>
        <div class="stat-number">{{ $resolvedTickets }}</div>
        <div class="stat-footer">Status resolved</div>
    </a>

    <a href="{{ route('admin.tickets.index', ['status' => 'closed']) }}"
       class="stat-card">
        <div class="stat-top">
            <span class="stat-label">Tiket Ditutup</span>
            <div class="stat-icon">🔒</div>
        </div>
        <div class="stat-number">{{ $closedTickets }}</div>
        <div class="stat-footer">Status closed</div>
    </a>

</div>

{{-- DAFTAR TIKET --}}
<div class="section">

    <div class="section-header">
        <div>
            <h3>Daftar Seluruh Tiket</h3>
            <p>
                Cari nomor tiket atau judul masalah dan filter
                berdasarkan status.
            </p>
        </div>

        <span class="total-badge">
            {{ $tickets->total() }} tiket
        </span>
    </div>

    {{-- SEARCH DAN FILTER --}}
    <form
        action="{{ route('admin.tickets.index') }}"
        method="GET"
        class="filter-form"
    >
        <div class="search-box">
            <span class="search-icon">⌕</span>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nomor tiket atau judul masalah..."
            >
        </div>

        <select name="status">
            <option value="">Semua Status</option>

            <option value="open"
                {{ request('status') === 'open' ? 'selected' : '' }}>
                Terbuka
            </option>

            <option value="assigned"
                {{ request('status') === 'assigned' ? 'selected' : '' }}>
                Ditugaskan
            </option>

            <option value="in_progress"
                {{ request('status') === 'in_progress' ? 'selected' : '' }}>
                Dalam Proses
            </option>

            <option value="resolved"
                {{ request('status') === 'resolved' ? 'selected' : '' }}>
                Selesai Diperbaiki
            </option>

            <option value="closed"
                {{ request('status') === 'closed' ? 'selected' : '' }}>
                Ditutup
            </option>
        </select>

        <button type="submit" class="btn btn-search">
            Cari
        </button>

        <a href="{{ route('admin.tickets.index') }}" class="btn btn-reset">
            Reset
        </a>
    </form>

    {{-- TABEL --}}
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Tiket</th>
                    <th>Judul Masalah</th>
                    <th>Pelapor</th>
                    <th>Kategori</th>
                    <th>Kantor</th>
                    <th>Departemen</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tickets as $ticket)
                    @php
                        $statusLabels = [
                            'open' => 'Terbuka',
                            'assigned' => 'Ditugaskan',
                            'in_progress' => 'Dalam Proses',
                            'resolved' => 'Selesai',
                            'closed' => 'Ditutup',
                        ];

                        $priorityLabels = [
                            'low' => 'Rendah',
                            'medium' => 'Sedang',
                            'high' => 'Tinggi',
                            'critical' => 'Kritis',
                        ];

                        $status = $ticket->status ?? 'open';
                        $priority = $ticket->priority ?? 'low';
                    @endphp

                    <tr>
                        <td>
                            {{ $tickets->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <span class="ticket-number">
                                {{ $ticket->ticket_number ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="subject"
                                  title="{{ $ticket->subject ?? '-' }}">
                                {{ $ticket->subject ?? '-' }}
                            </span>
                        </td>

                        <td>
                            {{ data_get($ticket, 'user.name', '-') }}
                        </td>

                        <td>
                            {{ data_get($ticket, 'category.name', '-') }}
                        </td>

                        <td>
                            {{ data_get($ticket, 'office.name', '-') }}
                        </td>

                        <td>
                            {{ data_get($ticket, 'department.name', '-') }}
                        </td>

                        <td>
                            <span class="priority priority-{{ $priority }}">
                                {{ $priorityLabels[$priority] ?? ucfirst($priority) }}
                            </span>
                        </td>

                        <td>
                            <span class="status status-{{ $status }}">
                                {{ $statusLabels[$status] ?? ucfirst($status) }}
                            </span>
                        </td>

                        <td>
                            {{ $ticket->created_at
                                ? $ticket->created_at->format('d/m/Y H:i')
                                : '-' }}
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty">
                                <div class="empty-icon">📭</div>

                                <div class="empty-title">
                                    Tidak ada tiket ditemukan
                                </div>

                                <div class="empty-text">
                                    Coba ubah kata pencarian atau filter status.
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if ($tickets->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Menampilkan {{ $tickets->firstItem() }}
                sampai {{ $tickets->lastItem() }}
                dari {{ $tickets->total() }} tiket
            </div>

            {{ $tickets->links() }}
        </div>
    @endif

</div>

<div class="footer-note">
    <span>●</span>
    Data monitoring berasal dari database IT Helpdesk Gateway.
</div>

@endsection
