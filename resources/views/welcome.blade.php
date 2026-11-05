<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'AceTVET') }} - Portal Pendidikan & Latihan Kemahiran Negara</title>

        <!-- PWA Meta Tags -->
        <meta name="theme-color" content="#174871">
        <meta name="msapplication-TileColor" content="#174871">
        <meta name="msapplication-config" content="/browserconfig.xml">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="AceTVET">
        <meta name="description" content="Portal Pendidikan & Latihan Kemahiran Negara - Sistem Pengurusan & Permohonan TVET">

        <!-- PWA Manifest -->
        <link rel="manifest" href="{{ asset('manifest.json') }}?v={{ time() }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo-acetvet-new.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logo-acetvet-new.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'theme-light': '#F2F3F4',       /* Light beige/off-white */
                            'theme-beige': '#DED1C6',       /* Light beige/pinkish-tan */
                            'theme-purple': '#A77693',      /* Muted purple/mauve */
                            'theme-blue': '#174871',        /* Dark blue/indigo */
                            'theme-dark': '#0F2D4D',        /* Very dark blue */
                            'theme-accent': '#FF6B35',      /* Pop orange/red for freshness */
                            'theme-yellow': '#FFD93D',      /* Pop yellow for freshness */
                            'theme-cream': '#FFF8E7',       /* Cream background */
                            // New cheerful colors
                            'theme-teal': '#86E3CE',       /* Light teal - fresh and calming */
                            'theme-green': '#D0E6A5',      /* Light green - growth and vitality */
                            'theme-warm-yellow': '#FFDD94', /* Warm yellow - friendly and warm */
                            'theme-coral': '#FAB97B',       /* Light coral - energetic and inviting */
                            'theme-lavender': '#CCABDB',    /* Light purple - creative and modern */
                        },
                        fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] }
                    }
                }
            }
        </script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }

            #preloader {
                position: fixed; inset: 0; background: linear-gradient(135deg, #0F2D4D 0%, #174871 50%, #A77693 100%); z-index: 99999;
                display: flex; flex-direction: column; justify-content: center; align-items: center;
                transition: opacity 0.8s ease, visibility 0.8s ease;
            }
            .loader-logo { animation: pulseGlow 1.8s infinite ease-in-out alternate; }
            @keyframes pulseGlow {
                0% { transform: scale(0.85); filter: drop-shadow(0 0 16px rgba(255, 107, 53, 0.5)); opacity: 0.75; }
                100% { transform: scale(1.06); filter: drop-shadow(0 0 40px rgba(255, 107, 53, 0.9)); opacity: 1; }
            }
            .loader-bar {
                width: 200px; height: 4px; background: rgba(255, 255, 255, 0.12);
                border-radius: 99px; overflow: hidden; margin-top: 28px; position: relative;
            }
            .loader-bar::after {
                content: ''; position: absolute; left: -100%; top: 0; height: 100%; width: 100%;
                background: linear-gradient(90deg, transparent, #FFD93D, #FF6B35, #A77693, transparent);
                animation: loadingProgress 1.5s infinite;
            }
            @keyframes loadingProgress { 0% { left: -100%; } 100% { left: 100%; } }
            .preloader-hidden { opacity: 0; visibility: hidden; }

            .magnetic-btn { transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); }
            .magnetic-btn:hover { transform: translateY(-2px); }

            .swiper-pagination-bullet {
                background: #ffffff !important; opacity: 0.35; height: 7px !important; width: 7px !important;
                transition: all 0.3s ease;
            }
            .swiper-pagination-bullet-active {
                background: #FF6B35 !important; opacity: 1; width: 24px !important; border-radius: 99px !important;
            }

            /* Hero slide height */
            .heroSwiper .swiper-slide {
                height: 350px !important;
            }
            @media (min-width: 640px) {
                .heroSwiper .swiper-slide {
                    height: 400px !important;
                }
            }

            .bulletin-track { display: inline-block; animation: marquee 28s linear infinite; }
            .bulletin-track:hover { animation-play-state: paused; }
            @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

            .h-scroll {
                display: flex; overflow-x: auto; scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch; scrollbar-width: none; gap: 0.75rem; padding-bottom: 0.5rem;
            }
            .h-scroll::-webkit-scrollbar { display: none; }
            .h-scroll > * { scroll-snap-align: start; flex-shrink: 0; }

            @media (min-width: 768px) {
                .h-scroll { display: grid; overflow: visible; }
            }

            /* Ensure equal height news cards */
            .newsSwiper .swiper-slide {
                height: auto !important;
            }
            .newsSwiper .swiper-slide > div {
                min-height: 400px;
            }
            @media (min-width: 640px) {
                .newsSwiper .swiper-slide > div {
                    min-height: 440px;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-theme-cream text-slate-900 overflow-hidden" id="body-content">

        <!-- PRELOADER -->
        <div id="preloader">
            <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}" alt="AceTVET Loading" class="h-28 sm:h-40 w-auto loader-logo drop-shadow-2xl">
            <div class="loader-bar"></div>
            <p class="text-white/90 text-xs mt-4 tracking-wider font-semibold">AceTVET loading...</p>
        </div>

        @include('layouts.navigation')

        <!-- FLOATING WHATSAPP BUTTON -->
        <a href="https://wa.me/60164801473?text=Hai,%20saya%20ingin%20bertanya%20tentang%20AceTVET"
           target="_blank"
           rel="noopener noreferrer"
           class="fixed bottom-6 right-6 z-50 flex items-center gap-2.5 bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark px-4 py-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 group hover:scale-105">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            <span class="font-extrabold text-xs tracking-wide">Hubungi Kami</span>
        </a>

        <!-- HERO SECTION WITH SWIPER SLIDER -->
        <div class="relative bg-gradient-to-br from-theme-dark via-theme-blue to-theme-purple text-white overflow-hidden border-b border-theme-purple/20">

            <div id="particles-js" class="absolute inset-0 pointer-events-auto opacity-60"></div>
            <!-- Glow Spheres with new theme colors -->
            <div class="absolute -top-16 left-1/4 w-80 sm:w-96 h-80 sm:h-96 bg-theme-teal/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 right-1/4 w-80 sm:w-96 h-80 sm:h-96 bg-theme-coral/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 pointer-events-none min-h-[450px] sm:min-h-[500px]">

                <!-- Two-column layout: Logo on left, Slider on right -->
                <div class="flex flex-col lg:flex-row items-center justify-center gap-6 lg:gap-8 h-full">

                    <!-- Left side: Big Logo with background -->
                    <div class="w-full lg:w-1/3 flex items-center justify-center pointer-events-auto">
                        <div class="relative group">
                            <!-- Floating background for logo -->
                            <div class="absolute inset-0 bg-gradient-to-br from-theme-accent/40 via-theme-blue/30 to-theme-purple/40 rounded-3xl blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                            <div class="absolute inset-0 bg-gradient-to-br from-theme-accent/30 via-theme-blue/20 to-theme-purple/30 rounded-3xl backdrop-blur-md border border-white/10 shadow-2xl shadow-theme-accent/70 transform group-hover:scale-105 group-hover:-translate-y-2 transition-all duration-500"></div>

                            <!-- Logo -->
                            <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}"
                                 alt="AceTVET"
                                 data-aos="zoom-in"
                                 data-aos-duration="700"
                                 class="relative w-48 sm:w-56 lg:w-64 h-auto pointer-events-auto transition-transform duration-300">
                        </div>
                    </div>

                    <!-- Right side: Swiper Slider -->
                    <div class="w-full lg:w-2/3 pointer-events-auto">
                        <div class="swiper heroSwiper">
                    <div class="swiper-wrapper">

                        <!-- Slide 1 -->
                        <div class="swiper-slide text-center relative">
                            <!-- Floating Background Image with Soft Edges -->
                            <div class="absolute inset-0 z-0 flex items-center justify-center p-6 sm:p-10">
                                <div class="relative w-full h-full max-w-5xl mx-auto transform hover:scale-105 transition-transform duration-700 ease-in-out">
                                    <!-- Image with soft edges and floating effect -->
                                    <img src="{{ asset('images/hero-slide1-graduation.png') }}?v={{ time() }}"
                                         alt="Graduation Background"
                                         class="w-full h-full object-cover rounded-3xl shadow-2xl shadow-theme-accent/60 transform hover:translate-y-[-10px] transition-all duration-700 ease-in-out"
                                         style="filter: brightness(0.85) contrast(1.1);">
                                    <!-- Gradient overlay on image -->
                                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-theme-dark/65 via-theme-blue/60 to-theme-purple/55 backdrop-blur-[2px]"></div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="relative z-10 px-4 py-2 flex flex-col justify-center items-center min-h-[350px] sm:min-h-[400px]">
                                <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 rounded-full bg-theme-accent/30 border border-theme-yellow/50 text-theme-light text-[10px] sm:text-xs font-bold tracking-wide uppercase mb-2 pointer-events-auto backdrop-blur-md shadow-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-theme-yellow animate-pulse"></span>
                                    Platform Pendidikan & Kemahiran TVET
                                </span>
                                <h1 data-aos="fade-up" data-aos-delay="100" class="text-xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-2 text-white leading-tight drop-shadow-lg">
                                    Membina Generasi <span class="bg-gradient-to-r from-theme-yellow via-theme-accent to-theme-purple bg-clip-text text-transparent drop-shadow-sm">Pakar Berkemahiran</span>
                                </h1>
                                <p data-aos="fade-up" data-aos-delay="250" class="text-xs sm:text-base text-slate-100 max-w-xl mx-auto mb-3 font-normal leading-relaxed drop-shadow-md">
                                    Latihan teknikal dan vokasional berkualiti tinggi yang diiktiraf industri untuk melahirkan tenaga kerja berkemahiran masa hadapan.
                                </p>
                                <div data-aos="fade-up" data-aos-delay="400" class="flex gap-3 justify-center flex-wrap pointer-events-auto">
                                    <a href="{{ route('courses.index') }}"
                                       class="magnetic-btn bg-gradient-to-r from-theme-accent to-theme-yellow hover:shadow-xl hover:shadow-theme-accent/50 text-theme-dark font-extrabold px-5 py-2.5 sm:px-7 sm:py-3 text-xs sm:text-sm rounded-xl transition flex items-center gap-2 shadow-lg">
                                        <span>Lihat Kursus TVET</span>
                                    </a>
                                    <a href="{{ route('pengenalan') }}"
                                       class="magnetic-btn bg-white/20 hover:bg-white/30 border-2 border-white/40 text-white font-bold px-4 py-2.5 sm:px-6 sm:py-3 text-xs sm:text-sm rounded-xl backdrop-blur-md transition flex items-center gap-1.5 shadow-lg">
                                        <span>Ketahui TVET</span>
                                        <span>💡</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2: PENGAMBILAN TVET -->
                        <div class="swiper-slide text-center relative">
                            <!-- Floating Background Image with Soft Edges -->
                            <div class="absolute inset-0 z-0 flex items-center justify-center p-6 sm:p-10">
                                <div class="relative w-full h-full max-w-5xl mx-auto transform hover:scale-105 transition-transform duration-700 ease-in-out">
                                    <!-- Image with soft edges and floating effect -->
                                    <img src="{{ asset('images/hero-slide2.png') }}?v={{ time() }}"
                                         alt="Practical Training Background"
                                         class="w-full h-full object-cover rounded-3xl shadow-2xl shadow-theme-yellow/60 transform hover:translate-y-[-10px] transition-all duration-700 ease-in-out"
                                         style="filter: brightness(0.85) contrast(1.1);">
                                    <!-- Gradient overlay on image -->
                                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-theme-dark/65 via-theme-blue/60 to-theme-purple/55 backdrop-blur-[2px]"></div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="relative z-10 px-4 py-2 flex flex-col justify-center items-center min-h-[350px] sm:min-h-[400px]">
                                <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 rounded-full bg-theme-yellow/30 border border-theme-yellow/50 text-theme-yellow text-[10px] sm:text-xs font-bold tracking-wide uppercase mb-2 pointer-events-auto backdrop-blur-md shadow-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-theme-accent animate-ping"></span>
                                    Permohonan Kini Dibuka
                                </span>
                                <h1 class="text-xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-2 text-white leading-tight drop-shadow-lg">
                                    Pengambilan TVET
                                </h1>
                                <p class="text-xs sm:text-base text-slate-100 max-w-xl mx-auto mb-3 font-normal leading-relaxed drop-shadow-md">
                                    Permohonan kemasukan ke Institusi Latihan Kemahiran Awam (ILKA) dibuka. Pilih kursus diminati dan hantar secara atas talian.
                                </p>
                                <div class="flex gap-3 justify-center flex-wrap pointer-events-auto">
                                    <a href="{{ route('up-tvet.form') }}"
                                       class="magnetic-btn bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark font-extrabold px-5 py-2.5 sm:px-7 sm:py-3 text-xs sm:text-sm rounded-xl transition shadow-xl shadow-theme-accent/30 flex items-center gap-2 cursor-pointer">
                                        <span>Borang Permohonan TVET</span>
                                        <span>📝</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="swiper-slide text-center relative">
                            <!-- Floating Background Image with Soft Edges -->
                            <div class="absolute inset-0 z-0 flex items-center justify-center p-6 sm:p-10">
                                <div class="relative w-full h-full max-w-5xl mx-auto transform hover:scale-105 transition-transform duration-700 ease-inout">
                                    <!-- Image with soft edges and floating effect -->
                                    <img src="{{ asset('images/hero-slide3-final.png') }}?v={{ time() }}"
                                         alt="Industry Partnership Background"
                                         class="w-full h-full object-cover rounded-3xl shadow-2xl shadow-theme-accent/50 transform hover:translate-y-[-10px] transition-all duration-700 ease-in-out"
                                         style="filter: brightness(0.85) contrast(1.1);">
                                    <!-- Gradient overlay on image -->
                                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-theme-dark/65 via-theme-purple/60 to-theme-blue/55 backdrop-blur-[2px]"></div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="relative z-10 px-4 py-2 flex flex-col justify-center items-center min-h-[350px] sm:min-h-[400px]">
                                <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 rounded-full bg-theme-purple/30 border border-theme-purple/50 text-theme-light text-[10px] sm:text-xs font-bold tracking-wide uppercase mb-2 pointer-events-auto backdrop-blur-md shadow-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-theme-blue"></span>
                                    Pasaran Kerja & Industri 4.0
                                </span>
                                <h1 class="text-xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-2 text-white leading-tight drop-shadow-lg">
                                    Kerjasama Industri Terkemuka
                                </h1>
                                <p class="text-xs sm:text-base text-slate-100 max-w-xl mx-auto mb-3 font-normal leading-relaxed drop-shadow-md">
                                    Modul pembelajaran berasaskan realiti industri dengan pensijilan diiktiraf oleh JPK dan agensi kebangsaan.
                                </p>
                                <div class="flex gap-3 justify-center flex-wrap pointer-events-auto">
                                    <a href="#kelebihan-section"
                                       class="magnetic-btn bg-white/20 hover:bg-white/30 border-2 border-white/40 text-white font-bold px-5 py-2.5 sm:px-6 sm:py-3 text-xs sm:text-sm rounded-xl backdrop-blur-md transition flex items-center gap-2 shadow-lg">
                                        <span>Kelebihan TVET</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-pagination pointer-events-auto !bottom-0"></div>
                </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- BULLETIN TICKER -->
        <div class="bg-theme-dark border-b border-theme-purple/30 text-slate-200">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-2">
                <div class="flex items-center gap-2 sm:gap-4">
                    <span class="bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark text-[9px] sm:text-[11px] font-extrabold uppercase px-2.5 py-1 rounded-lg shrink-0 z-10 flex items-center gap-1.5 shadow-sm">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-theme-dark opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-theme-dark"></span>
                        </span>
                        Pengumuman
                    </span>
                    <div class="overflow-hidden whitespace-nowrap flex-1">
                        <div class="bulletin-track">
                            <span class="text-[11px] sm:text-sm font-medium mx-3 sm:mx-6 text-slate-300">Pendaftaran sesi baharu kini dibuka — Mohon sekarang untuk jaminan tempat</span>
                            <span class="text-theme-yellow font-bold">•</span>
                            <span class="text-[11px] sm:text-sm font-medium mx-3 sm:mx-6 text-slate-300">Sijil Kemahiran Malaysia (SKM) diiktiraf peringkat antarabangsa & majikan</span>
                            <span class="text-theme-yellow font-bold">•</span>
                            <span class="text-[11px] sm:text-sm font-medium mx-3 sm:mx-6 text-slate-300">Elaun bulanan, penginapan dan latihan industri disediakan</span>
                            <span class="text-theme-yellow font-bold">•</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- QUICK ACCESS STATS BAR (Modern Float Bar) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 sm:mt-6 mb-6 sm:mb-8 relative z-10">
            <div class="bg-white rounded-2xl shadow-xl border border-theme-teal/30 p-4 sm:p-6 grid grid-cols-2 md:grid-cols-4 gap-4 divide-y md:divide-y-0 md:divide-x divide-theme-teal/30">
                <div class="flex items-center gap-3.5 p-2">
                    <div class="w-11 h-11 rounded-2xl bg-theme-teal/20 text-theme-blue flex items-center justify-center text-xl shrink-0">
                        🎓
                    </div>
                    <div>
                        <span class="text-base sm:text-2xl font-extrabold text-theme-dark block leading-none">100%</span>
                        <span class="text-[10px] sm:text-[11px] text-slate-600 font-bold uppercase tracking-wide block">Diiktiraf JPK</span>
                    </div>
                </div>

                <div class="flex items-center gap-3.5 p-2">
                    <div class="w-11 h-11 rounded-2xl bg-theme-lavender/30 text-theme-purple flex items-center justify-center text-xl shrink-0">
                        💼
                    </div>
                    <div>
                        <span class="text-base sm:text-2xl font-extrabold text-theme-dark block leading-none">94.8%</span>
                        <span class="text-[10px] sm:text-[11px] text-slate-600 font-bold uppercase tracking-wide block">Kebolehpasaran</span>
                    </div>
                </div>

                <div class="flex items-center gap-3.5 p-2">
                    <div class="w-11 h-11 rounded-2xl bg-theme-accent/20 text-theme-accent flex items-center justify-center text-xl shrink-0">
                        🛠️
                    </div>
                    <div>
                        <span class="text-base sm:text-2xl font-extrabold text-theme-dark block leading-none">70% Amali</span>
                        <span class="text-[10px] sm:text-[11px] text-slate-600 font-bold uppercase tracking-wide block">Hands-on Bengkel</span>
                    </div>
                </div>

                <div class="flex items-center gap-3.5 p-2">
                    <div class="w-11 h-11 rounded-2xl bg-theme-yellow/20 text-theme-yellow flex items-center justify-center text-xl shrink-0">
                        ⚡
                    </div>
                    <div>
                        <span class="text-base sm:text-2xl font-extrabold text-theme-dark block leading-none">Daftar</span>
                        <span class="text-[10px] sm:text-[11px] text-slate-600 font-bold uppercase tracking-wide block">Pendaftaran Mudah</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KERATAN AKHBAR & MEDIA (Interactive Carousel) -->
        <div id="keratan-akhbar" class="bg-gradient-to-b from-[#EFF0F0] via-[#FAF6CA] to-[#EEDD55] py-10 sm:py-16 border-t border-b border-[#EEDD55]/40 shadow-inner relative overflow-hidden">
            <!-- Subtle soft lighting circles in background -->
            <div class="absolute -top-20 -left-20 w-80 h-80 bg-white/40 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-[#EEDD55]/30 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-6 sm:mb-10">
                    <span class="text-theme-dark font-extrabold text-[10px] sm:text-xs tracking-widest uppercase bg-white/80 backdrop-blur-md px-3.5 py-1 rounded-full border border-white shadow-sm">
                        Liputan Akhbar
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-theme-dark mt-2.5 drop-shadow-sm">Keratan Akhbar & Media TVET</h2>
                    <p class="text-xs sm:text-sm text-theme-dark/80 mt-1 font-medium">Perkembangan terkini agenda transformasi pendidikan teknikal negara.</p>
                </div>

                <div class="relative px-8 sm:px-12">
                    <!-- Swiper Navigation Buttons -->
                    <button class="news-swiper-button-prev absolute left-0 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-full shadow-lg hover:shadow-xl border border-theme-beige/50 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-theme-blue hover:text-white hover:border-theme-blue group">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button class="news-swiper-button-next absolute right-0 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-full shadow-lg hover:shadow-xl border border-theme-beige/50 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-theme-blue hover:text-white hover:border-theme-blue group">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>

                    <div class="swiper newsSwiper pb-12 sm:pb-14 px-2 sm:px-4">
                        <div class="swiper-wrapper">
                            @forelse($news as $item)
                                <div class="swiper-slide h-auto">
                                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-theme-beige/50 flex flex-col h-full transform hover:-translate-y-1">
                                        <div class="flex-shrink-0">
                                            <div class="relative overflow-hidden bg-theme-dark h-40 sm:h-56">
                                                @if($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100">
                                                @else
                                                    <div class="w-full h-full bg-gradient-to-br from-theme-blue to-theme-purple flex items-center justify-center">
                                                        <span class="text-4xl">📰</span>
                                                    </div>
                                                @endif
                                                @if($item->source)
                                                    <div class="absolute top-2.5 left-2.5">
                                                        <span class="text-[9px] font-extrabold text-theme-dark bg-theme-yellow px-2 py-0.5 rounded-md uppercase tracking-wider shadow-sm">{{ $item->source }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1 flex flex-col p-4 sm:p-5">
                                            @if($item->news_date)
                                                <span class="text-[10px] font-semibold text-slate-400 block mb-1 flex-shrink-0">{{ $item->news_date->format('d M Y') }}</span>
                                            @endif
                                            <h3 class="font-extrabold text-xs sm:text-base text-theme-dark group-hover:text-theme-blue transition duration-300 leading-snug line-clamp-2 flex-shrink-0">
                                                {{ $item->title }}
                                            </h3>
                                            <p class="text-[11px] sm:text-xs text-slate-600 mt-2 line-clamp-2 leading-relaxed flex-1">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                        <div class="px-4 pb-4 sm:px-5 sm:pb-5 flex-shrink-0">
                                            @if($item->url)
                                                <a href="{{ $item->url }}" target="_blank" class="inline-flex items-center text-xs font-bold text-theme-blue hover:text-theme-purple transition gap-1.5">
                                                    <span>Baca Berita Penuh</span>
                                                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400">Tiada pautan</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <!-- Fallback to static news if no news in database -->
                                <div class="swiper-slide">
                                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-theme-beige/50 flex flex-col justify-between transform hover:-translate-y-1 h-full">
                                        <div>
                                            <div class="relative overflow-hidden bg-theme-dark h-40 sm:h-56">
                                                <img src="{{ asset('images/berita-1.jpeg') }}" alt="Gambar Berita 1" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90 group-hover:opacity-100">
                                                <div class="absolute top-2.5 left-2.5">
                                                    <span class="text-[9px] font-extrabold text-theme-dark bg-theme-yellow px-2 py-0.5 rounded-md uppercase tracking-wider shadow-sm">Kosmo!</span>
                                                </div>
                                            </div>
                                            <div class="p-4 sm:p-5">
                                                <span class="text-[10px] font-semibold text-slate-400 block mb-1">21 Sep 2026</span>
                                                <h3 class="font-extrabold text-xs sm:text-base text-theme-dark group-hover:text-theme-blue transition duration-300 leading-snug line-clamp-2">
                                                    Graduan TVET Mara lanjut pengajian di UK
                                                </h3>
                                                <p class="text-[11px] sm:text-xs text-slate-600 mt-2 line-clamp-2 leading-relaxed">
                                                    Farah Ezreen Anuar, graduan TVET Mara Ledang, membuktikan keupayaan dengan melanjutkan pengajian Master di UK.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 sm:px-5 sm:pb-5">
                                            <a href="https://www.kosmo.com.my/2026/09/21/graduan-tvet-mara-lanjut-pengajian-di-uk/" target="_blank" class="inline-flex items-center text-xs font-bold text-theme-blue hover:text-theme-purple transition gap-1.5">
                                                <span>Baca Berita Penuh</span>
                                                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-pagination pointer-events-auto !bottom-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ABOUT ACETVET & PARTNERS (Directly under Keratan Akhbar) -->
        <div id="tentang-acetvet" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
            <!-- About AceTVET Card -->
            <div data-aos="fade-up" class="bg-gradient-to-br from-white via-theme-cream/40 to-white rounded-3xl p-6 sm:p-10 border border-theme-blue/15 shadow-xl relative overflow-hidden mb-12 sm:mb-16">
                <div class="absolute -top-20 -right-20 w-72 h-72 bg-theme-yellow/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-theme-blue/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-theme-blue/10 border border-theme-blue/20 text-theme-blue text-xs font-bold tracking-widest">
                            <span>🏛️AceTVET</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-theme-dark tracking-tight leading-tight">
                            Peluang Baharu Pendidikan &amp; Masa Depan Kerjaya
                        </h2>
                        <div class="space-y-3 text-slate-700 text-sm sm:text-base leading-relaxed">
                            <p>
                                <strong class="text-theme-dark font-extrabold">AceTVET</strong> bertujuan untuk memperluas peluang pendidikan kepada lepasan SPM, khususnya mereka yang tidak berjaya mendapat tempat di Institusi Pengajian Tinggi Awam (IPTA) disebabkan keputusan akademik atau tidak lulus peperiksaan SPM. Program utama yang ditawarkan oleh AceTVET merangkumi pengajian program Sijil Kemahiran Malaysia (SKM) di bawah TVET Malaysia.
                            </p>
                        </div>
                        <div class="pt-2 flex flex-wrap gap-3">
                            <a href="{{ route('courses.index') }}"
                               class="inline-flex items-center gap-2 bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark font-extrabold px-5 py-2.5 rounded-xl text-xs sm:text-sm transition shadow-md hover:shadow-lg hover:scale-105">
                                <span>Terokai Program Kursus</span>
                            </a>
                            <a href="{{ route('pengenalan') }}"
                               class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-theme-blue border border-theme-blue/20 font-bold px-5 py-2.5 rounded-xl text-xs sm:text-sm transition shadow-sm hover:shadow">
                                <span>Maklumat TVET</span>
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-4 flex justify-center">
                        <div class="w-full max-w-xs sm:max-w-sm rounded-2xl p-6 bg-gradient-to-br from-theme-light via-white to-theme-cream border-2 border-theme-blue/20 shadow-lg text-center transform hover:-translate-y-1 transition duration-300">
                            <div class="h-36 sm:h-44 flex items-center justify-center p-3 bg-white/90 rounded-xl shadow-xs border border-theme-blue/10">
                                <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}" 
                                     alt="Logo AceTVET" 
                                     class="max-h-full max-w-full w-auto object-contain drop-shadow-sm transition-transform duration-300 hover:scale-105">
                            </div>
                            <div class="mt-4 pt-3 border-t border-theme-beige/40">
                                <span class="text-theme-dark font-extrabold text-base block">AceTVET</span>
                                <span class="text-theme-blue font-bold text-[11px] uppercase tracking-wider block mt-0.5">Peneraju Latihan Kemahiran</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PARTNERS SECTION -->
            <div data-aos="fade-up" class="text-center max-w-3xl mx-auto mb-6 sm:mb-8">
                <span class="text-theme-blue font-extrabold text-[10px] sm:text-xs tracking-widest uppercase bg-theme-blue/10 px-3.5 py-1 rounded-full border border-theme-blue/20">
                    Rakan Kolaborasi Strategik
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-theme-dark mt-2.5 tracking-tight">
                    Partners
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1.5">
                    Rakan kerjasama strategik, badan pentauliahan dan institusi pengajian dalam ekosistem latihan kemahiran AceTVET.
                </p>
            </div>

            <!-- Partners Logo Showcase -->
            <div data-aos="fade-up" data-aos-delay="100" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3.5 sm:gap-5">
                <!-- Partner 1: TVET Malaysia -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-tvet-malaysia.png') }}?v={{ time() }}"
                             alt="TVET Malaysia - Empowering the Nation"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        TVET Malaysia
                    </span>
                </div>

                <!-- Partner 2: PTPK -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-ptpk.png') }}?v={{ time() }}"
                             alt="Perbadanan Tabung Pembangunan Kemahiran (PTPK)"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        Tabung Pembangunan Kemahiran (PTPK)
                    </span>
                </div>

                <!-- Partner 3: MQA -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-mqa.png') }}?v={{ time() }}"
                             alt="Agensi Kelayakan Malaysia (MQA)"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        MQA (Agensi Kelayakan Malaysia)
                    </span>
                </div>

                <!-- Partner 4: iCEPS -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-iceps.png') }}?v={{ time() }}"
                             alt="Institute of Continuing Education & Professional Studies (iCEPS)"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        iCEPS (UiTM)
                    </span>
                </div>

                <!-- Partner 5: UTMSPACE -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-utmspace.png') }}?v={{ time() }}"
                             alt="UTMSPACE"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        UTM
                    </span>
                </div>

                <!-- Partner 6: UMCCed -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-umcced.png') }}?v={{ time() }}"
                             alt="University of Malaya Centre for Continuing Education (UMCCed)"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        UM (Universiti Malaya)
                    </span>
                </div>

                <!-- Partner 7: Kolej Teknikal Bumiputera (KTB) -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-ktb.png') }}?v={{ time() }}"
                             alt="Kolej Teknikal Bumiputera"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        Kolej Teknikal Bumiputera
                    </span>
                </div>

                <!-- Partner 8: Kolej Teknikal Ibnu Sina (KTIS) -->
                <div class="group bg-white rounded-2xl p-4 sm:p-5 border border-theme-blue/15 shadow-sm hover:shadow-xl hover:border-theme-accent/50 transition-all duration-300 flex flex-col items-center justify-center transform hover:-translate-y-1">
                    <div class="h-16 sm:h-20 w-full flex items-center justify-center p-1.5">
                        <img src="{{ asset('images/partners/partner-ktis.png') }}?v={{ time() }}"
                             alt="Kolej Teknikal Ibnu Sina"
                             class="max-h-full max-w-full object-contain filter group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="mt-3 text-[11px] sm:text-xs font-bold text-slate-700 text-center line-clamp-1 group-hover:text-theme-blue transition-colors">
                        Kolej Teknikal Ibnu Sina
                    </span>
                </div>
            </div>
        </div>

        <!-- KELEBIHAN ACETVET (Floating modern cards) -->
        <div id="kelebihan-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
            <div data-aos="fade-up" class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
                <span class="text-theme-blue font-extrabold text-[10px] sm:text-xs tracking-widest uppercase bg-theme-blue/10 px-3.5 py-1 rounded-full border border-theme-blue/20">
                    Kelebihan Ekosistem TVET
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-theme-dark mt-2.5 tracking-tight">
                    Mengapa Memilih TVET?
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2">
                    Laluan pantas ke alam kerjaya berpendapatan tinggi melalui penguasaan kemahiran praktikal.
                </p>
            </div>

            <div class="h-scroll md:grid md:grid-cols-3 md:gap-6 -mx-4 px-4 sm:mx-0 sm:px-0">
                <!-- Card 1 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-blue/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-blue/15 text-theme-blue rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-blue group-hover:text-white transition duration-300 shadow-sm">
                            🎯
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Kemahiran Terus Guna</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Graduan memperoleh kemahiran yang terus boleh digunakan di tempat kerja.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-blue text-xs font-bold gap-1">
                        <span>Sedia Bekerja</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-accent/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-accent/15 text-theme-accent rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-accent group-hover:text-white transition duration-300 shadow-sm">
                            🛠️
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Persekitaran Industri Sebenar</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Latihan menggunakan peralatan dan persekitaran industri sebenar.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-accent text-xs font-bold gap-1">
                        <span>Peralatan Moden</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-purple/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-purple/20 text-theme-purple rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-purple group-hover:text-white transition duration-300 shadow-sm">
                            🏫
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Yuran Awam Berpatutan</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Yuran pengajian di institusi awam (ILP, ADTEC) percuma atau sangat rendah.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-purple text-xs font-bold gap-1">
                        <span>Kos Minimum</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-yellow/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-yellow/20 text-theme-yellow rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-yellow group-hover:text-theme-dark transition duration-300 shadow-sm">
                            💰
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Kemudahan Pembiayaan</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            <a href="{{ route('pengenalan') }}" class="text-theme-blue font-bold underline hover:text-theme-accent transition">Pinjaman PTPK</a> tersedia antara RM5,000 hingga RM24,000 untuk institusi swasta.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-yellow text-xs font-bold gap-1">
                        <span>Bantuan PTPK</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-blue/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-blue/15 text-theme-blue rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-blue group-hover:text-white transition duration-300 shadow-sm">
                            🎓
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Pengiktirafan Rasmi</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Sijil <a href="{{ route('pengenalan') }}" class="text-theme-blue font-bold underline hover:text-theme-accent transition">SKM</a>, DKM, dan DLKM diiktiraf oleh JPK, MQA, dan JPA.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-blue text-xs font-bold gap-1">
                        <span>Diiktiraf Kerajaan</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-accent/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-accent/15 text-theme-accent rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-accent group-hover:text-white transition duration-300 shadow-sm">
                            🔍
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Semakan MySPIKE</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Pengesahan sijil SKM boleh disemak melalui sistem MySPIKE JPK oleh majikan.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-accent text-xs font-bold gap-1">
                        <span>Kesahihan Terjamin</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-purple/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-purple/20 text-theme-purple rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-purple group-hover:text-white transition duration-300 shadow-sm">
                            📈
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Laluan Kerjaya Jelas</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Laluan kerjaya jelas dari <a href="{{ route('pengenalan') }}" class="text-theme-blue font-bold underline hover:text-theme-accent transition">SKM Tahap 1</a> hingga Ijazah Sarjana Muda Teknologi Tahap 6.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-purple text-xs font-bold gap-1">
                        <span>Peningkatan Tahap</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-yellow/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-yellow/20 text-theme-yellow rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-yellow group-hover:text-theme-dark transition duration-300 shadow-sm">
                            🚀
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Peluang Keusahawanan</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Peluang keusahawanan dengan kemahiran praktikal selepas tamat pengajian.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-yellow text-xs font-bold gap-1">
                        <span>Bina Perniagaan</span>
                        <span>✓</span>
                    </div>
                </div>

                <!-- Card 9 -->
                <div class="group w-72 sm:w-auto p-5 sm:p-7 bg-white rounded-2xl border border-theme-beige/30 shadow-md hover:shadow-2xl hover:border-theme-blue/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1">
                    <div>
                        <div class="w-12 h-12 bg-theme-blue/15 text-theme-blue rounded-2xl flex items-center justify-center text-2xl mb-4 group-hover:bg-theme-blue group-hover:text-white transition duration-300 shadow-sm">
                            🏛️
                        </div>
                        <h3 class="font-extrabold text-base sm:text-lg text-theme-dark mb-2 leading-tight">Peluang Sektor Awam</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Jabatan Perkhidmatan Awam (JPA) mengiktiraf SKM untuk jawatan teknikal kerajaan.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-theme-beige/30 flex items-center text-theme-blue text-xs font-bold gap-1">
                        <span>Jawatan Awam</span>
                        <span>✓</span>
                    </div>
                </div>
            </div>
            <p class="text-center text-[10px] text-slate-400 mt-2 md:hidden"></p>
        </div>

        <!-- SPOTLIGHT KURSUS TEKSTIKAL (Floating Banner with CTA) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-gradient-to-r from-theme-dark via-theme-blue to-theme-purple text-white rounded-3xl p-6 sm:p-10 shadow-2xl border border-theme-purple/30 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-80 h-80 bg-theme-yellow/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div class="max-w-2xl text-center lg:text-left">
                        <span class="text-theme-yellow text-xs font-extrabold uppercase tracking-widest bg-theme-yellow/15 px-3 py-1 rounded-full border border-theme-yellow/30">
                            Terokai Kursus
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-extrabold mt-3 leading-tight">
                            Pilih Bidang Minat Anda Sekarang
                        </h2>
                        <p class="text-slate-200 text-xs sm:text-sm mt-2 leading-relaxed">
                            Automotif, Kulinari, Pastri, Kimpalan, Elektrik, Penyamanan Udara dan banyak lagi kursus teknikal menanti anda.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                        <a href="{{ route('courses.index') }}"
                           class="bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark font-extrabold px-6 py-3.5 rounded-xl text-sm transition shadow-lg hover:shadow-xl hover:scale-105 flex items-center justify-center gap-2">
                            <span>Lihat Semua Kursus</span>
                            <span>🔍</span>
                        </a>
                        <a href="{{ route('up-tvet.form') }}"
                           class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold px-6 py-3.5 rounded-xl text-sm transition backdrop-blur-md flex items-center justify-center gap-2 cursor-pointer">
                            <span>Daftar Permohonan</span>
                            <span>✍️</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="bg-theme-dark text-slate-400 py-8 text-xs sm:text-sm border-t border-theme-purple/30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 pb-6 border-b border-theme-purple/20">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}" alt="AceTVET" class="h-9 w-auto">
                        <div>
                            <span class="text-white font-extrabold text-base tracking-tight block">AceTVET Portal</span>
                            <span class="text-[10px] text-theme-yellow">Sistem Pengurusan & Permohonan TVET</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-6 text-[11px] text-slate-500">
                    <p>&copy; {{ date('Y') }} AceTVET Malaysia. Hak Cipta Terpelihara.</p>
                    <p>Dibina untuk memperkasakan pendidikan kemahiran teknikal negara.</p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

        <script>
            window.addEventListener('load', () => {
                setTimeout(() => {
                    const preloader = document.getElementById('preloader');
                    if (preloader) {
                        preloader.classList.add('preloader-hidden');
                    }
                    document.getElementById('body-content').classList.remove('overflow-hidden');
                    AOS.init({ duration: 500, once: true });

                    // Handle bfcache
                    window.addEventListener('pageshow', (event) => {
                        if (event.persisted && preloader) {
                            preloader.classList.add('preloader-hidden');
                        }
                    });

                    // Trigger preloader on leaving page via links
                    document.addEventListener('click', (e) => {
                        const link = e.target.closest('a');
                        if (!link) return;
                        const href = link.getAttribute('href');
                        const target = link.getAttribute('target');
                        if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:') || target === '_blank' || link.hasAttribute('download')) {
                            return;
                        }
                        try {
                            const url = new URL(link.href, window.location.origin);
                            if (url.origin === window.location.origin) {
                                if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash !== '') {
                                    return;
                                }
                                if (preloader) {
                                    preloader.classList.remove('preloader-hidden');
                                }
                            }
                        } catch (err) {}
                    });

                    // Initialize news swiper after AOS
                    setTimeout(() => {
                        const newsSwiper = new Swiper(".newsSwiper", {
                            loop: true,
                            autoplay: { delay: 4000, disableOnInteraction: false },
                            pagination: { el: ".swiper-pagination", clickable: true },
                            navigation: {
                                nextEl: ".news-swiper-button-next",
                                prevEl: ".news-swiper-button-prev",
                            },
                            breakpoints: {
                                0: { slidesPerView: 1, spaceBetween: 20 },
                                640: { slidesPerView: 2, spaceBetween: 24 },
                                1024: { slidesPerView: 3, spaceBetween: 32 },
                            },
                            autoHeight: false,
                            observer: true,
                            observeParents: true,
                        });
                    }, 200);
                }, 600);
            });

            const heroSwiper = new Swiper(".heroSwiper", {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { el: ".swiper-pagination", clickable: true },
                autoHeight: false,
            });

            particlesJS("particles-js", {
                "particles": {
                    "number": { "value": 35, "density": { "enable": true, "value_area": 800 } },
                    "color": { "value": "#6666ff" },
                    "shape": { "type": "circle" },
                    "opacity": { "value": 0.3, "random": false },
                    "size": { "value": 3, "random": true },
                    "line_linked": { "enable": true, "distance": 130, "color": "#b8b8ff", "opacity": 0.2, "width": 1 },
                    "move": { "enable": true, "speed": 1.2, "direction": "none", "out_mode": "out" }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" } },
                    "modes": { "grab": { "distance": 120, "line_linked": { "opacity": 0.5 } } }
                },
                "retina_detect": true
            });
        </script>

        <!-- Modal Permohonan UP_TVET -->
        <x-up-tvet-modal />

        <!-- PWA Service Worker Registration -->
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js?version=acetvet-v9')
                        .then(function(registration) {
                            console.log('Service Worker registered with scope:', registration.scope);
                            // Do NOT force update - let it load naturally
                        }, function(err) {
                            console.log('Service Worker registration failed:', err);
                            // Continue without service worker if it fails
                        });
                });
            }
        </script>
    </body>
</html>