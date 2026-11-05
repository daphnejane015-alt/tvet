<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-theme-dark leading-tight">
            {{ __('Pengenalan TVET') }}
        </h2>
    </x-slot>

    <div x-data="{ activeTab: 'tvet' }" class="bg-gradient-to-b from-theme-cream via-white to-theme-light min-h-screen">
        <!-- BREADCRUMB / HEADER PAGE -->
        <div class="relative bg-gradient-to-br from-theme-dark via-theme-blue to-theme-purple text-white py-8 md:py-12 border-b border-theme-purple/30 overflow-hidden">
            <div class="absolute -top-16 -left-16 w-80 h-80 bg-theme-accent/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-16 -right-16 w-80 h-80 bg-theme-yellow/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- LEFT COLUMN: TITLE & INTRO TEXT -->
                    <div class="lg:col-span-7 space-y-3">
                        <span class="text-theme-yellow text-[10px] md:text-xs font-bold tracking-widest uppercase bg-theme-yellow/15 px-3 py-1 rounded-full border border-theme-yellow/30 inline-block">
                            Maklumat Rasmi
                        </span>
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight">
                            Pengenalan TVET, JPK & KESUMA & PTPK
                        </h1>
                        <p class="text-slate-200 text-xs sm:text-sm max-w-2xl leading-relaxed">
                            Sistem Latihan Kemahiran Kebangsaan, institusi pelaksana serta kementerian peneraju agenda kecemerlangan modal insan AceTVET.
                        </p>
                    </div>

                    <!-- RIGHT COLUMN: AUTOMATIC LOGO SLIDES CAROUSEL -->
                    <div class="lg:col-span-5 flex justify-center lg:justify-end">
                        <div x-data="{
                                activeSlide: 0,
                                slides: [
                                    {
                                        name: 'TVET Malaysia',
                                        subtitle: 'Empowering the Nation',
                                        src: '{{ asset('images/logo-tvet-malaysia.png') }}',
                                        badge: 'TVET Malaysia'
                                    },
                                    {
                                        name: 'AceTVET',
                                        subtitle: 'Peneraju Latihan Kemahiran',
                                        src: '{{ asset('images/logo-acetvet-new.png') }}',
                                        badge: 'Portal Rasmi'
                                    },
                                    {
                                        name: 'Jabatan Pembangunan Kemahiran',
                                        subtitle: 'Agensi Pelaksana TVET Kebangsaan',
                                        src: '{{ asset('images/logo-jpk.png') }}',
                                        badge: 'JPK'
                                    },
                                    {
                                        name: 'Kementerian Sumber Manusia',
                                        subtitle: 'Kementerian Peneraju Agenda Kemahiran',
                                        src: '{{ asset('images/logo-kesuma.png') }}',
                                        badge: 'KESUMA / KSM'
                                    },
                                    {
                                        name: 'Tabung Pembangunan Kemahiran',
                                        subtitle: 'Agensi Pembiaya Utama Latihan Kemahiran',
                                        src: '{{ asset('images/logo-ptpk.png') }}',
                                        badge: 'PTPK'
                                    }
                                ],
                                timer: null,
                                startAutoplay() {
                                    this.stopAutoplay();
                                    this.timer = setInterval(() => {
                                        this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                                    }, 3000);
                                },
                                stopAutoplay() {
                                    if (this.timer) {
                                        clearInterval(this.timer);
                                        this.timer = null;
                                    }
                                },
                                goToSlide(index) {
                                    this.activeSlide = index;
                                    // Restart timer so it immediately resets the 3-second cycle without stopping
                                    this.startAutoplay();
                                }
                             }"
                             x-init="startAutoplay()"
                             class="relative w-full max-w-md sm:max-w-lg bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-5 sm:p-6 shadow-2xl overflow-hidden group">
                            
                            <!-- Slide Items -->
                            <div class="relative h-56 sm:h-64 flex items-center justify-center">
                                <template x-for="(slide, index) in slides" :key="index">
                                    <div x-show="activeSlide === index"
                                         x-transition:enter="transition ease-out duration-500 transform"
                                         x-transition:enter-start="opacity-0 translate-x-12 scale-95"
                                         x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                                         x-transition:leave="transition ease-in duration-300 transform absolute inset-0"
                                         x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                                         x-transition:leave-end="opacity-0 -translate-x-12 scale-95"
                                         class="w-full h-full flex flex-col items-center justify-center text-center">
                                        
                                        <!-- White Box Container for High Logo Contrast - Enlarged -->
                                        <div class="h-32 sm:h-36 w-60 sm:w-72 bg-white/95 rounded-2xl p-3 sm:p-4 shadow-lg border border-white/30 flex items-center justify-center">
                                            <img :src="slide.src" 
                                                 :alt="slide.name" 
                                                 class="max-h-full max-w-full w-auto object-contain drop-shadow-sm transition-transform duration-300 hover:scale-105">
                                        </div>

                                        <!-- Caption & Badge -->
                                        <div class="mt-3.5">
                                            <div class="flex items-center justify-center gap-2">
                                                <span class="text-[10px] sm:text-xs font-extrabold uppercase tracking-wider bg-theme-accent text-white px-3 py-0.5 rounded-full shadow-sm" x-text="slide.badge"></span>
                                                <span class="text-white font-extrabold text-xs sm:text-sm md:text-base tracking-tight truncate max-w-[260px] sm:max-w-xs" x-text="slide.name"></span>
                                            </div>
                                            <p class="text-[11px] sm:text-xs text-theme-yellow font-semibold mt-1" x-text="slide.subtitle"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Interactive Dot Indicators (Clickable, Re-starts Auto-slide Cleanly) -->
                            <div class="flex items-center justify-center gap-2 mt-3 z-10 relative">
                                <template x-for="(slide, index) in slides" :key="index">
                                    <button type="button"
                                            @click="goToSlide(index)"
                                            :aria-label="'Pergi ke slaid ' + slide.name"
                                            :title="slide.name"
                                            :class="activeSlide === index 
                                                ? 'w-7 bg-theme-yellow shadow-md ring-2 ring-theme-yellow/50' 
                                                : 'w-2.5 bg-white/40 hover:bg-white/80 hover:scale-125'"
                                            class="h-2.5 rounded-full transition-all duration-300 focus:outline-none cursor-pointer"></button>
                                </template>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- STICKY TAB NAVIGATION FOR MOBILE & DESKTOP -->
        <div class="sticky top-16 z-20 bg-white/95 backdrop-blur-md border-b border-theme-beige/50 shadow-sm">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <nav class="flex space-x-2 md:space-x-3 overflow-x-auto py-3 scrollbar-none" aria-label="Tabs">
                    <button
                        @click="activeTab = 'tvet'"
                        :class="activeTab === 'tvet' ? 'bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark shadow-md shadow-theme-accent/30 font-extrabold' : 'text-slate-700 hover:bg-slate-100 font-bold'"
                        class="px-4 py-2 text-xs md:text-sm rounded-xl whitespace-nowrap transition-all duration-200 cursor-pointer">
                        💡 Pengenalan TVET
                    </button>
                    <button
                        @click="activeTab = 'syarat'"
                        :class="activeTab === 'syarat' ? 'bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark shadow-md shadow-theme-accent/30 font-extrabold' : 'text-slate-700 hover:bg-slate-100 font-bold'"
                        class="px-4 py-2 text-xs md:text-sm rounded-xl whitespace-nowrap transition-all duration-200 cursor-pointer">
                        📋 Syarat Kemasukan
                    </button>
                    <button
                        @click="activeTab = 'jpk-kesuma'"
                        :class="activeTab === 'jpk-kesuma' ? 'bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark shadow-md shadow-theme-accent/30 font-extrabold' : 'text-slate-700 hover:bg-slate-100 font-bold'"
                        class="px-4 py-2 text-xs md:text-sm rounded-xl whitespace-nowrap transition-all duration-200 cursor-pointer">
                        🏛️ JPK & KESUMA & PTPK
                    </button>
                </nav>
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            
            <!-- TAB 1: PENGENALAN TVET -->
            <div x-show="activeTab === 'tvet'" x-transition:enter="transition ease-out duration-200 transform opacity-0 scale-98" x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100">
                <div class="bg-white rounded-3xl p-6 md:p-10 border border-theme-beige/50 shadow-lg">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        <div class="lg:col-span-7 space-y-5 order-1">
                            <div>
                                <span class="text-theme-blue font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-blue/10 px-3 py-1 rounded-full border border-theme-blue/20">
                                    Info Utama
                                </span>
                                <h2 class="text-2xl md:text-3xl font-extrabold text-theme-dark mt-2.5">Apakah itu TVET?</h2>
                            </div>

                            <p class="text-slate-600 leading-relaxed text-sm md:text-base">
                                <span class="font-bold text-theme-dark">TVET</span> ialah singkatan kepada
                                <span class="font-bold text-theme-dark">Pendidikan dan Latihan Teknikal dan Vokasional</span>
                                (Technical and Vocational Education and Training). TVET merupakan laluan pendidikan dan
                                latihan yang menjurus ke arah penguasaan kemahiran praktikal, teknologi industri, dan persiapan mempunyai kerjaya berpendapatan tinggi.
                            </p>

                            <div class="bg-gradient-to-r from-theme-light/50 via-white to-white p-5 rounded-2xl border-l-4 border-theme-blue text-slate-700 text-xs md:text-sm leading-relaxed space-y-2">
                                <p class="font-semibold text-theme-dark">Pembelajaran Bersepadu Sepanjang Hayat</p>
                                <p>
                                    TVET merangkumi latihan lepasan sekolah menengah sehingga ke tahap profesional industri melalui pentauliahan kemahiran berasaskan amalan kerja (work-based learning) serta pensijilan berterusan.
                                </p>
                            </div>

                            <div class="pt-2 flex flex-wrap gap-3">
                                <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark font-extrabold px-5 py-2.5 rounded-xl text-xs sm:text-sm transition shadow-md">
                                    <span>Lihat Pilihan Kursus</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-5 flex flex-col items-center order-2">
                            <div class="w-full max-w-xs sm:max-w-sm rounded-2xl p-6 bg-gradient-to-br from-theme-light via-white to-theme-cream border-2 border-theme-blue/20 hover:border-theme-accent shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-center">
                                <div class="h-36 md:h-44 flex items-center justify-center p-2 bg-white/90 rounded-xl shadow-sm border border-theme-blue/10">
                                    <img src="{{ asset('images/logo-tvet-malaysia.png') }}?v={{ file_exists(public_path('images/logo-tvet-malaysia.png')) ? filemtime(public_path('images/logo-tvet-malaysia.png')) : time() }}" 
                                         alt="Logo TVET Malaysia" 
                                         class="max-h-full max-w-full w-auto object-contain mx-auto drop-shadow-sm transition-transform duration-300 hover:scale-105">
                                </div>
                                <div class="mt-4 pt-3 border-t border-theme-beige/40">
                                    <span class="text-theme-dark font-extrabold text-base block">TVET Malaysia</span>
                                    <span class="text-theme-blue font-bold text-[11px] uppercase tracking-wider block mt-0.5">Empowering the Nation</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BOX 2: ADAKAH SIJIL TVET DIIKTIRAF? -->
                <div class="mt-8 bg-white rounded-3xl p-6 md:p-10 border border-theme-beige/50 shadow-lg"
                     x-data="{ showModal: false }">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        
                        <!-- LEFT SIDE ON DESKTOP, TOP ON MOBILE: DESCRIPTION & ACCREDITATION DETAILS -->
                        <div class="lg:col-span-7 space-y-5 order-1">
                            <div>
                                <span class="text-theme-accent font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-accent/10 px-3 py-1 rounded-full border border-theme-accent/20">
                                    Pentauliahan &amp; Pengiktirafan
                                </span>
                                <h2 class="text-2xl md:text-3xl font-extrabold text-theme-dark mt-2.5">
                                    Adakah sijil TVET diiktiraf ?
                                </h2>
                            </div>

                            <p class="text-slate-700 leading-relaxed text-sm md:text-base font-medium">
                                SKM, DKM, dan DLKM diiktiraf oleh JPK di bawah Akta 652. Sijil ini berdaftar dalam Daftar Kelayakan Malaysia (MQR) di bawah MQA. Jabatan Perkhidmatan Awam (JPA) turut mengiktiraf SKM untuk jawatan teknikal dalam perkhidmatan kerajaan.
                            </p>

                            <!-- FEATURE HIGHLIGHT PILLS -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                                <div class="bg-gradient-to-br from-theme-light to-white p-3.5 rounded-2xl border border-theme-beige/50 shadow-sm flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-theme-blue/15 text-theme-blue flex items-center justify-center font-extrabold text-sm shrink-0">
                                        ⚖️
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-theme-dark">Akta 652</h4>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Pengiktirafan rasmi JPK di bawah Akta Pembangunan Kemahiran Kebangsaan.</p>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-theme-light to-white p-3.5 rounded-2xl border border-theme-beige/50 shadow-sm flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-theme-accent/15 text-theme-accent flex items-center justify-center font-extrabold text-sm shrink-0">
                                        🎓
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-theme-dark">MQR &amp; MQA</h4>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Tersenarai dalam Kerangka Kelayakan Malaysia (MQF).</p>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-theme-light to-white p-3.5 rounded-2xl border border-theme-beige/50 shadow-sm flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-theme-yellow/30 text-theme-dark flex items-center justify-center font-extrabold text-sm shrink-0">
                                        🏛️
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-extrabold text-theme-dark">JPA Diiktiraf</h4>
                                        <p class="text-[11px] text-slate-500 leading-tight mt-0.5">Layak untuk pelantikan jawatan teknikal sektor awam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE ON DESKTOP, BOTTOM ON MOBILE: SIJIL IMAGE WITH CLICK-TO-ENLARGE -->
                        <div class="lg:col-span-5 flex flex-col items-center order-2">
                            <div @click="showModal = true"
                                 class="group relative cursor-pointer rounded-2xl p-2.5 bg-gradient-to-br from-theme-light via-white to-theme-cream border-2 border-theme-blue/20 hover:border-theme-accent shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                
                                <div class="relative overflow-hidden rounded-xl">
                                    <img src="{{ asset('images/contoh-sijil-skm.png') }}?v={{ file_exists(public_path('images/contoh-sijil-skm.png')) ? filemtime(public_path('images/contoh-sijil-skm.png')) : time() }}" 
                                         alt="Contoh Sijil Kemahiran Malaysia (SKM)" 
                                         class="w-56 sm:w-64 md:w-72 h-auto max-h-96 object-contain rounded-lg transition-transform duration-300 group-hover:scale-105 shadow-inner">
                                    
                                    <!-- Hover Overlay Badge -->
                                    <div class="absolute inset-0 bg-theme-dark/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center text-white p-3 text-center rounded-lg backdrop-blur-[1.5px]">
                                        <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center mb-2 shadow-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-extrabold tracking-wide uppercase bg-theme-accent px-2.5 py-1 rounded-md shadow">Klik untuk besarkan</span>
                                    </div>
                                </div>
                            </div>

                            <!-- NOTE BELOW IMAGE -->
                            <div class="mt-3 text-center">
                                <span class="inline-block text-[11px] sm:text-xs font-extrabold tracking-wider text-theme-blue uppercase bg-theme-blue/10 px-3.5 py-1.5 rounded-full border border-theme-blue/25 shadow-sm">
                                    CONTOH SIJIL DIIKTIRAF MQA &amp; MQF
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- IMAGE POPUP / MODAL (LIGHTBOX) -->
                    <div x-show="showModal" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @keydown.escape.window="showModal = false"
                         class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 bg-theme-dark/80 backdrop-blur-md"
                         style="display: none;">
                        
                        <!-- Backdrop click to close -->
                        <div class="absolute inset-0" @click="showModal = false"></div>

                        <!-- Modal Window -->
                        <div class="relative bg-white rounded-3xl max-w-2xl w-full max-h-[92vh] flex flex-col overflow-hidden shadow-2xl border border-white/20 z-10"
                             @click.stop>
                            
                            <!-- Floating Close Button -->
                            <button @click="showModal = false" 
                                    type="button"
                                    class="absolute top-4 right-4 z-20 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900/80 text-white flex items-center justify-center transition shadow-md backdrop-blur-sm focus:outline-none"
                                    title="Tutup">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <!-- Image Container with Scrollable Area -->
                            <div class="p-4 sm:p-6 overflow-y-auto max-h-[92vh] flex flex-col items-center justify-center bg-slate-50">
                                <img src="{{ asset('images/contoh-sijil-skm.png') }}?v={{ file_exists(public_path('images/contoh-sijil-skm.png')) ? filemtime(public_path('images/contoh-sijil-skm.png')) : time() }}" 
                                     alt="Pratonton Sijil Kemahiran Malaysia" 
                                     class="w-auto h-auto max-h-[78vh] object-contain rounded-xl shadow-lg border border-slate-200">
                                
                                <p class="text-center text-xs font-bold text-theme-blue mt-4 bg-theme-blue/10 px-4 py-1.5 rounded-full border border-theme-blue/20">
                                    CONTOH SIJIL DIIKTIRAF MQA &amp; MQF
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- BOX 3: TAHAP KELAYAKAN TVET -->
                <div class="mt-8 bg-white rounded-3xl p-6 md:p-10 border border-theme-beige/50 shadow-lg space-y-6">
                    <div>
                        <span class="text-theme-blue font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-blue/10 px-3 py-1 rounded-full border border-theme-blue/20">
                            Kerangka Kelayakan
                        </span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-theme-dark mt-2.5">
                            Tahap kelayakan TVET
                        </h2>
                        <p class="text-slate-700 leading-relaxed text-sm md:text-base font-medium mt-3 max-w-4xl">
                            SKM dikeluarkan oleh JPK di bawah KSM. SVM dan DVM dikeluarkan oleh BPLTV di bawah KPM. Kedua-dua laluan diiktiraf dalam MQF.
                        </p>
                    </div>

                    <!-- TAHAP KELAYAKAN TABLE -->
                    <div class="overflow-x-auto rounded-2xl border border-theme-beige/60 shadow-sm">
                        <table class="w-full text-left text-xs sm:text-sm border-collapse bg-white">
                            <thead>
                                <tr class="bg-gradient-to-r from-theme-light via-slate-100 to-theme-light text-theme-dark border-b border-theme-beige/60 font-extrabold">
                                    <th scope="col" class="py-4 px-4 sm:px-6 whitespace-nowrap">Tahap MQF</th>
                                    <th scope="col" class="py-4 px-4 sm:px-6">Nama Kelayakan</th>
                                    <th scope="col" class="py-4 px-4 sm:px-6 whitespace-nowrap">Singkatan</th>
                                    <th scope="col" class="py-4 px-4 sm:px-6 whitespace-nowrap">Tempoh</th>
                                    <th scope="col" class="py-4 px-4 sm:px-6 whitespace-nowrap">Badan Pensijil</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-theme-blue/10 text-theme-blue font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-theme-blue/20">Tahap 1</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Sijil Kemahiran Malaysia Tahap 1</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">SKM 1</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">6 hingga 12 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">JPK</td>
                                </tr>

                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-theme-blue/10 text-theme-blue font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-theme-blue/20">Tahap 2</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Sijil Kemahiran Malaysia Tahap 2</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">SKM 2</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">12 hingga 18 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">JPK</td>
                                </tr>

                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-theme-blue/10 text-theme-blue font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-theme-blue/20">Tahap 3</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Sijil Kemahiran Malaysia Tahap 3</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">SKM 3</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">24 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">JPK</td>
                                </tr>

                                <tr class="hover:bg-theme-light/40 transition bg-slate-50/50">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-theme-accent/15 text-theme-accent font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-theme-accent/20">Tahap 3</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Sijil Vokasional Malaysia</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">SVM</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">24 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">KPM</td>
                                </tr>

                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-theme-purple/20 text-theme-purple font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-theme-purple/30">Tahap 4</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Diploma Kemahiran Malaysia</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">DKM</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">30 hingga 36 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">JPK</td>
                                </tr>

                                <tr class="hover:bg-theme-light/40 transition bg-slate-50/50">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-theme-purple/20 text-theme-purple font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-theme-purple/30">Tahap 4</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Diploma Vokasional Malaysia</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">DVM</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">24 hingga 30 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">KPM</td>
                                </tr>

                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-theme-yellow/30 text-theme-dark font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-theme-yellow/50">Tahap 5</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Diploma Lanjutan Kemahiran Malaysia</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">DLKM</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">24 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">JPK</td>
                                </tr>

                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark whitespace-nowrap">
                                        <span class="inline-block bg-teal-100 text-teal-800 font-extrabold text-xs px-2.5 py-0.5 rounded-md border border-teal-300">Tahap 6</span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Ijazah Sarjana Muda Teknologi</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-slate-400 whitespace-nowrap">-</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap">48 bulan</td>
                                    <td class="py-3.5 px-4 sm:px-6 whitespace-nowrap font-bold text-slate-800">Politeknik</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- BOX 4: TIGA LALUAN MENDAPATKAN SIJIL TVET MALAYSIA -->
                <div class="mt-8 bg-white rounded-3xl p-6 md:p-10 border border-theme-beige/50 shadow-lg space-y-6">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <div>
                            <span class="text-theme-accent font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-accent/10 px-3 py-1 rounded-full border border-theme-accent/20">
                                Laluan Pensijilan Kemahiran
                            </span>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-theme-dark mt-2.5">
                                Tiga laluan mendapatkan sijil TVET Malaysia
                            </h2>
                            <p class="text-slate-700 leading-relaxed text-sm md:text-base font-medium mt-3 max-w-4xl">
                                Terdapat tiga laluan utama untuk mendapatkan sijil kemahiran di bawah JPK:
                            </p>
                        </div>

                        <!-- Swipe indicator for mobile view -->
                        <div class="md:hidden flex items-center gap-1.5 text-xs text-theme-accent font-bold bg-theme-accent/10 px-3 py-1 rounded-full border border-theme-accent/25">
                            <span>Slide ke kanan</span>
                            <span>→</span>
                        </div>
                    </div>

                    <!-- 3 INTERACTIVE ROUTE CARDS: SLIDE HORIZONTALLY ON MOBILE, GRID ON TABLET/DESKTOP -->
                    <div class="flex md:grid md:grid-cols-3 gap-5 md:gap-6 overflow-x-auto pb-4 md:pb-0 pt-2 -mx-2 px-2 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-theme-accent/30 scroll-smooth">
                        
                        <!-- LALUAN 1 -->
                        <div class="w-[85vw] max-w-[320px] md:w-auto shrink-0 snap-center bg-gradient-to-b from-[#FFFDF9] to-[#FFF5EB] rounded-3xl border-2 border-[#FFA043]/30 hover:border-[#FFA043] shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-1">
                            <!-- Header with Badge & Illustration -->
                            <div class="bg-gradient-to-r from-[#FF5E00] via-[#FF7700] to-[#FFA000] p-4 text-white flex items-center justify-between gap-3 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-white text-[#FF5E00] flex items-center justify-center font-black text-xl shrink-0 shadow-md">
                                        1
                                    </div>
                                    <div class="leading-tight">
                                        <span class="text-[11px] font-black uppercase tracking-wider block text-white/95">Sistem Latihan</span>
                                        <h3 class="text-xs sm:text-sm font-black uppercase text-white">Penuh Masa (SLaPB)</h3>
                                    </div>
                                </div>
                                <div class="w-12 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-xl shrink-0">
                                    🏫
                                </div>
                            </div>

                            <!-- Content Points -->
                            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                                <ul class="space-y-4 text-xs sm:text-sm text-slate-700 leading-relaxed">
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>Pelajar mengikuti latihan sepenuh masa di pusat bertauliah yang berdaftar dengan JPK.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>Latihan merangkumi teori dan amali mengikut SKPK.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>Tempoh bergantung kepada tahap kelayakan.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- LALUAN 2 -->
                        <div class="w-[85vw] max-w-[320px] md:w-auto shrink-0 snap-center bg-gradient-to-b from-[#FFFDF9] to-[#FFF5EB] rounded-3xl border-2 border-[#FFA043]/30 hover:border-[#FFA043] shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-1">
                            <!-- Header with Badge & Illustration -->
                            <div class="bg-gradient-to-r from-[#FF5E00] via-[#FF7700] to-[#FFA000] p-4 text-white flex items-center justify-between gap-3 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-white text-[#FF5E00] flex items-center justify-center font-black text-xl shrink-0 shadow-md">
                                        2
                                    </div>
                                    <div class="leading-tight">
                                        <span class="text-[11px] font-black uppercase tracking-wider block text-white/95">Sistem Latihan</span>
                                        <h3 class="text-xs sm:text-sm font-black uppercase text-white">Dual Nasional (SLDN)</h3>
                                    </div>
                                </div>
                                <div class="w-12 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-xl shrink-0">
                                    🏭
                                </div>
                            </div>

                            <!-- Content Points -->
                            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                                <ul class="space-y-4 text-xs sm:text-sm text-slate-700 leading-relaxed">
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>Pelajar berlatih di dua lokasi: pusat latihan dan syarikat industri.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>Nisbah masa di industri biasanya 70% hingga 80%.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>SLDN sesuai untuk pelajar yang ingin pengalaman kerja sebenar semasa latihan.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>Syarikat rakan industri menyediakan mentor dan peralatan.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- LALUAN 3 -->
                        <div class="w-[85vw] max-w-[320px] md:w-auto shrink-0 snap-center bg-gradient-to-b from-[#FFFDF9] to-[#FFF5EB] rounded-3xl border-2 border-[#FFA043]/30 hover:border-[#FFA043] shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-1">
                            <!-- Header with Badge & Illustration -->
                            <div class="bg-gradient-to-r from-[#FF5E00] via-[#FF7700] to-[#FFA000] p-4 text-white flex items-center justify-between gap-3 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-white text-[#FF5E00] flex items-center justify-center font-black text-xl shrink-0 shadow-md">
                                        3
                                    </div>
                                    <div class="leading-tight">
                                        <span class="text-[11px] font-black uppercase tracking-wider block text-white/95">Pentauliahan</span>
                                        <h3 class="text-xs sm:text-sm font-black uppercase text-white leading-tight">Pencapaian Terdahulu (PPT)</h3>
                                    </div>
                                </div>
                                <div class="w-12 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-xl shrink-0">
                                    📜
                                </div>
                            </div>

                            <!-- Content Points -->
                            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                                <ul class="space-y-4 text-xs sm:text-sm text-slate-700 leading-relaxed">
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>Pekerja yang sudah mempunyai pengalaman kerja boleh mendapatkan SKM tanpa mengikuti latihan formal.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>JPK menilai kemahiran sedia ada melalui penilaian praktikal dan portfolio.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-[#FF5E00] shrink-0 mt-1.5 shadow-sm"></span>
                                        <span>PPT sesuai untuk pekerja berpengalaman yang belum mempunyai sijil rasmi.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- BOX 5: APAKAH PERBEZAAN TVET DAN UNIVERSITI? -->
                <div class="mt-8 bg-white rounded-3xl p-6 md:p-10 border border-theme-beige/50 shadow-lg space-y-6">
                    <div>
                        <span class="text-theme-blue font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-blue/10 px-3 py-1 rounded-full border border-theme-blue/20">
                            Perbandingan Pendidikan
                        </span>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-theme-dark mt-2.5">
                            Apakah perbezaan TVET dan Universiti?
                        </h2>
                        <p class="text-slate-700 leading-relaxed text-sm md:text-base font-medium mt-3 max-w-4xl">
                            Ketahui perbezaan utama antara laluan Pendidikan Teknikal &amp; Latihan Vokasional (TVET) berbanding pengajian akademik di Universiti bagi merancang hala tuju kerjaya anda:
                        </p>
                    </div>

                    <!-- COMPARISON TABLE -->
                    <div class="overflow-x-auto rounded-2xl border border-theme-beige/60 shadow-sm">
                        <table class="w-full text-left text-xs sm:text-sm border-collapse bg-white">
                            <thead>
                                <tr class="bg-gradient-to-r from-theme-light via-slate-100 to-theme-light text-theme-dark border-b border-theme-beige/60 font-extrabold">
                                    <th scope="col" class="py-4 px-4 sm:px-6 w-1/4 font-black">Aspek</th>
                                    <th scope="col" class="py-4 px-4 sm:px-6 w-3/8 text-theme-accent font-black">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2.5 h-2.5 rounded-full bg-theme-accent"></span>
                                            <span>TVET</span>
                                        </div>
                                    </th>
                                    <th scope="col" class="py-4 px-4 sm:px-6 w-3/8 text-theme-blue font-black">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2.5 h-2.5 rounded-full bg-theme-blue"></span>
                                            <span>Universiti</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Fokus</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Kemahiran praktikal dan teknikal</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">Teori akademik dan penyelidikan</td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition bg-slate-50/40">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Nisbah praktikal:teori</td>
                                    <td class="py-3.5 px-4 sm:px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-black bg-theme-accent/15 text-theme-dark border border-theme-accent/30">
                                            70:30
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            30:70
                                        </span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Tempoh pengajian</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">6 bulan hingga 4 tahun</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">3 hingga 5 tahun</td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition bg-slate-50/40">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Kos purata</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Percuma (awam) hingga RM20,000 (swasta)</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">RM10,000 hingga RM50,000+</td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Kelayakan masuk minimum</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">PT3 (SKM Tahap 1)</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">SPM (diploma), STPM (ijazah)</td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition bg-slate-50/40">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Badan pensijilan</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">JPK (KSM) dan BPLTV (KPM)</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">MQA (KPT)</td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Pembiayaan</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">Pinjaman PTPK</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">Pinjaman PTPTN</td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition bg-slate-50/40">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Kebolehpasaran</td>
                                    <td class="py-3.5 px-4 sm:px-6">
                                        <span class="inline-flex items-center gap-1.5 font-black text-theme-accent bg-theme-accent/10 px-2.5 py-1 rounded-lg border border-theme-accent/20">
                                            <span>✓</span>
                                            <span>83.1% dalam 3 bulan</span>
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">66.3% dalam 6 bulan (KPT, 2024)</td>
                                </tr>
                                <tr class="hover:bg-theme-light/40 transition">
                                    <td class="py-3.5 px-4 sm:px-6 font-extrabold text-theme-dark">Laluan perantisan</td>
                                    <td class="py-3.5 px-4 sm:px-6 font-semibold text-slate-800">SLDN (industri + latihan)</td>
                                    <td class="py-3.5 px-4 sm:px-6 text-slate-600">Latihan industri 1 semester</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB 2: SYARAT AM KEMASUKAN -->
            <div x-show="activeTab === 'syarat'" x-transition:enter="transition ease-out duration-200 transform opacity-0 scale-98" x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100" style="display: none;">
                <div class="max-w-3xl mx-auto bg-white rounded-3xl p-6 md:p-10 border border-theme-beige/50 shadow-lg">
                    <div class="text-center mb-8">
                        <span class="text-theme-purple font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-purple/30 px-3.5 py-1 rounded-full border border-theme-purple/50">
                            Kelayakan Pelajar
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-theme-dark mt-2">Syarat Am Kemasukan TVET</h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">Garis panduan asas sebelum menghantar permohonan kemasukan.</p>
                    </div>

                    <div class="space-y-3.5">
                        
                        <!-- 1. Kewarganegaraan -->
                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Kewarganegaraan</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Warganegara Malaysia.</p>
                            </div>
                        </div>

                        <!-- 2. Had Umur -->
                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Had Umur Calon</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Berumur antara <span class="font-bold text-theme-dark">16 hingga 35 tahun</span> (mengikut peringkat pengajian, institusi dan mod pengajian).</p>
                            </div>
                        </div>

                        <!-- 3. Kesihatan Fizikal -->
                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Kesihatan Fizikal</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Mempunyai <span class="font-bold text-theme-dark">sihat tubuh badan</span> (tidak rabun warna bagi bidang Elektrik / Elektronik / Seni).</p>
                            </div>
                        </div>

                        <!-- 4. Kelayakan Akademik -->
                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Kelayakan Akademik</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Mempunyai kelulusan <span class="font-bold text-theme-dark">PT3 / SPM / setaraf</span> (sesetengah program menerima calon tanpa kelayakan akademik).</p>
                            </div>
                        </div>

                        <!-- 5. Kemahiran Asas 3M -->
                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Kemahiran Asas</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Menguasai kemahiran asas <span class="font-bold text-theme-dark">3M (Membaca, Menulis dan Mengira)</span> bagi membolehkan mereka mengikuti pembelajaran.</p>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 pt-6 border-t border-theme-beige/40 text-center">
                        <button type="button" @click="$dispatch('open-up-tvet-modal')"
                                class="inline-flex items-center gap-2 bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark font-extrabold px-6 py-3 rounded-xl text-xs sm:text-sm transition shadow-md">
                            <span>Isi Borang Permohonan Sekarang</span>
                            <span>📝</span>
                        </button>
                    </div>
                </div>
                </div>
            </div>

            <!-- TAB 3: JPK & KESUMA -->
            <div x-show="activeTab === 'jpk-kesuma'" x-transition:enter="transition ease-out duration-200 transform opacity-0 scale-98" x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100" style="display: none;" class="space-y-6">

                <!-- JPK CARD -->
                <div class="bg-white rounded-3xl p-6 md:p-8 border border-theme-beige/50 shadow-lg space-y-6">
                    <div class="border-b border-theme-beige/40 pb-5 flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <span class="text-theme-blue font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-blue/10 px-3 py-1 rounded-full border border-theme-blue/20">
                                Agensi Pelaksana TVET
                            </span>
                            <h2 class="text-xl md:text-2xl font-extrabold text-theme-dark mt-2">Jabatan Pembangunan Kemahiran (JPK)</h2>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-center">
                            <img src="{{ asset('images/logo-jpk.png') }}" alt="Logo JPK" class="h-14 sm:h-16 md:h-20 w-auto object-contain">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-slate-50 rounded-2xl p-5 md:p-6 border border-theme-beige/40 flex flex-col justify-between">
                            <div>
                                <span class="inline-block bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                    Definisi & Fungsi
                                </span>
                                <p class="text-slate-600 leading-relaxed text-xs md:text-sm">
                                    Agensi kerajaan di bawah KESUMA yang <span class="font-bold text-theme-dark">dipertanggungjawabkan untuk merancang, menggalak, dan menyelaras pembangunan latihan kemahiran serta menetapkan standard kualiti kebangsaan bagi TVET di Malaysia.</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-theme-dark to-theme-blue text-white rounded-2xl p-5 md:p-6 border border-theme-purple/30">
                            <span class="inline-block bg-theme-purple/30 border border-theme-purple/40 text-theme-yellow text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                Peranan JPK
                            </span>
                            <ul class="space-y-3 text-slate-200 text-xs md:text-sm">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Membuat dan Mengemaskini Standard NOSS</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Menilai dan memberi kelulusan pentauliahan kepada institusi TVET (awam mahupun swasta) untuk menjalankan program kemahiran beriktiraf JPK.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Mengeluarkan Sijil Kemahiran Malaysia (SKM)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Penyelaras Program Industri (Akademi Dalam Industri / SLDN)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- KESUMA CARD -->
                <div class="bg-white rounded-3xl p-6 md:p-8 border border-theme-beige/50 shadow-lg space-y-6">
                    <div class="border-b border-theme-beige/40 pb-5 flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <span class="text-theme-purple font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-purple/10 px-3 py-1 rounded-full border border-theme-purple/20">
                                Kementerian Peneraju
                            </span>
                            <h2 class="text-xl md:text-2xl font-extrabold text-theme-dark mt-2">Kementerian Sumber Manusia (KESUMA/KSM)</h2>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-center">
                            <img src="{{ asset('images/logo-kesuma.png') }}" alt="Logo KESUMA" class="h-14 sm:h-16 md:h-20 w-auto object-contain">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-slate-50 rounded-2xl p-5 md:p-6 border border-theme-beige/40 flex flex-col justify-between">
                            <div>
                                <span class="inline-block bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                    Misi Kementerian
                                </span>
                                <p class="text-slate-600 leading-relaxed text-xs md:text-sm">
                                     Kementerian Sumber Manusia (KESUMA) kementerian kerajaan <span class="font-bold text-theme-dark">bertanggungjawab merancang, mengurus, dan membangunkan modal insan serta tenaga kerja negara.</span> Fokus utamanya merangkumi pembangunan kemahiran, pasaran buruh, perhubungan perusahaan, serta keselamatan dan kesihatan pekerjaan.
                                </p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-theme-dark to-theme-blue text-white rounded-2xl p-5 md:p-6 border border-theme-purple/30">
                            <span class="inline-block bg-theme-purple/30 border border-theme-purple/40 text-theme-yellow text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                Peranan KESUMA Dalam TVET
                            </span>
                            <ul class="space-y-3 text-slate-200 text-xs md:text-sm">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Penggubal & Penyelaras Standard Kemahiran (Melalui JPK)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Penyedia Institusi Latihan TVET Awam (Melalui JTM)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Penyedia Pembiayaan Latihan TVET (Melalui PTPK)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-theme-yellow font-black text-base leading-none">•</span>
                                    <span>Analisis Pasaran Buruh & Penempatan Kerjaya</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- PTPK CARD -->
                <div class="bg-white rounded-3xl p-6 md:p-8 border border-theme-beige/50 shadow-lg space-y-6">
                    <div class="border-b border-theme-beige/40 pb-5 flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <span class="text-theme-accent font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-accent/10 px-3 py-1 rounded-full border border-theme-accent/20">
                                Agensi Pembiaya Latihan TVET
                            </span>
                            <h2 class="text-xl md:text-2xl font-extrabold text-theme-dark mt-2">Perbadanan Tabung Pembangunan Kemahiran (PTPK)</h2>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-center">
                            <img src="{{ asset('images/logo-ptpk.png') }}" alt="Logo PTPK" class="h-14 sm:h-16 md:h-20 w-auto object-contain">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Left Box: Definisi / Pengenalan PTPK -->
                        <div class="bg-slate-50 rounded-2xl p-5 md:p-6 border border-theme-beige/40 flex flex-col justify-between">
                            <div>
                                <span class="inline-block bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                    Definisi & Fungsi
                                </span>
                                <p class="text-slate-600 leading-relaxed text-xs md:text-sm">
                                    PTPK bermaksud Perbadanan Tabung Pembangunan Kemahiran. Ia merupakan sebuah <span class="font-bold text-theme-dark">badan berkanun di bawah Kementerian Sumber Manusia (KSM) yang bertindak sebagai agensi pembiaya utama latihan kemahiran TVET di Malaysia.</span>
                                </p>
                            </div>
                        </div>

                        <!-- Right Box: Peranan PTPK -->
                        <div class="bg-gradient-to-br from-theme-dark to-theme-blue text-white rounded-2xl p-5 md:p-6 border border-theme-purple/30">
                            <span class="inline-block bg-theme-purple/30 border border-theme-purple/40 text-theme-yellow text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                Peranan PTPK
                            </span>
                            <div class="space-y-3.5 text-xs md:text-sm">
                                <div>
                                    <h4 class="font-bold text-theme-yellow text-xs sm:text-sm flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-theme-yellow shrink-0"></span>
                                        Menyediakan Pinjaman Latihan Kemahiran
                                    </h4>
                                    <p class="text-slate-200 text-xs mt-1 pl-4 leading-relaxed">
                                        Membiayai yuran pengajian dan elaun sara diri bulanan bagi pelatih peringkat SKM, DKM dan DLKM.
                                    </p>
                                </div>

                                <div>
                                    <h4 class="font-bold text-theme-yellow text-xs sm:text-sm flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-theme-yellow shrink-0"></span>
                                        Meningkatkan Akses TVET
                                    </h4>
                                    <p class="text-slate-200 text-xs mt-1 pl-4 leading-relaxed">
                                        Membantu belia, khususnya golongan B40, mengikuti pengajian kemahiran tanpa kekangan kewangan.
                                    </p>
                                </div>

                                <div>
                                    <h4 class="font-bold text-theme-yellow text-xs sm:text-sm flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-theme-yellow shrink-0"></span>
                                        Mengurus Bayaran Balik Pinjaman
                                    </h4>
                                    <p class="text-slate-200 text-xs mt-1 pl-4 leading-relaxed">
                                        Mengutip bayaran balik daripada bekas pelatih supaya dana dapat digunakan semula untuk pemohon baharu.
                                    </p>
                                </div>

                                <div>
                                    <h4 class="font-bold text-theme-yellow text-xs sm:text-sm flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-theme-yellow shrink-0"></span>
                                        Menyokong Tenaga Kerja Mahir Negara
                                    </h4>
                                    <p class="text-slate-200 text-xs mt-1 pl-4 leading-relaxed">
                                        Melaburkan dana dalam kursus kemahiran kritikal yang memenuhi keperluan industri negara.
                                    </p>
                                </div>

                                <div>
                                    <h4 class="font-bold text-theme-yellow text-xs sm:text-sm flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-theme-yellow shrink-0"></span>
                                        Mengurus Bantuan Khusus
                                    </h4>
                                    <p class="text-slate-200 text-xs mt-1 pl-4 leading-relaxed">
                                        Menyediakan insentif dan pembiayaan khas untuk golongan seperti OKU serta program latihan semula (<span class="italic">reskilling &amp; upskilling</span>).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>