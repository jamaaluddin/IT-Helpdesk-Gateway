@extends('layouts.admin')

@section('title', 'Asset Management - Gateway Admin')
@section('page-title', 'Asset Management')
@section('page-subtitle', 'Kelola dan pantau aset IT Gateway')

@push('styles')

    /* =========================
       PAGE HEADING
    ========================== */

    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .page-heading h2 {
        font-size: 26px;
        line-height: 1.3;
        color: #064e3b;
    }

    .page-heading p {
        margin-top: 6px;
        color: #6b7280;
        font-size: 13px;
    }

    .page-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 10px 16px;
        border: 1px solid transparent;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        cursor: pointer;
        transition: .2s ease;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(0,0,0,.15);
    }

    .btn:active {
        transform: translateY(-1px);
        box-shadow: none;
    }

    .btn-primary {
        background: #059669;
        color: white;
    }

    .btn-primary:hover {
        background: #047857;
    }

    .btn-secondary {
        background: white;
        color: #047857;
        border-color: #a7f3d0;
    }

    .btn-secondary:hover {
        background: #ecfdf5;
    }

    /* =========================
       SUMMARY
    ========================== */

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 25px;
    }

    .summary-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 19px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 13px;
        box-shadow: 0 3px 12px rgba(0,0,0,.04);
    }

    .summary-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 12px;
        font-size: 23px;
    }

    .summary-icon.total {
        background: #d1fae5;
    }

    .summary-icon.active {
        background: #dbeafe;
    }

    .summary-icon.retired {
        background: #f3f4f6;
    }

    .summary-info p {
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .summary-info h3 {
        color: #111827;
        font-size: 23px;
        line-height: 1.2;
    }

    /* =========================
       GENERAL CARD
    ========================== */

    .card {
        width: 100%;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,.04);
        overflow: hidden;
    }

    .card-header {
        padding: 17px 19px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .card-header h3 {
        color: #111827;
        font-size: 16px;
    }

    .card-header p {
        margin-top: 5px;
        color: #6b7280;
        font-size: 12px;
    }

    .card-count {
        color: #047857;
        background: #ecfdf5;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================
       CATEGORY CARDS
    ========================== */

    .category-section {
        margin-bottom: 25px;
    }

    .category-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 13px;
        flex-wrap: wrap;
    }

    .category-heading h3 {
        font-size: 17px;
        color: #111827;
    }

    .category-heading p {
        margin-top: 4px;
        font-size: 12px;
        color: #6b7280;
    }

    .category-scroll {
        display: flex;
        gap: 14px;
        overflow-x: auto;
        padding: 3px 3px 13px;
        scroll-behavior: smooth;
        scrollbar-width: thin;
        scrollbar-color: #a7f3d0 #f3f4f6;
    }

    .category-card {
        flex: 0 0 190px;
        min-height: 145px;
        padding: 17px;
        text-align: left;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 13px;
        cursor: pointer;
        transition: .2s ease;
    }

    .category-card:hover {
        border-color: #6ee7b7;
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,.08);
    }

    .category-card.active {
        background: #ecfdf5;
        border: 2px solid #059669;
        padding: 16px;
    }

    .category-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        margin-bottom: 12px;
        background: #d1fae5;
        border-radius: 10px;
        font-size: 21px;
    }

    .category-name {
        display: block;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.4;
        min-height: 35px;
    }

    .category-total {
        display: block;
        margin-top: 7px;
        color: #047857;
        font-size: 20px;
        font-weight: 800;
    }

    .category-total small {
        font-size: 11px;
        color: #6b7280;
        font-weight: 500;
    }

    /* =========================
       ASSET LIST
    ========================== */

    .asset-list-card {
        margin-bottom: 20px;
    }

    .asset-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        flex-wrap: wrap;
        border-bottom: 1px solid #e5e7eb;
    }

    .category-tabs {
        display: flex;
        gap: 7px;
        overflow-x: auto;
        max-width: 100%;
        padding-bottom: 5px;
        scrollbar-width: thin;
    }

    .category-tab {
        flex-shrink: 0;
        padding: 9px 14px;
        background: #f9fafb;
        color: #4b5563;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .category-tab:hover {
        background: #ecfdf5;
        color: #047857;
        border-color: #a7f3d0;
    }

    .category-tab.active {
        background: #059669;
        color: white;
        border-color: #059669;
    }

    .filter-area {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 230px;
        min-height: 38px;
        padding: 9px 12px 9px 35px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        outline: none;
        font-size: 12px;
    }

    .search-box input:focus,
    .filter-select:focus {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5,150,105,.10);
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 13px;
        color: #9ca3af;
        pointer-events: none;
    }

    .filter-select {
        min-height: 38px;
        padding: 8px 11px;
        background: white;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        color: #374151;
        font-size: 12px;
        outline: none;
    }

    /* =========================
       TABLE
    ========================== */

    .table-wrapper {
        width: 100%;
        max-height: 500px;
        overflow: auto;
    }

    .table-wrapper table {
        width: 100%;
        min-width: 1100px;
        border-collapse: collapse;
    }

    .table-wrapper thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        padding: 13px 12px;
        background: #ecfdf5;
        color: #065f46;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .table-wrapper tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
        color: #374151;
        vertical-align: middle;
    }

    .table-wrapper tbody tr:hover {
        background: #f9fafb;
    }

    .asset-code {
        color: #047857;
        font-weight: 700;
        white-space: nowrap;
    }

    .asset-name {
        display: inline-block;
        color: #111827;
        font-weight: 600;
        min-width: 130px;
    }

    .price {
        font-weight: 600;
        white-space: nowrap;
    }

    .action-cell {
        white-space: nowrap;
    }

    .detail-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 9px 15px;
        background: #059669;
        color: white;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        transition: .2s ease;
    }

    .detail-btn:hover {
        background: #047857;
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(0,0,0,.15);
    }

    .detail-btn:active {
        transform: translateY(-1px);
        box-shadow: none;
    }

    /* =========================
       BADGES
    ========================== */

    .badge {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .condition-good {
        background: #dcfce7;
        color: #166534;
    }

    .condition-minor {
        background: #fef3c7;
        color: #92400e;
    }

    .condition-major {
        background: #ffedd5;
        color: #9a3412;
    }

    .condition-broken {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-available {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-in-use {
        background: #dcfce7;
        color: #166534;
    }

    .status-maintenance {
        background: #fef3c7;
        color: #92400e;
    }

    .status-damaged {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-retired {
        background: #e5e7eb;
        color: #374151;
    }

    /* =========================
       EMPTY STATE
    ========================== */

    .empty {
        text-align: center;
        padding: 45px 20px !important;
        color: #6b7280;
    }

    .empty-icon {
        margin-bottom: 10px;
        font-size: 36px;
    }

    .empty-title {
        font-size: 15px;
        font-weight: 700;
        color: #374151;
    }

    .empty-text {
        margin-top: 5px;
        font-size: 12px;
        line-height: 1.6;
    }

    .no-result-row {
        display: none;
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 1000px) {
        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .asset-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .filter-area {
            width: 100%;
        }

        .search-box {
            flex: 1;
        }

        .search-box input {
            width: 100%;
        }
    }

    @media (max-width: 700px) {
        .page-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-actions {
            width: 100%;
        }

        .page-actions .btn {
            flex: 1;
        }

        .category-card {
            flex-basis: 165px;
        }

        .card-header {
            padding: 14px;
        }
    }

    @media (max-width: 480px) {
        .page-heading h2 {
            font-size: 23px;
        }

        .page-actions {
            flex-direction: column;
        }

        .page-actions .btn {
            width: 100%;
        }

        .summary-grid {
            gap: 10px;
        }

        .summary-card {
            padding: 13px;
            gap: 9px;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            font-size: 18px;
        }

        .summary-info h3 {
            font-size: 19px;
        }

        .filter-area {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box input,
        .filter-select {
            width: 100%;
        }
    }

@endpush

@section('content')

    <!-- PAGE HEADING -->
    <div class="page-heading">
        <div>
            <h2>💻 Asset Management</h2>
            <p>Kelola dan pantau seluruh inventaris aset IT Gateway.</p>
        </div>

        <div class="page-actions">
            <a href="{{ route('admin.asset-types.index') }}"
               class="btn btn-secondary">
                Kelola Jenis Aset
            </a>

            <a href="{{ route('admin.assets.create') }}"
               class="btn btn-primary">
                + Tambah Aset
            </a>
        </div>
    </div>

    <!-- SUMMARY -->
    <div class="summary-grid">

        <div class="summary-card">
            <div class="summary-icon total">📦</div>
            <div class="summary-info">
                <p>Total Aset</p>
                <h3>{{ number_format($totalAssets, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon active">🟢</div>
            <div class="summary-info">
                <p>Aset Aktif</p>
                <h3>{{ number_format($activeAssets, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon retired">📁</div>
            <div class="summary-info">
                <p>Tidak Digunakan</p>
                <h3>{{ number_format($retiredAssets, 0, ',', '.') }}</h3>
            </div>
        </div>

    </div>

    <!-- CATEGORY CARDS -->
    <section class="category-section">

        <div class="category-heading">
            <div>
                <h3>Kategori Aset</h3>
                <p>Pilih kategori untuk melihat aset berdasarkan jenisnya.</p>
            </div>

            <span class="card-count">
                {{ $assetTypes->count() }} Kategori
            </span>
        </div>

        <div class="category-scroll">

            @forelse ($assetTypes as $type)

                @php
                    $categoryName = strtolower($type->name);

                    if (str_contains($categoryName, 'komputer') ||
                        str_contains($categoryName, 'pc') ||
                        str_contains($categoryName, 'laptop')) {
                        $categoryIcon = '💻';
                    } elseif (str_contains($categoryName, 'printer')) {
                        $categoryIcon = '🖨️';
                    } elseif (str_contains($categoryName, 'server')) {
                        $categoryIcon = '🖥️';
                    } elseif (str_contains($categoryName, 'mouse') ||
                              str_contains($categoryName, 'keyboard') ||
                              str_contains($categoryName, 'periferal')) {
                        $categoryIcon = '⌨️';
                    } elseif (str_contains($categoryName, 'komponen') ||
                              str_contains($categoryName, 'ssd') ||
                              str_contains($categoryName, 'storage')) {
                        $categoryIcon = '💾';
                    } else {
                        $categoryIcon = '📦';
                    }
                @endphp

                <button type="button"
                    class="category-card"
                    data-category-select="{{ $type->id }}">

                    <span class="category-icon">
                        {{ $categoryIcon }}
                    </span>

                    <span class="category-name">
                        {{ $type->name }}
                    </span>

                    <span class="category-total">
                        {{ $categoryCounts[$type->id] ?? 0 }}
                        <small>Aset</small>
                    </span>

                </button>

            @empty

                <div class="card" style="padding:20px;">
                    <p style="color:#6b7280;font-size:13px;">
                        Belum ada kategori aset yang terdaftar.
                    </p>
                </div>

            @endforelse

        </div>

    </section>

    <!-- ASSET LIST -->
    <section class="card asset-list-card">

        <div class="card-header">
            <div>
                <h3>Daftar Aset</h3>
                <p>Daftar inventaris berdasarkan kategori yang dipilih.</p>
            </div>

            <span class="card-count" id="visible-count">
                {{ $assets->count() }} Aset
            </span>
        </div>

        <!-- CATEGORY TABS -->
        <div class="asset-toolbar">

            <div class="category-tabs">

                <button type="button"
                    class="category-tab active"
                    data-category-tab="all">
                    Semua Aset
                </button>

                @foreach ($assetTypes as $type)

                    <button type="button"
                        class="category-tab"
                        data-category-tab="{{ $type->id }}">
                        {{ $type->name }}
                    </button>

                @endforeach

            </div>

            <!-- SEARCH AND FILTER -->
            <div class="filter-area">

                <div class="search-box">
                    <span class="search-icon">🔍</span>

                    <input type="text"
                        id="asset-search"
                        placeholder="Cari kode atau nama aset...">
                </div>

                <select id="asset-status-filter" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="available">Tersedia</option>
                    <option value="in_use">Digunakan</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="damaged">Rusak</option>
                    <option value="retired">Tidak Digunakan</option>
                </select>

            </div>

        </div>

        <!-- TABLE -->
        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>Kode Aset</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Model</th>
                        <th>Serial Number</th>
                        <th>Lokasi</th>
                        <th>Harga</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="asset-table-body">

                    @forelse ($assets as $asset)

                        <tr class="asset-row"
                            data-category="{{ $asset->asset_type_id }}"
                            data-status="{{ $asset->status }}"
                            data-search="{{ strtolower(
                                ($asset->asset_code ?? '') . ' ' .
                                ($asset->name ?? '') . ' ' .
                                ($asset->brand ?? '') . ' ' .
                                ($asset->model ?? '') . ' ' .
                                ($asset->serial_number ?? '')
                            ) }}">

                            <td>
                                <span class="asset-code">
                                    {{ $asset->asset_code }}
                                </span>
                            </td>

                            <td>
                                <span class="asset-name">
                                    {{ $asset->name }}
                                </span>
                            </td>

                            <td>
                                {{ $asset->assetType->name ?? '-' }}
                            </td>

                            <td>{{ $asset->brand ?? '-' }}</td>

                            <td>{{ $asset->model ?? '-' }}</td>

                            <td>{{ $asset->serial_number ?? '-' }}</td>

                            <td>{{ $asset->office->name ?? '-' }}</td>

                            <td>
                                @if ($asset->purchase_price !== null)
                                    <span class="price">
                                        Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if ($asset->condition === 'good')
                                    <span class="badge condition-good">Baik</span>
                                @elseif ($asset->condition === 'minor_damage')
                                    <span class="badge condition-minor">Rusak Ringan</span>
                                @elseif ($asset->condition === 'major_damage')
                                    <span class="badge condition-major">Rusak Berat</span>
                                @elseif ($asset->condition === 'broken')
                                    <span class="badge condition-broken">Rusak</span>
                                @else
                                    <span class="badge">
                                        {{ $asset->condition ?? '-' }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($asset->status === 'available')
                                    <span class="badge status-available">Tersedia</span>
                                @elseif ($asset->status === 'in_use')
                                    <span class="badge status-in-use">Digunakan</span>
                                @elseif ($asset->status === 'maintenance')
                                    <span class="badge status-maintenance">Maintenance</span>
                                @elseif ($asset->status === 'damaged')
                                    <span class="badge status-damaged">Rusak</span>
                                @elseif ($asset->status === 'retired')
                                    <span class="badge status-retired">Tidak Digunakan</span>
                                @else
                                    <span class="badge">
                                        {{ $asset->status ?? '-' }}
                                    </span>
                                @endif
                            </td>

                            <td class="action-cell">
                                <a href="{{ route('admin.assets.show', $asset) }}"
                                   class="detail-btn">
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr class="empty-row">
                            <td colspan="11" class="empty">
                                <div class="empty-icon">💻</div>
                                <div class="empty-title">Belum ada data aset</div>
                                <div class="empty-text">
                                    Tambahkan aset IT Gateway untuk mulai mengelola inventaris.
                                </div>
                            </td>
                        </tr>

                    @endforelse

                    <tr id="filter-empty" class="no-result-row">
                        <td colspan="11" class="empty">
                            <div class="empty-icon">🔍</div>
                            <div class="empty-title">Aset tidak ditemukan</div>
                            <div class="empty-text">
                                Tidak ada aset yang sesuai dengan pencarian atau filter.
                            </div>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const categoryCards = document.querySelectorAll('[data-category-select]');
    const categoryTabs = document.querySelectorAll('[data-category-tab]');
    const assetRows = document.querySelectorAll('.asset-row');

    const searchInput = document.getElementById('asset-search');
    const statusFilter = document.getElementById('asset-status-filter');

    const visibleCount = document.getElementById('visible-count');
    const emptyMessage = document.getElementById('filter-empty');

    let selectedCategory = 'all';

    function filterAssets() {

        const keyword = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusFilter.value;

        let visibleTotal = 0;

        assetRows.forEach(function (row) {

            const rowCategory = row.dataset.category;
            const rowStatus = row.dataset.status;
            const rowSearch = row.dataset.search;

            const matchesCategory =
                selectedCategory === 'all' ||
                rowCategory === selectedCategory;

            const matchesSearch =
                rowSearch.includes(keyword);

            const matchesStatus =
                selectedStatus === '' ||
                rowStatus === selectedStatus;

            const isVisible =
                matchesCategory &&
                matchesSearch &&
                matchesStatus;

            row.style.display = isVisible ? '' : 'none';

            if (isVisible) {
                visibleTotal++;
            }

        });

        visibleCount.textContent = visibleTotal + ' Aset';

        emptyMessage.style.display =
            visibleTotal === 0 ? 'table-row' : 'none';
    }

    function selectCategory(categoryId) {

        selectedCategory = String(categoryId);

        categoryCards.forEach(function (card) {
            card.classList.toggle(
                'active',
                card.dataset.categorySelect === selectedCategory
            );
        });

        categoryTabs.forEach(function (tab) {
            tab.classList.toggle(
                'active',
                tab.dataset.categoryTab === selectedCategory
            );
        });

        filterAssets();
    }

    categoryCards.forEach(function (card) {

        card.addEventListener('click', function () {
            selectCategory(card.dataset.categorySelect);

            document.querySelector('.asset-list-card')
                .scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
        });

    });

    categoryTabs.forEach(function (tab) {

        tab.addEventListener('click', function () {
            selectCategory(tab.dataset.categoryTab);
        });

    });

    searchInput.addEventListener('input', filterAssets);

    statusFilter.addEventListener('change', filterAssets);

    // Kondisi awal: Semua aset
    selectCategory('all');

});
</script>
@endpush
