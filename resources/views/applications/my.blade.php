<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permohonan Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Kursus</th>
                        <th class="py-2">Tarikh Mohon</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $app)
                        <tr class="border-b">
                            <td class="py-2">{{ $app->course->name }}</td>
                            <td class="py-2">{{ $app->created_at->format('d M Y') }}</td>
                            <td class="py-2">
                                <span @class([
                                    'px-2 py-1 rounded text-xs font-semibold',
                                    'bg-yellow-100 text-yellow-700' => $app->status === 'pending',
                                    'bg-green-100 text-green-700' => $app->status === 'approved',
                                    'bg-red-100 text-red-700' => $app->status === 'rejected',
                                ])>
                                    {{ ucfirst($app->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-4 text-center text-gray-500">Tiada permohonan lagi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>