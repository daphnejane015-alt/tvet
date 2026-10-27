<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                    <span class="text-2xl">📰</span> Urus Berita
                </h2>
                <p class="text-xs text-gray-500 mt-1">Urus semua berita yang dipaparkan di laman utama. ({{ $news->count() }}/10)</p>
            </div>
            @if($news->count() < 10)
                <a href="{{ route('admin.news.create') }}"
                   class="inline-flex items-center gap-2 bg-theme-accent text-theme-dark font-semibold px-4 py-2 rounded-lg hover:bg-amber-400 transition shadow-sm text-sm">
                    <span>➕</span> Tambah Berita Baru
                </a>
            @else
                <span class="text-xs text-gray-500 bg-gray-100 px-4 py-2 rounded-lg">Had maksimum (10) dicapai</span>
            @endif
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

            <!-- News Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-slate-50 border-b border-gray-200 text-gray-600 text-xs uppercase font-bold tracking-wider">
                                <th class="py-3.5 px-4">Gambar</th>
                                <th class="py-3.5 px-4">Tajuk</th>
                                <th class="py-3.5 px-4">Sumber</th>
                                <th class="py-3.5 px-4">Tarikh</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-4">Tertib</th>
                                <th class="py-3.5 px-4 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($news as $item)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3.5 px-4">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-16 h-12 object-cover rounded-lg border border-gray-200">
                                        @else
                                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                                Tiada
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <div class="max-w-xs">
                                            <div class="font-semibold text-gray-900 line-clamp-1">{{ $item->title }}</div>
                                            <div class="text-xs text-gray-500 line-clamp-1 mt-1">{{ Str::limit($item->description, 50) }}</div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="text-xs text-gray-600">{{ $item->source ?? '-' }}</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="text-xs text-gray-500">{{ $item->news_date ? $item->news_date->format('d M Y') : '-' }}</span>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($item->is_active)
                                            <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                <span>✓</span> Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                                <span>○</span> Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        <span class="text-xs text-gray-500 font-medium">{{ $item->order }}</span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <form method="POST" action="{{ route('admin.news.toggle-status', $item) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1 {{ $item->is_active ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-600 hover:text-white' }} border border-gray-200 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition"
                                                        title="{{ $item->is_active ? 'Nyahaktifkan' : 'Aktifkan' }}">
                                                    <span>{{ $item->is_active ? '🔴' : '🟢' }}</span>
                                                </button>
                                            </form>
                                            <a href="{{ route('admin.news.edit', $item) }}"
                                               class="inline-flex items-center gap-1 bg-theme-blue text-white hover:bg-theme-purple text-xs font-semibold px-3 py-1.5 rounded-lg transition shadow-sm"
                                               title="Kemaskini">
                                                <span>✏️</span>
                                            </a>
                                            <form method="POST" action="{{ route('admin.news.destroy', $item) }}"
                                                  onsubmit="return confirm('Adakah anda pasti mahu memadam berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border border-red-200 text-xs font-semibold px-2.5 py-1.5 rounded-lg transition"
                                                        title="Padam">
                                                    <span>🗑️</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-gray-400">
                                        <span class="text-4xl block mb-2">📰</span>
                                        <p class="text-sm font-medium">Tiada berita ditemui.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
