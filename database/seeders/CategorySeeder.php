<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Teknologi Automotif', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teknologi Automasi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teknologi Mekatronik', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teknologi Elektrik', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teknologi Kimpalan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kenderaan Elektrik (EV)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pengajian Awal Kanak-Kanak', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pendidikan Prasekolah', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Seni Kulinari', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pembuatan Roti', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pastri', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Penyejukan & Penyamanan Udara', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kecantikan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
