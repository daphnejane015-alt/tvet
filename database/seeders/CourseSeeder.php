<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'category' => 'Teknologi Automotif',
                'name' => 'SKM Teknologi Automotif',
                'description' => 'Kursus ini melatih pelajar dalam penyelenggaraan, pembaikan, dan diagnostik kenderaan moden.',
                'career_prospects' => 'Juruteknik Automotif, Penyelia Bengkel, Usahawan Automotif',
                'min_salary' => 1800.00,
                'max_salary' => 3500.00,
                'duration' => '2 Tahun',
            ],
            [
                'category' => 'Teknologi Automasi',
                'name' => 'SKM Teknologi Automasi Industri',
                'description' => 'Fokus kepada sistem kawalan automatik, PLC, dan robotik dalam industri pembuatan.',
                'career_prospects' => 'Juruteknik Automasi, Pengendali PLC, Penyelia Pengeluaran',
                'min_salary' => 2000.00,
                'max_salary' => 4000.00,
                'duration' => '18 Bulan',
            ],
            [
                'category' => 'Teknologi Elektrik',
                'name' => 'SKM Pemasangan & Wiring Elektrik',
                'description' => 'Latihan praktikal pendawaian elektrik domestik dan komersial mengikut standard keselamatan.',
                'career_prospects' => 'Juruelektrik Berlesen, Penyelia Pendawaian, Usahawan Elektrik',
                'min_salary' => 1800.00,
                'max_salary' => 3200.00,
                'duration' => '1 Tahun',
            ],
            [
                'category' => 'Teknologi Kimpalan',
                'name' => 'SKM Kimpalan Arka & Gas',
                'description' => 'Kemahiran kimpalan logam untuk industri pembinaan dan pembuatan.',
                'career_prospects' => 'Juruteknik Kimpalan, Penyelia Fabrikasi, Pemeriksa Kimpalan',
                'min_salary' => 1900.00,
                'max_salary' => 3800.00,
                'duration' => '1 Tahun',
            ],
            [
                'category' => 'Kenderaan Elektrik (EV)',
                'name' => 'SKM Teknologi Kenderaan Elektrik',
                'description' => 'Pengenalan sistem bateri, motor elektrik, dan penyelenggaraan kenderaan EV.',
                'career_prospects' => 'Juruteknik EV, Penyelia Bengkel EV, Pakar Diagnostik Bateri',
                'min_salary' => 2000.00,
                'max_salary' => 4200.00,
                'duration' => '1 Tahun',
            ],
            [
                'category' => 'Pengajian Awal Kanak-Kanak',
                'name' => 'SKM Pengajian Awal Kanak-Kanak',
                'description' => 'Melatih pelajar dalam perkembangan kanak-kanak, kurikulum awal, dan pengurusan pusat jagaan.',
                'career_prospects' => 'Pengasuh Bertauliah, Pengurus Taska, Usahawan Pusat Jagaan',
                'min_salary' => 1600.00,
                'max_salary' => 3000.00,
                'duration' => '2 Tahun',
            ],
            [
                'category' => 'Pendidikan Prasekolah',
                'name' => 'SKM Pendidikan Prasekolah',
                'description' => 'Asas pedagogi prasekolah, aktiviti pembelajaran kreatif dan pengurusan bilik darjah.',
                'career_prospects' => 'Guru Prasekolah, Pembantu Guru, Penyelaras Pusat Tadika',
                'min_salary' => 1700.00,
                'max_salary' => 3200.00,
                'duration' => '1 Tahun',
            ],
            [
                'category' => 'Seni Kulinari',
                'name' => 'SKM Seni Kulinari',
                'description' => 'Kemahiran memasak profesional, pengurusan dapur, dan penyediaan hidangan pelbagai kuisin.',
                'career_prospects' => 'Cef Junior, Penyelia Dapur, Usahawan Katering',
                'min_salary' => 1800.00,
                'max_salary' => 3600.00,
                'duration' => '2 Tahun',
            ],
            [
                'category' => 'Pembuatan Roti',
                'name' => 'SKM Pembuatan Roti & Pastri',
                'description' => 'Teknik asas dan lanjutan dalam pembuatan roti, kek dan pastri komersial.',
                'career_prospects' => 'Juru Roti (Baker), Penyelia Pastri, Usahawan Bakeri',
                'min_salary' => 1700.00,
                'max_salary' => 3300.00,
                'duration' => '1 Tahun',
            ],
            [
                'category' => 'Penyejukan & Penyamanan Udara',
                'name' => 'SKM Penyejukan & Penyamanan Udara (RAC)',
                'description' => 'Pemasangan, penyelenggaraan dan pembaikan sistem penyaman udara dan peti sejuk.',
                'career_prospects' => 'Juruteknik RAC, Penyelia Penyelenggaraan, Usahawan Servis Aircond',
                'min_salary' => 1900.00,
                'max_salary' => 3800.00,
                'duration' => '1 Tahun',
            ],
            [
                'category' => 'Kecantikan',
                'name' => 'SKM Terapi Kecantikan',
                'description' => 'Latihan dalam rawatan kulit, dandanan dan pengurusan salon profesional.',
                'career_prospects' => 'Juruhias/Ahli Terapi Kecantikan, Penyelia Salon, Usahawan Kecantikan',
                'min_salary' => 1600.00,
                'max_salary' => 3500.00,
                'duration' => '1 Tahun',
            ],
        ];

        foreach ($courses as $course) {
            $category = Category::where('name', $course['category'])->first();

            if (! $category) {
                continue; // skip kalau kategori tak wujud
            }

            Course::firstOrCreate(
                [
                    'name' => $course['name'],
                    'category_id' => $category->id,
                ],
                [
                    'slug' => Str::slug($course['name']),
                    'description' => $course['description'],
                    'career_prospects' => $course['career_prospects'],
                    'min_salary' => $course['min_salary'],
                    'max_salary' => $course['max_salary'],
                    'duration' => $course['duration'],
                    'image' => null,
                ]
            );
        }
    }
}