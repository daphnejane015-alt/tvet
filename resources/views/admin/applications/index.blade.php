<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Urus Permohonan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white rounded-xl shadow-md p-6">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            <p class="text-sm text-gray-500 mb-6">{{ $applications->count() }} permohonan direkodkan</p>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b-2 border-theme-blue/10 bg-theme-cream">
                            <th class="py-3 px-4 font-bold text-theme-blue">Pelajar</th>
                            <th class="py-3 px-4 font-bold text-theme-blue">Kursus</th>
                            <th class="py-3 px-4 font-bold text-theme-blue">Tarikh</th>
                            <th class="py-3 px-4 font-bold text-theme-blue">Status</th>
                            <th class="py-3 px-4 font-bold text-theme-blue text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($applications as $app)
                            <tr class="border-b border-gray-100 hover:bg-theme-cream/50 transition">
                                <td class="py-3 px-4">
                                    <p class="font-medium text-gray-800">{{ $app->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $app->user->email }}</p>
                                </td>
                                <td class="py-3 px-4 text-gray-700">{{ $app->course->name }}</td>
                                <td class="py-3 px-4 text-gray-500">{{ $app->created_at->format('d M Y') }}</td>
                                <td class="py-3 px-4">
                                    <span @class([
                                        'px-3 py-1 rounded-full text-xs font-semibold',
                                        'bg-yellow-100 text-yellow-700' => $app->status === 'pending',
                                        'bg-green-100 text-green-700' => $app->status === 'approved',
                                        'bg-red-100 text-red-700' => $app->status === 'rejected',
                                    ])>
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @if ($app->status === 'pending')
                                            <form method="POST" action="{{ route('admin.applications.update', $app) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-xs font-semibold hover:bg-green-200 transition">
                                                    Lulus
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.applications.update', $app) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-xs font-semibold hover:bg-red-200 transition">
                                                    Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Selesai</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400">Tiada permohonan lagi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>