@extends('layouts.admin')

@section('title', 'User Management - Admin Gateway')
@section('page-title', 'User Management')
@section('page-subtitle', 'Kelola dan pantau seluruh akun pengguna sistem IT Helpdesk Gateway.')

@section('content')

<style>


    .page-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .page-heading h2 {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 6px;
    }

    .page-heading p {
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
    }

    @media (max-width: 550px) {
        .page-heading h2 {
            font-size: 20px;
        }
    }


    .user-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .user-stat {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,.035);
    }

    .user-stat-label {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .user-stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
    }

    .user-filter {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 7px;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        min-height: 40px;
        padding: 9px 11px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background: #fff;
        font-size: 13px;
        color: #374151;
    }

    .filter-actions {
        display: flex;
        gap: 9px;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    .user-btn {
        border: none;
        border-radius: 7px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: .2s ease;
    }

    .user-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,.12);
    }

    .user-btn:active {
        transform: translateY(1px);
    }

    .btn-filter {
        background: #059669;
        color: #fff;
    }

    .btn-reset {
        background: #f3f4f6;
        color: #374151;
    }

    .user-table-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
    }

    .user-table-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .user-table-heading h3 {
        font-size: 17px;
        color: #1f2937;
    }

    .table-scroll {
        max-height: 500px;
        overflow: auto;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }

    .user-table {
        width: 100%;
        min-width: 1100px;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 13px;
    }

    .user-table th {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        text-align: left;
        padding: 13px 12px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    .user-table td {
        padding: 13px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #374151;
        vertical-align: middle;
    }

    .user-table tbody tr:hover {
        background: #f9fafb;
    }

    .user-status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-active {
        color: #047857;
        background: #d1fae5;
    }

    .status-pending {
        color: #b45309;
        background: #fef3c7;
    }

    .status-rejected {
        color: #b91c1c;
        background: #fee2e2;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .btn-approve {
        background: #059669;
        color: #fff;
    }

    .btn-reject {
        background: #dc2626;
        color: #fff;
    }

    .btn-small {
        padding: 7px 10px;
        font-size: 11px;
    }

    .empty-users {
        text-align: center;
        padding: 35px 15px !important;
        color: #94a3b8 !important;
    }

    .pagination-wrapper {
        margin-top: 18px;
    }

    .alert-success {
        padding: 13px 16px;
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        border-radius: 8px;
        color: #065f46;
        margin-bottom: 18px;
        font-size: 13px;
    }

    @media (max-width: 900px) {
        .user-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .filter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 550px) {
        .user-stats,
        .filter-grid {
            grid-template-columns: 1fr;
        }

        .user-stat-value {
            font-size: 24px;
        }
    }
</style>


{{-- PAGE HEADING --}}
<div class="page-heading">
    <div>
        <h2>👥 User Management</h2>
        <p>Kelola dan pantau seluruh akun pengguna sistem IT Helpdesk Gateway.</p>
    </div>
</div>


@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Statistik User --}}
<div class="user-stats">
    <div class="user-stat">
        <div class="user-stat-label">Total User</div>
        <div class="user-stat-value">{{ number_format($totalUsers) }}</div>
    </div>

    <div class="user-stat">
        <div class="user-stat-label">Akun Aktif</div>
        <div class="user-stat-value" style="color:#059669;">
            {{ number_format($activeUsers) }}
        </div>
    </div>

    <div class="user-stat">
        <div class="user-stat-label">Menunggu Persetujuan</div>
        <div class="user-stat-value" style="color:#d97706;">
            {{ number_format($pendingUsers) }}
        </div>
    </div>

    <div class="user-stat">
        <div class="user-stat-label">Pendaftaran Ditolak</div>
        <div class="user-stat-value" style="color:#dc2626;">
            {{ number_format($rejectedUsers) }}
        </div>
    </div>
</div>

