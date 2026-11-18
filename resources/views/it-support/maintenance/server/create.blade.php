@extends('layouts.itsupport')

@section('title', 'Input Internet / Server Maintenance')

@section('page-title', 'Input Internet / Server Maintenance')

@section('page-subtitle', 'Catat hasil pekerjaan maintenance jaringan dan server IT Gateway')

@section('content')

<style>
    .server-form-page {
        max-width: 1000px;
        margin: auto;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        color: #7c3aed;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 24px;
        transition: .2s ease;
    }

    .back-button:hover {
        color: #5b21b6;
        transform: translateX(-3px);
    }

    .welcome {
        margin-bottom: 27px;
    }

    .welcome h2 {
        font-size: 23px;
        margin-bottom: 7px;
        color: #172033;
    }

    .welcome p {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    .form-card {
        background: white;
        border-radius: 18px;
        padding: 30px;
        border: 1px solid #eef2f7;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
    }

    .form-section {
        margin-bottom: 28px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section h3 {
        font-size: 17px;
        color: #172033;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eef2f7;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 13px;
        font-weight: bold;
        color: #374151;
    }

    .required {
        color: #dc2626;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        padding: 12px 13px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #1f2937;
        background: white;
        outline: none;
        transition: border .2s ease, box-shadow .2s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, .10);
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
        line-height: 1.6;
    }

    .alert {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 13px 15px;
        border-radius: 10px;
        margin-bottom: 22px;
        font-size: 13px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #eef2f7;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 46px;
        padding: 11px 22px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .btn:active {
        transform: translateY(1px);
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: #475569;
        transform: translateY(-2px);
    }

    .btn-primary {
        background: #7c3aed;
        color: white;
        box-shadow: 0 4px 10px rgba(124, 58, 237, .20);
    }

    .btn-primary:hover {
        background: #6d28d9;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 7px 15px rgba(124, 58, 237, .25);
    }

    @media (max-width: 550px) {
        .form-card {
            padding: 20px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="server-form-page">

    <a
        href="{{ route('it-support.maintenance.server') }}"
        class="back-button"
    >
        ← Kembali ke Internet / Server
    </a>

    <div class="welcome">
        <h2>🌐 Form Maintenance</h2>
        <p>
            Isi data pekerjaan maintenance Internet atau Server
            yang telah dilakukan.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert">
            <strong>
                Terdapat kesalahan pada data yang dimasukkan.
            </strong>

            <ul style="margin: 8px 0 0 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('it-support.maintenance.server.store') }}"
        method="POST"
        class="form-card"
    >
        @csrf

        <div class="form-section">

            <h3>Informasi Maintenance</h3>

            <div class="form-grid">

                <div class="form-group">
                    <label for="office_id">
                        Kantor <span class="required">*</span>
                    </label>

                    <select
                        name="office_id"
                        id="office_id"
                        required
                    >
                        <option value="">-- Pilih Kantor --</option>

                        @foreach ($offices as $office)
                            <option
                                value="{{ $office->id }}"
                                {{ old('office_id') == $office->id ? 'selected' : '' }}
                            >
                                {{ $office->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="maintenance_date">
                        Tanggal Maintenance
                        <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="maintenance_date"
                        id="maintenance_date"
                        value="{{ old('maintenance_date', date('Y-m-d')) }}"
                        required
                    >
                </div>

            </div>
        </div>

        <div class="form-section">

            <h3>Detail Internet / Server</h3>

            <div class="form-grid">

                <div class="form-group">
                    <label for="ip_address">IP Address</label>

                    <input
                        type="text"
                        name="ip_address"
                        id="ip_address"
                        value="{{ old('ip_address') }}"
                        placeholder="Contoh: 192.168.1.1"
                    >
                </div>

                <div class="form-group">
                    <label for="security">Security</label>

                    <input
                        type="text"
                        name="security"
                        id="security"
                        value="{{ old('security') }}"
                        placeholder="Contoh: Firewall aktif"
                    >
                </div>

                <div class="form-group full">
                    <label for="bandwidth">Bandwidth</label>

                    <input
                        type="text"
                        name="bandwidth"
                        id="bandwidth"
                        value="{{ old('bandwidth') }}"
                        placeholder="Contoh: 100 Mbps"
                    >
                </div>

            </div>
        </div>

        <div class="form-section">

            <h3>Hasil Maintenance</h3>

            <div class="form-grid">

                <div class="form-group full">
                    <label for="result">Hasil Maintenance</label>

                    <textarea
                        name="result"
                        id="result"
                        placeholder="Tuliskan hasil maintenance yang dilakukan..."
                    >{{ old('result') }}</textarea>
                </div>

                <div class="form-group full">
                    <label for="remarks">Catatan</label>

                    <textarea
                        name="remarks"
                        id="remarks"
                        placeholder="Tambahkan catatan jika diperlukan..."
                    >{{ old('remarks') }}</textarea>
                </div>

            </div>
        </div>

        <div class="form-actions">

            <a
                href="{{ route('it-support.maintenance.server') }}"
                class="btn btn-cancel"
            >
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                💾 Simpan Laporan
            </button>

        </div>

    </form>

</div>

@endsection
