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
        $categories = [
            'Teknologi Automotif',
            'Teknologi Automasi',
            'Teknologi Mekatronik',
            'Teknologi Elektrik',
            'Teknologi Kimpalan',
            'Kenderaan Elektrik (EV)',
            'Pengajian Awal Kanak-Kanak',
            'Pendidikan Prasekolah',
            'Seni Kulinari',
            'Pembuatan Roti',
            'Pastri',
            'Penyejukan & Penyamanan Udara',
            'Kecantikan',
        ];

        foreach ($categories as $categoryName) {
            Category::firstOrCreate(
                ['name' => $categoryName]
            );
        }
    }
}
