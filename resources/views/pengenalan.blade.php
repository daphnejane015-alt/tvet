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
                <span class="text-theme-yellow text-[10px] md:text-xs font-bold tracking-widest uppercase bg-theme-yellow/15 px-3 py-1 rounded-full border border-theme-yellow/30">
                    Maklumat Rasmi
                </span>
                <h1 class="text-2xl md:text-4xl font-extrabold mt-3 tracking-tight">
                    Pengenalan TVET, JPK & KESUMA
                </h1>
                <p class="text-slate-200 mt-2 text-xs md:text-sm max-w-2xl leading-relaxed">
                    Sistem Latihan Kemahiran Kebangsaan, institusi pelaksana serta kementerian peneraju agenda kecemerlangan modal insan AceTVET.
                </p>
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
                        🏛️ JPK & KESUMA
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
                        <div class="lg:col-span-8 space-y-5">
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
                                latihan yang menjurus ke arah penguasaan kemahiran praktikal, teknologi industri, dan kesiapsiagaan kerjaya berpendapatan tinggi.
                            </p>

                            <div class="bg-gradient-to-r from-theme-light/50 via-white to-white p-5 rounded-2xl border-l-4 border-theme-blue text-slate-700 text-xs md:text-sm leading-relaxed space-y-2">
                                <p class="font-semibold text-theme-dark">Pembelajaran Bersepadu Sepanjang Hayat:</p>
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

                        <div class="lg:col-span-4 flex justify-center">
                            <div class="p-6 bg-gradient-to-tr from-theme-dark to-theme-blue rounded-3xl border border-theme-purple/30 shadow-xl text-center">
                                <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}" alt="Logo AceTVET" class="h-32 md:h-44 w-auto object-contain mx-auto drop-shadow-2xl">
                                <span class="text-white font-extrabold text-sm block mt-3">AceTVET Ecosystem</span>
                                <span class="text-theme-yellow text-[10px] uppercase tracking-wider block">Peneraju Latihan Kemahiran</span>
                            </div>
                        </div>
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

                    <div class="space-y-3">
                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Kewarganegaraan & Had Umur</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Warganegara Malaysia dan berumur antara 16 tahun ke atas semasa tarikh pendaftaran.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Kelayakan Akademik Minimum</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Lulus SPM/SPMV dengan sekurang-kurangnya 3 kepujian, ATAU memiliki sijil PT3/PBS yang diiktiraf.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Kesihatan Fizikal</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Sihat tubuh badan serta bebas daripada masalah kesihatan yang menghalang aktiviti amali bengkel.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-50 hover:bg-theme-light/50 transition border border-theme-beige/40">
                            <div class="w-7 h-7 bg-theme-yellow text-theme-dark rounded-xl flex items-center justify-center font-extrabold text-xs shrink-0 mt-0.5 shadow-sm">✓</div>
                            <div>
                                <h4 class="font-bold text-xs sm:text-sm text-theme-dark">Sesi Temu Duga / Ujian Bakat</h4>
                                <p class="text-slate-600 text-xs mt-0.5">Lulus temu duga atau ujian kecenderungan vokasional khas untuk kursus tertentu (jika ditetapkan).</p>
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

            <!-- TAB 3: JPK & KESUMA -->
            <div x-show="activeTab === 'jpk-kesuma'" x-transition:enter="transition ease-out duration-200 transform opacity-0 scale-98" x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100" style="display: none;" class="space-y-6">

                <!-- JPK CARD -->
                <div class="bg-white rounded-3xl p-6 md:p-8 border border-theme-beige/50 shadow-lg space-y-6">
                    <div class="border-b border-theme-beige/40 pb-4 flex items-center justify-between flex-wrap gap-3">
                        <div>
                            <span class="text-theme-blue font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-blue/10 px-3 py-1 rounded-full border border-theme-blue/20">
                                Agensi Pelaksana TVET
                            </span>
                            <h2 class="text-xl md:text-2xl font-extrabold text-theme-dark mt-2">Jabatan Pembangunan Kemahiran (JPK)</h2>
                        </div>
                        <img src="{{ asset('images/logo-jpk.png') }}" alt="Logo JPK" class="h-10 md:h-12 w-auto object-contain">
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
                            <span class="inline-block bg-theme-blue/30 border border-theme-purple/40 text-theme-light text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                Peranan Utama JPK
                            </span>
                            <ul class="space-y-2.5 text-slate-200 text-xs md:text-sm">
                                <li class="flex items-start gap-2">
                                    <span class="text-theme-yellow font-bold">•</span>
                                    <span>Pembangunan dan pengemaskinian Standard Kemahiran Pekerjaan Kebangsaan (NOSS).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-theme-yellow font-bold">•</span>
                                    <span>Pentauliahan dan audit institusi latihan TVET awam dan swasta.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-theme-yellow font-bold">•</span>
                                    <span>Penganugerahan Sijil Kemahiran Malaysia (SKM) Tahap 1 hingga Tahap 5 (DLKM).</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- KESUMA CARD -->
                <div class="bg-white rounded-3xl p-6 md:p-8 border border-theme-beige/50 shadow-lg space-y-6">
                    <div class="border-b border-theme-beige/40 pb-4 flex items-center justify-between flex-wrap gap-3">
                        <div>
                            <span class="text-theme-purple font-extrabold text-[10px] md:text-xs tracking-widest uppercase bg-theme-purple/10 px-3 py-1 rounded-full border border-theme-purple/20">
                                Kementerian Peneraju
                            </span>
                            <h2 class="text-xl md:text-2xl font-extrabold text-theme-dark mt-2">Kementerian Sumber Manusia (KESUMA)</h2>
                        </div>
                        <img src="{{ asset('images/logo-kesuma.png') }}" alt="Logo KESUMA" class="h-10 md:h-12 w-auto object-contain">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-slate-50 rounded-2xl p-5 md:p-6 border border-theme-beige/40 flex flex-col justify-between">
                            <div>
                                <span class="inline-block bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                    Misi Kementerian
                                </span>
                                <p class="text-slate-600 leading-relaxed text-xs md:text-sm">
                                    Kementerian kerajaan yang bertanggungjawab merancang, mengurus, dan memperkasa modal insan negara melalui pembangunan kemahiran TVET, pematuhan piawaian buruh, serta keselamatan pekerjaan.
                                </p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-theme-dark to-theme-blue text-white rounded-2xl p-5 md:p-6 border border-theme-purple/30">
                            <span class="inline-block bg-theme-purple/30 border border-theme-purple/40 text-theme-yellow text-[10px] font-extrabold px-3 py-1 rounded-md mb-3 uppercase tracking-wider">
                                Tanggungjawab KESUMA Dalam TVET
                            </span>
                            <ul class="space-y-2.5 text-slate-200 text-xs md:text-sm">
                                <li class="flex items-start gap-2">
                                    <span class="text-theme-yellow font-bold">•</span>
                                    <span>Penyelarasan dasar kemahiran nasional bersama JPK.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-theme-yellow font-bold">•</span>
                                    <span>Penyediaan institusi TVET (ILP, ADTEC, JMTI bawah JTM).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-theme-yellow font-bold">•</span>
                                    <span>Pembiayaan latihan kemahiran melalui Perbadanan Tabung Pembangunan Kemahiran (PTPK).</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>