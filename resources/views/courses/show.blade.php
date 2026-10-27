<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-theme-dark leading-tight">
                {{ $course->name }}
            </h2>
            <a href="{{ route('courses.index') }}" class="text-xs text-theme-blue font-bold hover:underline flex items-center gap-1">
                <span>←</span> Kembali ke Senarai Kursus
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-theme-cream via-white to-theme-cream min-h-screen">
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

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-theme-purple/20">

                <div class="relative h-72 sm:h-96 w-full bg-slate-900 overflow-hidden">
                    @if ($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" class="w-full h-full object-cover brightness-95" alt="{{ $course->name }}">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-theme-blue via-indigo-600 to-theme-dark flex flex-col items-center justify-center text-white">
                            <span class="text-5xl mb-2">⚙️</span>
                            <span class="font-bold text-xl">{{ $course->category->name }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-theme-dark/80 via-transparent to-black/20"></div>

                    <div class="absolute bottom-5 left-6 right-6 flex flex-wrap items-center justify-between gap-3">
                        <span class="inline-block text-xs bg-theme-blue text-white font-extrabold uppercase tracking-wide px-4 py-1.5 rounded-full shadow-md border border-theme-purple/40">
                            {{ $course->category->name }}
                        </span>
                        <span class="text-xs font-bold px-3 py-1.5 rounded-full bg-theme-yellow text-slate-950 shadow-md flex items-center gap-1.5">
                            <span>⏱️ Tempoh:</span>
                            <span class="font-extrabold">{{ $course->duration ?? '12 Bulan' }}</span>
                        </span>
                    </div>
                </div>

                <div class="p-6 sm:p-10 space-y-8">
                    <div>
                        <h1 class="text-2xl sm:text-4xl font-extrabold text-theme-dark leading-tight">{{ $course->name }}</h1>
                        <p class="text-slate-600 mt-4 leading-relaxed text-sm sm:text-base">{{ $course->description }}</p>
                    </div>

                    <!-- Highlights Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="p-5 rounded-2xl bg-theme-light/25 border border-theme-light/50">
                            <p class="text-[10px] text-theme-dark uppercase font-extrabold tracking-wider">Tempoh Latihan Amali</p>
                            <p class="text-xl font-extrabold text-theme-dark mt-1">📅 {{ $course->duration ?? '12 Bulan' }}</p>
                            <p class="text-xs text-slate-500 mt-1">Termasuk latihan industri / On-the-Job Training (OJT)</p>
                        </div>

                        @if ($course->min_salary || $course->max_salary)
                            <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-100">
                                <p class="text-[10px] text-emerald-800 uppercase font-extrabold tracking-wider">Anggaran Gaji Permulaan</p>
                                <p class="text-xl font-extrabold text-emerald-900 mt-1">
                                    RM {{ number_format($course->min_salary, 0) }} - RM {{ number_format($course->max_salary, 0) }}
                                    <span class="text-xs font-normal text-emerald-700">/ bulan</span>
                                </p>
                                <p class="text-xs text-emerald-700 mt-1">Berdasarkan piawaian pasaran graduan berkemahiran</p>
                            </div>
                        @endif
                    </div>

                    @if ($course->career_prospects)
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                            <h3 class="text-xs font-extrabold text-theme-blue uppercase tracking-wider mb-2 flex items-center gap-2">
                                <span>💼</span>
                                <span>Peluang & Laluan Kerjaya</span>
                            </h3>
                            <p class="text-slate-700 text-sm leading-relaxed">{{ $course->career_prospects }}</p>
                        </div>
                    @endif

                    <!-- CTA Buttons -->
                    <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a href="{{ route('courses.index') }}" class="text-xs font-bold text-slate-500 hover:text-theme-blue transition">
                            ← Balik ke Katalog Kursus
                        </a>

                        <a href="{{ route('up-tvet.form', ['course' => $course->name]) }}"
                           class="w-full sm:w-auto bg-gradient-to-r from-theme-accent to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-extrabold px-8 py-3.5 rounded-xl transition shadow-lg hover:shadow-xl hover:scale-105 text-center flex items-center justify-center gap-2">
                            <span>Mohon Kursus Ini Sekarang</span>
                            <span>🚀</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>