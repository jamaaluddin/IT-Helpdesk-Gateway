<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gateway.co.id'],
            [
                'role_id' => 3,
                'office_id' => 1,
                'department_id' => 7,
                'name' => 'Administrator',
                'phone' => null,
                'password' => Hash::make('admin12345'),
                'status' => 'active',
                'approved_at' => now(),
            ]
        );
    }
}
