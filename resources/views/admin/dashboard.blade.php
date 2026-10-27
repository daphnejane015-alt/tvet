<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Bar -->
            <div class="bg-gradient-to-r from-theme-blue to-theme-purple rounded-xl p-6 mb-8 text-white">
                <h3 class="text-xl font-bold">Selamat Datang, {{ Auth::user()->name }} 👋</h3>
                <p class="text-gray-200 text-sm mt-1">Berikut ringkasan aktiviti sistem AceTVET hari ini.</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-theme-blue hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-theme-blue">{{ $totalCourses }}</p>
                            <p class="text-xs text-gray-500 mt-1">Jumlah Kursus</p>
                        </div>
                        <div class="w-10 h-10 bg-theme-blue/10 rounded-full flex items-center justify-center text-xl">
                            📚
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-theme-purple hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-theme-purple">{{ $totalStudents }}</p>
                            <p class="text-xs text-gray-500 mt-1">Jumlah Pelajar</p>
                        </div>
                        <div class="w-10 h-10 bg-theme-purple/10 rounded-full flex items-center justify-center text-xl">
                            🎓
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-5 border-l-4 border-emerald-500 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-emerald-600">{{ $totalUpTvetApplications }}</p>
                            <p class="text-xs text-gray-500 mt-1">Permohonan Kursus TVET</p>
                        </div>
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-xl">
                            📋
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8">
                <h3 class="text-lg font-bold text-theme-blue mb-4">Tindakan Pantas</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.courses.index') }}"
                       class="flex items-center gap-2 bg-theme-blue text-white px-5 py-3 rounded-lg hover:bg-theme-purple transition shadow-sm text-sm font-semibold">
                        <span>📚</span> Urus Kursus
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-2 bg-white text-theme-purple border-2 border-theme-purple px-5 py-3 rounded-lg hover:bg-theme-purple hover:text-white transition shadow-sm text-sm font-semibold">
                        <span>👥</span> Senarai Pengguna
                    </a>
                    <a href="{{ route('admin.up-tvet.index') }}"
                       class="flex items-center gap-2 bg-emerald-600 text-white px-5 py-3 rounded-lg hover:bg-emerald-700 transition shadow-sm text-sm font-semibold">
                        <span>📋</span> Permohonan Kursus TVET
                        @if($totalUpTvetApplications > 0)
                            <span class="bg-emerald-800 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                {{ $totalUpTvetApplications }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.courses.create') }}"
                       class="flex items-center gap-2 bg-theme-accent text-theme-blue font-semibold px-5 py-3 rounded-lg hover:bg-amber-400 transition shadow-sm text-sm">
                        <span>➕</span> Tambah Kursus Baru
                    </a>
                    <a href="{{ route('admin.news.index') }}"
                       class="flex items-center gap-2 bg-theme-yellow text-theme-dark font-semibold px-5 py-3 rounded-lg hover:bg-yellow-400 transition shadow-sm text-sm">
                        <span>📰</span> Urus Berita
                    </a>
                </div>
            </div>

            <!-- Recent Applications & Kursus Diminati -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

                <!-- Permohonan Kursus TVET Terkini -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-bold text-theme-blue flex items-center gap-1.5">
                            <span>📋</span> Permohonan Kursus TVET Terkini
                        </h3>
                        <a href="{{ route('admin.up-tvet.index') }}" class="text-xs text-emerald-600 hover:underline font-semibold">
                            Lihat Semua →
                        </a>
                    </div>

                    @forelse ($recentUpTvetApplications as $upApp)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div>
                                <p class="font-medium text-gray-800 text-xs">{{ $upApp->full_name }}</p>
                                <p class="text-[11px] text-gray-500 font-medium">
                                    {{ $upApp->interested_course ?? $upApp->program_type ?? $upApp->email }}
                                </p>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">
                                {{ ucfirst($upApp->status) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-6">Belum ada permohonan kursus TVET.</p>
                    @endforelse
                </div>

                <!-- Kursus Popular -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-bold text-theme-blue">Kursus Paling Diminati</h3>
                        <a href="{{ route('admin.courses.index') }}" class="text-xs text-theme-purple hover:underline font-semibold">
                            Lihat Semua →
                        </a>
                    </div>

                    @forelse ($popularCourses as $course)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                            <div>
                                <p class="font-medium text-gray-800 text-xs">{{ $course->name }}</p>
                                <p class="text-[11px] text-gray-400">{{ $course->category->name }}</p>
                            </div>
                            <span class="bg-theme-accent/10 text-theme-accent font-bold text-xs px-2.5 py-0.5 rounded-full">
                                {{ $course->applications_count }} mohon
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-6">Belum ada data.</p>
                    @endforelse
                </div>

            </div>

        </div>
    </div>
</x-app-layout>