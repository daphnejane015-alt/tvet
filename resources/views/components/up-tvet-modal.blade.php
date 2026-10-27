@php
    $isLoggedIn = auth()->check();
    $hasCompleted = $isLoggedIn && auth()->user()->hasCompletedUpTvet();
    $upApp = $hasCompleted ? auth()->user()->upTvetApplication : null;
    $nativeFormUrl = route('up-tvet.form');
    $autoOpen = session('up_tvet_success') || session('up_tvet_open');
@endphp

<div x-data="{
        open: {{ $autoOpen ? 'true' : 'false' }},
        hasCompleted: {{ $hasCompleted ? 'true' : 'false' }}
     }"
     @open-up-tvet-modal.window="open = true"
     x-cloak>

    <!-- Modal Backdrop -->
    <div x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 overflow-y-auto"
         @click.self="open = false">

        <!-- Modal Dialog -->
        <div x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100 my-8 text-left transition-all">

            <!-- Flash Success Message if just submitted -->
            @if(session('up_tvet_success'))
                <div class="bg-emerald-500 text-white p-4 flex items-center gap-3">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <div class="text-xs sm:text-sm font-medium">
                        {{ session('up_tvet_success') }}
                    </div>
                </div>
            @endif

            @if(!$isLoggedIn)
                <!-- ================= CASE 1: GUEST (NOT LOGGED IN) ================= -->
                <div class="bg-gradient-to-r from-theme-blue to-theme-purple p-6 text-white text-center relative">
                    <button @click="open = false" class="absolute top-4 right-4 text-slate-300 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="w-14 h-14 bg-amber-500/20 text-amber-400 rounded-2xl flex items-center justify-center mx-auto mb-3 text-2xl font-bold border border-amber-400/30">
                        📋
                    </div>
                    <h3 class="text-xl font-bold">Mohon TVET</h3>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1">Pengambilan Pelajar TVET Sesi Terkini</p>
                </div>

                <div class="p-6 space-y-4">
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-xs sm:text-sm text-amber-900 flex items-start gap-3">
                        <span class="text-lg">💡</span>
                        <div>
                            <strong class="font-bold block mb-1">Log Masuk Diperlukan</strong>
                            Sila log masuk atau daftar akaun terlebih dahulu untuk mengisi borang permohonan TVET supaya permohonan anda direkodkan dalam sistem dan anda menerima pengesahan rasmi.
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <a href="{{ route('login') }}"
                           class="w-full text-center bg-theme-blue hover:bg-theme-purple text-white font-bold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-sm">
                            Log Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="w-full text-center bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-sm">
                            Daftar Akaun
                        </a>
                    </div>
                </div>

            @elseif($hasCompleted)
                <!-- ================= CASE 2: LOGGED IN & ALREADY FILLED ================= -->
                <div class="bg-gradient-to-r from-emerald-800 to-theme-blue p-6 text-white text-center relative">
                    <button @click="open = false" class="absolute top-4 right-4 text-slate-300 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="w-16 h-16 bg-emerald-500/20 text-emerald-300 rounded-full flex items-center justify-center mx-auto mb-3 text-3xl font-bold border-2 border-emerald-400/40">
                        ✓
                    </div>
                    <span class="inline-block px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-200 text-xs font-semibold uppercase tracking-wider mb-2 border border-emerald-400/30">
                        Borang Telah Diisi
                    </span>
                    <h3 class="text-xl font-extrabold text-white">Anda Telah Mengisi Borang TVET!</h3>
                    <p class="text-xs text-emerald-100 mt-1">Maklumat permohonan anda telah selamat direkodkan dalam sistem.</p>
                </div>

                <div class="p-6 space-y-4">
                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 text-xs sm:text-sm space-y-2.5 max-h-96 overflow-y-auto">
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Nama Pemohon:</span>
                            <span class="font-bold text-slate-900">{{ $upApp->full_name }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">E-mel:</span>
                            <span class="font-semibold text-blue-600">{{ $upApp->email }}</span>
                        </div>
                        @if($upApp->ic_number)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">No. Kad Pengenalan:</span>
                            <span class="font-mono text-slate-800">{{ $upApp->ic_number }}</span>
                        </div>
                        @endif
                        @if($upApp->phone_number)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">No. Telefon:</span>
                            <span class="text-slate-800">{{ $upApp->phone_number }}</span>
                        </div>
                        @endif
                        @if($upApp->address)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Alamat:</span>
                            <span class="text-slate-800">{{ $upApp->address }}</span>
                        </div>
                        @endif
                        @if($upApp->city || $upApp->state)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Bandar / Negeri:</span>
                            <span class="text-slate-800">{{ $upApp->city ?? '-' }}, {{ $upApp->state ?? '-' }}</span>
                        </div>
                        @endif
                        @if($upApp->education_level)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Tahap Pendidikan:</span>
                            <span class="text-slate-800">{{ $upApp->education_level }}</span>
                        </div>
                        @endif
                        @if($upApp->school_name)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Nama Sekolah:</span>
                            <span class="text-slate-800">{{ $upApp->school_name }}</span>
                        </div>
                        @endif
                        @if($upApp->graduation_year)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Tahun Tamat:</span>
                            <span class="text-slate-800">{{ $upApp->graduation_year }}</span>
                        </div>
                        @endif
                        @if($upApp->course_interest)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Kursus Diminati:</span>
                            <span class="font-semibold text-theme-blue">{{ $upApp->course_interest }}</span>
                        </div>
                        @endif
                        @if($upApp->emergency_contact_name)
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Kontak Kecemasan:</span>
                            <span class="text-slate-800">{{ $upApp->emergency_contact_name }} ({{ $upApp->emergency_contact_phone ?? '-' }})</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                            <span class="text-slate-500">Tarikh Lengkap:</span>
                            <span class="font-medium text-slate-800">
                                {{ $upApp->completed_at ? \Carbon\Carbon::parse($upApp->completed_at)->format('d M Y, h:i A') : $upApp->created_at->format('d M Y, h:i A') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500">Status Permohonan:</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold
                                @if($upApp->status === 'verified') bg-blue-100 text-blue-800
                                @elseif($upApp->status === 'contacted') bg-purple-100 text-purple-800
                                @else bg-emerald-100 text-emerald-800 @endif">
                                {{ ucfirst($upApp->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-blue-50/80 border border-blue-200 rounded-xl p-3.5 text-xs text-blue-900 flex items-start gap-2.5">
                        <span class="text-base">📧</span>
                        <div>
                            <strong>Notifikasi E-mel:</strong> Pengesahan telah direkodkan dalam sistem dan dihantar ke <strong>{{ $upApp->email }}</strong>.
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 pt-2">
                        <a href="{{ route('up-tvet.edit', $upApp) }}"
                           class="w-full text-center bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold py-2.5 px-3 rounded-xl text-xs transition shadow-sm">
                            ✏️ Kemaskini Borang
                        </a>
                        <a href="{{ $nativeFormUrl }}"
                           class="w-full text-center bg-theme-blue hover:bg-theme-purple text-white font-bold py-2.5 px-3 rounded-xl text-xs transition shadow-sm">
                            ➕ Mohon Kursus Lain
                        </a>
                    </div>
                    <div>
                        <button type="button" @click="open = false"
                                class="w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-xl text-xs transition">
                            Tutup
                        </button>
                    </div>
                </div>

            @else
                <!-- ================= CASE 3: LOGGED IN & NOT YET COMPLETED ================= -->
                <div class="bg-gradient-to-r from-theme-blue to-theme-purple p-6 text-white text-center relative">
                    <button @click="open = false" class="absolute top-4 right-4 text-slate-300 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="w-14 h-14 bg-amber-500/20 text-amber-400 rounded-2xl flex items-center justify-center mx-auto mb-3 text-2xl font-bold border border-amber-400/30">
                        📝
                    </div>
                    <h3 class="text-xl font-bold">Mohon TVET</h3>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1">Lengkapkan borang permohonan untuk mendaftar</p>
                </div>

                <div class="p-6 space-y-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 space-y-2">
                        <div class="flex items-center gap-2 text-blue-900 font-bold text-xs uppercase tracking-wider">
                            <span class="text-lg">💡</span>
                            Borang Permohonan Sistem
                        </div>
                        <p class="text-xs text-blue-800 leading-relaxed">
                            Sila lengkapkan borang permohonan TVET secara terus di platform ini. Semua maklumat akan disimpan dengan selamat dalam sistem dan diproses oleh pentadbir.
                        </p>
                    </div>

                    <div class="space-y-3 pt-2">
                        <a href="{{ $nativeFormUrl }}"
                           class="w-full bg-theme-blue hover:bg-theme-purple text-white font-bold py-3 px-4 rounded-xl text-xs sm:text-sm transition shadow-md flex items-center justify-center gap-2">
                            <span>Isi Borang Permohonan TVET</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
