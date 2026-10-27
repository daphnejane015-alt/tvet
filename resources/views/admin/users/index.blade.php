<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                    <span class="text-2xl">👥</span> Senarai Pengguna
                </h2>
                <p class="text-xs text-gray-500 mt-1">Urus semua akaun pengguna yang telah mendaftar atau log masuk ke dalam sistem TVET.</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs bg-theme-blue/10 text-theme-blue font-bold px-3 py-1.5 rounded-lg border border-theme-blue/20">
                    Jumlah: {{ $totalUsers }} Akaun
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
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

            @if (session('error'))
                <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Semua Pengguna</p>
                        <h3 class="text-2xl font-black text-theme-blue mt-1">{{ $totalUsers }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                        👥
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Akaun Pelajar</p>
                        <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $studentCount }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
                        🎓
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Akaun Pentadbir</p>
                        <h3 class="text-2xl font-black text-amber-600 mt-1">{{ $adminCount }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                        🛡️
                    </div>
                </div>
            </div>

            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                    <div class="sm:col-span-6 relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nama atau emel pengguna..."
                               class="w-full pl-10 pr-4 py-2 text-sm border-gray-300 rounded-lg focus:border-theme-purple focus:ring-theme-purple">
                        <span class="absolute left-3 top-2.5 text-gray-400">
                            🔍
                        </span>
                    </div>

                    <div class="sm:col-span-3">
                        <select name="role" class="w-full py-2 text-sm border-gray-300 rounded-lg focus:border-theme-purple focus:ring-theme-purple">
                            <option value="">Semua Peranan</option>
                            <option value="student" {{ request('role') === 'student' ? 'selected' : '' }}>Pelajar</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Pentadbir (Admin)</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3 flex gap-2">
                        <button type="submit" class="w-full bg-theme-blue hover:bg-theme-purple text-white text-xs font-semibold py-2.5 px-4 rounded-lg transition shadow-sm">
                            Tapis Carian
                        </button>
                        @if(request('search') || request('role'))
                            <a href="{{ route('admin.users.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3 py-2.5 rounded-lg transition flex items-center justify-center">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table of Users -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-gray-200 text-gray-600 text-xs uppercase font-bold tracking-wider">
                                <th class="py-3.5 px-4">Pengguna</th>
                                <th class="py-3.5 px-4">Peranan</th>
                                <th class="py-3.5 px-4">Permohonan Kursus</th>
                                <th class="py-3.5 px-4">Status Pemohon</th>
                                <th class="py-3.5 px-4">Tarikh Daftar</th>
                                <th class="py-3.5 px-4 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($users as $user)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-theme-blue to-theme-purple text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-sm">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900 flex items-center gap-2">
                                                    <span>{{ $user->name }}</span>
                                                    @if(auth()->id() === $user->id)
                                                        <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-1.5 py-0.2 rounded-full">Anda</span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($user->isAdmin())
                                            <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                <span>🛡️</span> Pentadbir
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                <span>🎓</span> Pelajar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($user->upTvetApplications && $user->upTvetApplications->count() > 0)
                                            <div class="space-y-1">
                                                @foreach($user->upTvetApplications->take(3) as $tvetApp)
                                                    <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-900 border border-amber-200/60 text-xs font-semibold px-2.5 py-1 rounded-lg block">
                                                        <span>📚</span> {{ $tvetApp->course_interest ?? 'Kursus TVET' }}
                                                    </span>
                                                @endforeach
                                                @if($user->upTvetApplications->count() > 3)
                                                    <span class="text-[10px] text-gray-500 font-medium pl-1">+{{ $user->upTvetApplications->count() - 3 }} kursus lagi</span>
                                                @endif
                                            </div>
                                        @elseif($user->applications && $user->applications->count() > 0)
                                            <div class="space-y-1">
                                                @foreach($user->applications->take(2) as $app)
                                                    <span class="inline-block bg-blue-50 text-blue-700 text-xs font-medium px-2 py-0.5 rounded border border-blue-200/50">
                                                        {{ $app->course ? $app->course->name : 'Kursus #' . $app->course_id }}
                                                    </span>
                                                @endforeach
                                                @if($user->applications->count() > 2)
                                                    <span class="text-[10px] text-gray-400 block">+{{ $user->applications->count() - 2 }} lagi</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Belum Memohon</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @php
                                            $latestApp = $user->upTvetApplications?->first();
                                            $isComplete = $latestApp && $latestApp->isComplete();
                                        @endphp

                                        @if($isComplete)
                                            <div class="space-y-1">
                                                <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-800 text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-300">
                                                    <span>✓</span> Approved (Lengkap)
                                                </span>
                                                @if($latestApp->status && $latestApp->status !== 'completed')
                                                    <span class="block text-[10px] font-semibold text-gray-500 pl-1 uppercase">
                                                        Status: {{ ucfirst($latestApp->status) }}
                                                    </span>
                                                @endif
                                            </div>
                                        @elseif($latestApp)
                                            <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-amber-200">
                                                <span>⏳</span> Maklumat Belum Penuh
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Belum Mengisi</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-xs text-gray-500">
                                        {{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : '-' }}
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                               class="inline-flex items-center gap-1 bg-theme-blue text-white hover:bg-theme-purple text-xs font-semibold px-3 py-1.5 rounded-lg transition shadow-sm"
                                               title="Kemaskini Akaun">
                                                <span>✏️</span> Kemaskini
                                            </a>

                                            <!-- Delete Button -->
                                            @if(auth()->id() !== $user->id)
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                      onsubmit="return confirm('Adakah anda pasti mahu memadam akaun pengguna {{ $user->name }} ({{ $user->email }})? Tindakan ini tidak boleh dibatalkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-1 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border border-red-200 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition"
                                                            title="Padam Akaun">
                                                        <span>🗑️</span> Padam
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-[11px] text-gray-400 italic px-2">Akaun Semasa</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-gray-400">
                                        <span class="text-4xl block mb-2">🔍</span>
                                        <p class="text-sm font-medium">Tiada akaun pengguna ditemui.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="p-4 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
