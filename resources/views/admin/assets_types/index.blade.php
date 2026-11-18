@extends('layouts.admin')

@section('title', 'Kelola Jenis Aset - Gateway Admin')
@section('page-title', 'Kelola Jenis Aset')
@section('page-subtitle', 'Pengaturan kategori aset IT Helpdesk Gateway')

@section('content')

@push('styles')

    /* PAGE CONTENT */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 20px;
        color: #047857;
        font-size: 13px;
        font-weight: bold;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .page-heading {
        margin-bottom: 22px;
    }

    .page-heading h2 {
        font-size: 27px;
        line-height: 1.3;
        color: #064e3b;
        margin: 0;
    }

    .page-heading p {
        margin: 7px 0 0;
        font-size: 14px;
        line-height: 1.6;
        color: #6b7280;
        max-width: 760px;
    }

    /* NOTIFICATION */
    .alert {
        padding: 13px 16px;
        border-radius: 9px;
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 18px;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .alert ul {
        margin: 8px 0 0 20px;
    }

    /* PANEL */
    .panel {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,.04);
        overflow: hidden;
        margin-bottom: 22px;
    }

    .panel-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
    }

    .panel-header h3 {
        color: #064e3b;
        font-size: 16px;
        margin: 0;
    }

    .panel-header p {
        color: #6b7280;
        font-size: 13px;
        line-height: 1.5;
        margin: 5px 0 0;
    }

    .panel-body {
        padding: 20px;
    }

    /* FORM */
    .form-grid {
        display: grid;
        grid-template-columns: minmax(180px, 1fr) minmax(220px, 1.5fr) auto;
        gap: 15px;
        align-items: end;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #374151;
    }

    .form-group input {
        display: block;
        width: 100%;
        min-height: 42px;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 13px;
        outline: none;
        background: white;
    }

    .form-group input:focus,
    .edit-form input:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5,150,105,.10);
    }

    /* BUTTON */
    .button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 10px 13px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s ease;
    }

    .button-green {
        background: #059669;
        color: white;
    }

    .button-green:hover {
        background: #047857;
    }

    .button-gray {
        background: #f3f4f6;
        color: #374151;
        border-color: #e5e7eb;
    }

    .button-gray:hover {
        background: #e5e7eb;
    }

    .button-red {
        background: #fee2e2;
        color: #991b1b;
    }

    .button-red:hover {
        background: #fecaca;
    }

    /* TABLE */
    .table-wrapper {
        width: 100%;
        max-height: 500px;
        overflow: auto;
    }

    .table-wrapper table {
        width: 100%;
        min-width: 1000px;
        border-collapse: collapse;
    }

    .table-wrapper thead th {
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

    .table-wrapper tbody td {
        padding: 14px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
        vertical-align: middle;
    }

    .table-wrapper tbody tr:last-child td {
        border-bottom: none;
    }

    .table-wrapper tbody tr:hover {
        background: #f9fafb;
    }

    .type-name {
        font-weight: bold;
        color: #111827;
        min-width: 125px;
    }

    .description {
        color: #6b7280;
        line-height: 1.5;
        max-width: 220px;
        overflow-wrap: anywhere;
    }

    /* BADGE */
    .badge {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .badge-active {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-inactive {
        background: #f3f4f6;
        color: #4b5563;
    }

    .count {
        display: inline-block;
        min-width: 32px;
        padding: 7px 9px;
        background: #ecfdf5;
        color: #065f46;
        border-radius: 7px;
        font-weight: bold;
        text-align: center;
    }

    /* EDIT FORM */
    .edit-form {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 190px;
    }

    .edit-form input {
        width: 100%;
        min-width: 170px;
        min-height: 36px;
        padding: 8px 10px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 12px;
        outline: none;
    }

    .edit-form .button {
        align-self: flex-start;
    }

    .actions {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .actions form {
        margin: 0;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 38px 20px !important;
        color: #6b7280;
        line-height: 1.6;
    }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .form-grid {
            grid-template-columns: 1fr 1fr;
        }

        .form-submit {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 700px) {
        .page-heading h2 {
            font-size: 23px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-submit {
            grid-column: auto;
        }

        .form-submit .button {
            width: 100%;
        }

        .panel-body {
            padding: 16px;
        }
    }

    @media (max-width: 480px) {
        .page-heading h2 {
            font-size: 21px;
        }
    }

@endpush


    <a href="{{ route('admin.assets.index') }}" class="back-link">
        ← Kembali ke Asset Management
    </a>

    <div class="page-heading">
        <h2>Master Jenis Aset</h2>

        <p>
            Tambahkan dan kelola kategori aset seperti komputer, printer,
            mouse, keyboard, SSD, dan perangkat lainnya.
        </p>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <strong>Data belum berhasil disimpan.</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TAMBAH JENIS ASET --}}
    <section class="panel">

        <div class="panel-header">
            <h3>Tambah Jenis Aset</h3>
            <p>Jenis aset baru akan langsung berstatus aktif.</p>
        </div>

        <div class="panel-body">

            <form action="{{ route('admin.asset-types.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label for="name">Nama Jenis Aset</label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Printer"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi (Opsional)</label>

                        <input
                            type="text"
                            id="description"
                            name="description"
                            value="{{ old('description') }}"
                            placeholder="Contoh: Perangkat pencetak dokumen"
                            maxlength="1000"
                        >
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="button button-green">
                            + Tambah Jenis
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </section>

    {{-- DAFTAR JENIS ASET --}}
    <section class="panel">

        <div class="panel-header">
            <h3>Daftar Jenis Aset</h3>

            <p>
                Perubahan status tidak menghapus data aset yang sudah terdaftar.
            </p>
        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Aset</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Aset</th>
                        <th>Status</th>
                        <th>Edit Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($assetTypes as $assetType)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="type-name">
                                    {{ $assetType->name }}
                                </div>
                            </td>

                            <td>
                                <div class="description">
                                    {{ $assetType->description ?: '—' }}
                                </div>
                            </td>

                            <td>
                                <span class="count">
                                    {{ $assetType->assets_count }}
                                </span>
                            </td>

                            <td>
                                @if ($assetType->is_active)
                                    <span class="badge badge-active">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge badge-inactive">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td>
                                <form
                                    action="{{ route('admin.asset-types.update', $assetType) }}"
                                    method="POST"
                                    class="edit-form"
                                >
                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ $assetType->name }}"
                                        aria-label="Nama jenis aset"
                                        maxlength="255"
                                        required
                                    >

                                    <input
                                        type="text"
                                        name="description"
                                        value="{{ $assetType->description }}"
                                        aria-label="Deskripsi jenis aset"
                                        placeholder="Deskripsi (opsional)"
                                        maxlength="1000"
                                    >

                                    <button type="submit" class="button button-gray">
                                        Simpan Perubahan
                                    </button>
                                </form>
                            </td>

                            <td>
                                <div class="actions">

                                    <form
                                        action="{{ route('admin.asset-types.toggle-status', $assetType) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin mengubah status jenis aset ini?')"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        @if ($assetType->is_active)
                                            <button type="submit" class="button button-red">
                                                Nonaktifkan
                                            </button>
                                        @else
                                            <button type="submit" class="button button-green">
                                                Aktifkan
                                            </button>
                                        @endif
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="empty-state">
                                Belum ada jenis aset. Silakan tambahkan melalui formulir di atas.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

@endsection
