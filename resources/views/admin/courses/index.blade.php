<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-theme-dark tracking-tight">
                {{ __('Urus Kursus') }}
            </h2>
            <span class="text-xs bg-theme-light/60 text-theme-dark font-bold px-3 py-1 rounded-full border border-theme-purple/40">
                {{ $courses->count() }} Kursus Berdaftar
            </span>
        </div>
    </x-slot>

    <div class="bg-gradient-to-b from-theme-cream via-white to-theme-cream min-h-screen pb-16 -mx-4 sm:mx-0 px-4 sm:px-0">
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-900 rounded-r-xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <span class="text-lg">✓</span>
                        <span class="text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-extrabold text-theme-blue">Senarai Kursus</h3>
                        <p class="text-sm text-slate-500 mt-1">{{ $courses->count() }} kursus berdaftar dalam sistem</p>
                    </div>
                    <a href="{{ route('admin.courses.create') }}"
                       class="flex items-center justify-center gap-2 bg-gradient-to-r from-theme-blue to-theme-purple text-white px-5 py-2.5 rounded-xl hover:from-theme-purple hover:to-theme-blue transition-all duration-200 text-sm font-semibold shadow-md hover:shadow-lg hover:scale-105">
                        <span>➕</span> Tambah Kursus Baru
                    </a>
                </div>
            </div>

            @if ($courses->isEmpty())
                <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-12 text-center">
                    <div class="w-20 h-20 bg-theme-light/40 text-theme-blue rounded-2xl flex items-center justify-center text-4xl mx-auto mb-4 shadow-inner">
                        📚
                    </div>
                    <h3 class="text-xl font-extrabold text-theme-dark mb-2">Tiada Kursus Lagi</h3>
                    <p class="text-sm text-slate-500 mb-5">Mulakan dengan menambah kursus pertama anda.</p>
                    <a href="{{ route('admin.courses.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-theme-blue text-white text-xs font-bold shadow-md hover:bg-theme-blue/90 hover:scale-105 transition-all">
                        <span>➕</span> Tambah Kursus Pertama
                    </a>
                </div>
            @else
                <!-- Courses Grid - Matching Public Design -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                    @foreach ($courses as $course)
                        @php
                            $imageUrl = $course->image ? asset('storage/' . $course->image) : null;
                            $salaryText = ($course->min_salary || $course->max_salary)
                                ? 'RM ' . number_format($course->min_salary, 0) . ' - ' . number_format($course->max_salary, 0)
                                : 'Mengikut Standard Industri';
                        @endphp

                        <!-- Course Card - Modern Design -->
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl border border-slate-100 hover:border-theme-blue/40 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1.5 relative">

                            <!-- Top Image Banner -->
                            <div class="relative overflow-hidden h-52 bg-slate-900">
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

                                <!-- Gradient Overlay -->
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
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <!-- Course Title -->
                                    <h3 class="text-lg font-extrabold text-theme-dark leading-snug group-hover:text-theme-blue transition-colors duration-200 mb-2">
                                        {{ $course->name }}
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

                                    <!-- Admin Action Buttons -->
                                    <div class="pt-3 border-t border-slate-100 flex items-center gap-2">
                                        <a href="{{ route('admin.courses.edit', $course) }}"
                                           class="flex-1 py-2.5 px-4 text-xs font-extrabold text-white bg-gradient-to-r from-theme-blue to-theme-purple hover:from-theme-purple hover:to-theme-blue rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-xs hover:shadow-md">
                                            <span>✏️</span>
                                            <span>Edit</span>
                                        </a>
                                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                              onsubmit="return confirm('Padam kursus ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="flex-1 py-2.5 px-4 text-xs font-extrabold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-xs hover:shadow-md">
                                                <span>🗑️</span>
                                                <span>Padam</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>