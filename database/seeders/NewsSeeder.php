<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'Graduan TVET Mara lanjut pengajian di UK',
                'description' => 'Farah Ezreen Anuar, graduan TVET Mara Ledang, membuktikan keupayaan dengan melanjutkan pengajian Master di UK.',
                'source' => 'Kosmo!',
                'image' => 'news/CDETyusyiVBizZhq5SIrBUFb8uUpm6brgaiT3U7A.png',
                'url' => 'https://www.kosmo.com.my/2026/09/21/graduan-tvet-mara-lanjut-pengajian-di-uk/',
                'news_date' => '2026-09-21',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'WAS 2026 perkasa agenda TVET & teknologi mampan',
                'description' => 'UTeM anjur World Academia Summit untuk perkasakan inovasi TVET negara dan kebolehpasaran graduan.',
                'source' => 'Malaysia Gazette',
                'image' => 'news/Xo09a6TlGlpJcm0eGfWIOfVyKxSyzXVchUAMIrdy.png',
                'url' => 'https://malaysiagazette.com/2026/09/19/was-2026-satukan-tiga-persidangan-perkasa-agenda-tvet-dan-teknologi-mampan-negara/',
                'news_date' => '2026-09-19',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Program Jom TVET: Pilihan utama kerjaya masa hadapan',
                'description' => '1,000 pelajar meriahkan Program Jom TVET di KV Kangar anjuran KPM dan BPLTV bagi memupuk minat TVET.',
                'source' => 'Berita RTM',
                'image' => 'news/hsgY7C2poZiHgp4OhJSlnPGx2ZHRJoHD9y2q2lKK.png',
                'url' => 'https://berita.rtm.gov.my/nasional/senarai-berita-nasional/senarai-artikel/program-jom-tvet-pilihan-utama-kerjaya-masa-hadapan/',
                'news_date' => '2026-09-16',
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($newsItems as $item) {
            News::create($item);
        }
    }
}
