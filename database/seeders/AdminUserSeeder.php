<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@tvet.com'],
            [
                'name' => 'Admin TVET',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}
