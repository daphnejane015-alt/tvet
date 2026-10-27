<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-theme-dark tracking-tight">
                {{ __('Katalog Kursus TVET') }}
            </h2>
            <span class="text-xs bg-theme-light/60 text-theme-dark font-bold px-3 py-1 rounded-full border border-theme-purple/40">
                {{ $courses->total() }} Kursus Ditawarkan
            </span>
        </div>
    </x-slot>

    <!-- MAIN ALPINE WRAPPER FOR POPUP MODAL & CATEGORY FILTER -->
    <div x-data="{ 
        selectedCategory: 'all',
        showModal: false,
        activeCourse: {
            id: null,
            name: '',
            category_name: '',
            duration: '',
            salary: '',
            description: '',
            career_prospects: '',
            image_url: '',
            mohon_url: ''
        },
        openDetailModal(course) {
            this.activeCourse = course;
            this.showModal = true;
            document.body.classList.add('overflow-hidden');
        },
        closeDetailModal() {
            this.showModal = false;
            document.body.classList.remove('overflow-hidden');
        }
    }" class="bg-gradient-to-b from-theme-cream via-white to-theme-cream min-h-screen pb-16">

        <!-- HERO BANNER -->
        <div class="relative bg-gradient-to-br from-theme-dark via-[#131326] to-[#1c1c38] text-white overflow-hidden border-b border-theme-blue/30">
            <!-- Ambient Glow Circles -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-theme-blue/25 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-theme-yellow/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-theme-purple/15 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 text-center">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-theme-blue/20 border border-theme-purple/40 text-theme-light text-xs font-semibold tracking-wide uppercase mb-4 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-theme-yellow animate-pulse"></span>
                    <span>Pilihan Kerjaya Masa Depan</span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-4 text-white leading-tight">
                    Terokai Kursus <span class="bg-gradient-to-r from-theme-purple via-theme-light to-theme-yellow bg-clip-text text-transparent">TVET Berkualiti</span>
                </h1>
                
                <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto mb-8 font-normal leading-relaxed">
                    Kembangkan bakat teknikal dan vokasional anda dengan sijil diiktiraf industri, latihan amali bersama pakar, dan potensi gaji yang lumayan.
                </p>

                <!-- Search / Category Pills -->
                <div class="flex flex-wrap items-center justify-center gap-2 pt-2">
                    <button @click="selectedCategory = 'all'"
                            :class="selectedCategory === 'all' ? 'bg-gradient-to-r from-theme-blue to-[#7a7aff] text-white shadow-lg shadow-theme-blue/30 scale-105' : 'bg-slate-900/80 text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-700/60'"
                            class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 cursor-pointer">
                        ✨ Semua Kategori ({{ $courses->total() }})
                    </button>
                    @if(isset($categories))
                        @foreach($categories as $cat)
                            <button @click="selectedCategory = '{{ $cat->id }}'"
                                    :class="selectedCategory === '{{ $cat->id }}' ? 'bg-gradient-to-r from-theme-blue to-[#7a7aff] text-white shadow-lg shadow-theme-blue/30 scale-105' : 'bg-slate-900/80 text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-700/60'"
                                    class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 cursor-pointer">
                                {{ $cat->name }} <span class="text-[10px] opacity-70 ml-1">({{ $cat->courses_count }})</span>
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- NOTIFICATIONS -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-theme-yellow/20 border-l-4 border-emerald-500 text-emerald-900 rounded-r-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="text-lg">✓</span>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="text-lg">⚠️</span>
                        <span class="text-sm font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- EMPTY STATE -->
            @if ($courses->isEmpty())
                <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-12 text-center max-w-lg mx-auto my-12">
                    <div class="w-20 h-20 bg-theme-light/40 text-theme-blue rounded-2xl flex items-center justify-center text-4xl mx-auto mb-4 shadow-inner">
                        📚
                    </div>
                    <h3 class="text-xl font-extrabold text-theme-dark mb-2">Tiada Kursus Tersedia</h3>
                    <p class="text-sm text-slate-500">Sila semak semula kemudian atau hubungi pihak pentadbir untuk maklumat terkini.</p>
                </div>
            @else
                <!-- COURSES GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                    @foreach ($courses as $course)
                        @php
                            $imageUrl = $course->image ? asset('storage/' . $course->image) : asset('images/logo-acetvet.png');
                            $hasCustomImage = (bool) $course->image;
                            $salaryText = ($course->min_salary || $course->max_salary) 
                                ? 'RM ' . number_format($course->min_salary, 0) . ' - ' . number_format($course->max_salary, 0) . ' / bln' 
                                : 'Mengikut Standard Industri';
                            $mohonUrl = route('up-tvet.form', ['course' => $course->name]);
                            
                            $coursePayload = json_encode([
                                'id' => $course->id,
                                'name' => $course->name,
                                'category_id' => $course->category_id,
                                'category_name' => $course->category->name ?? 'TVET',
                                'duration' => $course->duration ?? '12 Bulan',
                                'salary' => $salaryText,
                                'description' => $course->description ?? 'Program kemahiran komprehensif merangkumi teori dan amali intensif bertaraf industri.',
                                'career_prospects' => $course->career_prospects ?? 'Graduan bersedia untuk menyertai sektor industri utama, keusahawanan teknikal, dan pensijilan lanjutan.',
                                'image_url' => $imageUrl,
                                'mohon_url' => $mohonUrl,
                            ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                        @endphp

                        <!-- CARD ITEM with category filtering -->
                        <div x-show="selectedCategory === 'all' || selectedCategory === '{{ $course->category_id }}'"
                             x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl border border-slate-100 hover:border-theme-blue/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1.5 relative">
                            
                            <!-- Top Image Banner with Quick-Pop Trigger -->
                            <div class="relative overflow-hidden h-52 bg-slate-900 cursor-pointer"
                                 @click='openDetailModal({!! $coursePayload !!})'>
                                @if ($course->image)
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $course->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500 ease-out brightness-95 group-hover:brightness-105">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-theme-blue via-indigo-600 to-theme-dark flex flex-col items-center justify-center p-6 text-center">
                                        <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-3xl mb-2 text-white">
                                            ⚙️
                                        </div>
                                        <span class="text-white font-extrabold text-sm tracking-wide">{{ $course->category->name ?? 'AceTVET' }}</span>
                                    </div>
                                @endif

                                <!-- Gradient Overlay for readability -->
                                <div class="absolute inset-0 bg-gradient-to-t from-theme-dark/80 via-transparent to-black/30 pointer-events-none"></div>

                                <!-- Floating Category Pill -->
                                <div class="absolute top-3.5 left-3.5">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full bg-theme-dark/80 text-theme-yellow border border-theme-yellow/40 backdrop-blur-md shadow-sm">
                                        {{ $course->category->name ?? 'Umum' }}
                                    </span>
                                </div>

                                <!-- Floating Duration Pill -->
                                <div class="absolute top-3.5 right-3.5">
                                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full bg-white/90 text-theme-dark shadow-sm backdrop-blur-md flex items-center gap-1">
                                        <span>⏱️</span>
                                        <span>{{ $course->duration ?? '12 Bulan' }}</span>
                                    </span>
                                </div>

                                <!-- Floating "Lihat Pantas" Overlay Button (Pop preview cue) -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-theme-dark/50 backdrop-blur-[2px]">
                                    <span class="px-4 py-2 bg-white text-theme-dark rounded-xl text-xs font-extrabold shadow-xl flex items-center gap-2 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                        <span>🔍</span>
                                        <span>Info Pantas Kursus</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <!-- Course Title -->
                                    <h3 class="text-lg font-extrabold text-theme-dark leading-snug group-hover:text-theme-blue transition-colors duration-200 mb-2">
                                        <a href="{{ route('courses.show', $course) }}" class="hover:underline">
                                            {{ $course->name }}
                                        </a>
                                    </h3>

                                    <!-- Description preview -->
                                    @if ($course->description)
                                        <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed mb-4">
                                            {{ Str::limit($course->description, 110) }}
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <!-- Salary / Career Highlight -->
                                    <div class="mb-5 p-3 rounded-xl bg-theme-light/20 border border-theme-light/40 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-700 font-extrabold text-xs flex items-center justify-center">
                                                💰
                                            </span>
                                            <div>
                                                <span class="text-[9px] uppercase tracking-wider text-slate-600 font-bold block">Anggaran Gaji</span>
                                                <span class="text-xs font-extrabold text-emerald-800 block">
                                                    @if ($course->min_salary || $course->max_salary)
                                                        RM {{ number_format($course->min_salary, 0) }} - {{ number_format($course->max_salary, 0) }}
                                                    @else
                                                        Kompetitif
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <span class="text-[10px] text-theme-blue font-bold bg-white px-2 py-0.5 rounded shadow-xs">
                                            Industri
                                        </span>
                                    </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2.5 pt-3 border-t border-slate-100">
                                    <!-- Direct Link to Dedicated Details Page -->
                                    <a href="{{ route('courses.show', $course) }}"
                                       class="flex-1 py-2.5 px-3 text-xs font-extrabold text-theme-dark bg-theme-light/40 hover:bg-theme-blue hover:text-white rounded-xl transition-all duration-200 flex items-center justify-center gap-1.5 shadow-xs">
                                        <span>Lihat Info</span>
                                        <span>🔍</span>
                                    </a>

                                    <!-- Mohon Direct -->
                                    <a href="{{ $mohonUrl }}"
                                       class="flex-1 py-2.5 px-3 text-xs font-extrabold text-slate-950 bg-gradient-to-r from-theme-accent to-amber-400 hover:from-amber-400 hover:to-amber-300 rounded-xl transition shadow-sm hover:shadow-md flex items-center justify-center gap-1 text-center">
                                        <span>Mohon TVET</span>
                                        <span>→</span>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>

        <!-- ================================================================= -->
        <!-- ATTRACTIVE INTERACTIVE COURSE POP-UP MODAL (User Requested)        -->
        <!-- ================================================================= -->
        <div x-show="showModal" 
             style="display: none;"
             class="fixed inset-0 z-50 overflow-y-auto" 
             role="dialog" 
             aria-modal="true">
            
            <!-- Backdrop Overlay with subtle blur -->
            <div x-show="showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeDetailModal()"
                 class="fixed inset-0 bg-theme-dark/80 backdrop-blur-sm transition-opacity"></div>

            <div class="flex min-h-full items-center justify-center p-3 sm:p-6 text-center">
                <!-- Modal Panel -->
                <div x-show="showModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all w-full max-w-2xl border border-theme-purple/30">
                    
                    <!-- Close button -->
                    <button @click="closeDetailModal()" 
                            class="absolute top-4 right-4 z-20 w-9 h-9 rounded-full bg-theme-dark/70 text-white hover:bg-theme-dark flex items-center justify-center transition shadow-lg backdrop-blur-md cursor-pointer">
                        ✕
                    </button>

                    <!-- Large High-Res Course Image Header -->
                    <div class="relative h-60 sm:h-72 w-full bg-slate-900 overflow-hidden">
                        <img :src="activeCourse.image_url" 
                             :alt="activeCourse.name" 
                             class="w-full h-full object-cover brightness-95">
                        
                        <!-- Rich aesthetic gradient over image -->
                        <div class="absolute inset-0 bg-gradient-to-t from-theme-dark via-theme-dark/30 to-black/20"></div>

                        <!-- Pill Tags -->
                        <div class="absolute bottom-4 left-5 right-5 flex flex-wrap items-center justify-between gap-2">
                            <span class="px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wide bg-theme-blue text-white shadow-md border border-theme-purple/40"
                                  x-text="activeCourse.category_name">
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-theme-yellow text-slate-950 shadow-md flex items-center gap-1.5">
                                <span>⏱️ Tempoh:</span>
                                <span class="font-extrabold" x-text="activeCourse.duration"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Modal Body Details -->
                    <div class="p-6 sm:p-8 space-y-6 max-h-[60vh] overflow-y-auto">
                        <!-- Course Title -->
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-theme-dark leading-tight" 
                                x-text="activeCourse.name"></h2>
                            <p class="text-xs text-slate-600 mt-1 flex items-center gap-1">
                                <span>🏛️</span> Dilatih di Institusi Latihan Kemahiran Awam (ILKA) diiktiraf JPK.
                            </p>
                        </div>

                        <!-- Description -->
                        <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl border border-slate-100">
                            <h4 class="text-xs font-extrabold uppercase tracking-wider text-theme-blue mb-2 flex items-center gap-1.5">
                                <span>📖</span>
                                <span>Deskripsi & Sukatan Kursus</span>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed" 
                               x-text="activeCourse.description"></p>
                        </div>

                        <!-- Career Prospects & Salary Box -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Salary -->
                            <div class="p-4 rounded-2xl bg-emerald-50/80 border border-emerald-100">
                                <span class="text-[10px] uppercase tracking-wider font-extrabold text-emerald-700 block mb-1">
                                    💰 Anggaran Gaji Permulaan
                                </span>
                                <span class="text-base font-extrabold text-emerald-900 block" 
                                      x-text="activeCourse.salary"></span>
                                <span class="text-[10px] text-emerald-600 block mt-0.5">Berdasarkan data pasaran kerja TVET</span>
                            </div>

                            <!-- Career -->
                            <div class="p-4 rounded-2xl bg-theme-light/30 border border-theme-light/60">
                                <span class="text-[10px] uppercase tracking-wider font-extrabold text-theme-blue block mb-1">
                                    💼 Prospek Kerjaya
                                </span>
                                <p class="text-xs text-slate-700 font-medium line-clamp-3 leading-relaxed" 
                                   x-text="activeCourse.career_prospects"></p>
                            </div>
                        </div>

                        <!-- Value Badges -->
                        <div class="flex flex-wrap items-center gap-3 pt-2">
                            <div class="flex items-center gap-1.5 text-xs text-slate-600 font-semibold bg-slate-100 px-3 py-1.5 rounded-lg">
                                <span class="text-emerald-500 font-bold">✓</span> Sijil Kemahiran Malaysia (SKM)
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-slate-600 font-semibold bg-slate-100 px-3 py-1.5 rounded-lg">
                                <span class="text-emerald-500 font-bold">✓</span> Elaun Bulanan Disediakan
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-slate-600 font-semibold bg-slate-100 px-3 py-1.5 rounded-lg">
                                <span class="text-emerald-500 font-bold">✓</span> Penempatan Kerja Terus
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions Footer -->
                    <div class="p-5 sm:p-6 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <button type="button" 
                                @click="closeDetailModal()"
                                class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-200 transition cursor-pointer">
                            Tutup
                        </button>
                        
                        <a :href="activeCourse.mohon_url"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-theme-accent via-amber-400 to-amber-500 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-extrabold px-7 py-3 rounded-xl text-sm transition-all duration-200 shadow-md hover:shadow-lg hover:scale-105">
                            <span>Mohon Kursus Ini Sekarang</span>
                            <span>🚀</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>