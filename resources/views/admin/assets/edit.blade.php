
@extends('layouts.admin')

@section('title', 'Edit Aset - Gateway Admin')
@section('page-title', 'Asset Management')
@section('page-subtitle', 'Perbarui informasi aset IT Gateway')

@push('styles')

/* =========================
   PAGE HEADING
========================= */

.page-heading {
    margin-bottom: 25px;
}

.page-heading h1 {
    margin: 0;
    font-size: 28px;
    color: #064e3b;
}

.page-heading p {
    margin: 7px 0 0;
    color: #6b7280;
    font-size: 14px;
}

/* =========================
   FORM CARD
========================= */

.form-card {
    background: white;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    padding: 28px;
    max-width: 1000px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.form-group.full {
    grid-column: 1 / -1;
}

.form-card label {
    font-size: 13px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 7px;
}

.form-card input,
.form-card select,
.form-card textarea {
    width: 100%;
    padding: 11px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 13px;
    font-family: Arial, sans-serif;
    background: white;
    color: #1f2937;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-card input:focus,
.form-card select:focus,
.form-card textarea:focus {
    outline: none;
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5,150,105,0.10);
}

.form-card textarea {
    min-height: 110px;
    resize: vertical;
}

.error {
    margin-top: 6px;
    color: #dc2626;
    font-size: 12px;
}

/* =========================
   FORM ACTIONS
========================= */

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    padding: 11px 20px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}

/* Efek tombol terangkat */

.btn:hover {
    transform: translateY(-3px);
}

.btn:active {
    transform: translateY(-1px);
    box-shadow: none;
}

.btn:focus-visible {
    outline: 3px solid rgba(5,150,105,0.25);
    outline-offset: 3px;
}

.btn-cancel {
    background: #f3f4f6;
    color: #374151;
    border: 1px solid #d1d5db;
}

.btn-cancel:hover {
    background: #e5e7eb;
    box-shadow: 0 6px 14px rgba(0,0,0,0.10);
}

.btn-save {
    background: #059669;
    color: white;
    box-shadow: 0 3px 8px rgba(5,150,105,0.15);
}

.btn-save:hover {
    background: #047857;
    box-shadow: 0 7px 16px rgba(5,150,105,0.25);
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 900px) {

    .content {
        padding: 22px;
    }

    .page-heading h1 {
        font-size: 25px;
    }

    .form-card {
        padding: 24px;
    }

}

