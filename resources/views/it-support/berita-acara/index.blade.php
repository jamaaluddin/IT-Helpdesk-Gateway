@extends('layouts.itsupport')

@section('title', 'Berita Acara - IT Support Gateway')
@section('page-title', 'Berita Acara')
@section('page-subtitle', 'Kelola dokumen operasional dan administrasi IT Support Gateway')

@section('content')

<style>
    .ba-page {
        max-width: 1400px;
        margin: auto;
        color: #1f2937;
        font-family: Arial, sans-serif;
    }

    .ba-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .ba-top h2 {
        font-size: 23px;
        color: #172033;
        margin-bottom: 7px;
    }

    .ba-top p {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.5;
    }

    .ba-count {
        display: inline-flex;
        margin-top: 12px;
        padding: 6px 11px;
        border-radius: 20px;
        background: #ede9fe;
        border: 1px solid #ddd6fe;
        color: #7c3aed;
        font-size: 11px;
        font-weight: bold;
    }

    .ba-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 10px;
        background: #7c3aed;
        color: white;
        border: 1px solid #7c3aed;
        font-size: 13px;
        font-weight: bold;
        white-space: nowrap;
        transition: .2s ease;
    }

    .ba-add-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(124, 58, 237, .18);
    }

    .ba-add-btn:active {
        transform: translateY(0);
    }

    .ba-section {
        background: white;
        border: 1px solid #eef2f7;
        border-radius: 18px;
        padding: 25px;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, .03),
            0 8px 18px rgba(0, 0, 0, .05),
            0 16px 35px rgba(124, 58, 237, .05);
    }

    .ba-section-heading {
        margin-bottom: 20px;
    }

    .ba-section-heading h3 {
        font-size: 17px;
        color: #172033;
        margin-bottom: 6px;
    }

    .ba-section-heading p {
        font-size: 13px;
        color: #6b7280;
    }

    .ba-alert {
        padding: 13px 16px;
        border-radius: 9px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .ba-alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .ba-alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .ba-filter {
        display: grid;
        grid-template-columns: minmax(180px, 2fr) minmax(150px, 1fr) repeat(2, minmax(145px, 1fr)) auto;
        gap: 10px;
        align-items: end;
        margin-bottom: 20px;
    }

    .ba-filter-group label {
        display: block;
        margin-bottom: 7px;
        color: #475569;
        font-size: 12px;
        font-weight: bold;
    }

    .ba-filter-group input,
    .ba-filter-group select {
        width: 100%;
        height: 40px;
        padding: 0 11px;
        border: 1px solid #dbe2ea;
        border-radius: 8px;
        background: white;
        color: #374151;
        font-size: 12px;
        outline: none;
    }

    .ba-filter-group input:focus,
    .ba-filter-group select:focus {
        border-color: #a78bfa;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, .08);
    }

    .ba-filter-actions {
        display: flex;
        gap: 7px;
    }

    .ba-filter-btn,
    .ba-reset-btn {
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
        transition: .2s ease;
    }

    .ba-filter-btn {
        background: #7c3aed;
        color: white;
        border: 1px solid #7c3aed;
        cursor: pointer;
    }

    .ba-filter-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 4px 9px rgba(124, 58, 237, .15);
    }

    .ba-reset-btn {
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .ba-reset-btn:hover {
        background: #f1f5f9;
    }

    .ba-table-scroll {
        width: 100%;
        max-height: 500px;
        overflow: auto;
        border: 1px solid #eef2f7;
        border-radius: 12px;
    }

    .ba-table-scroll::-webkit-scrollbar {
        width: 7px;
        height: 7px;
    }

    .ba-table-scroll::-webkit-scrollbar-thumb {
        background: #c4b5fd;
        border-radius: 10px;
    }

    .ba-table-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .ba-table {
        width: 100%;
        min-width: 950px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .ba-table thead th {
        position: sticky;
        top: 0;
        z-index: 5;
        padding: 14px 13px;
        background: #f8fafc;
        color: #64748b;
        border-bottom: 1px solid #e5e7eb;
        font-size: 12px;
        text-align: left;
        white-space: nowrap;
    }

    .ba-table tbody td {
        padding: 14px 13px;
        border-bottom: 1px solid #eef2f7;
        color: #374151;
        font-size: 13px;
        vertical-align: middle;
    }

    .ba-table tbody tr:hover td {
        background: #fcfaff;
    }

    .ba-table tbody tr:last-child td {
        border-bottom: none;
    }

    .ba-number {
        color: #7c3aed;
        font-weight: bold;
        white-space: nowrap;
    }

    .ba-type {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 20px;
        background: #ede9fe;
        color: #7c3aed;
        font-size: 11px;
        font-weight: bold;
    }

    .ba-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 90px;
        padding: 9px 12px;
        border-radius: 8px;
        background: #7c3aed;
        color: white;
        font-size: 12px;
        font-weight: bold;
        transition: .2s ease;
    }

    .ba-action-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(124, 58, 237, .13);
    }

    .ba-empty {
        padding: 55px 20px;
        text-align: center;
        color: #6b7280;
        font-size: 13px;
    }

    .ba-empty-icon {
        font-size: 35px;
        margin-bottom: 12px;
    }

    .ba-pagination {
        margin-top: 20px;
    }

    @media (max-width: 1100px) {
        .ba-filter {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ba-filter-actions {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 700px) {
        .ba-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .ba-add-btn {
            width: 100%;
        }

        .ba-section {
            padding: 17px;
        }
    }

    @media (max-width: 500px) {
        .ba-filter {
            grid-template-columns: 1fr;
        }

        .ba-filter-actions {
            grid-column: auto;
        }

        .ba-filter-btn,
        .ba-reset-btn {
            flex: 1;
        }
    }
</style>

<main class="ba-page">

    <div class="ba-top">
        <div>
            <h2>📄 Daftar Berita Acara</h2>

            <p>
                Buat dan kelola dokumen kegiatan operasional IT Support.
            </p>

            <span class="ba-count">
                Total {{ $documents->total() }} Dokumen
            </span>
        </div>

        <a href="{{ route('it-support.berita-acara.create') }}"
           class="ba-add-btn">
            ＋ Buat Berita Acara
        </a>
    </div>

    @if (session('success'))
        <div class="ba-alert ba-alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="ba-alert ba-alert-error">
            Ada kesalahan saat memproses dokumen.
            Silakan periksa kembali data yang dimasukkan.
        </div>
    @endif

    <section class="ba-section">

        <div class="ba-section-heading">
            <h3>Daftar Dokumen</h3>
            <p>
                Cari dokumen berdasarkan nomor, judul, jenis, atau tanggal.
            </p>
        </div>

        <form method="GET"
              action="{{ route('it-support.berita-acara.index') }}"
              class="ba-filter">

            <div class="ba-filter-group">
                <label for="search">Pencarian</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nomor atau judul dokumen..."
                >
            </div>

            <div class="ba-filter-group">
                <label for="type">Jenis Dokumen</label>
                <select name="type" id="type">
                    <option value="">Semua Jenis</option>

                    @foreach ($documentTypes as $type)
                        <option value="{{ $type }}"
                            {{ request('type') === $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="ba-filter-group">
                <label for="start_date">Dari Tanggal</label>
                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                >
            </div>

            <div class="ba-filter-group">
                <label for="end_date">Sampai Tanggal</label>
                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                >
            </div>

            <div class="ba-filter-actions">
                <button type="submit" class="ba-filter-btn">
                    Cari
                </button>

                <a href="{{ route('it-support.berita-acara.index') }}"
                   class="ba-reset-btn">
                    Reset
                </a>
            </div>

        </form>

        <div class="ba-table-scroll">

            <table class="ba-table">

                <thead>
                    <tr>
                        <th style="width: 19%;">Nomor Dokumen</th>
                        <th style="width: 25%;">Judul Dokumen</th>
                        <th style="width: 16%;">Jenis Dokumen</th>
                        <th style="width: 13%;">Tanggal</th>
                        <th style="width: 15%;">Dibuat Oleh</th>
                        <th style="width: 12%; text-align:center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($documents as $document)

                        <tr>
                            <td>
                                <span class="ba-number">
                                    {{ $document->document_number }}
                                </span>
                            </td>

                            <td>
                                {{ $document->title }}
                            </td>

                            <td>
                                <span class="ba-type">
                                    {{ $document->document_type }}
                                </span>
                            </td>

                            <td>
                                {{ $document->document_date->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $document->creator?->name ?? '-' }}
                            </td>

                            <td style="text-align:center;">
                                <a
                                    href="{{ route('it-support.berita-acara.show', $document) }}"
                                    class="ba-action-btn"
                                >
                                    Detail
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                <div class="ba-empty">
                                    <div class="ba-empty-icon">📂</div>

                                    <strong>Belum Ada Dokumen</strong>

                                    <p style="margin-top:8px;">
                                        Belum ada Berita Acara yang tersimpan
                                        atau tidak ditemukan hasil pencarian.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($documents->hasPages())
            <div class="ba-pagination">
                {{ $documents->links() }}
            </div>
        @endif

    </section>

</main>

@endsection
