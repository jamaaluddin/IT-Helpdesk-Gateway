<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'User',
                'description' => 'Karyawan yang dapat membuat dan memantau tiket helpdesk.',
            ],
            [
                'name' => 'IT Support',
                'description' => 'Petugas IT yang menangani tiket dan maintenance.',
            ],
            [
                'name' => 'Admin',
                'description' => 'Administrator atau Manager yang mengelola sistem dan data.',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                [
                    'description' => $role['description'],
                    'updated_at' => now(),
                ]
            );
        }
    }
}