{{-- Filter User --}}
<div class="user-filter">
    <form method="GET" action="{{ route('admin.users.index') }}">
        <div class="filter-grid">

            <div class="filter-group">
                <label for="search">Cari Nama atau Email</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Masukkan nama atau email..."
                >
            </div>

            <div class="filter-group">
                <label for="status">Status Akun</label>
                <select id="status" name="status">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="office_id">Kantor / Cabang</label>
                <select id="office_id" name="office_id">
                    <option value="">Semua Kantor</option>
                    @foreach($offices as $office)
                        <option value="{{ $office->id }}" {{ request('office_id') == $office->id ? 'selected' : '' }}>
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="department_id">Departemen</label>
                <select id="department_id" name="department_id">
                    <option value="">Semua Departemen</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="role_id">Role</label>
                <select id="role_id" name="role_id">
                    <option value="">Semua Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="start_date">Tanggal Pendaftaran Mulai</label>
                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                >
            </div>

            <div class="filter-group">
                <label for="end_date">Tanggal Pendaftaran Sampai</label>
                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                >
            </div>

        </div>

        <div class="filter-actions">
            <button type="submit" class="user-btn btn-filter">
                Terapkan Filter
            </button>

            <a href="{{ route('admin.users.index') }}" class="user-btn btn-reset">
                Reset Filter
            </a>
        </div>
    </form>
</div>

{{-- Tabel User --}}
<div class="user-table-card">
    <div class="user-table-heading">
        <h3>Daftar Pengguna</h3>
        <span style="font-size:13px;color:#64748b;">
            Menampilkan {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}
            dari {{ $users->total() }} akun
        </span>
    </div>

    <div class="table-scroll">
        <table class="user-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Kantor / Cabang</th>
                    <th>Departemen</th>
                    <th>Role</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?: '-' }}</td>
                        <td>{{ $user->office_name ?: '-' }}</td>
                        <td>{{ $user->department_name ?: '-' }}</td>
                        <td>{{ $user->role_name ?: '-' }}</td>
                        <td>
                            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') : '-' }}
                        </td>
                        <td>
                            @if($user->status === 'active')
                                <span class="user-status status-active">Aktif</span>
                            @elseif($user->status === 'pending')
                                <span class="user-status status-pending">Menunggu</span>
                            @elseif($user->status === 'rejected')
                                <span class="user-status status-rejected">Ditolak</span>
                            @else
                                <span class="user-status">{{ $user->status ?: 'Tidak diketahui' }}</span>
                            @endif
                        </td>
                        <td>
                            @if($user->status === 'pending')
                                <div class="action-buttons">
                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.approve', $user->id) }}"
                                        onsubmit="return confirm('Setujui pendaftaran {{ addslashes($user->name) }}?')"
                                    >
                                        @csrf
                                        <button type="submit" class="user-btn btn-approve btn-small">
                                            Setujui
                                        </button>
                                    </form>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.reject', $user->id) }}"
                                        onsubmit="return confirm('Tolak pendaftaran {{ addslashes($user->name) }}?')"
                                    >
                                        @csrf
                                        <button type="submit" class="user-btn btn-reject btn-small">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span style="color:#94a3b8;">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="empty-users">
                            Tidak ada data pengguna yang sesuai dengan filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $users->links() }}
    </div>
</div>


{{-- USER APPROVAL --}}
<div class="user-table-card" style="margin-top:24px;">

    <div class="user-table-heading">
        <div>
            <h3>User Approval</h3>
            <p style="font-size:13px;color:#64748b;margin-top:5px;">
                Daftar pengguna yang menunggu persetujuan Admin.
            </p>
        </div>

        <span class="user-status status-pending">
            {{ $pendingApprovalUsers->count() }} Menunggu
        </span>
    </div>

    <div class="table-scroll">
        <table class="user-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Kantor / Cabang</th>
                    <th>Departemen</th>
                    <th>Role</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pendingApprovalUsers as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>

                        <td>{{ $user->email }}</td>

                        <td>{{ $user->phone ?: '-' }}</td>

                        <td>{{ $user->office_name ?: '-' }}</td>

                        <td>{{ $user->department_name ?: '-' }}</td>

                        <td>{{ $user->role_name ?: '-' }}</td>

                        <td>
                            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') : '-' }}
                        </td>

                        <td>
                            <div class="action-buttons">
                                <form
                                    method="POST"
                                    action="{{ route('admin.users.approve', $user->id) }}"
                                    onsubmit="return confirm('Setujui pendaftaran {{ addslashes($user->name) }}?')"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="user-btn btn-approve btn-small"
                                    >
                                        Setujui
                                    </button>
                                </form>

                                <form
                                    method="POST"
                                    action="{{ route('admin.users.reject', $user->id) }}"
                                    onsubmit="return confirm('Tolak pendaftaran {{ addslashes($user->name) }}?')"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="user-btn btn-reject btn-small"
                                    >
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty-users">
                            Tidak ada pengguna yang menunggu persetujuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
