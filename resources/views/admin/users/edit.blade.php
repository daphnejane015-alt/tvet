<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="text-2xl">✏️</span> Kemaskini Maklumat Pengguna
            </h2>
            <a href="{{ route('admin.users.index') }}"
               class="text-xs font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 rounded-lg transition flex items-center gap-1.5">
                <span>←</span> Kembali ke Senarai Pengguna
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md p-8 border-t-4 border-theme-blue">

                <!-- User Meta Header -->
                <div class="flex items-center gap-4 pb-6 mb-6 border-b border-gray-100">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-theme-blue to-theme-purple text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-md">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-xs text-gray-500">Mendaftar pada: {{ $user->created_at ? $user->created_at->format('d M Y, h:i A') : '-' }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Penuh -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Nama Penuh</label>
                        <input type="text" name="name"
                               class="w-full border-gray-300 rounded-lg focus:border-theme-purple focus:ring-theme-purple text-sm"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Emel -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Alamat Emel</label>
                        <input type="email" name="email"
                               class="w-full border-gray-300 rounded-lg focus:border-theme-purple focus:ring-theme-purple text-sm"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Peranan (Role) -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-theme-blue mb-1">Peranan Akaun (Role)</label>
                        <select name="role" class="w-full border-gray-300 rounded-lg focus:border-theme-purple focus:ring-theme-purple text-sm" required>
                            <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Pelajar (Student)</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Pentadbir (Admin)</option>
                        </select>
                        <p class="text-xs text-gray-400 mt-1">Pentadbir mempunyai akses penuh ke panel pentadbiran sistem TVET.</p>
                        @error('role')
                            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Divider Tukar Kata Laluan -->
                    <div class="pt-4 border-t border-gray-100 mb-5">
                        <h4 class="text-sm font-bold text-gray-700 mb-1">Tukar Kata Laluan (Pilihan)</h4>
                        <p class="text-xs text-gray-400">Biarkan kosong jika tidak mahu mengubah kata laluan pengguna ini.</p>
                    </div>

                    <!-- Kata Laluan Baru -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kata Laluan Baru</label>
                        <input type="password" name="password"
                               placeholder="Minimum 8 aksara"
                               class="w-full border-gray-300 rounded-lg focus:border-theme-purple focus:ring-theme-purple text-sm">
                        @error('password')
                            <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pengesahan Kata Laluan -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sahkan Kata Laluan Baru</label>
                        <input type="password" name="password_confirmation"
                               placeholder="Ulang kata laluan baru"
                               class="w-full border-gray-300 rounded-lg focus:border-theme-purple focus:ring-theme-purple text-sm">
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.users.index') }}"
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-theme-blue hover:bg-theme-purple text-white px-6 py-2.5 rounded-lg text-sm font-semibold transition shadow-sm flex items-center gap-2">
                            <span>💾</span> Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
