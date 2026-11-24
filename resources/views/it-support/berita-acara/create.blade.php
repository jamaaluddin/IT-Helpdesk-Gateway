@extends('layouts.itsupport')

@section('title', 'Buat Berita Acara - IT Support Gateway')
@section('page-title', 'Buat Berita Acara')
@section('page-subtitle', 'Buat dokumen kegiatan operasional IT Support Gateway')

@section('content')

<style>
    .ba-create {
        max-width: 1100px;
        margin: auto;
        color: #1f2937;
        font-family: Arial, sans-serif;
    }

    .ba-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .ba-heading h2 {
        font-size: 23px;
        color: #172033;
        margin-bottom: 7px;
    }

    .ba-heading p {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.5;
    }

    .ba-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 16px;
        border: 1px solid #ddd6fe;
        border-radius: 9px;
        background: #ede9fe;
        color: #7c3aed;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
        transition: .2s ease;
    }

    .ba-back:hover {
        background: #ddd6fe;
        transform: translateY(-2px);
    }

    .ba-card {
        background: white;
        border: 1px solid #eef2f7;
        border-radius: 17px;
        padding: 28px;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, .03),
            0 8px 18px rgba(0, 0, 0, .05),
            0 16px 35px rgba(124, 58, 237, .05);
    }

    .ba-section-title {
        padding-bottom: 15px;
        margin-bottom: 22px;
        border-bottom: 1px solid #eef2f7;
    }

    .ba-section-title h3 {
        color: #172033;
        font-size: 16px;
        margin-bottom: 6px;
    }

    .ba-section-title p {
        color: #6b7280;
        font-size: 12px;
        line-height: 1.5;
    }

    .ba-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .ba-field {
        margin-bottom: 20px;
        min-width: 0;
    }

    .ba-field.full {
        grid-column: 1 / -1;
    }

    .ba-field label {
        display: block;
        margin-bottom: 8px;
        color: #374151;
        font-size: 13px;
        font-weight: bold;
    }

    .ba-field label .required {
        color: #dc2626;
    }

    .ba-field input,
    .ba-field select,
    .ba-field textarea {
        width: 100%;
        padding: 12px 13px;
        border: 1px solid #dbe2ea;
        border-radius: 9px;
        background: white;
        color: #374151;
        font-family: Arial, sans-serif;
        font-size: 13px;
        outline: none;
        transition: .2s ease;
    }

    .ba-field input,
    .ba-field select {
        height: 43px;
    }

    .ba-field textarea {
        min-height: 190px;
        resize: vertical;
        line-height: 1.7;
    }

    .ba-field input:focus,
    .ba-field select:focus,
    .ba-field textarea:focus {
        border-color: #a78bfa;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, .08);
    }

    .ba-field input::placeholder,
    .ba-field textarea::placeholder {
        color: #9ca3af;
    }

    .ba-hint {
        display: block;
        margin-top: 7px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.5;
    }

    .ba-error {
        display: block;
        margin-top: 7px;
        color: #dc2626;
        font-size: 11px;
    }

    .ba-divider {
        border: none;
        border-top: 1px solid #eef2f7;
        margin: 12px 0 25px;
    }

    .ba-optional-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 8px;
        color: #172033;
        font-size: 15px;
        font-weight: bold;
    }

    .ba-optional-title span {
        padding: 4px 8px;
        border-radius: 20px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 10px;
    }

    .ba-optional-description {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .ba-repeat-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .ba-repeat-item {
        display: grid;
        grid-template-columns: 1fr 1fr 42px;
        gap: 10px;
        align-items: center;
    }

    .ba-repeat-item input {
        height: 42px;
        width: 100%;
        min-width: 0;
        padding: 10px 12px;
        border: 1px solid #dbe2ea;
        border-radius: 8px;
        font-size: 12px;
        outline: none;
    }

    .ba-repeat-item input:focus {
        border-color: #a78bfa;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, .08);
    }

    .ba-remove-btn {
        width: 42px;
        height: 42px;
        border: 1px solid #fecaca;
        border-radius: 8px;
        background: #fef2f2;
        color: #dc2626;
        font-size: 17px;
        cursor: pointer;
        transition: .2s ease;
    }

    .ba-remove-btn:hover {
        background: #fee2e2;
        transform: translateY(-2px);
    }

    .ba-add-row {
        margin-top: 13px;
        padding: 9px 13px;
        border: 1px solid #ddd6fe;
        border-radius: 8px;
        background: #f5f3ff;
        color: #7c3aed;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: .2s ease;
    }

    .ba-add-row:hover {
        background: #ede9fe;
        transform: translateY(-2px);
    }

    .ba-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #eef2f7;
    }

    .ba-cancel,
    .ba-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 130px;
        height: 43px;
        padding: 0 17px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: .2s ease;
    }

    .ba-cancel {
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        color: #64748b;
    }

    .ba-cancel:hover {
        background: #f1f5f9;
    }

    .ba-submit {
        border: 1px solid #7c3aed;
        background: #7c3aed;
        color: white;
    }

    .ba-submit:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(124, 58, 237, .18);
    }

    .ba-submit:active {
        transform: translateY(0);
    }

    @media (max-width: 700px) {
        .ba-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .ba-back {
            width: 100%;
        }

        .ba-card {
            padding: 20px;
        }

        .ba-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .ba-field.full {
            grid-column: auto;
        }
    }

    @media (max-width: 500px) {
        .ba-repeat-item {
            grid-template-columns: 1fr 42px;
        }

        .ba-repeat-item input:first-child {
            grid-column: 1 / -1;
        }

        .ba-actions {
            flex-direction: column-reverse;
        }

        .ba-cancel,
        .ba-submit {
            width: 100%;
        }
    }
</style>

<main class="ba-create">

    <div class="ba-heading">
        <div>
            <h2>📄 Buat Berita Acara</h2>
            <p>
                Lengkapi informasi dan isi dokumen yang akan disimpan.
            </p>
        </div>

        <a href="{{ route('it-support.berita-acara.index') }}"
           class="ba-back">
            ← Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:14px;border-radius:9px;margin-bottom:18px;font-size:13px;">
            <strong>Periksa kembali data berikut:</strong>
            <ul style="margin:8px 0 0 20px;line-height:1.7;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('it-support.berita-acara.store') }}"
            method="POST"
            id="beritaAcaraForm"
            data-party-count="{{ count(old('related_parties', [])) }}"
            data-signature-count="{{ count(old('signature_blocks', [])) }}">

        @csrf

        <section class="ba-card">

            <div class="ba-section-title">
                <h3>1. Informasi Dokumen</h3>
                <p>
                    Masukkan identitas dasar Berita Acara.
                </p>
            </div>

            <div class="ba-grid">

                <div class="ba-field">
                    <label for="title">
                        Judul Dokumen <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Contoh: Berita Acara Penggantian SSD"
                        maxlength="255"
                        required
                    >

                    @error('title')
                        <span class="ba-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="ba-field">
                    <label for="document_type">
                        Jenis Dokumen <span class="required">*</span>
                    </label>

                    <select id="document_type"
                            name="document_type"
                            required>

                        <option value="">Pilih Jenis Dokumen</option>

                        @foreach ([
                            'Pengajuan Pembelian',
                            'Penggantian Komponen',
                            'Pemeriksaan',
                            'Maintenance',
                            'Lainnya'
                        ] as $type)

                            <option value="{{ $type }}"
                                {{ old('document_type') === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>

                        @endforeach

                    </select>

                    @error('document_type')
                        <span class="ba-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="ba-field">
                    <label for="document_date">
                        Tanggal Dokumen <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        id="document_date"
                        name="document_date"
                        value="{{ old('document_date', date('Y-m-d')) }}"
                        required
                    >

                    @error('document_date')
                        <span class="ba-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <hr class="ba-divider">

            <div class="ba-section-title">
                <h3>2. Isi Berita Acara</h3>
                <p>
                    Tuliskan informasi kegiatan secara lengkap.
                    Isi dokumen dapat disesuaikan dengan kebutuhan masing-masing kegiatan.
                </p>
            </div>

            <div class="ba-field">
                <label for="content">
                    Isi Dokumen <span class="required">*</span>
                </label>

                <textarea
                    id="content"
                    name="content"
                    placeholder="Tuliskan isi Berita Acara di sini...

Contoh:

Pada hari ..., tanggal ..., telah dilakukan kegiatan ...

Adapun kegiatan yang dilakukan meliputi:
1. ...
2. ...
3. ...

Hasil kegiatan:
...

Demikian Berita Acara ini dibuat untuk digunakan sebagaimana mestinya."
                    required
                >{{ old('content') }}</textarea>

                <span class="ba-hint">
                    Gunakan format penulisan yang sesuai dengan kegiatan
                    dan kebutuhan administrasi kantor.
                </span>

                @error('content')
                    <span class="ba-error">{{ $message }}</span>
                @enderror
            </div>

            <hr class="ba-divider">

            <div class="ba-section-title">
                <div class="ba-optional-title">
                    3. Pihak Terkait
                    <span>Opsional</span>
                </div>

                <p>
                    Tambahkan pihak yang terlibat dalam kegiatan atau dokumen.
                </p>
            </div>

            <div id="relatedParties" class="ba-repeat-list">

                @php
                    $parties = old('related_parties', []);
                @endphp

                @forelse ($parties as $index => $party)

                    <div class="ba-repeat-item">
                        <input
                            type="text"
                            name="related_parties[{{ $index }}][name]"
                            value="{{ $party['name'] ?? '' }}"
                            placeholder="Nama pihak"
                        >

                        <input
                            type="text"
                            name="related_parties[{{ $index }}][role]"
                            value="{{ $party['role'] ?? '' }}"
                            placeholder="Jabatan / Bagian"
                        >

                        <button type="button"
                                class="ba-remove-btn"
                                onclick="removeRow(this)">
                            ×
                        </button>
                    </div>

                @empty

                @endforelse

            </div>

            <button type="button"
                    class="ba-add-row"
                    onclick="addParty()">
                ＋ Tambah Pihak
            </button>

            <hr class="ba-divider">

            <div class="ba-section-title">
                <div class="ba-optional-title">
                    4. Pihak Penandatangan
                    <span>Opsional</span>
                </div>

                <p>
                    Tambahkan nama dan jabatan pihak yang perlu menandatangani dokumen.
                    Bagian ini tidak wajib diisi.
                </p>
            </div>

            <div id="signatureBlocks" class="ba-repeat-list">

                @php
                    $signatures = old('signature_blocks', []);
                @endphp

                @forelse ($signatures as $index => $signature)

                    <div class="ba-repeat-item">
                        <input
                            type="text"
                            name="signature_blocks[{{ $index }}][name]"
                            value="{{ $signature['name'] ?? '' }}"
                            placeholder="Nama penandatangan"
                        >

                        <input
                            type="text"
                            name="signature_blocks[{{ $index }}][role]"
                            value="{{ $signature['role'] ?? '' }}"
                            placeholder="Jabatan"
                        >

                        <button type="button"
                                class="ba-remove-btn"
                                onclick="removeRow(this)">
                            ×
                        </button>
                    </div>

                @empty

                @endforelse

            </div>

            <button type="button"
                    class="ba-add-row"
                    onclick="addSignature()">
                ＋ Tambah Penandatangan
            </button>

            <div class="ba-actions">

                <a href="{{ route('it-support.berita-acara.index') }}"
                   class="ba-cancel">
                    Batal
                </a>

                <button type="submit" class="ba-submit">
                    💾 Simpan Berita Acara
                </button>

            </div>

        </section>

    </form>

</main>


<script>
    const form = document.getElementById('beritaAcaraForm');

    let partyIndex = Number(form.dataset.partyCount);
    let signatureIndex = Number(form.dataset.signatureCount);

    function addParty() {
        const container = document.getElementById('relatedParties');

        const row = document.createElement('div');
        row.className = 'ba-repeat-item';

        row.innerHTML = `
            <input
                type="text"
                name="related_parties[${partyIndex}][name]"
                placeholder="Nama pihak"
            >

            <input
                type="text"
                name="related_parties[${partyIndex}][role]"
                placeholder="Jabatan / Bagian"
            >

            <button type="button"
                    class="ba-remove-btn"
                    onclick="removeRow(this)">
                ×
            </button>
        `;

        container.appendChild(row);
        partyIndex++;
    }

    function addSignature() {
        const container = document.getElementById('signatureBlocks');

        const row = document.createElement('div');
        row.className = 'ba-repeat-item';

        row.innerHTML = `
            <input
                type="text"
                name="signature_blocks[${signatureIndex}][name]"
                placeholder="Nama penandatangan"
            >

            <input
                type="text"
                name="signature_blocks[${signatureIndex}][role]"
                placeholder="Jabatan"
            >

            <button type="button"
                    class="ba-remove-btn"
                    onclick="removeRow(this)">
                ×
            </button>
        `;

        container.appendChild(row);
        signatureIndex++;
    }

    function removeRow(button) {
        button.closest('.ba-repeat-item').remove();
    }
</script>


@endsection
