@extends('layouts.itsupport')

@section('title', 'Aset Gateway')
@section('page-title', 'Aset Gateway')
@section('page-subtitle', 'Pengelolaan inventaris perangkat milik PT Gateway')

@section('content')

<style>
    .container {
        max-width: 1400px;
        margin: auto;
        padding: 30px;
    }

    .page-intro {
        margin-bottom: 27px;
    }

    .page-intro h2 {
        font-size: 23px;
        margin-bottom: 7px;
        color: #172033;
    }

    .page-intro p {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .category-card {
        display: flex;
        flex-direction: column;
        background: white;
        padding: 25px;
        min-height: 190px;
        border-radius: 17px;
        border: 1px solid #eef2f7;
        text-decoration: none;
        color: inherit;
        box-shadow:
            0 3px 7px rgba(0, 0, 0, 0.03),
            0 8px 18px rgba(0, 0, 0, 0.05),
            0 16px 35px rgba(0, 0, 0, 0.06),
            0 25px 50px rgba(124, 58, 237, 0.07);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow:
            0 5px 10px rgba(0, 0, 0, 0.04),
            0 12px 25px rgba(0, 0, 0, 0.07),
            0 22px 45px rgba(0, 0, 0, 0.08),
            0 32px 65px rgba(124, 58, 237, 0.12);
    }

    .category-card:active {
        transform: translateY(-1px);
    }

    .category-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ede9fe;
        border-radius: 13px;
        font-size: 27px;
        margin-bottom: 17px;
    }

    .category-name {
        font-size: 17px;
        font-weight: bold;
        color: #172033;
        margin-bottom: 7px;
    }

    .category-description {
        color: #6b7280;
        font-size: 12px;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .category-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 13px;
        border-top: 1px solid #eef2f7;
        gap: 10px;
    }

    .asset-count {
        font-size: 12px;
        color: #64748b;
    }

    .category-link {
        font-size: 12px;
        color: #7c3aed;
        font-weight: bold;
    }

    .empty {
        text-align: center;
        padding: 45px 20px;
        color: #6b7280;
        background: white;
        border: 1px dashed #dbe2ea;
        border-radius: 12px;
        font-size: 13px;
        grid-column: 1 / -1;
    }

    @media (max-width: 1200px) {
        .category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 900px) {
        .container {
            padding: 20px;
        }
    }

    @media (max-width: 550px) {
        .container {
            padding: 15px;
        }

        .category-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="container">

    <div class="page-intro">
        <h2>Pengelolaan Aset Gateway</h2>

        <p>
            Pilih kategori aset untuk melihat dan mengelola inventaris
            perangkat milik PT Gateway.
        </p>
    </div>

    <div class="category-grid">

        @forelse ($assetTypes as $assetType)

            <a
                href="{{ route('it-support.assets.category', $assetType) }}"
                class="category-card"
            >

                @php
                    $categoryName = strtolower($assetType->name);

                    $categoryIcon = '📦';
                    $categoryClass = 'default';

                    if (str_contains($categoryName, 'komputer') || str_contains($categoryName, 'pc')) {
                        $categoryIcon = '💻';
                        $categoryClass = 'komputer';
                    } elseif (str_contains($categoryName, 'laptop')) {
                        $categoryIcon = '💻';
                        $categoryClass = 'komputer';
                    } elseif (str_contains($categoryName, 'printer')) {
                        $categoryIcon = '🖨️';
                        $categoryClass = 'printer';
                    } elseif (str_contains($categoryName, 'handphone') || str_contains($categoryName, 'hp') || str_contains($categoryName, 'smartphone')) {
                        $categoryIcon = '📱';
                        $categoryClass = 'aksesori';
                    } elseif (str_contains($categoryName, 'monitor')) {
                        $categoryIcon = '🖥️';
                        $categoryClass = 'monitor';
                    } elseif (str_contains($categoryName, 'server')) {
                        $categoryIcon = '🗄️';
                        $categoryClass = 'server';
                    } elseif (str_contains($categoryName, 'router') || str_contains($categoryName, 'modem')) {
                        $categoryIcon = '📡';
                        $categoryClass = 'jaringan';
                    } elseif (str_contains($categoryName, 'jaringan') || str_contains($categoryName, 'network')) {
                        $categoryIcon = '🌐';
                        $categoryClass = 'jaringan';
                    } elseif (str_contains($categoryName, 'keyboard')) {
                        $categoryIcon = '⌨️';
                        $categoryClass = 'aksesori';
                    } elseif (str_contains($categoryName, 'mouse')) {
                        $categoryIcon = '🖱️';
                        $categoryClass = 'aksesori';
                    } elseif (str_contains($categoryName, 'scanner')) {
                        $categoryIcon = '📠';
                        $categoryClass = 'printer';
                    } elseif (str_contains($categoryName, 'ups')) {
                        $categoryIcon = '🔋';
                        $categoryClass = 'aksesori';
                    } elseif (str_contains($categoryName, 'proyektor') || str_contains($categoryName, 'projector')) {
                        $categoryIcon = '📽️';
                        $categoryClass = 'monitor';
                    }
                @endphp

                <div class="category-icon {{ $categoryClass }}">
                    {{ $categoryIcon }}
                </div>

                <div class="category-name">
                    {{ $assetType->name }}
                </div>

                <div class="category-description">
                    Lihat dan kelola inventaris
                    {{ strtolower($assetType->name) }} Gateway.
                </div>

                <div class="category-footer">

                    <span class="asset-count">
                        {{ $assetType->assets_count }} aset
                    </span>

                    <span class="category-link">
                        Lihat Aset →
                    </span>

                </div>

            </a>

        @empty

            <div class="empty">
                Belum ada kategori aset yang tersedia.
            </div>

        @endforelse

    </div>

</main>

@endsection
