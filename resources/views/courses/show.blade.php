<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 sm:gap-3">
            <h2 class="font-extrabold text-lg sm:text-xl text-theme-dark leading-tight line-clamp-2">
                {{ $course->name }}
            </h2>
            <a href="{{ route('courses.index') }}"
               class="inline-flex items-center gap-1.5 self-start sm:self-auto px-3 sm:px-3.5 py-1.5 rounded-xl bg-sky-100 hover:bg-sky-200 text-sky-900 border border-sky-300/80 text-[10px] sm:text-xs font-extrabold transition-all duration-200 shadow-xs hover:shadow-sm group">
                <span class="transition-transform duration-200 group-hover:-translate-x-1">←</span>
                <span>Kembali</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-theme-cream via-white to-theme-cream min-h-screen -mx-4 sm:mx-0 px-4 sm:px-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-theme-yellow/20 border-l-4 border-emerald-500 text-emerald-900 rounded-r-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-xl shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden border border-theme-purple/20">

                <div class="relative h-56 sm:h-72 md:h-96 w-full bg-slate-900 overflow-hidden">
                    @if ($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" class="w-full h-full object-cover brightness-95" alt="{{ $course->name }}">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-theme-blue via-indigo-600 to-theme-dark flex flex-col items-center justify-center text-white">
                            <span class="text-4xl sm:text-5xl mb-2">⚙️</span>
                            <span class="font-bold text-lg sm:text-xl">{{ $course->category->name }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-theme-dark/80 via-transparent to-black/20"></div>

                    <div class="absolute bottom-4 left-4 right-4 sm:bottom-5 sm:left-6 sm:right-6 flex flex-wrap items-center justify-between gap-2 sm:gap-3">
                        <span class="inline-block text-[10px] sm:text-xs bg-theme-blue text-white font-extrabold uppercase tracking-wide px-3 sm:px-4 py-1 sm:py-1.5 rounded-full shadow-md border border-theme-purple/40">
                            {{ $course->category->name }}
                        </span>
                        <span class="text-[10px] sm:text-xs font-bold px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-theme-yellow text-slate-950 shadow-md flex items-center gap-1 sm:gap-1.5">
                            <span>⏱️</span>
                            <span class="font-extrabold">{{ $course->duration ?? '12 Bulan' }}</span>
                        </span>
                    </div>
                </div>

                <div class="p-5 sm:p-6 md:p-10 space-y-6 sm:space-y-8">
                    <div>
                        <h1 class="text-xl sm:text-2xl md:text-4xl font-extrabold text-theme-dark leading-tight">{{ $course->name }}</h1>
                        <p class="text-slate-600 mt-3 sm:mt-4 leading-relaxed text-xs sm:text-sm md:text-base">{{ $course->description }}</p>
                    </div>

                    <!-- Highlights Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        <div class="p-4 sm:p-5 rounded-2xl bg-theme-light/25 border border-theme-light/50">
                            <p class="text-[9px] sm:text-[10px] text-theme-dark uppercase font-extrabold tracking-wider">Tempoh Latihan Amali</p>
                            <p class="text-lg sm:text-xl font-extrabold text-theme-dark mt-1">📅 {{ $course->duration ?? '12 Bulan' }}</p>
                            <p class="text-[10px] sm:text-xs text-slate-500 mt-1">Termasuk latihan industri / On-the-Job Training (OJT)</p>
                        </div>

                        @if ($course->min_salary || $course->max_salary)
                            <div class="p-4 sm:p-5 rounded-2xl bg-emerald-50 border border-emerald-100">
                                <p class="text-[9px] sm:text-[10px] text-emerald-800 uppercase font-extrabold tracking-wider">Anggaran Gaji Permulaan</p>
                                <p class="text-lg sm:text-xl font-extrabold text-emerald-900 mt-1">
                                    RM {{ number_format($course->min_salary, 0) }} - RM {{ number_format($course->max_salary, 0) }}
                                    <span class="text-[10px] sm:text-xs font-normal text-emerald-700">/ bulan</span>
                                </p>
                                <p class="text-[10px] sm:text-xs text-emerald-700 mt-1">Berdasarkan piawaian pasaran graduan berkemahiran</p>
                            </div>
                        @endif
                    </div>

                    @if ($course->career_prospects)
                        @php
                            // Parse points entered by admin: supports newlines, *, -, •, or comma-separated items
                            $rawProspects = trim($course->career_prospects);
                            // Check if it has multiple lines or bullet points
                            $hasNewlines = str_contains($rawProspects, "\n");
                            $hasBullets = preg_match('/(^|\n)\s*[\*\-•]/', $rawProspects);

                            if ($hasNewlines || $hasBullets) {
                                $lines = preg_split('/\r\n|\r|\n/', $rawProspects);
                            } else {
                                // Fallback for comma-separated or single text
                                $lines = str_contains($rawProspects, ',') ? explode(',', $rawProspects) : [$rawProspects];
                            }

                            $cleanedPoints = collect($lines)->map(function($line) {
                                return trim(preg_replace('/^[\s\*\-•\d\.\)]+/', '', $line));
                            })->filter()->values();
                        @endphp

                        <div class="p-4 sm:p-6 md:p-7 rounded-2xl bg-gradient-to-br from-slate-50 via-theme-light/10 to-theme-cream/20 border border-theme-blue/20 shadow-xs">
                            <h3 class="text-[10px] sm:text-xs font-extrabold text-theme-blue uppercase tracking-wider mb-3 sm:mb-3.5 flex items-center gap-2">
                                <span class="w-5 h-5 sm:w-6 sm:h-6 rounded-lg bg-theme-blue/15 text-theme-blue flex items-center justify-center text-[10px] sm:text-xs">💼</span>
                                <span>Peluang &amp; Laluan Kerjaya</span>
                            </h3>

                            @if($cleanedPoints->count() > 1)
                                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-2.5 md:gap-3 text-slate-700 text-[10px] sm:text-xs md:text-sm">
                                    @foreach($cleanedPoints as $point)
                                        <li class="flex items-start gap-2 sm:gap-2.5 p-2 sm:p-2.5 md:p-3 rounded-xl bg-white/90 border border-slate-200/70 shadow-xs hover:border-theme-accent transition-colors">
                                            <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-theme-accent shrink-0 mt-1 sm:mt-1.5 shadow-xs"></span>
                                            <span class="font-medium leading-relaxed">{{ $point }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="flex items-start gap-2 sm:gap-2.5 p-2.5 sm:p-3 rounded-xl bg-white/90 border border-slate-200/70 shadow-xs">
                                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-theme-accent shrink-0 mt-1 sm:mt-1.5"></span>
                                    <p class="text-slate-700 text-[10px] sm:text-xs md:text-sm leading-relaxed font-medium">
                                        {{ $cleanedPoints->first() ?? $course->career_prospects }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- CTA Buttons -->
                    <div class="pt-4 sm:pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-between gap-3 sm:gap-4">
                        <a href="{{ route('courses.index') }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 sm:gap-2 px-4 sm:px-5 py-3 sm:py-3.5 rounded-xl bg-sky-100 hover:bg-sky-200 active:bg-sky-300 text-sky-900 border border-sky-300/80 text-[10px] sm:text-xs md:text-sm font-extrabold transition-all duration-200 shadow-xs hover:shadow-md text-center group">
                            <span class="transition-transform duration-200 group-hover:-translate-x-1">←</span>
                            <span>Kembali ke Senarai Kursus</span>
                        </a>

                        <a href="{{ route('up-tvet.form', ['course' => $course->name]) }}"
                           class="w-full sm:w-auto bg-gradient-to-r from-theme-accent to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-extrabold px-5 sm:px-8 py-3 sm:py-3.5 rounded-xl transition shadow-lg hover:shadow-xl hover:scale-105 text-center flex items-center justify-center gap-1.5 sm:gap-2 text-[10px] sm:text-xs md:text-sm">
                            <span>Mohon Kursus Ini Sekarang</span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>