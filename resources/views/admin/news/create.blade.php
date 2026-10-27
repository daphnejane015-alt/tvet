<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                    <span class="text-2xl">➕</span> Tambah Berita Baru
                </h2>
                <p class="text-xs text-gray-500 mt-1">Tambah berita baharu untuk dipaparkan di laman utama.</p>
            </div>
            <a href="{{ route('admin.news.index') }}"
               class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 font-semibold px-4 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                <span>←</span> Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">Tajuk Berita *</label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               required
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-theme-blue focus:ring-theme-blue text-sm"
                               placeholder="Masukkan tajuk berita">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Penerangan *</label>
                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  required
                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-theme-blue focus:ring-theme-blue text-sm"
                                  placeholder="Masukkan penerangan berita">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Source -->
                    <div class="mb-6">
                        <label for="source" class="block text-sm font-bold text-gray-700 mb-2">Sumber</label>
                        <input type="text"
                               id="source"
                               name="source"
                               value="{{ old('source') }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-theme-blue focus:ring-theme-blue text-sm"
                               placeholder="Contoh: Kosmo!, Berita RTM">
                        @error('source')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-bold text-gray-700 mb-2">Gambar</label>
                        <input type="file"
                               id="image"
                               name="image"
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-theme-blue focus:ring-theme-blue text-sm">
                        <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF (Maks: 2MB)</p>
                        @error('image')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- URL -->
                    <div class="mb-6">
                        <label for="url" class="block text-sm font-bold text-gray-700 mb-2">Pautan Berita</label>
                        <input type="url"
                               id="url"
                               name="url"
                               value="{{ old('url') }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-theme-blue focus:ring-theme-blue text-sm"
                               placeholder="https://...">
                        @error('url')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- News Date -->
                    <div class="mb-6">
                        <label for="news_date" class="block text-sm font-bold text-gray-700 mb-2">Tarikh Berita</label>
                        <input type="date"
                               id="news_date"
                               name="news_date"
                               value="{{ old('news_date') }}"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-theme-blue focus:ring-theme-blue text-sm">
                        @error('news_date')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order -->
                    <div class="mb-6">
                        <label for="order" class="block text-sm font-bold text-gray-700 mb-2">Tertib Paparan</label>
                        <input type="number"
                               id="order"
                               name="order"
                               value="{{ old('order', 0) }}"
                               min="0"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-theme-blue focus:ring-theme-blue text-sm"
                               placeholder="0">
                        <p class="mt-1 text-xs text-gray-500">Nombor lebih kecil akan dipaparkan dahulu</p>
                        @error('order')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Active -->
                    <div class="mb-6">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   checked
                                   class="w-5 h-5 text-theme-blue border-gray-300 rounded focus:ring-theme-blue">
                            <span class="text-sm font-medium text-gray-700">Aktifkan berita ini</span>
                        </label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                        <button type="submit"
                                class="bg-theme-blue hover:bg-theme-purple text-white font-semibold px-6 py-2.5 rounded-lg transition shadow-sm text-sm">
                            Simpan Berita
                        </button>
                        <a href="{{ route('admin.news.index') }}"
                           class="bg-gray-100 text-gray-700 font-semibold px-6 py-2.5 rounded-lg hover:bg-gray-200 transition text-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
