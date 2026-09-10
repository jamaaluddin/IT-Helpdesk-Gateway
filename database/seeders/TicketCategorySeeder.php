<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hardware',
                'description' => 'Masalah perangkat keras seperti komputer, laptop, mouse, keyboard, monitor, SSD, dan perangkat lainnya.',
            ],
            [
                'name' => 'Software',
                'description' => 'Masalah aplikasi, sistem operasi, instalasi, konfigurasi, dan software lainnya.',
            ],
            [
                'name' => 'Network / Internet',
                'description' => 'Masalah jaringan, koneksi internet, Wi-Fi, LAN, dan konektivitas lainnya.',
            ],
            [
                'name' => 'Printer',
                'description' => 'Masalah printer, scanner, pencetakan, koneksi printer, dan perangkat sejenisnya.',
            ],
            [
                'name' => 'Server',
                'description' => 'Masalah server, layanan server, akses server, dan konfigurasi server.',
            ],
            [
                'name' => 'Maintenance',
                'description' => 'Permintaan atau kegiatan perawatan perangkat dan sistem IT.',
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Masalah IT lainnya yang tidak termasuk kategori yang tersedia.',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('ticket_categories')->updateOrInsert(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'is_active' => true,
                    'updated_at' => now(),
                ]
            );
        }
    }
}
