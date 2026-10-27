<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Urus Kursus</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-theme-blue">Senarai Kursus</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $courses->count() }} kursus berdaftar dalam sistem</p>
                    </div>
                    <a href="{{ route('admin.courses.create') }}"
                       class="flex items-center justify-center gap-2 bg-theme-blue text-white px-5 py-2.5 rounded-lg hover:bg-theme-purple transition text-sm font-semibold shadow-sm">
                        <span>➕</span> Tambah Kursus Baru
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-theme-blue hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                        @if ($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" class="w-full h-44 object-cover">
                        @else
                            <div class="w-full h-44 bg-gradient-to-br from-theme-blue to-theme-purple flex items-center justify-center">
                                <span class="text-white font-semibold text-sm px-4 text-center">{{ $course->category->name }}</span>
                            </div>
                        @endif
                        <div class="p-5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-theme-purple font-bold uppercase tracking-wide">
                                    {{ $course->category->name }}
                                </span>
                                <span class="text-xs bg-theme-accent/10 text-theme-accent font-semibold px-2 py-0.5 rounded-full">
                                    {{ $course->duration }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-theme-blue leading-snug mb-2">{{ $course->name }}</h3>
                            @if ($course->description)
                                <p class="text-xs text-gray-500 line-clamp-2 mb-3">{{ Str::limit($course->description, 80) }}</p>
                            @endif
                            @if ($course->min_salary || $course->max_salary)
                                <div class="flex items-center gap-1 mb-4">
                                    <span class="text-xs text-gray-500">💰</span>
                                    <p class="text-sm font-semibold text-green-700">
                                        RM {{ number_format($course->min_salary, 0) }} - {{ number_format($course->max_salary, 0) }}
                                    </p>
                                </div>
                            @endif
                            <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                                <a href="{{ route('admin.courses.edit', $course) }}"
                                   class="flex-1 text-center text-sm bg-theme-blue text-white px-3 py-2 rounded-lg hover:bg-theme-purple transition font-medium">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                      onsubmit="return confirm('Padam kursus ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="flex-1 text-sm bg-red-50 text-red-600 px-3 py-2 rounded-lg hover:bg-red-100 transition font-medium">
                                        Padam
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($courses->isEmpty())
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="text-5xl mb-4">📚</div>
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Tiada Kursus Lagi</h3>
                    <p class="text-sm text-gray-500 mb-4">Mulakan dengan menambah kursus pertama anda.</p>
                    <a href="{{ route('admin.courses.create') }}"
                       class="inline-flex items-center gap-2 bg-theme-blue text-white px-5 py-2.5 rounded-lg hover:bg-theme-purple transition text-sm font-semibold">
                        <span>➕</span> Tambah Kursus Pertama
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>