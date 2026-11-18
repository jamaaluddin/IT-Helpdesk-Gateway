
@extends('layouts.admin')

@section('title', 'Tambah Aset - Gateway Admin')
@section('page-title', 'Asset Management')
@section('page-subtitle', 'Tambahkan aset IT baru ke dalam sistem')

@push('styles)

/* =========================
   PAGE HEADING
========================== */

.page-heading {
    margin-bottom: 25px;
}

.page-heading h2 {
    font-size: 28px;
    color: #064e3b;
}

.page-heading p {
    margin-top: 7px;
    font-size: 14px;
    color: #6b7280;
}

/* =========================
   FORM CARD
========================== */

.form-card {
    width: 100%;
    max-width: 1000px;
    background: white;
    border-radius: 14px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    padding: 25px;
}

.form-section {
    margin-bottom: 25px;
}

.form-section:last-child {
    margin-bottom: 0;
}

.form-section-title {
    margin-bottom: 18px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 16px;
    font-weight: 700;
    color: #065f46;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
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
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 700;
    color: #374151;
}

.required {
    color: #dc2626;
}

.form-card input,
.form-card select,
.form-card textarea {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: white;
    color: #1f2937;
    font-size: 13px;
    outline: none;
    transition: 0.2s;
}

.form-card input:focus,
.form-card select:focus,
.form-card textarea:focus {
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5,150,105,0.10);
}

.form-card textarea {
    min-height: 100px;
    resize: vertical;
}

.error {
    margin-top: 5px;
    font-size: 11px;
    color: #dc2626;
}

/* =========================
   ALERT
========================== */

.alert {
    max-width: 1000px;
    margin-bottom: 20px;
    padding: 13px 15px;
    border-radius: 9px;
    background: #fee2e2;
    color: #991b1b;
    font-size: 13px;
}

.alert ul {
    padding-left: 18px;
}

/* =========================
   ACTION
========================== */

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}

.form-actions .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 11px 18px;
    border-radius: 8px;
    border: none;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.btn-cancel {
    background: #f3f4f6;
    color: #374151;
}

.btn-cancel:hover {
    background: #e5e7eb;
}

.btn-save {
    background: #059669;
    color: white;
}

.btn-save:hover {
    background: #047857;
}

/* =========================
   RESPONSIVE
========================== */

