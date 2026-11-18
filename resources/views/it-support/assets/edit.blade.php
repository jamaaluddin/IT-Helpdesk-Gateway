@extends('layouts.itsupport')

@section('title', 'Edit Aset')
@section('page-title', 'Edit Aset')
@section('page-subtitle', 'Perbarui informasi aset Gateway sesuai kondisi terbaru')

@section('content')

<style>
    .form-card {
        background: white;
        border-radius: 17px;
        border: 1px solid #eef2f7;
        padding: 30px;
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.03),
                    0 8px 18px rgba(0, 0, 0, 0.05),
                    0 16px 35px rgba(0, 0, 0, 0.06),
                    0 25px 50px rgba(124, 58, 237, 0.06);
    }

    .form-section {
        margin-bottom: 28px;
    }

    .form-section:last-of-type {
        margin-bottom: 25px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 14px;
        margin-bottom: 22px;
        border-bottom: 1px solid #eef2f7;
    }

    .section-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #ede9fe;
        color: #7c3aed;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .section-heading h3 {
        font-size: 16px;
        color: #172033;
    }

    .section-heading p {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 3px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 13px;
        font-weight: bold;
        color: #374151;
        margin-bottom: 9px;
    }

    .required {
        color: #ef4444;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        min-height: 43px;
        padding: 11px 13px;
        border: 1px solid #dbe1ea;
        border-radius: 8px;
        background: #fff;
        color: #1f2937;
        font-family: Arial, sans-serif;
        font-size: 13px;
        outline: none;
        transition: 0.2s ease;
    }

    .form-group input:hover,
    .form-group select:hover,
    .form-group textarea:hover {
        border-color: #c4b5fd;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.10);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #9ca3af;
    }

    .form-group textarea {
        min-height: 115px;
        resize: vertical;
        line-height: 1.6;
    }

    .error-message {
        color: #dc2626;
        font-size: 12px;
        margin-top: 7px;
    }

    .alert-error {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        border-radius: 9px;
        padding: 13px 16px;
        margin-bottom: 22px;
        font-size: 13px;
    }

    .alert-error ul {
        padding-left: 20px;
        margin-top: 7px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        padding-top: 22px;
        border-top: 1px solid #eef2f7;
    }

    .btn {
        min-width: 115px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #4b5563;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
        transform: translateY(-2px);
    }

    .btn-save {
        background: #7c3aed;
        color: white;
        box-shadow: 0 4px 10px rgba(124, 58, 237, 0.20);
    }

    .btn-save:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(124, 58, 237, 0.25);
    }

    .btn:active {
        transform: translateY(0);
    }

    @media (max-width: 900px) {
        .form-card {
            padding: 24px;
        }
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }
    }

    @media (max-width: 550px) {
        .form-card {
            padding: 20px 16px;
        }

        .section-heading {
            margin-bottom: 18px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn {
            width: 100%;
        }
    }
</style>

<div class="form-card">

    @if ($errors->any())
        <div class="alert-error">
            <strong>Data belum berhasil disimpan.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('it-support.assets.update', $asset->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        {{-- INFORMASI ASET --}}
        <section class="form-section">

            <div class="section-heading">
                <div class="section-icon">💻</div>

                <div>
                    <h3>Informasi Aset</h3>
                    <p>Informasi dasar dan identitas aset.</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>
                        Kategori Aset <span class="required">*</span>
                    </label>

                    <select name="asset_type_id" required>
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($assetTypes as $type)
                            <option
                                value="{{ $type->id }}"
                                {{ old('asset_type_id', $asset->asset_type_id) == $type->id ? 'selected' : '' }}
                            >
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('asset_type_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Kode Aset <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="asset_code"
                        value="{{ old('asset_code', $asset->asset_code) }}"
                        placeholder="Contoh: ACCT-DEWI"
                        required
                    >

                    @error('asset_code')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Nama Aset <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $asset->name) }}"
                        placeholder="Contoh: Komputer Accounting"
                        required
                    >

                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Merek</label>

                    <input
                        type="text"
                        name="brand"
                        value="{{ old('brand', $asset->brand) }}"
                        placeholder="Contoh: Lenovo"
                    >

                    @error('brand')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Model</label>

                    <input
                        type="text"
                        name="model"
                        value="{{ old('model', $asset->model) }}"
                        placeholder="Masukkan model aset"
                    >

                    @error('model')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nomor Seri</label>

                    <input
                        type="text"
                        name="serial_number"
                        value="{{ old('serial_number', $asset->serial_number) }}"
                        placeholder="Masukkan nomor seri"
                    >

                    @error('serial_number')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </section>

        {{-- LOKASI ASET --}}
        <section class="form-section">

            <div class="section-heading">
                <div class="section-icon">📍</div>

                <div>
                    <h3>Lokasi Aset</h3>
                    <p>Informasi kantor dan departemen pengguna aset.</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>
                        Kantor <span class="required">*</span>
                    </label>

                    <select name="office_id" required>
                        <option value="">-- Pilih Kantor --</option>

                        @foreach ($offices as $office)
                            <option
                                value="{{ $office->id }}"
                                {{ old('office_id', $asset->office_id) == $office->id ? 'selected' : '' }}
                            >
                                {{ $office->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('office_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Departemen</label>

                    <select name="department_id">
                        <option value="">-- Pilih Departemen --</option>

                        @foreach ($departments as $department)
                            <option
                                value="{{ $department->id }}"
                                {{ old('department_id', $asset->department_id) == $department->id ? 'selected' : '' }}
                            >
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('department_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </section>

        {{-- INFORMASI PEMBELIAN --}}
        <section class="form-section">

            <div class="section-heading">
                <div class="section-icon">🛒</div>

                <div>
                    <h3>Informasi Pembelian</h3>
                    <p>Data harga dan tanggal pembelian aset.</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>Harga Pembelian</label>

                    <input
                        type="number"
                        name="purchase_price"
                        value="{{ old('purchase_price', $asset->purchase_price) }}"
                        placeholder="Contoh: 5000000"
                        min="0"
                        step="0.01"
                    >

                    @error('purchase_price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Pembelian</label>

                    <input
                        type="date"
                        name="purchase_date"
                        value="{{ old('purchase_date', $asset->purchase_date?->format('Y-m-d')) }}"
                    >

                    @error('purchase_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </section>

        {{-- KONDISI DAN STATUS --}}
        <section class="form-section">

            <div class="section-heading">
                <div class="section-icon">⚙️</div>

                <div>
                    <h3>Kondisi dan Status Aset</h3>
                    <p>Tentukan kondisi fisik dan status penggunaan aset.</p>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>
                        Kondisi <span class="required">*</span>
                    </label>

                    <select name="condition" required>
                        <option value="">-- Pilih Kondisi --</option>

                        <option value="good"
                            {{ old('condition', $asset->condition) == 'good' ? 'selected' : '' }}>
                            Baik
                        </option>

                        <option value="minor_damage"
                            {{ old('condition', $asset->condition) == 'minor_damage' ? 'selected' : '' }}>
                            Rusak Ringan
                        </option>

                        <option value="major_damage"
                            {{ old('condition', $asset->condition) == 'major_damage' ? 'selected' : '' }}>
                            Rusak Berat
                        </option>

                        <option value="broken"
                            {{ old('condition', $asset->condition) == 'broken' ? 'selected' : '' }}>
                            Tidak Berfungsi
                        </option>
                    </select>

                    @error('condition')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>
                        Status <span class="required">*</span>
                    </label>

                    <select name="status" required>
                        <option value="">-- Pilih Status --</option>

                        <option value="available"
                            {{ old('status', $asset->status) == 'available' ? 'selected' : '' }}>
                            Tersedia
                        </option>

                        <option value="in_use"
                            {{ old('status', $asset->status) == 'in_use' ? 'selected' : '' }}>
                            Digunakan
                        </option>

                        <option value="maintenance"
                            {{ old('status', $asset->status) == 'maintenance' ? 'selected' : '' }}>
                            Dalam Maintenance
                        </option>

                        <option value="damaged"
                            {{ old('status', $asset->status) == 'damaged' ? 'selected' : '' }}>
                            Rusak
                        </option>

                        <option value="retired"
                            {{ old('status', $asset->status) == 'retired' ? 'selected' : '' }}>
                            Dipensiunkan
                        </option>
                    </select>

                    @error('status')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full">
                    <label>Catatan</label>

                    <textarea
                        name="notes"
                        placeholder="Tambahkan informasi atau catatan mengenai aset ini..."
                    >{{ old('notes', $asset->notes) }}</textarea>

                    @error('notes')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </section>

        {{-- BUTTON --}}
        <div class="form-actions">

            <a
                href="{{ route('it-support.assets.category', $asset->asset_type_id) }}"
                class="btn btn-cancel"
            >
                ← Batal
            </a>

            <button type="submit" class="btn btn-save">
                💾 Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection
