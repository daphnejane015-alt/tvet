<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-theme-dark tracking-tight">
                {{ __('Edit Kursus') }}
            </h2>
            <a href="{{ route('admin.courses.index') }}"
               class="text-xs bg-theme-light/60 text-theme-dark font-bold px-3 py-1 rounded-full border border-theme-purple/40 hover:bg-theme-light transition">
                ← Kembali ke Senarai
            </a>
        </div>
    </x-slot>

    <div class="bg-gradient-to-b from-theme-cream via-white to-theme-cream min-h-screen pb-16 -mx-4 sm:mx-0 px-4 sm:px-0">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 pt-8">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 border-t-4 border-theme-accent">

                <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="block text-sm font-extrabold text-theme-blue mb-2">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-xl focus:border-theme-accent focus:ring-2 focus:ring-theme-accent/20 transition px-4 py-3">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $course->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-extrabold text-theme-blue mb-2">Nama Kursus</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-xl focus:border-theme-accent focus:ring-2 focus:ring-theme-accent/20 transition px-4 py-3"
                               value="{{ old('name', $course->name) }}" placeholder="Contoh: Diploma Teknologi Automotif">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-extrabold text-theme-blue mb-2">Deskripsi</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-xl focus:border-theme-accent focus:ring-2 focus:ring-theme-accent/20 transition px-4 py-3" rows="4"
                                  placeholder="Terangkan serba sedikit tentang kursus ini...">{{ old('description', $course->description) }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-extrabold text-theme-blue mb-2">Peluang Kerjaya</label>
                        <textarea name="career_prospects" class="w-full border-gray-300 rounded-xl focus:border-theme-accent focus:ring-2 focus:ring-theme-accent/20 transition px-4 py-3" rows="3"
                                  placeholder="Contoh: Juruteknik Automotif, Penyelia Bengkel, Usahawan Automotif">{{ old('career_prospects', $course->career_prospects) }}</textarea>
                        @error('career_prospects') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-extrabold text-theme-blue mb-2">Tempoh</label>
                        <input type="text" name="duration" class="w-full border-gray-300 rounded-xl focus:border-theme-accent focus:ring-2 focus:ring-theme-accent/20 transition px-4 py-3"
                               value="{{ old('duration', $course->duration) }}" placeholder="Contoh: 6 Bulan">
                        @error('duration') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-extrabold text-theme-blue mb-2">Gaji Minimum (RM)</label>
                            <input type="number" step="0.01" name="min_salary" class="w-full border-gray-300 rounded-xl focus:border-theme-accent focus:ring-2 focus:ring-theme-accent/20 transition px-4 py-3"
                                   value="{{ old('min_salary', $course->min_salary) }}" placeholder="1500">
                            @error('min_salary') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-extrabold text-theme-blue mb-2">Gaji Maksimum (RM)</label>
                            <input type="number" step="0.01" name="max_salary" class="w-full border-gray-300 rounded-xl focus:border-theme-accent focus:ring-2 focus:ring-theme-accent/20 transition px-4 py-3"
                                   value="{{ old('max_salary', $course->max_salary) }}" placeholder="3500">
                            @error('max_salary') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-extrabold text-theme-blue mb-2">Gambar Semasa</label>
                        @if ($course->image)
                            <div class="relative inline-block mt-2 mb-4">
                                <img src="{{ asset($course->image) }}" class="w-40 h-28 object-cover rounded-xl shadow-md border-2 border-slate-200">
                                <div class="absolute -bottom-2 -right-2 bg-theme-blue text-white text-xs px-2 py-1 rounded-lg font-bold">
                                    Semasa
                                </div>
                            </div>
                        @else
                            <div class="w-40 h-28 bg-gradient-to-br from-theme-light to-theme-beige rounded-xl flex items-center justify-center mt-2 mb-4 border-2 border-dashed border-slate-300">
                                <span class="text-slate-400 text-sm">Tiada Gambar</span>
                            </div>
                        @endif

                        <label class="block text-sm font-extrabold text-theme-blue mb-2">Tukar Gambar (Pilihan)</label>
                        <div class="flex items-center gap-3">
                            <label for="image" class="cursor-pointer bg-gradient-to-r from-theme-blue to-theme-purple text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:from-theme-purple hover:to-theme-blue transition-all duration-200 shadow-md hover:shadow-lg flex items-center gap-2">
                                <span>📁</span>
                                <span>Pilih Fail</span>
                            </label>
                            <span id="fileNameDisplay" class="text-sm text-slate-500 font-medium">Tiada fail dipilih</span>
                            <input type="file" id="image" name="image" class="hidden"
                                   onchange="document.getElementById('fileNameDisplay').innerText = this.files.length ? this.files[0].name : 'Tiada fail dipilih'">
                        </div>
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-theme-blue to-theme-purple text-white px-6 py-3 rounded-xl font-extrabold hover:from-theme-purple hover:to-theme-blue transition-all duration-200 shadow-md hover:shadow-lg hover:scale-105 flex items-center justify-center gap-2">
                            <span>💾</span>
                            <span>Kemaskini Kursus</span>
                        </button>
                        <a href="{{ route('admin.courses.index') }}"
                           class="flex-1 bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition flex items-center justify-center gap-2">
                            <span>✕</span>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>