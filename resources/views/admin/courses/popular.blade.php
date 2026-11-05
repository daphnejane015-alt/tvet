<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-xl text-theme-dark leading-tight flex items-center gap-2">
                    Analisis Kursus Paling Diminati
                </h2>
                <p class="text-xs text-gray-500 mt-1">
                     Statistik permohonan kursus dan pecahan butiran pemohon mengikut setiap kursus.
                </p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-sky-100 hover:bg-sky-200 text-sky-900 border border-sky-300/80 text-xs font-extrabold transition shadow-xs">
                <span>←</span>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8" x-data="{ activeCourseId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Top Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Jumlah Kursus Aktif</p>
                        <h3 class="text-2xl font-black text-theme-blue mt-1">{{ $courses->count() }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-theme-blue flex items-center justify-center text-xl font-bold">
                        📚
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Jumlah Permohonan Direkod</p>
                        <h3 class="text-2xl font-black text-theme-accent mt-1">{{ $totalRegistrations }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-orange-50 text-theme-accent flex items-center justify-center text-xl font-bold">
                        👥
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Kursus No. 1 Paling Tinggi</p>
                        <h3 class="text-sm sm:text-base font-extrabold text-gray-900 mt-1 truncate max-w-[200px]" title="{{ $courses->first()->name ?? '-' }}">
                            {{ $courses->first()->name ?? '-' }}
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                        🏆
                    </div>
                </div>
            </div>

            <!-- Detailed Course Breakdown List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-base font-bold text-theme-dark">Pecahan Pemohon Mengikut Kursus</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Tekan pada kursus untuk melihat senarai dan butiran pemohon secara terperinci.</p>
                    </div>
                </div>

                <div class="space-y-4">
                    @forelse ($courses as $index => $course)
                        <div class="border rounded-2xl overflow-hidden transition-all duration-200 {{ $course->total_registered > 0 ? 'border-theme-blue/20 bg-white' : 'border-gray-200 bg-gray-50/50' }}">
                            
                            <!-- Course Header Bar (Clickable) -->
                            <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 cursor-pointer hover:bg-slate-50/80 transition"
                                 @click="activeCourseId = (activeCourseId === {{ $course->id }} ? null : {{ $course->id }})">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-xl flex items-center justify-center font-extrabold text-xs {{ $index === 0 ? 'bg-amber-100 text-amber-800' : ($index === 1 ? 'bg-slate-200 text-slate-800' : 'bg-gray-100 text-gray-600') }}">
                                        #{{ $index + 1 }}
                                    </span>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="font-extrabold text-gray-900 text-sm sm:text-base">{{ $course->name }}</h4>
                                            <span class="text-[9px] uppercase font-extrabold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">
                                                {{ $course->category->name ?? 'Umum' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between sm:justify-end gap-3 pt-2 sm:pt-0 border-t sm:border-0 border-gray-100">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold {{ $course->total_registered > 0 ? 'bg-theme-accent/15 text-theme-accent border border-theme-accent/30' : 'bg-gray-100 text-gray-500' }}">
                                        <span>👥</span>
                                        <span>{{ $course->total_registered }} Permohonan</span>
                                    </span>

                                    <button type="button" 
                                            class="text-xs font-bold text-theme-blue flex items-center gap-1">
                                        <span x-text="activeCourseId === {{ $course->id }} ? 'Sembunyi' : 'Lihat Pemohon'"></span>
                                        <svg class="w-4 h-4 transition-transform duration-200" 
                                             :class="activeCourseId === {{ $course->id }} ? 'rotate-180' : ''" 
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Expandable Applicants Table -->
                            <div x-show="activeCourseId === {{ $course->id }}" 
                                 x-transition 
                                 class="p-4 sm:p-5 bg-slate-50 border-t border-gray-100">
                                @if(isset($course->applicants) && $course->applicants->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left text-xs">
                                            <thead>
                                                <tr class="text-gray-500 uppercase tracking-wider font-extrabold border-b border-gray-200 pb-2">
                                                    <th class="py-2 px-3">Nama Pemohon</th>
                                                    <th class="py-2 px-3">No. KP / Telefon</th>
                                                    <th class="py-2 px-3">Lokasi</th>
                                                    <th class="py-2 px-3">Tarikh Memohon</th>
                                                    <th class="py-2 px-3">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200/60">
                                                @foreach($course->applicants as $applicant)
                                                    <tr class="hover:bg-white/80 transition">
                                                        <td class="py-2.5 px-3">
                                                            <p class="font-bold text-gray-900">{{ $applicant->full_name }}</p>
                                                            <p class="text-[11px] text-gray-500">{{ $applicant->email }}</p>
                                                        </td>
                                                        <td class="py-2.5 px-3">
                                                            <p class="font-mono text-gray-700">{{ $applicant->ic_number ?: '-' }}</p>
                                                            <p class="text-emerald-700 font-semibold">{{ $applicant->phone_number ?: '-' }}</p>
                                                        </td>
                                                        <td class="py-2.5 px-3 text-gray-600">
                                                            {{ $applicant->city ? $applicant->city . ', ' . $applicant->state : ($applicant->state ?: '-') }}
                                                        </td>
                                                        <td class="py-2.5 px-3 text-gray-600">
                                                            {{ $applicant->completed_at ? $applicant->completed_at->format('d/m/Y') : $applicant->created_at->format('d/m/Y') }}
                                                        </td>
                                                        <td class="py-2.5 px-3">
                                                            @if($applicant->status === 'verified')
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                                                    ★ Disahkan
                                                                </span>
                                                            @elseif($applicant->status === 'contacted')
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800">
                                                                    📞 Dihubungi
                                                                </span>
                                                            @elseif($applicant->status === 'rejected')
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                                                                    ✗ Ditolak
                                                                </span>
                                                            @elseif($applicant->status === 'completed' || empty($applicant->status))
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                                    ✓ Telah Mengisi
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-800">
                                                                    {{ ucfirst($applicant->status) }}
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-4 pt-3 border-t border-gray-200 flex justify-end">
                                        <a href="{{ route('admin.up-tvet.index', ['course' => $course->name]) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 bg-theme-blue hover:bg-theme-purple text-white rounded-xl text-xs font-extrabold transition shadow-xs">
                                            <span>Lihat Detail di Permohonan Kursus TVET</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="py-6 text-center text-gray-400">
                                        <p class="text-xs font-medium">Belum ada pemohon yang mendaftar kursus ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-8">Tiada kursus berdaftar ditemui.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
