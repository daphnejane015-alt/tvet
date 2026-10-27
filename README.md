# TVET System

Sistem pengurusan kursus dan permohonan pelajar untuk institusi TVET (Technical and Vocational Education and Training), dibina menggunakan Laravel.

## Ciri-Ciri

- **Laman Awam** — Papar senarai kursus, kategori, dan maklumat institusi
- **Pendaftaran & Log Masuk** — Sistem role-based (Admin & Pelajar)
- **Permohonan Kursus** — Pelajar boleh memohon kursus dan menjejaki status permohonan
- **Panel Admin** — Urus kursus, kategori, dan permohonan pelajar
- **Dashboard Statistik** — Ringkasan aktiviti sistem untuk admin

## Teknologi Digunakan

- **Backend**: Laravel 10
- **Frontend**: Blade, Tailwind CSS, Alpine.js
- **Authentication**: Laravel Breeze
- **Database**: MySQL

## Setup Projek (Local Development)

1. Clone repository ini
```bash
   git clone https://github.com/rahimahsufian14/tvet-system.git
   cd tvet-system
```

2. Install dependencies
```bash
   composer install
   npm install
```

3. Salin fail environment dan jana application key
```bash
   copy .env.example .env
   php artisan key:generate
```

4. Konfigurasi database dalam fail `.env`