@media (max-width: 700px) {
    .page-heading h2 {
        font-size: 24px;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-group.full {
        grid-column: auto;
    }
}

@media (max-width: 480px) {
    .form-card {
        padding: 18px;
    }

    .page-heading h2 {
        font-size: 22px;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .form-actions .btn {
        width: 100%;
    }
}

@endpush

@section('content')

    <!-- PAGE HEADING -->

    <div class="page-heading">

        <h2>
            + Tambah Aset
        </h2>

        <p>
            Masukkan informasi aset IT yang ingin didaftarkan.
        </p>

    </div>


    <!-- VALIDATION ALERT -->

    @if ($errors->any())

        <div class="alert">

            <strong>
                Data belum dapat disimpan.
            </strong>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- FORM CARD -->

    <div class="form-card">

        <form
            action="{{ route('admin.assets.store') }}"
            method="POST"
        >

            @csrf


            <!-- INFORMASI UTAMA -->

            <div class="form-section">

                <div class="form-section-title">
                    Informasi Utama
                </div>

                <div class="form-grid">

                    <div class="form-group">

                        <label for="asset_code">
                            Kode Aset <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="asset_code"
                            name="asset_code"
                            value="{{ old('asset_code') }}"
                            placeholder="Contoh: AST-001"
                            required
                        >

                        @error('asset_code')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="name">
                            Nama Aset <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Laptop Dell Latitude"
                            required
                        >

                        @error('name')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="asset_type_id">
                            Jenis Aset <span class="required">*</span>
                        </label>

                        <select
                            id="asset_type_id"
                            name="asset_type_id"
                            required
                        >

                            <option value="">
                                -- Pilih Jenis Aset --
                            </option>

                            @foreach ($assetTypes as $type)

                                <option
                                    value="{{ $type->id }}"
                                    {{ old('asset_type_id') == $type->id ? 'selected' : '' }}
                                >
                                    {{ $type->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('asset_type_id')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="brand">
                            Merek
                        </label>

                        <input
                            type="text"
                            id="brand"
                            name="brand"
                            value="{{ old('brand') }}"
                            placeholder="Contoh: Dell"
                        >

                    </div>


                    <div class="form-group">

                        <label for="model">
                            Model
                        </label>

                        <input
                            type="text"
                            id="model"
                            name="model"
                            value="{{ old('model') }}"
                            placeholder="Contoh: Latitude 5420"
                        >

                    </div>


                    <div class="form-group">

                        <label for="serial_number">
                            Serial Number
                        </label>

                        <input
                            type="text"
                            id="serial_number"
                            name="serial_number"
                            value="{{ old('serial_number') }}"
                            placeholder="Masukkan serial number"
                        >

                        @error('serial_number')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- LOKASI -->

            <div class="form-section">

                <div class="form-section-title">
                    Lokasi & Penempatan
                </div>

                <div class="form-grid">

                    <div class="form-group">

                        <label for="office_id">
                            Office <span class="required">*</span>
                        </label>

                        <select
                            id="office_id"
                            name="office_id"
                            required
                        >

                            <option value="">
                                -- Pilih Office --
                            </option>

                            @foreach ($offices as $office)

                                <option
                                    value="{{ $office->id }}"
                                    {{ old('office_id') == $office->id ? 'selected' : '' }}
                                >
                                    {{ $office->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('office_id')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label for="department_id">
                            Department
                        </label>

                        <select
                            id="department_id"
                            name="department_id"
                        >

                            <option value="">
                                -- Pilih Department --
                            </option>

                            @foreach ($departments as $department)

                                <option
                                    value="{{ $department->id }}"
                                    {{ old('department_id') == $department->id ? 'selected' : '' }}
                                >
                                    {{ $department->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('department_id')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- KONDISI -->

            <div class="form-section">

                <div class="form-section-title">
                    Kondisi & Status
                </div>

                <div class="form-grid">

                    <div class="form-group">

                        <label for="condition">
                            Kondisi <span class="required">*</span>
                        </label>

                        <select
                            id="condition"
                            name="condition"
                            required
                        >

                            <option value="">
                                -- Pilih Kondisi --
                            </option>

                            <option
                                value="good"
                                {{ old('condition', 'good') === 'good' ? 'selected' : '' }}
                            >
                                Baik
                            </option>

                            <option
                                value="minor_damage"
                                {{ old('condition') === 'minor_damage' ? 'selected' : '' }}
                            >
                                Rusak Ringan
                            </option>

                            <option
                                value="major_damage"
                                {{ old('condition') === 'major_damage' ? 'selected' : '' }}
                            >
                                Rusak Berat
                            </option>

                            <option
                                value="broken"
                                {{ old('condition') === 'broken' ? 'selected' : '' }}
                            >
                                Rusak
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="status">
                            Status <span class="required">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                        >

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option
                                value="available"
                                {{ old('status', 'available') === 'available' ? 'selected' : '' }}
                            >
                                Tersedia
                            </option>

                            <option
                                value="in_use"
                                {{ old('status') === 'in_use' ? 'selected' : '' }}
                            >
                                Digunakan
                            </option>

                            <option
                                value="maintenance"
                                {{ old('status') === 'maintenance' ? 'selected' : '' }}
                            >
                                Maintenance
                            </option>

                            <option
                                value="damaged"
                                {{ old('status') === 'damaged' ? 'selected' : '' }}
                            >
                                Rusak
                            </option>

                            <option
                                value="retired"
                                {{ old('status') === 'retired' ? 'selected' : '' }}
                            >
                                Tidak Digunakan
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="purchase_price">
                            Harga Pembelian
                        </label>

                        <input
                            type="number"
                            id="purchase_price"
                            name="purchase_price"
                            value="{{ old('purchase_price') }}"
                            min="0"
                            step="0.01"
                            placeholder="Contoh: 12500000"
                        >

                    </div>


                    <div class="form-group">

                        <label for="purchase_date">
                            Tanggal Pembelian
                        </label>

                        <input
                            type="date"
                            id="purchase_date"
                            name="purchase_date"
                            value="{{ old('purchase_date') }}"
                        >

                    </div>


                    <div class="form-group full">

                        <label for="notes">
                            Catatan
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            placeholder="Catatan tambahan mengenai aset..."
                        >{{ old('notes') }}</textarea>

                    </div>

                </div>

            </div>


            <!-- ACTION -->

            <div class="form-actions">

                <a
                    href="{{ route('admin.assets.index') }}"
                    class="btn btn-cancel"
                >
                    ← Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    💾 Simpan Aset
                </button>

            </div>

        </form>

    </div>

@endsection
