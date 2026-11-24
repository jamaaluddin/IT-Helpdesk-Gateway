@extends('layouts.itsupport')

@section('title', 'Detail Berita Acara - IT Support Gateway')
@section('page-title', 'Detail Berita Acara')
@section('page-subtitle', 'Informasi lengkap dokumen kegiatan operasional IT Support')

@section('content')

<style>
    .ba-detail {
        max-width: 1100px;
        margin: auto;
        color: #1f2937;
    }

    .ba-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .ba-top-left {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .ba-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 40px;
        padding: 10px 15px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .ba-btn:hover {
        transform: translateY(-2px);
    }

    .ba-btn:active {
        transform: translateY(0);
    }

    .ba-btn-back {
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .ba-btn-edit {
        color: white;
        background: #7c3aed;
        border: 1px solid #7c3aed;
    }

    .ba-btn-edit:hover {
        background: #6d28d9;
        box-shadow: 0 5px 12px rgba(124, 58, 237, .18);
    }

    .ba-btn-print {
        color: #047857;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
    }

    .ba-btn-print:hover {
        background: #d1fae5;
    }

    .ba-btn-delete {
        color: #dc2626;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .ba-btn-delete:hover {
        background: #fee2e2;
    }

    .ba-card {
        background: white;
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 28px;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, .03),
            0 8px 18px rgba(0, 0, 0, .05),
            0 16px 35px rgba(124, 58, 237, .04);
    }

    .ba-document-header {
        text-align: center;
        padding-bottom: 23px;
        margin-bottom: 23px;
        border-bottom: 2px solid #e5e7eb;
    }

    .ba-document-header .document-label {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        background: #f3e8ff;
        color: #7c3aed;
        font-size: 10px;
        font-weight: bold;
        margin-bottom: 13px;
    }

    .ba-document-header h2 {
        color: #172033;
        font-size: 22px;
        line-height: 1.5;
        margin-bottom: 9px;
        overflow-wrap: anywhere;
    }

    .ba-document-number {
        color: #64748b;
        font-size: 12px;
        letter-spacing: .3px;
    }

    .ba-info-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 28px;
    }

    .ba-info-item {
        padding: 15px;
        border: 1px solid #eef2f7;
        border-radius: 11px;
        background: #fafbfc;
        min-width: 0;
    }

    .ba-info-item label {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 8px;
    }

    .ba-info-item strong {
        display: block;
        color: #374151;
        font-size: 13px;
        overflow-wrap: anywhere;
    }

    .ba-section {
        margin-top: 28px;
    }

    .ba-section h3 {
        color: #172033;
        font-size: 15px;
        padding-bottom: 12px;
        border-bottom: 1px solid #eef2f7;
        margin-bottom: 16px;
    }

    .ba-content {
        color: #374151;
        font-size: 13px;
        line-height: 1.9;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        min-height: 120px;
    }

    .ba-empty {
        padding: 17px;
        border: 1px dashed #dbe2ea;
        border-radius: 9px;
        color: #94a3b8;
        font-size: 12px;
        text-align: center;
    }

    .ba-party-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .ba-party-item {
        padding: 14px;
        border: 1px solid #eef2f7;
        border-radius: 9px;
        background: #fafbfc;
    }

    .ba-party-item strong {
        display: block;
        color: #374151;
        font-size: 13px;
        margin-bottom: 5px;
        overflow-wrap: anywhere;
    }

    .ba-party-item span {
        color: #64748b;
        font-size: 11px;
    }

    .ba-signature-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        margin-top: 10px;
    }

    .ba-signature-item {
        min-height: 135px;
        padding: 18px;
        border: 1px dashed #dbe2ea;
        border-radius: 10px;
        text-align: center;
    }

    .ba-signature-item span {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-bottom: 65px;
    }

    .ba-signature-item strong {
        display: block;
        color: #374151;
        font-size: 12px;
        text-decoration: underline;
        overflow-wrap: anywhere;
    }

    .ba-signature-item small {
        display: block;
        color: #64748b;
        font-size: 11px;
        margin-top: 5px;
    }

    .ba-created-info {
        margin-top: 30px;
        padding-top: 17px;
        border-top: 1px solid #eef2f7;
        color: #94a3b8;
        font-size: 11px;
    }

    .ba-delete-form {
        display: inline;
    }

    @media (max-width: 700px) {
        .ba-card {
            padding: 19px;
        }

        .ba-info-grid {
            grid-template-columns: 1fr;
        }

        .ba-party-grid,
        .ba-signature-grid {
            grid-template-columns: 1fr;
        }

        .ba-top {
            align-items: stretch;
        }

        .ba-top-left {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .ba-top-left .ba-btn {
            width: 100%;
        }

        .ba-document-header h2 {
            font-size: 18px;
        }
    }

    @media print {
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            background: white !important;
        }

        body * {
            visibility: hidden;
        }

        #baPrintArea,
        #baPrintArea * {
            visibility: visible;
        }

        #baPrintArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0;
            margin: 0;
            border: none;
            box-shadow: none;
            border-radius: 0;
        }

        .ba-no-print {
            display: none !important;
        }

        .ba-info-item {
            background: white;
        }

        .ba-party-item {
            background: white;
        }

        .ba-content {
            color: black;
        }
    }
</style>

<div class="ba-detail">

    {{-- Tombol Aksi --}}
    <div class="ba-top ba-no-print">

        <a href="{{ route('it-support.berita-acara.index') }}"
           class="ba-btn ba-btn-back">
            ← Kembali
        </a>

        <div class="ba-top-left">

            <button type="button"
                    onclick="window.print()"
                    class="ba-btn ba-btn-print">
                🖨️ Cetak
            </button>

            <a href="{{ route('it-support.berita-acara.edit', $beritaAcara) }}"
               class="ba-btn ba-btn-edit">
                ✏️ Edit Dokumen
            </a>

            <form
                action="{{ route('it-support.berita-acara.destroy', $beritaAcara) }}"
                method="POST"
                class="ba-delete-form"
                onsubmit="return confirm('Yakin ingin menghapus Berita Acara ini? Dokumen yang dihapus tidak dapat dikembalikan.')"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="ba-btn ba-btn-delete">
                    🗑️ Hapus
                </button>
            </form>

        </div>

    </div>

    {{-- Area Dokumen --}}
    <section class="ba-card" id="baPrintArea">

        <div class="ba-document-header">

            <span class="document-label">
                BERITA ACARA
            </span>

            <h2>{{ $beritaAcara->title }}</h2>

            <div class="ba-document-number">
                Nomor: {{ $beritaAcara->document_number }}
            </div>

        </div>

        {{-- Informasi Dokumen --}}
        <div class="ba-info-grid">

            <div class="ba-info-item">
                <label>Jenis Dokumen</label>
                <strong>{{ $beritaAcara->document_type }}</strong>
            </div>

            <div class="ba-info-item">
                <label>Tanggal Dokumen</label>
                <strong>
                    {{ $beritaAcara->document_date?->translatedFormat('d F Y') }}
                </strong>
            </div>

            <div class="ba-info-item">
                <label>Dibuat Oleh</label>
                <strong>
                    {{ $beritaAcara->creator?->name ?? 'Tidak diketahui' }}
                </strong>
            </div>

        </div>

        {{-- Isi Dokumen --}}
        <div class="ba-section">

            <h3>Isi Berita Acara</h3>

            <div class="ba-content">{{ $beritaAcara->content }}</div>

        </div>

        {{-- Pihak Terkait --}}
        <div class="ba-section">

            <h3>Pihak Terkait</h3>

            @if (!empty($beritaAcara->related_parties))

                <div class="ba-party-grid">

                    @foreach ($beritaAcara->related_parties as $party)

                        @if (!empty($party['name']) || !empty($party['role']))

                            <div class="ba-party-item">

                                <strong>
                                    {{ $party['name'] ?? '-' }}
                                </strong>

                                <span>
                                    {{ $party['role'] ?? '-' }}
                                </span>

                            </div>

                        @endif

                    @endforeach

                </div>

            @else

                <div class="ba-empty">
                    Tidak ada pihak terkait yang dicantumkan.
                </div>

            @endif

        </div>

        {{-- Penandatangan --}}
        <div class="ba-section">

            <h3>Pihak Penandatangan</h3>

            @if (!empty($beritaAcara->signature_blocks))

                <div class="ba-signature-grid">

                    @foreach ($beritaAcara->signature_blocks as $signature)

                        @if (!empty($signature['name']) || !empty($signature['role']))

                            <div class="ba-signature-item">

                                <span>
                                    {{ $signature['role'] ?? 'Penandatangan' }}
                                </span>

                                <strong>
                                    {{ $signature['name'] ?? '-' }}
                                </strong>

                                <small>
                                    {{ $signature['role'] ?? '' }}
                                </small>

                            </div>

                        @endif

                    @endforeach

                </div>

            @else

                <div class="ba-empty">
                    Tidak ada informasi penandatangan yang dicantumkan.
                </div>

            @endif

        </div>

        <div class="ba-created-info">
            Dokumen dibuat pada:
            {{ $beritaAcara->created_at?->translatedFormat('d F Y, H:i') }}
            WIB
        </div>

    </section>

</div>

@endsection
