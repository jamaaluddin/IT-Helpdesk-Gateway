@extends('layouts.itsupport')

@section('title', 'Buat Jadwal Maintenance')

@section('page-title', 'Buat Jadwal Maintenance')

@section('page-subtitle', 'Tentukan aset dan tanggal untuk maintenance komputer')

@section('content')

<style>
    .page-heading {
        margin-bottom: 27px;
    }

    .page-heading h2 {
        font-size: 23px;
        margin-bottom: 7px;
        color: #172033;
    }

    .page-heading p {
        color: #6b7280;
        font-size: 14px;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 15px;
        background: #ede9fe;
        color: #7c3aed;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: bold;
        transition: background .2s ease, transform .2s ease;
    }

    .back-button:hover {
        background: #ddd6fe;
        transform: translateY(-2px);
    }

    .section {
        background: white;
        border-radius: 18px;
        padding: 28px;
        border: 1px solid #eef2f7;
        box-shadow:
            0 3px 7px rgba(0,0,0,.03),
            0 8px 18px rgba(0,0,0,.05),
            0 16px 35px rgba(0,0,0,.06),
            0 25px 60px rgba(124,58,237,.07);
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-header h3 {
        font-size: 19px;
        color: #172033;
    }

    .error-box {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        padding: 14px 16px;
        border-radius: 10px;
        margin-bottom: 22px;
        font-size: 14px;
    }

    .error-box ul {
        margin: 8px 0 0 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-group select,
    .form-group input,
    .form-group textarea {
        width: 100%;
        border: 1px solid #dbe2ea;
        border-radius: 9px;
        padding: 12px 13px;
        font-size: 14px;
        color: #1f2937;
        background: white;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-group select:focus,
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124,58,237,.1);
    }

    .form-group textarea {
        min-height: 110px;
        resize: vertical;
    }

    .asset-info {
        margin-top: 8px;
        padding: 10px 12px;
        background: #f5f3ff;
        border-left: 4px solid #7c3aed;
        border-radius: 7px;
        font-size: 12px;
        color: #5b21b6;
    }

    .actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #eef2f7;
    }

    .btn-submit,
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 8px 15px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: bold;
        text-decoration: none;
        transition:
            background .2s ease,
            transform .2s ease,
            box-shadow .2s ease;
    }

    .btn-submit {
        border: none;
        background: #7c3aed;
        color: white;
        cursor: pointer;
        box-shadow: 0 4px 9px rgba(124,58,237,.18);
    }

    .btn-submit:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 7px 15px rgba(124,58,237,.25);
    }

    .btn-submit:active,
    .btn-cancel:active {
        transform: translateY(0);
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
        transform: translateY(-2px);
    }

    @media (max-width: 550px) {
        .section {
            padding: 20px;
        }
    }
</style>

{{-- PAGE TITLE --}}
<div class="page-heading">
    <h2>🔧 Buat Jadwal Maintenance</h2>

    <p>
        Tentukan aset dan tanggal untuk maintenance.
    </p>

    <a
        href="{{ route('it-support.maintenance.pc') }}"
        class="back-button"
    >
        ← Kembali ke PC Maintenance
    </a>
</div>

<section class="section">

    <div class="section-header">
        <h3>Informasi Jadwal Maintenance</h3>
    </div>

    <div class="section-body">

        @if($errors->any())
            <div class="error-box">
                <strong>Periksa kembali data yang diisi:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('it-support.maintenance.schedules.store') }}"
            method="POST"
        >
            @csrf

            {{-- ASSET --}}
            <div class="form-group">
                <label for="asset_id">
                    Aset yang Akan Di-maintenance
                </label>

                <select
                    id="asset_id"
                    name="asset_id"
                    required
                >
                    <option value="">
                        -- Pilih Aset --
                    </option>

                    @foreach($assets as $asset)
                        <option
                            value="{{ $asset->id }}"
                            {{ old('asset_id') == $asset->id ? 'selected' : '' }}
                        >
                            {{ $asset->name }} - {{ $asset->asset_code }}
                        </option>
                    @endforeach
                </select>

                <div class="asset-info">
                    Pilih perangkat yang akan dilakukan maintenance.
                </div>
            </div>

            {{-- OFFICE --}}
            <div class="form-group">
                <label for="office_id">
                    Kantor / Lokasi
                </label>

                <select
                    id="office_id"
                    name="office_id"
                    required
                >
                    <option value="">
                        -- Pilih Kantor --
                    </option>

                    @foreach($offices as $office)
                        <option
                            value="{{ $office->id }}"
                            {{ old('office_id') == $office->id ? 'selected' : '' }}
                        >
                            {{ $office->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- DATE --}}
            <div class="form-group">
                <label for="scheduled_date">
                    Tanggal Maintenance
                </label>

                <input
                    type="date"
                    id="scheduled_date"
                    name="scheduled_date"
                    value="{{ old('scheduled_date') }}"
                    required
                >
            </div>

            {{-- REMARKS --}}
            <div class="form-group">
                <label for="remarks">
                    Catatan / Keterangan
                </label>

                <textarea
                    id="remarks"
                    name="remarks"
                    placeholder="Contoh: Maintenance rutin komputer user, pengecekan hardware, dan pembersihan perangkat..."
                >{{ old('remarks') }}</textarea>
            </div>

            {{-- ACTIONS --}}
            <div class="actions">
                <button
                    type="submit"
                    class="btn-submit"
                >
                    💾 Simpan Jadwal
                </button>

                <a
                    href="{{ route('it-support.maintenance.schedules.index') }}"
                    class="btn-cancel"
                >
                    Batal
                </a>
            </div>

        </form>

    </div>
</section>

@endsection
