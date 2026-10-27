<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                    <span class="text-2xl">📋</span> Permohonan Kursus TVET
                </h2>
                <p class="text-xs text-gray-500 mt-1">Senarai pemohon yang telah melengkapkan borang permohonan kursus TVET dalam sistem.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8" x-data="{ selectedApp: null, showModal: false, statusApp: null, showStatusModal: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Alerts -->
            @if (session('success'))
                <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Telah Mengisi</p>
                        <h3 class="text-2xl font-black text-theme-blue mt-1">{{ $totalCount }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                        👥
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Permohonan Hari Ini</p>
                        <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $todayCount }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        ⚡
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status Disahkan</p>
                        <h3 class="text-2xl font-black text-amber-600 mt-1">{{ $verifiedCount }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                        ⭐
                    </div>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <form method="GET" action="{{ route('admin.up-tvet.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                    <div class="sm:col-span-6 relative">
                        <input type="text" name="search" value="{{ $search }}"
                               placeholder="Cari nama, e-mel, no. telefon atau IC..."
                               class="w-full text-sm rounded-lg border-gray-300 focus:border-theme-blue focus:ring focus:ring-theme-blue/20 pl-9 py-2.5">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <div class="sm:col-span-3">
                        <select name="status" class="w-full text-sm rounded-lg border-gray-300 focus:border-theme-blue focus:ring focus:ring-theme-blue/20 py-2.5">
                            <option value="">Semua Status</option>
                            <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Telah Mengisi (Completed)</option>
                            <option value="verified" {{ $status === 'verified' ? 'selected' : '' }}>Disahkan (Verified)</option>
                            <option value="contacted" {{ $status === 'contacted' ? 'selected' : '' }}>Telah Dihubungi (Contacted)</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3 flex gap-2">
                        <button type="submit" class="w-full bg-theme-blue hover:bg-theme-purple text-white text-xs font-semibold px-4 py-2.5 rounded-lg transition shadow-sm">
                            Tapis
                        </button>
                        @if($search || $status)
                            <a href="{{ route('admin.up-tvet.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-2.5 rounded-lg transition flex items-center justify-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table of Applicants -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <p class="text-sm font-semibold text-gray-700">
                        Menunjukkan {{ $applications->total() }} rekod pemohon
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                                <th class="py-3.5 px-4 font-bold text-center w-12">#</th>
                                <th class="py-3.5 px-4 font-bold">Nama Pemohon</th>
                                <th class="py-3.5 px-4 font-bold">No. KP / Telefon</th>
                                <th class="py-3.5 px-4 font-bold">Permohonan Kursus</th>
                                <th class="py-3.5 px-4 font-bold">Lokasi</th>
                                <th class="py-3.5 px-4 font-bold">Tarikh</th>
                                <th class="py-3.5 px-4 font-bold">Status</th>
                                <th class="py-3.5 px-4 font-bold text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($applications as $index => $app)
                                <tr class="hover:bg-blue-50/40 transition">
                                    <td class="py-3.5 px-4 text-center font-medium text-gray-500 text-xs">
                                        {{ $applications->firstItem() + $index }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-theme-blue to-theme-purple text-white font-bold text-xs flex items-center justify-center uppercase shadow-sm">
                                                {{ substr($app->full_name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $app->full_name }}</p>
                                                <p class="text-xs text-gray-500">{{ $app->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="space-y-1">
                                            <p class="text-xs text-gray-700 font-mono">{{ $app->ic_number ?: '-' }}</p>
                                            @if($app->phone_number)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $app->phone_number) }}" target="_blank"
                                                   class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-800 text-xs font-medium hover:underline">
                                                    <span>{{ $app->phone_number }}</span>
                                                    <span class="text-[10px] bg-emerald-100 text-emerald-700 px-1 rounded">WA</span>
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($app->course_interest)
                                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-theme-accent/10 text-theme-accent">
                                                {{ $app->course_interest }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-gray-600 text-xs">
                                        @if($app->city && $app->state)
                                            <p>{{ $app->city }}, {{ $app->state }}</p>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-gray-600 text-xs">
                                        {{ $app->completed_at ? \Carbon\Carbon::parse($app->completed_at)->format('d M Y') : $app->created_at->format('d M Y') }}
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($app->status === 'completed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                ✓ Telah Mengisi
                                            </span>
                                        @elseif($app->status === 'verified')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                                ★ Disahkan
                                            </span>
                                        @elseif($app->status === 'contacted')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                                📞 Dihubungi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                                {{ ucfirst($app->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <!-- Detail Button -->
                                            <button type="button"
                                                    @click="selectedApp = {{ json_encode($app) }}; showModal = true"
                                                    class="p-1.5 text-gray-600 hover:text-theme-blue hover:bg-gray-100 rounded-lg transition"
                                                    title="Lihat Butiran">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>

                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.up-tvet.edit', $app) }}"
                                               class="p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition"
                                               title="Kemaskini Rekod">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            <!-- Status Button -->
                                            <button type="button"
                                                    @click="statusApp = {{ json_encode($app) }}; showStatusModal = true"
                                                    class="p-1.5 text-amber-600 hover:text-amber-800 hover:bg-amber-50 rounded-lg transition"
                                                    title="Kemaskini Status">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </button>

                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.up-tvet.destroy', $app) }}"
                                                  onsubmit="return confirm('Adakah anda pasti ingin memadamkan rekod permohonan {{ $app->full_name }}? Tindakan ini tidak boleh diundur.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition" title="Padam Rekod">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-12 text-center">
                                        <div class="text-4xl mb-2">📭</div>
                                        <p class="text-sm font-medium text-gray-500">Tiada rekod permohonan kursus TVET ditemui.</p>
                                        <p class="text-xs text-gray-400 mt-1">Pemohon yang selesai mengisi borang permohonan TVET akan dipaparkan di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($applications->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>

        </div>

        <!-- Detail Modal -->
        <div x-show="showModal"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity"
                     @click="showModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    
                    <div class="bg-gradient-to-r from-theme-blue to-theme-purple px-6 py-5 text-white flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">📄</span>
                            <h3 class="text-lg font-bold">Butiran Pemohon Kursus TVET</h3>
                        </div>
                        <button @click="showModal = false" class="text-gray-300 hover:text-white transition text-lg">&times;</button>
                    </div>

                    <div class="px-6 py-5 space-y-4">
                        <template x-if="selectedApp">
                            <div class="space-y-3">
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 space-y-2">
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Nama Penuh</span>
                                        <span class="text-sm font-bold text-gray-900" x-text="selectedApp.full_name"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Alamat E-mel</span>
                                        <span class="text-sm font-semibold text-blue-600" x-text="selectedApp.email"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">No. Kad Pengenalan</span>
                                        <span class="text-sm font-mono text-gray-800" x-text="selectedApp.ic_number || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">No. Telefon</span>
                                        <span class="text-sm font-semibold text-gray-800" x-text="selectedApp.phone_number || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Alamat</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.address || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Bandar / Negeri</span>
                                        <span class="text-sm text-gray-800" x-text="(selectedApp.city || '-') + ', ' + (selectedApp.state || '-')"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Poskod</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.postcode || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Tahap Pendidikan</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.education_level || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Nama Sekolah</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.school_name || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Tahun Tamat</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.graduation_year || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Permohonan Kursus</span>
                                        <span class="text-sm font-semibold text-theme-blue" x-text="selectedApp.course_interest || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Kenapa Pilih Kursus</span>
                                        <span class="text-sm text-gray-700 max-w-xs text-right" x-text="selectedApp.why_choose_course || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Nama Kecemasan</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.emergency_contact_name || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Telefon Kecemasan</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.emergency_contact_phone || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Hubungan Kecemasan</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.emergency_contact_relationship || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Nama Bapa</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.father_name || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Telefon Bapa</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.father_contact || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Pekerjaan Bapa</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.father_occupation || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Nama Ibu</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.mother_name || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Telefon Ibu</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.mother_contact || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Pekerjaan Ibu</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.mother_occupation || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Jumlah Pendapatan</span>
                                        <span class="text-sm font-semibold text-gray-800" x-text="selectedApp.total_income ? 'RM ' + selectedApp.total_income : 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Nama Pegawai Jemputan</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.invitation_officer_name || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Telefon Pegawai Jemputan</span>
                                        <span class="text-sm text-gray-800" x-text="selectedApp.invitation_officer_contact || 'Tidak dinyatakan'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Setuju Terma</span>
                                        <span class="text-sm font-bold" :class="selectedApp.agreed_to_terms ? 'text-emerald-600' : 'text-red-600'" x-text="selectedApp.agreed_to_terms ? '✓ Ya' : '✗ Tidak'"></span>
                                    </div>
                                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                        <span class="text-xs text-gray-500 font-medium">Tarikh & Masa</span>
                                        <span class="text-sm text-gray-700" x-text="selectedApp.completed_at ? new Date(selectedApp.completed_at).toLocaleString('ms-MY') : '-'"></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 font-medium">Status</span>
                                        <span class="text-xs uppercase font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800" x-text="selectedApp.status"></span>
                                    </div>
                                </div>

                                <div class="bg-amber-50/60 p-3 rounded-lg border border-amber-200 text-xs text-amber-900">
                                    <strong>Catatan Pemohon / Nota:</strong>
                                    <p class="mt-1 text-slate-700" x-text="selectedApp.notes || 'Tiada sebarang catatan tambahan.'"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 flex justify-end gap-2">
                        <button type="button" @click="showModal = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs font-semibold px-4 py-2 rounded-lg transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Status Modal -->
        <div x-show="showStatusModal"
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto"
             aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showStatusModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity"
                     @click="showStatusModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showStatusModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                    
                    <form method="POST" :action="statusApp ? '{{ url('/admin/up-tvet') }}/' + statusApp.id + '/status' : '#'">
                        @csrf
                        @method('PATCH')

                        <div class="bg-gradient-to-r from-theme-blue to-theme-purple px-6 py-5 text-white flex justify-between items-center">
                            <h3 class="text-base font-bold flex items-center gap-2">
                                <span>✏️</span> Kemaskini Status Pemohon
                            </h3>
                            <button type="button" @click="showStatusModal = false" class="text-gray-300 hover:text-white transition text-lg">&times;</button>
                        </div>

                        <div class="px-6 py-5 space-y-4">
                            <template x-if="statusApp">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800" x-text="'Pemohon: ' + statusApp.full_name"></p>
                                    <p class="text-xs text-gray-500 mb-4" x-text="statusApp.email"></p>

                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Status Baharu</label>
                                            <select name="status" class="w-full text-sm rounded-lg border-gray-300 focus:border-theme-blue focus:ring focus:ring-theme-blue/20">
                                                <option value="completed" :selected="statusApp.status === 'completed'">Telah Mengisi (Completed)</option>
                                                <option value="verified" :selected="statusApp.status === 'verified'">Disahkan (Verified)</option>
                                                <option value="contacted" :selected="statusApp.status === 'contacted'">Telah Dihubungi (Contacted)</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Catatan Pentadbir (Pilihan)</label>
                                            <textarea name="notes" rows="3" class="w-full text-sm rounded-lg border-gray-300 focus:border-theme-blue focus:ring focus:ring-theme-blue/20"
                                                      placeholder="Masukkan sebarang nota atau tindakan lanjutan..."
                                                      :value="statusApp.notes || ''"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-2">
                            <button type="button" @click="showStatusModal = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs font-semibold px-4 py-2 rounded-lg transition">
                                Batal
                            </button>
                            <button type="submit" class="bg-theme-blue hover:bg-theme-purple text-white text-xs font-semibold px-4 py-2 rounded-lg transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
