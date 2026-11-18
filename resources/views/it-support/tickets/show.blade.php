@extends('layouts.itsupport')

@section('title', 'Detail Tiket IT Support')
@section('page-title', 'Detail Tiket IT Support')
@section('page-subtitle', 'Periksa informasi tiket dan lakukan tindakan penanganan')

@section('content')

<style>
    .ticket-detail-page {
        max-width: 1050px;
        margin: 0 auto;
        padding: 30px 25px 45px;
        color: #1f2937;
    }

    .ticket-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .ticket-topbar h2 {
        font-size: 25px;
        color: #172033;
        letter-spacing: -0.4px;
        margin-bottom: 7px;
    }

    .ticket-topbar p {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        background: #ede9fe;
        color: #7c3aed;
        padding: 11px 17px;
        border-radius: 10px;
        border: 1px solid #ddd6fe;
        font-size: 13px;
        font-weight: bold;
        white-space: nowrap;
        box-shadow: 0 3px 6px rgba(124, 58, 237, 0.08);
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .back-btn:hover {
        background: #ddd6fe;
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(124, 58, 237, 0.13);
    }

    .ticket-card {
        background: #fff;
        padding: 32px;
        border-radius: 20px;
        border: 1px solid #eef2f7;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.05),
                    0 16px 35px rgba(0, 0, 0, 0.06),
                    0 25px 60px rgba(124, 58, 237, 0.08);
        transition: box-shadow .25s ease;
    }

    .ticket-card:hover {
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06),
                    0 22px 45px rgba(0, 0, 0, 0.07),
                    0 32px 70px rgba(124, 58, 237, 0.11);
    }

    .card-title {
        font-size: 20px;
        color: #172033;
        padding-bottom: 18px;
        margin-bottom: 24px;
        border-bottom: 1px solid #eef2f7;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .info-box {
        background: linear-gradient(145deg, #fff, #fafbfc);
        border: 1px solid #edf0f5;
        border-radius: 13px;
        padding: 17px 18px;
        min-height: 84px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .025),
                    0 6px 14px rgba(0, 0, 0, .035);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, .04),
                    0 10px 20px rgba(0, 0, 0, .06);
    }

    .label {
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 7px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .value {
        font-size: 15px;
        font-weight: 600;
        color: #1f2937;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .ticket-number {
        color: #7c3aed;
        font-weight: bold;
    }

    .handling-remote {
        border-color: #ddd6fe;
        background: linear-gradient(145deg, #faf9ff, #f5f3ff);
    }

    .handling-title {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .remote-detail {
        grid-column: 1 / -1;
        background: linear-gradient(145deg, #faf9ff, #f5f3ff);
        border: 1px solid #ddd6fe;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 8px rgba(124, 58, 237, .05);
    }

    .remote-detail-title {
        font-size: 15px;
        font-weight: 700;
        color: #5b21b6;
        margin-bottom: 16px;
    }

    .remote-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
    }

    .remote-item {
        background: #fff;
        border: 1px solid #e9e3ff;
        border-radius: 10px;
        padding: 13px 14px;
    }

    .remote-label {
        font-size: 10px;
        color: #7c3aed;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
        margin-bottom: 6px;
    }

    .remote-value {
        font-size: 14px;
        font-weight: 600;
        color: #1f2937;
        word-break: break-word;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .05);
    }

    .status-open {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-assigned {
        background: #ede9fe;
        color: #7c3aed;
    }

    .status-process {
        background: #fef3c7;
        color: #d97706;
    }

    .status-resolved {
        background: #dcfce7;
        color: #16a34a;
    }

    .status-closed {
        background: #e5e7eb;
        color: #4b5563;
    }

    .priority-low {
        background: #e0f2fe;
        color: #0284c7;
    }

    .priority-medium {
        background: #fef3c7;
        color: #d97706;
    }

    .priority-high {
        background: #fee2e2;
        color: #dc2626;
    }

    .priority-critical {
        background: #fecaca;
        color: #991b1b;
    }

    .ticket-row {
        margin-bottom: 23px;
    }

    .ticket-row:last-child {
        margin-bottom: 0;
    }

    .description {
        background: linear-gradient(145deg, #fafbfc, #f7f8fa);
        padding: 17px 18px;
        border-radius: 12px;
        border: 1px solid #edf0f5;
        line-height: 1.7;
        font-size: 14px;
        color: #374151;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, .025);
    }

    .reopen-box {
        background: linear-gradient(145deg, #fffaf5, #fff7ed);
        border: 1px solid #fed7aa;
        color: #9a3412;
    }

    .image-box {
        background: linear-gradient(145deg, #fafbfc, #f7f8fa);
        padding: 18px;
        border-radius: 13px;
        border: 1px solid #edf0f5;
        text-align: center;
    }

    .image-box img {
        display: block;
        max-width: 550px;
        width: 100%;
        max-height: 500px;
        object-fit: contain;
        margin: 0 auto;
        border-radius: 11px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .06);
    }

    .action-area {
        margin-top: 30px;
        padding-top: 26px;
        border-top: 1px solid #eef2f7;
    }

    .action-title {
        font-size: 17px;
        color: #172033;
        margin-bottom: 16px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        margin-top: 10px;
        margin-right: 8px;
        padding: 11px 19px;
        background: #7c3aed;
        color: #fff;
        text-decoration: none;
        border-radius: 10px;
        font-weight: bold;
        font-size: 13px;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(124, 58, 237, .20),
                    0 10px 20px rgba(124, 58, 237, .11);
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .action-btn:hover {
        background: #6d28d9;
        transform: translateY(-2px);
        box-shadow: 0 7px 13px rgba(124, 58, 237, .26),
                    0 14px 25px rgba(124, 58, 237, .15);
    }

    .action-btn:active {
        transform: translateY(0);
    }

    .resolve-form {
        margin-top: 15px;
        background: linear-gradient(145deg, #fbfaff, #f8f7ff);
        border: 1px solid #e9e3ff;
        border-radius: 15px;
        padding: 22px;
        box-shadow: 0 5px 14px rgba(124, 58, 237, .05);
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
    }

    .form-help {
        display: block;
        margin-top: 7px;
        color: #6b7280;
        font-size: 12px;
        line-height: 1.5;
    }

    .resolve-form textarea {
        width: 100%;
        min-height: 130px;
        padding: 13px 14px;
        border: 1px solid #d9dce3;
        border-radius: 10px;
        background: #fff;
        color: #1f2937;
        font-family: Arial, sans-serif;
        font-size: 13px;
        line-height: 1.6;
        resize: vertical;
        outline: none;
        transition: border .2s ease, box-shadow .2s ease;
    }

    .resolve-form textarea:focus {
        border-color: #a78bfa;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, .10);
    }

    .file-input {
        width: 100%;
        padding: 12px;
        background: #fff;
        border: 1px dashed #c4b5fd;
        border-radius: 10px;
        font-size: 13px;
        color: #4b5563;
        cursor: pointer;
    }

    .error-box {
        background: linear-gradient(145deg, #fff5f5, #fee2e2);
        color: #991b1b;
        padding: 14px 16px;
        border-radius: 11px;
        margin-bottom: 18px;
        border: 1px solid #fecaca;
    }

    .error-box ul {
        margin: 0;
        padding-left: 20px;
    }

    .error-box li {
        font-size: 13px;
        margin-bottom: 4px;
    }

    .ticket-bottom-back {
        margin-top: 28px;
    }

    @media (max-width: 800px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .remote-grid {
            grid-template-columns: 1fr;
        }

        .ticket-card {
            padding: 25px;
        }
    }

    @media (max-width: 700px) {
        .ticket-detail-page {
            padding: 22px 18px 35px;
        }

        .ticket-topbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .ticket-topbar h2 {
            font-size: 22px;
        }

        .back-btn {
            width: 100%;
        }

        .ticket-card {
            padding: 20px;
            border-radius: 16px;
        }
    }

    @media (max-width: 480px) {
        .action-btn {
            width: 100%;
            margin-right: 0;
        }

        .resolve-form {
            padding: 17px;
        }
    }
</style>

<main class="ticket-detail-page">

    <div class="ticket-topbar">
        <div>
            <h2>🎫 Detail Tiket</h2>
            <p>Periksa informasi tiket dan lakukan tindakan penanganan.</p>
        </div>

        <a href="{{ route('it-support.tickets') }}" class="back-btn">
            ← Daftar Tiket
        </a>
    </div>

    <div class="ticket-card">

        <div class="card-title">
            Informasi Tiket
        </div>

        <div class="info-grid">

            {{-- NOMOR TIKET --}}
            <div class="info-box">
                <div class="label">Nomor Tiket</div>
                <div class="value ticket-number">
                    {{ $ticket->ticket_number }}
                </div>
            </div>

            {{-- PELAPOR --}}
            <div class="info-box">
                <div class="label">Pelapor</div>
                <div class="value">
                    {{ $ticket->user->name ?? '-' }}
                </div>
            </div>

            {{-- MASALAH --}}
            <div class="info-box">
                <div class="label">Masalah</div>
                <div class="value">
                    {{ $ticket->subject }}
                </div>
            </div>

            {{-- KATEGORI --}}
            <div class="info-box">
                <div class="label">Kategori</div>
                <div class="value">
                    {{ $ticket->category->name ?? '-' }}
                </div>
            </div>

            {{-- KOMPUTER --}}
            <div class="info-box">
                <div class="label">Komputer</div>
                <div class="value">
                    @if ($ticket->asset)
                        {{ $ticket->asset->asset_code }}
                        <br>
                        <span style="font-size: 13px; color: #6b7280; font-weight: normal;">
                            {{ $ticket->asset->name }}
                        </span>
                    @else
                        <span style="color: #9ca3af; font-weight: normal;">
                            Tidak ada komputer yang dipilih
                        </span>
                    @endif
                </div>
            </div>

            {{-- CABANG --}}
            <div class="info-box">
                <div class="label">Cabang</div>
                <div class="value">
                    {{ $ticket->office->name ?? '-' }}
                </div>
            </div>

            {{-- DEPARTEMEN --}}
            <div class="info-box">
                <div class="label">Departemen</div>
                <div class="value">
                    {{ $ticket->department->name ?? '-' }}
                </div>
            </div>

            {{-- METODE PENANGANAN --}}
            @if ($ticket->handling_method)
                <div class="info-box {{ $ticket->handling_method === 'remote' ? 'handling-remote' : '' }}">
                    <div class="label handling-title">
                        @if ($ticket->handling_method === 'remote')
                            🌐
                        @else
                            🧑‍💻
                        @endif
                        Metode Penanganan
                    </div>

                    <div class="value">
                        @if ($ticket->handling_method === 'remote')
                            Remote
                        @elseif ($ticket->handling_method === 'in_person')
                            Tatap Muka
                        @else
                            -
                        @endif
                    </div>
                </div>
            @endif

            {{-- PRIORITAS --}}
            <div class="info-box">
                <div class="label">Prioritas</div>

                <div class="value">
                    @php
                        $isPendingPriority =
                            $ticket->status === 'open'
                            && $ticket->assigned_to === null
                            && $ticket->priority === null;

                        $isOwnedTicket =
                            in_array($ticket->status, ['assigned', 'in_progress'])
                            && (int) $ticket->assigned_to === (int) auth()->id();
                    @endphp

                    @if ($isPendingPriority || $isOwnedTicket)
                        <form
                            action="{{ route('it-support.tickets.priority', $ticket) }}"
                            method="POST"
                        >
                            @csrf

                            <select
                                name="priority"
                                required
                                style="width: 100%; padding: 10px 12px; border: 1px solid #ddd6fe; border-radius: 9px; background: #faf9ff; color: #374151; font-size: 13px; font-weight: 600; outline: none; cursor: pointer;"
                            >
                                <option value="" disabled {{ $ticket->priority === null ? 'selected' : '' }}>
                                    Pilih Prioritas
                                </option>

                                <option value="low" {{ $ticket->priority === 'low' ? 'selected' : '' }}>
                                    Low - Tidak mendesak
                                </option>

                                <option value="medium" {{ $ticket->priority === 'medium' ? 'selected' : '' }}>
                                    Medium - Normal
                                </option>

                                <option value="high" {{ $ticket->priority === 'high' ? 'selected' : '' }}>
                                    High - Mengganggu pekerjaan
                                </option>

                                <option value="critical" {{ $ticket->priority === 'critical' ? 'selected' : '' }}>
                                    Critical - Pekerjaan terhenti
                                </option>
                            </select>

                            <button type="submit" class="action-btn">
                                Simpan Penilaian Prioritas
                            </button>
                        </form>

                    @elseif ($ticket->priority)
                        <span class="badge priority-{{ $ticket->priority }}">
                            {{ ucfirst($ticket->priority) }}
                        </span>

                    @else
                        <span class="badge" style="background: #f3f4f6; color: #6b7280;">
                            Belum Ditentukan
                        </span>
                    @endif
                </div>
            </div>

            {{-- STATUS --}}
            <div class="info-box">
                <div class="label">Status</div>

                <div class="value">
                    @if ($ticket->status === 'open')
                        <span class="badge status-open">Baru</span>

                    @elseif ($ticket->status === 'assigned')
                        <span class="badge status-assigned">Diambil</span>

                    @elseif ($ticket->status === 'in_progress' && $ticket->reopen_reason)
                        <span class="badge status-process">Perbaikan Ulang</span>

                    @elseif ($ticket->status === 'in_progress')
                        <span class="badge status-process">Sedang Diproses</span>

                    @elseif ($ticket->status === 'resolved')
                        <span class="badge status-resolved">Selesai</span>

                    @elseif ($ticket->status === 'closed')
                        <span class="badge status-closed">Ditutup</span>

                    @else
                        <span class="badge status-closed">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- DETAIL REMOTE --}}
            @if (
                $ticket->handling_method === 'remote' &&
                (
                    $ticket->remote_application ||
                    $ticket->remote_address ||
                    $ticket->remote_password
                )
            )
                <div class="remote-detail">
                    <div class="remote-detail-title">
                        🌐 Informasi Remote
                    </div>

                    <div class="remote-grid">
                        <div class="remote-item">
                            <div class="remote-label">Aplikasi</div>
                            <div class="remote-value">
                                @if ($ticket->remote_application === 'anydesk')
                                    AnyDesk
                                @elseif ($ticket->remote_application === 'teamviewer')
                                    TeamViewer
                                @elseif ($ticket->remote_application === 'ultraviewer')
                                    UltraViewer
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="remote-item">
                            <div class="remote-label">Remote Address</div>
                            <div class="remote-value">
                                {{ $ticket->remote_address ?? '-' }}
                            </div>
                        </div>

                        <div class="remote-item">
                            <div class="remote-label">Remote Password</div>
                            <div class="remote-value">
                                {{ $ticket->remote_password ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- ALASAN REOPEN --}}
        @if ($ticket->reopen_reason)
            <div class="ticket-row">
                <div class="label">Alasan Perbaikan Ulang</div>
                <div class="description reopen-box">
                    {{ $ticket->reopen_reason }}
                </div>
            </div>
        @endif

        {{-- DESKRIPSI --}}
        <div class="ticket-row">
            <div class="label">Deskripsi Masalah</div>
            <div class="description">
                {{ $ticket->description }}
            </div>
        </div>

        {{-- FOTO MASALAH --}}
        @if ($ticket->problem_image)
            <div class="ticket-row">
                <div class="label">Foto / Bukti Masalah</div>

                <div class="image-box">
                    <img
                        src="{{ asset('storage/' . $ticket->problem_image) }}"
                        alt="Foto masalah"
                    >
                </div>
            </div>
        @endif

        {{-- TANGGAL LAPORAN --}}
        <div class="ticket-row">
            <div class="label">Tanggal Laporan</div>
            <div class="value">
                {{ $ticket->created_at->format('d/m/Y H:i') }}
            </div>
        </div>

        {{-- TINDAKAN TIKET --}}
        <div class="action-area">
            <div class="action-title">
                ⚙️ Tindakan Tiket
            </div>

            {{-- MULAI MENANGANI --}}
            @if (in_array($ticket->status, ['open', 'assigned']) && $ticket->priority !== null)
                <form
                    action="{{ route('it-support.tickets.start', $ticket) }}"
                    method="POST"
                    style="display: inline;"
                >
                    @csrf

                    <button type="submit" class="action-btn">
                        🔧 Mulai Menangani
                    </button>
                </form>
            @endif

            {{-- SELESAIKAN TIKET --}}
            @if ($ticket->status === 'in_progress')

                @if ($errors->any())
                    <div class="error-box">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="resolve-form">
                    <form
                        action="{{ route('it-support.tickets.resolve', $ticket) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <div class="form-group">
                            <label for="resolution_notes" class="form-label">
                                📝 Hasil Pekerjaan / Perbaikan
                            </label>

                            <textarea
                                name="resolution_notes"
                                id="resolution_notes"
                                placeholder="Jelaskan tindakan atau perbaikan yang dilakukan..."
                                required
                            >{{ old('resolution_notes') }}</textarea>

                            <small class="form-help">
                                Jelaskan secara singkat tindakan yang dilakukan
                                dan hasil dari perbaikan.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="evidence" class="form-label">
                                📎 Bukti Perbaikan
                            </label>

                            <input
                                type="file"
                                name="evidence"
                                id="evidence"
                                class="file-input"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                            >

                            <small class="form-help">
                                Upload bukti bahwa perbaikan telah dilakukan.
                                Format: JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                            </small>
                        </div>

                        <button type="submit" class="action-btn">
                            ✅ Selesaikan Tiket
                        </button>
                    </form>
                </div>
            @endif
        </div>

        {{-- KEMBALI --}}
        <div class="ticket-bottom-back">
            <a href="{{ route('it-support.tickets') }}" class="back-btn">
                ← Kembali ke Daftar Tiket
            </a>
        </div>

    </div>
</main>

@endsection
