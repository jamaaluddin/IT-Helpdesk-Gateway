<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Import',
                'code' => 'IMP',
            ],
            [
                'name' => 'Export',
                'code' => 'EXP',
            ],
            [
                'name' => 'Accounting & Finance',
                'code' => 'ACC-FIN',
            ],
            [
                'name' => 'Sales',
                'code' => 'SLS',
            ],
            [
                'name' => 'BD',
                'code' => 'BD',
            ],
            [
                'name' => 'Domestik',
                'code' => 'DOM',
            ],
            [
                'name' => 'IT',
                'code' => 'IT',
            ],
        ];

        foreach ($departments as $department) {
            DB::table('departments')->updateOrInsert(
                ['code' => $department['code']],
                [
                    'name' => $department['name'],
                    'is_active' => true,
                    'updated_at' => now(),
                ]
            );
        }
    }
}