@media (max-width: 700px) {

    .content {
        padding: 18px;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-group.full {
        grid-column: auto;
    }

}

@media (max-width: 480px) {

    .page-heading h1 {
        font-size: 23px;
    }

    .form-card {
        padding: 18px;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .btn {
        width: 100%;
    }

}

@endpush

@section('content')

<div class="page-heading">

    <h1>Edit Aset</h1>

    <p>
        Ubah informasi aset: {{ $asset->name }}
    </p>

</div>

<div class="form-card">

    <form
        action="{{ route('admin.assets.update', $asset) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- KODE ASET --}}

            <div class="form-group">

                <label for="asset_code">
                    Kode Aset
                </label>

                <input
                    type="text"
                    id="asset_code"
                    name="asset_code"
                    value="{{ old('asset_code', $asset->asset_code) }}"
                    required
                >

                @error('asset_code')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- NAMA ASET --}}

            <div class="form-group">

                <label for="name">
                    Nama Aset
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $asset->name) }}"
                    required
                >

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- JENIS ASET --}}

            <div class="form-group">

                <label for="asset_type_id">
                    Jenis Aset
                </label>

                <select
                    id="asset_type_id"
                    name="asset_type_id"
                    required
                >

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
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- MEREK --}}

            <div class="form-group">

                <label for="brand">
                    Merek
                </label>

                <input
                    type="text"
                    id="brand"
                    name="brand"
                    value="{{ old('brand', $asset->brand) }}"
                >

                @error('brand')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- MODEL --}}

            <div class="form-group">

                <label for="model">
                    Model
                </label>

                <input
                    type="text"
                    id="model"
                    name="model"
                    value="{{ old('model', $asset->model) }}"
                >

                @error('model')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- SERIAL NUMBER --}}

            <div class="form-group">

                <label for="serial_number">
                    Serial Number
                </label>

                <input
                    type="text"
                    id="serial_number"
                    name="serial_number"
                    value="{{ old('serial_number', $asset->serial_number) }}"
                >

                @error('serial_number')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- OFFICE --}}

            <div class="form-group">

                <label for="office_id">
                    Lokasi / Office
                </label>

                <select
                    id="office_id"
                    name="office_id"
                    required
                >

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
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- DEPARTMENT --}}

            <div class="form-group">

                <label for="department_id">
                    Departemen
                </label>

                <select
                    id="department_id"
                    name="department_id"
                >

                    <option value="">
                        -- Tidak ada departemen --
                    </option>

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
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- HARGA PEMBELIAN --}}

            <div class="form-group">

                <label for="purchase_price">
                    Harga Pembelian
                </label>

                <input
                    type="number"
                    id="purchase_price"
                    name="purchase_price"
                    value="{{ old('purchase_price', $asset->purchase_price) }}"
                    min="0"
                >

                @error('purchase_price')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- TANGGAL PEMBELIAN --}}

            <div class="form-group">

                <label for="purchase_date">
                    Tanggal Pembelian
                </label>

                <input
                    type="date"
                    id="purchase_date"
                    name="purchase_date"
                    value="{{ old('purchase_date', $asset->purchase_date ? $asset->purchase_date->format('Y-m-d') : '') }}"
                >

                @error('purchase_date')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- KONDISI --}}

            <div class="form-group">

                <label for="condition">
                    Kondisi
                </label>

                <select
                    id="condition"
                    name="condition"
                    required
                >

                    <option
                        value="good"
                        {{ old('condition', $asset->condition) === 'good' ? 'selected' : '' }}
                    >
                        Baik
                    </option>

                    <option
                        value="minor_damage"
                        {{ old('condition', $asset->condition) === 'minor_damage' ? 'selected' : '' }}
                    >
                        Rusak Ringan
                    </option>

                    <option
                        value="major_damage"
                        {{ old('condition', $asset->condition) === 'major_damage' ? 'selected' : '' }}
                    >
                        Rusak Berat
                    </option>

                    <option
                        value="broken"
                        {{ old('condition', $asset->condition) === 'broken' ? 'selected' : '' }}
                    >
                        Rusak
                    </option>

                </select>

                @error('condition')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- STATUS --}}

            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    required
                >

                    <option
                        value="available"
                        {{ old('status', $asset->status) === 'available' ? 'selected' : '' }}
                    >
                        Tersedia
                    </option>

                    <option
                        value="in_use"
                        {{ old('status', $asset->status) === 'in_use' ? 'selected' : '' }}
                    >
                        Digunakan
                    </option>

                    <option
                        value="maintenance"
                        {{ old('status', $asset->status) === 'maintenance' ? 'selected' : '' }}
                    >
                        Maintenance
                    </option>

                    <option
                        value="damaged"
                        {{ old('status', $asset->status) === 'damaged' ? 'selected' : '' }}
                    >
                        Rusak
                    </option>

                    <option
                        value="retired"
                        {{ old('status', $asset->status) === 'retired' ? 'selected' : '' }}
                    >
                        Tidak Digunakan
                    </option>

                </select>

                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

            {{-- CATATAN --}}

            <div class="form-group full">

                <label for="notes">
                    Catatan
                </label>

                <textarea
                    id="notes"
                    name="notes"
                >{{ old('notes', $asset->notes) }}</textarea>

                @error('notes')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>

        </div>

        {{-- TOMBOL AKSI --}}

        <div class="form-actions">

            <a
                href="{{ route('admin.assets.show', $asset) }}"
                class="btn btn-cancel"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-save"
            >
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection
