<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Kursus</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md p-8 border-t-4 border-theme-accent">

                <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-lg focus:border-theme-accent focus:ring-theme-accent">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Nama Kursus</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-lg focus:border-theme-accent focus:ring-theme-accent"
                               value="{{ old('name') }}" placeholder="Contoh: Diploma Teknologi Automotif">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Deskripsi</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-lg focus:border-theme-accent focus:ring-theme-accent" rows="4"
                                  placeholder="Terangkan serba sedikit tentang kursus ini...">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Peluang Kerjaya</label>
                        <textarea name="career_prospects" class="w-full border-gray-300 rounded-lg focus:border-theme-accent focus:ring-theme-accent" rows="3"
                                  placeholder="Contoh: Juruteknik Automotif, Penyelia Bengkel, Usahawan Automotif">{{ old('career_prospects') }}</textarea>
                        @error('career_prospects') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Tempoh</label>
                        <input type="text" name="duration" class="w-full border-gray-300 rounded-lg focus:border-theme-accent focus:ring-theme-accent"
                               value="{{ old('duration') }}" placeholder="Contoh: 6 Bulan">
                        @error('duration') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-theme-blue mb-1">Gaji Minimum (RM)</label>
                            <input type="number" step="0.01" name="min_salary" class="w-full border-gray-300 rounded-lg focus:border-theme-accent focus:ring-theme-accent"
                                   value="{{ old('min_salary') }}" placeholder="1500">
                            @error('min_salary') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-theme-blue mb-1">Gaji Maksimum (RM)</label>
                            <input type="number" step="0.01" name="max_salary" class="w-full border-gray-300 rounded-lg focus:border-theme-accent focus:ring-theme-accent"
                                   value="{{ old('max_salary') }}" placeholder="3500">
                            @error('max_salary') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Gambar Kursus</label>
                        <div class="flex items-center gap-3">
                            <label for="image" class="cursor-pointer bg-theme-blue text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-theme-purple transition">
                                Pilih Fail
                            </label>
                            <span id="fileNameDisplay" class="text-sm text-gray-500">Tiada fail dipilih</span>
                            <input type="file" id="image" name="image" class="hidden"
                                   onchange="document.getElementById('fileNameDisplay').innerText = this.files.length ? this.files[0].name : 'Tiada fail dipilih'">
                        </div>
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-theme-blue text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-theme-purple transition">
                            Simpan Kursus
                        </button>
                        <a href="{{ route('admin.courses.index') }}"
                           class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-200 transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>