@extends('layouts.itsupport')

@section('title', 'Detail PC Maintenance')

@section('page-title', 'Detail PC Maintenance')

@section('page-subtitle', 'Informasi pekerjaan maintenance komputer')

@section('content')

<style>
    .back-button {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        color: #7c3aed;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 22px;
        transition: .2s ease;
    }

    .back-button:hover {
        color: #6d28d9;
        transform: translateX(-2px);
    }

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

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 28px;
        margin-bottom: 30px;
        align-items: stretch;
    }

    .section {
        background: white;
        border-radius: 18px;
        padding: 0;
        border: 1px solid #eef2f7;
        box-shadow:
            0 3px 7px rgba(0,0,0,.03),
            0 8px 18px rgba(0,0,0,.05),
            0 16px 35px rgba(0,0,0,.06),
            0 25px 60px rgba(124,58,237,.07);
        margin-bottom: 30px;
        overflow: hidden;
    }

    .section-header {
        padding: 24px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eef2f7;
    }

    .section-header h3 {
        font-size: 19px;
        color: #172033;
    }

    .section-body {
        padding: 28px;
    }

    .asset-name {
        font-size: 22px;
        font-weight: bold;
        color: #172033;
        margin-bottom: 6px;
    }

    .asset-code {
        color: #7c3aed;
        font-size: 13px;
        font-weight: bold;
    }

    .info-list {
        margin-top: 22px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        padding: 13px 0;
        border-bottom: 1px solid #eef2f7;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .label {
        color: #6b7280;
        font-size: 13px;
    }

    .value {
        color: #172033;
        font-size: 13px;
        font-weight: bold;
        text-align: right;
    }

    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .badge-scheduled {
        background: #fef3c7;
        color: #d97706;
    }

    .badge-completed {
        background: #dcfce7;
        color: #16a34a;
    }

    .badge-rescheduled {
        background: #e0f2fe;
        color: #0284c7;
    }

    .remarks {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        padding: 16px;
        border-radius: 11px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.75;
    }

    .record {
        background: #f8fafc;
        border: 1px solid #eef2f7;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .record:hover {
        transform: translateY(-2px);
        box-shadow:
            0 5px 12px rgba(0,0,0,.04),
            0 12px 25px rgba(124,58,237,.07);
    }

    .record:last-child {
        margin-bottom: 0;
    }

    .record-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 18px;
        padding-bottom: 14px;
        border-bottom: 1px solid #e5e7eb;
    }

    .record h4 {
        margin: 0 0 7px;
        font-size: 14px;
        color: #172033;
    }

    .record-date {
        font-size: 12px;
        color: #6b7280;
    }

    .record-label {
        font-size: 12px;
        color: #7c3aed;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .record p {
        margin: 0 0 15px;
        font-size: 13px;
        color: #64748b;
        line-height: 1.7;
    }

    .record p:last-child {
        margin-bottom: 0;
    }

    .empty {
        text-align: center;
        padding: 35px;
        color: #6b7280;
        background: #f9fafb;
        border: 1px dashed #dbe2ea;
        border-radius: 10px;
        font-size: 14px;
    }

    .empty-icon {
        font-size: 30px;
        margin-bottom: 10px;
    }

    .empty h3 {
        margin-bottom: 7px;
        color: #374151;
        font-size: 15px;
    }

    .empty p {
        font-size: 13px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: bold;
        color: #374151;
    }

    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        background: #ffffff;
        color: #172033;
        font-family: Arial, sans-serif;
        font-size: 13px;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
        line-height: 1.6;
    }

    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 3px rgba(124,58,237,.10);
    }

    .btn-submit {
        border: none;
        background: #7c3aed;
        color: white;
        padding: 13px 22px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: .2s ease;
        box-shadow: 0 4px 10px rgba(124,58,237,.20);
    }

    .btn-submit:hover {
        background: #6d28d9;
        transform: translateY(-2px);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    @media (max-width: 1200px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 550px) {
        .section-header {
            padding: 20px;
        }

        .section-body {
            padding: 20px;
        }

        .info-row {
            flex-direction: column;
            gap: 5px;
        }

        .value {
            text-align: left;
        }

        .record {
            padding: 16px;
        }
    }
</style>

<a href="{{ route('it-support.maintenance.pc') }}" class="back-button">
    ← Kembali ke PC Maintenance
</a>

<div class="page-heading">
    <h2>🔧 Detail Maintenance</h2>
    <p>Informasi pekerjaan maintenance yang dikelola oleh IT Support.</p>
</div>

<div class="info-grid">

    {{-- INFORMASI ASET --}}
    <section class="section">
        <div class="section-header">
            <h3>💻 Informasi Aset</h3>
        </div>

        <div class="section-body">
            <div class="asset-name">
                {{ $maintenanceSchedule->asset->name ?? '-' }}
            </div>

            <div class="asset-code">
                {{ $maintenanceSchedule->asset->asset_code ?? '-' }}
            </div>

            <div class="info-list">

                <div class="info-row">
                    <span class="label">Merek</span>
                    <span class="value">
                        {{ $maintenanceSchedule->asset->brand ?? '-' }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="label">Model</span>
                    <span class="value">
                        {{ $maintenanceSchedule->asset->model ?? '-' }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="label">Serial Number</span>
                    <span class="value">
                        {{ $maintenanceSchedule->asset->serial_number ?? '-' }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="label">Kondisi Aset</span>
                    <span class="value">
                        {{ $maintenanceSchedule->asset->condition ?? '-' }}
                    </span>
                </div>

            </div>
        </div>
    </section>

    {{-- INFORMASI JADWAL --}}
    <section class="section">
        <div class="section-header">
            <h3>📅 Informasi Jadwal</h3>
        </div>

        <div class="section-body">

            <div class="info-row">
                <span class="label">Kantor</span>
                <span class="value">
                    {{ $maintenanceSchedule->office->name ?? '-' }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Tanggal Maintenance</span>
                <span class="value">
                    {{ $maintenanceSchedule->scheduled_date?->format('d-m-Y') ?? '-' }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Tanggal Aktual</span>
                <span class="value">
                    {{ $maintenanceSchedule->actual_date?->format('d-m-Y') ?? '-' }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Status</span>
                <span class="value">
                    @if($maintenanceSchedule->status === 'scheduled')
                        <span class="badge badge-scheduled">Terjadwal</span>
                    @elseif($maintenanceSchedule->status === 'completed')
                        <span class="badge badge-completed">Selesai</span>
                    @elseif($maintenanceSchedule->status === 'rescheduled')
                        <span class="badge badge-rescheduled">Dijadwalkan Ulang</span>
                    @elseif($maintenanceSchedule->status === 'cancelled')
                        <span class="badge" style="background:#fee2e2;color:#b91c1c;">
                            Dibatalkan
                        </span>
                    @else
                        <span class="badge">
                            {{ ucfirst(str_replace('_', ' ', $maintenanceSchedule->status)) }}
                        </span>
                    @endif
                </span>
            </div>

            <div class="info-row">
                <span class="label">Dibuat Oleh</span>
                <span class="value">
                    {{ $maintenanceSchedule->scheduledBy->name ?? '-' }}
                </span>
            </div>

        </div>
    </section>

</div>

{{-- CATATAN ADMIN --}}
<section class="section">
    <div class="section-header">
        <h3>📝 Catatan / Instruksi Maintenance</h3>
    </div>

    <div class="section-body">
        <div class="remarks">
            {{ $maintenanceSchedule->remarks ?: 'Tidak ada catatan atau instruksi maintenance.' }}
        </div>
    </div>
</section>

{{-- HASIL MAINTENANCE --}}
<section class="section">
    <div class="section-header">
        <h3>🔧 Hasil Maintenance</h3>
    </div>

    <div class="section-body">

        @if($maintenanceSchedule->records->count() > 0)

            @foreach($maintenanceSchedule->records as $record)
                <div class="record">

                    <div class="record-top">
                        <div>
                            <h4>
                                Dilakukan oleh:
                                {{ $record->performedBy->name ?? '-' }}
                            </h4>

                            <div class="record-date">
                                {{ $record->performed_at?->format('d-m-Y H:i') ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div class="record-label">Analisis</div>
                    <p>{{ $record->analysis ?: '-' }}</p>

                    <div class="record-label">Tindakan</div>
                    <p>{{ $record->action ?: '-' }}</p>

                    <div class="record-label">Hasil</div>
                    <p>{{ $record->result ?: '-' }}</p>

                    <div class="record-label">Kondisi Setelah Maintenance</div>
                    <p>{{ $record->condition_after ?: '-' }}</p>

                    @if($record->remarks)
                        <div class="record-label">Catatan</div>
                        <p>{{ $record->remarks }}</p>
                    @endif

                </div>
            @endforeach

        @else

            <div class="empty">
                <div class="empty-icon">🔧</div>
                <h3>Belum Ada Hasil Maintenance</h3>
                <p>Belum ada hasil maintenance yang dicatat oleh IT Support.</p>
            </div>

        @endif

    </div>
</section>

{{-- FORM HASIL MAINTENANCE --}}
@if(
    $maintenanceSchedule->status === 'scheduled' &&
    $maintenanceSchedule->records->count() === 0
)
    <section class="section">

        <div class="section-header">
            <h3>🛠️ Isi Hasil Maintenance</h3>
        </div>

        <div class="section-body">

            <form
                action="{{ route('it-support.maintenance.pc.record.store', $maintenanceSchedule) }}"
                method="POST"
            >
                @csrf

                @if($errors->any())
                    <div class="remarks" style="margin-bottom: 22px; border-color: #fecaca; background: #fef2f2; color: #b91c1c;">
                        <strong>Periksa kembali data yang diisi:</strong>
                        <ul style="margin: 8px 0 0 18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="analysis">Analisis Masalah</label>
                    <textarea
                        id="analysis"
                        name="analysis"
                        rows="4"
                        required
                        placeholder="Jelaskan kondisi atau masalah yang ditemukan..."
                    >{{ old('analysis') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="action">Tindakan yang Dilakukan</label>
                    <textarea
                        id="action"
                        name="action"
                        rows="4"
                        required
                        placeholder="Jelaskan tindakan maintenance yang dilakukan..."
                    >{{ old('action') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="result">Hasil Maintenance</label>
                    <textarea
                        id="result"
                        name="result"
                        rows="4"
                        required
                        placeholder="Jelaskan hasil setelah maintenance..."
                    >{{ old('result') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="condition_after">Kondisi Setelah Maintenance</label>
                    <select id="condition_after" name="condition_after" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="good" {{ old('condition_after') === 'good' ? 'selected' : '' }}>
                            Baik
                        </option>
                        <option value="minor_damage" {{ old('condition_after') === 'minor_damage' ? 'selected' : '' }}>
                            Kerusakan Ringan
                        </option>
                        <option value="major_damage" {{ old('condition_after') === 'major_damage' ? 'selected' : '' }}>
                            Kerusakan Berat
                        </option>
                        <option value="broken" {{ old('condition_after') === 'broken' ? 'selected' : '' }}>
                            Rusak
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="remarks">Catatan Tambahan</label>
                    <textarea
                        id="remarks"
                        name="remarks"
                        rows="3"
                        placeholder="Catatan tambahan jika diperlukan..."
                    >{{ old('remarks') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">
                    💾 Simpan Hasil Maintenance
                </button>

            </form>

        </div>
    </section>
@endif

@endsection
