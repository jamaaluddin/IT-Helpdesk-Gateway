<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        $offices = [
            [
                'name' => 'Head Office Jakarta',
                'code' => 'JKT-HO',
                'address' => 'PT. Gateway Container Line, GCL Building, Jl. Otista III No 18, Jakarta 13120 - Indonesia',
            ],
            [
                'name' => 'Bandung Office',
                'code' => 'BDG',
                'address' => 'Metro Trade Centre, Block H No. 2, Bandung',
            ],
            [
                'name' => 'Cikarang Office',
                'code' => 'CKR',
                'address' => 'BPK Warehouse Kawasan Industri Jababeka, Phase 8, Blok A1-A3, Tanjung Sari, Kec. Cikarang Utara, Kabupaten Bekasi',
            ],
            [
                'name' => 'Semarang Office',
                'code' => 'SMG',
                'address' => 'Komplek Ruko, Semarang Indah, Block E2 No. 19 Jl. Madukoro Raya, Semarang, 50144 - Indonesia',
            ],
            [
                'name' => 'Surabaya Office',
                'code' => 'SBY',
                'address' => 'Jl. Gayung Sari Barat No. 91B, Surabaya, East Java - Indonesia',
            ],
            [
                'name' => 'Medan Office',
                'code' => 'MDN',
                'address' => 'Mandiri Building 7th Floor, Jl. Imam Bonjol No. 165, Medan 20112 - Indonesia',
            ],
            [
                'name' => 'Office at the Airport',
                'code' => 'CGK-APT',
                'address' => 'Gedung 501 Lantai 1 No. D.3B, Terminal Kargo Bandara, Soekarno Hatta, Jakarta, Indonesia',
            ],
        ];

        foreach ($offices as $office) {
            DB::table('offices')->updateOrInsert(
                ['code' => $office['code']],
                [
                    'name' => $office['name'],
                    'address' => $office['address'],
                    'is_active' => true,
                    'updated_at' => now(),
                ]
            );
        }
    }
}
