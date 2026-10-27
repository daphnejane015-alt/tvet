<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-theme-blue to-theme-purple rounded-xl p-8 mb-8 text-white">
                <h3 class="text-2xl font-bold">Selamat Kembali, {{ Auth::user()->name }} 👋</h3>
                <p class="text-gray-200 text-sm mt-2">
                    @if (Auth::user()->isAdmin())
                        Anda log masuk sebagai <span class="font-semibold text-theme-accent">Admin</span>.
                    @else
                        Anda log masuk sebagai <span class="font-semibold text-theme-accent">Pelajar</span>.
                    @endif
                </p>
            </div>

            @if (Auth::user()->isAdmin())
                <!-- ADMIN VIEW -->
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <div class="text-4xl mb-3">🛠️</div>
                    <h3 class="text-lg font-bold text-theme-blue mb-2">Panel Pentadbir</h3>
                    <p class="text-sm text-gray-500 mb-5">
                        Urus kursus, semak permohonan pelajar, dan pantau statistik sistem dari panel admin.
                    </p>
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-block bg-theme-blue text-white px-6 py-3 rounded-lg hover:bg-theme-purple transition">
                        Pergi ke Admin Panel →
                    </a>
                </div>
            @else
                <!-- STUDENT VIEW -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">✓</span>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('up_tvet_success'))
                    <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">🎉</span>
                            <span class="text-sm font-medium">{{ session('up_tvet_success') }}</span>
                        </div>
                    </div>
                @endif

                <div x-data="{ selectedApp: null, showDetailModal: false }">
                    <!-- Action Bar / Summary Header -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-t-4 border-theme-accent flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-2xl">📋</span>
                                <h3 class="text-lg font-bold text-theme-blue">Pendaftaran Kursus TVET</h3>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                Anda boleh mendaftar lebih daripada satu kursus pilihan. Setiap permohonan boleh disemak dan dikemaskini.
                            </p>
                        </div>
                        <a href="{{ route('up-tvet.form') }}"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-bold px-5 py-2.5 rounded-lg text-sm transition shadow-md shrink-0">
                            <span>➕</span>
                            <span>Mohon Kursus TVET Baharu</span>
                        </a>
                    </div>

                    <!-- Permohonan Saya Section (Full List in Dashboard) -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100 bg-slate-50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                            <div>
                                <h3 class="text-base font-bold text-theme-blue flex items-center gap-2">
                                    <span>📝</span> Permohonan Saya
                                </h3>
                                <p class="text-xs text-gray-500 mt-0.5">Senarai semua kursus yang telah anda daftarkan berserta status permohonan terkini.</p>
                            </div>
                            <span class="bg-theme-blue text-white text-xs font-bold px-3 py-1 rounded-full">
                                {{ $upTvetApplications->count() }} Kursus Didaftar
                            </span>
                        </div>

                        @if ($upTvetApplications->isEmpty())
                            <div class="p-12 text-center">
                                <div class="text-5xl mb-3">🎓</div>
                                <h4 class="text-base font-bold text-gray-700 mb-1">Belum Ada Permohonan Kursus</h4>
                                <p class="text-xs text-gray-500 max-w-md mx-auto mb-5">
                                    Anda belum mendaftar mana-mana kursus TVET lagi. Klik butang di bawah untuk memulakan permohonan pertama anda!
                                </p>
                                <a href="{{ route('up-tvet.form') }}"
                                   class="inline-flex items-center gap-2 bg-theme-blue hover:bg-theme-purple text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition shadow-sm">
                                    <span>✍️</span> Isi Borang Permohonan Sekarang
                                </a>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead>
                                        <tr class="bg-slate-100/70 border-b border-gray-200 text-gray-600 text-xs uppercase font-bold tracking-wider">
                                            <th class="py-3.5 px-6">Kursus Dipohon</th>
                                            <th class="py-3.5 px-4">Tarikh Permohonan</th>
                                            <th class="py-3.5 px-4">Status</th>
                                            <th class="py-3.5 px-6 text-center">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach ($upTvetApplications as $app)
                                            <tr class="hover:bg-slate-50/70 transition">
                                                <td class="py-4 px-6">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-bold shrink-0 border border-amber-200/50">
                                                            📚
                                                        </div>
                                                        <div>
                                                            <div class="font-bold text-gray-900 text-sm">
                                                                {{ $app->course_interest ?? 'Kursus TVET' }}
                                                            </div>
                                                            <div class="text-xs text-gray-400 mt-0.5">
                                                                No. IC: <span class="font-mono text-gray-600">{{ $app->ic_number ?? '-' }}</span> | Tel: {{ $app->phone_number ?? '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-4 text-gray-600 text-xs">
                                                    {{ $app->completed_at ? \Carbon\Carbon::parse($app->completed_at)->format('d M Y, h:i A') : $app->created_at->format('d M Y, h:i A') }}
                                                </td>
                                                <td class="py-4 px-4">
                                                    @if($app->status === 'verified')
                                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                            <span>★</span> Disahkan (Verified)
                                                        </span>
                                                    @elseif($app->status === 'contacted')
                                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800">
                                                            <span>📞</span> Dihubungi (Contacted)
                                                        </span>
                                                    @elseif($app->status === 'approved')
                                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                                            <span>✓</span> Diluluskan
                                                        </span>
                                                    @elseif($app->status === 'rejected')
                                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                                            <span>✕</span> Ditolak
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                            <span>✓</span> Telah Mengisi
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="py-4 px-6 text-center">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <!-- Lihat Butiran Button -->
                                                        <button type="button"
                                                                @click="selectedApp = {{ json_encode($app) }}; showDetailModal = true"
                                                                class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition"
                                                                title="Lihat Butiran Lengkap">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>
                                                            <span>Butiran</span>
                                                        </button>

                                                        <!-- Kemaskini Button -->
                                                        <a href="{{ route('up-tvet.edit', $app) }}"
                                                           class="inline-flex items-center gap-1.5 bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200 text-xs font-semibold px-3 py-1.5 rounded-lg transition"
                                                           title="Kemaskini Borang Permohonan">
                                                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                            <span>Kemaskini</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- User Detail Modal -->
                    <div x-show="showDetailModal"
                         x-cloak
                         class="fixed inset-0 z-50 overflow-y-auto"
                         aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="showDetailModal"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="fixed inset-0 bg-gray-900 bg-opacity-60 transition-opacity"
                                 @click="showDetailModal = false"></div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <div x-show="showDetailModal"
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
                                        <h3 class="text-lg font-bold">Butiran Permohonan Kursus</h3>
                                    </div>
                                    <button @click="showDetailModal = false" class="text-gray-300 hover:text-white transition text-lg">&times;</button>
                                </div>

                                <div class="px-6 py-5 space-y-4 max-h-[75vh] overflow-y-auto">
                                    <template x-if="selectedApp">
                                        <div class="space-y-3">
                                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 space-y-2.5">
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Kursus Dipohon:</span>
                                                    <span class="text-sm font-bold text-theme-blue" x-text="selectedApp.course_interest"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Status Permohonan:</span>
                                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase"
                                                          :class="{
                                                              'bg-blue-100 text-blue-800': selectedApp.status === 'verified',
                                                              'bg-purple-100 text-purple-800': selectedApp.status === 'contacted',
                                                              'bg-emerald-100 text-emerald-800': selectedApp.status === 'completed'
                                                          }"
                                                          x-text="selectedApp.status"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Nama Pemohon:</span>
                                                    <span class="text-sm font-semibold text-gray-900" x-text="selectedApp.full_name"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">E-mel:</span>
                                                    <span class="text-sm text-blue-600 font-medium" x-text="selectedApp.email"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">No. Kad Pengenalan:</span>
                                                    <span class="text-sm font-mono text-gray-800" x-text="selectedApp.ic_number || '-'"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">No. Telefon:</span>
                                                    <span class="text-sm text-gray-800" x-text="selectedApp.phone_number || '-'"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Alamat:</span>
                                                    <span class="text-sm text-gray-800 max-w-xs text-right" x-text="selectedApp.address || '-'"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Bandar / Negeri:</span>
                                                    <span class="text-sm text-gray-800" x-text="(selectedApp.city || '-') + ', ' + (selectedApp.state || '-')"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Tahap Pendidikan:</span>
                                                    <span class="text-sm text-gray-800" x-text="selectedApp.education_level || '-'"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Nama Sekolah:</span>
                                                    <span class="text-sm text-gray-800" x-text="selectedApp.school_name || '-'"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Tahun Tamat:</span>
                                                    <span class="text-sm text-gray-800" x-text="selectedApp.graduation_year || '-'"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Sebab Memilih Kursus:</span>
                                                    <span class="text-sm text-gray-700 max-w-xs text-right" x-text="selectedApp.why_choose_course || '-'"></span>
                                                </div>
                                                <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                                                    <span class="text-xs text-gray-500 font-medium">Kontak Kecemasan:</span>
                                                    <span class="text-sm text-gray-800" x-text="(selectedApp.emergency_contact_name || '-') + ' (' + (selectedApp.emergency_contact_phone || '-') + ')'"></span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-xs text-gray-500 font-medium">Tarikh Hantar:</span>
                                                    <span class="text-xs text-gray-700 font-medium" x-text="selectedApp.completed_at ? new Date(selectedApp.completed_at).toLocaleString('ms-MY') : '-'"></span>
                                                </div>
                                            </div>

                                            <div class="flex gap-3 pt-2">
                                                <a :href="'/up-tvet/' + selectedApp.id + '/edit'"
                                                   class="w-full text-center bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-sm">
                                                    ✏️ Kemaskini Borang Ini
                                                </a>
                                                <button type="button" @click="showDetailModal = false"
                                                        class="w-full text-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>