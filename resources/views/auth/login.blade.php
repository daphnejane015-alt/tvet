<x-guest-layout>
    @php
        $initialTab = old('login_type', $role ?? 'student');
        if (!in_array($initialTab, ['student', 'admin'])) {
            $initialTab = 'student';
        }
    @endphp

    <div x-data="{
        activeTab: '{{ $initialTab }}',
        setTab(tab) {
            this.activeTab = tab;
            const url = new URL(window.location);
            url.searchParams.set('role', tab);
            window.history.replaceState({}, '', url);
        }
    }">
        <!-- Dual Portal Switcher Tabs -->
        <div class="bg-slate-100 p-1 rounded-xl flex items-center mb-6 border border-slate-200">
            <button type="button"
                    @click="setTab('student')"
                    :class="activeTab === 'student' ? 'bg-white text-theme-blue font-bold shadow-md shadow-slate-200' : 'text-slate-500 hover:text-slate-800 font-medium'"
                    class="flex-1 py-2.5 px-3 rounded-lg text-xs sm:text-sm flex items-center justify-center gap-2 transition duration-200">
                <span class="text-base">🎓</span>
                <span>Log Masuk Pelajar</span>
            </button>

            <button type="button"
                    @click="setTab('admin')"
                    :class="activeTab === 'admin' ? 'bg-slate-900 text-amber-400 font-bold shadow-md shadow-slate-900/30' : 'text-slate-500 hover:text-slate-800 font-medium'"
                    class="flex-1 py-2.5 px-3 rounded-lg text-xs sm:text-sm flex items-center justify-center gap-2 transition duration-200">
                <span class="text-base">🛡️</span>
                <span>Log Masuk Pentadbir</span>
            </button>
        </div>

        <!-- Dynamic Portal Header -->
        <div class="mb-5 text-center transition-all duration-300">
            <!-- Student Header Info -->
            <div x-show="activeTab === 'student'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-[10px] font-extrabold uppercase tracking-wider mb-1.5 border border-blue-200">
                    Portal Pelajar
                </span>
                <h2 class="text-xl font-bold text-slate-900">Selamat Kembali, Pelajar</h2>
                <p class="text-xs text-slate-500 mt-1 max-w-xs mx-auto">
                    Akses permohonan kursus kemahiran, semak status dan semakan UP_TVET.
                </p>
            </div>

            <!-- Admin Header Info -->
            <div x-show="activeTab === 'admin'"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-block px-3 py-1 rounded-full bg-amber-500/10 text-amber-800 text-[10px] font-extrabold uppercase tracking-wider mb-1.5 border border-amber-400/30">
                    Portal Pentadbir Sistem
                </span>
                <h2 class="text-xl font-bold text-slate-900">Log Masuk Kakitangan</h2>
                <p class="text-xs text-slate-500 mt-1 max-w-xs mx-auto">
                    Kawasan terhad untuk pegawai dan pentadbir pengurusan TVET sahaja.
                </p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" novalidate id="loginForm">
            @csrf

            <!-- Hidden field for Login Type -->
            <input type="hidden" name="login_type" :value="activeTab">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" value="Alamat E-mel" class="text-xs font-semibold text-slate-700" />
                <div class="relative mt-1">
                    <x-text-input id="email"
                                  class="block w-full text-sm pl-10 pr-3 py-2.5 rounded-lg border-slate-300 focus:border-theme-accent focus:ring focus:ring-theme-accent/20"
                                  type="email"
                                  name="email"
                                  :value="old('email')"
                                  required autofocus autocomplete="username"
                                  placeholder="nama@contoh.com" />
                    <span class="absolute left-3 top-3 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <div class="flex justify-between items-center">
                    <x-input-label for="password" value="Kata Laluan" class="text-xs font-semibold text-slate-700" />
                    @if (Route::has('password.request'))
                        <a class="text-xs text-slate-500 hover:text-theme-blue hover:underline transition" href="{{ route('password.request') }}">
                            Lupa kata laluan?
                        </a>
                    @endif
                </div>

                <div class="relative mt-1">
                    <x-text-input id="password"
                                  class="block w-full text-sm pl-10 pr-10 py-2.5 rounded-lg border-slate-300 focus:border-theme-accent focus:ring focus:ring-theme-accent/20"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password"
                                  placeholder="••••••••" />

                    <span class="absolute left-3 top-3 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </span>

                    <button type="button"
                            onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                        <svg id="eye-password" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-slate-300 text-theme-blue shadow-sm focus:ring-theme-accent"
                           name="remember">
                    <span class="ms-2 text-xs text-slate-600 select-none">Ingat log masuk saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="mt-5">
                <button type="submit"
                        :class="activeTab === 'student' ? 'bg-theme-blue hover:bg-theme-purple text-white' : 'bg-slate-900 hover:bg-slate-800 text-amber-400 border border-amber-400/30'"
                        class="w-full py-3 px-4 rounded-xl text-sm font-bold shadow-md transition duration-200 flex items-center justify-center gap-2">
                    <span x-text="activeTab === 'student' ? 'Log Masuk Pelajar' : 'Log Masuk Pentadbir'"></span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>

            <!-- Contextual Footer -->
            <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                <div x-show="activeTab === 'student'">
                    <p class="text-xs text-slate-600">
                        Belum mendaftar sebagai pelajar?
                        <a href="{{ route('register') }}" class="font-bold text-amber-600 hover:text-amber-500 hover:underline ms-1">
                            Daftar Akaun Baharu →
                        </a>
                    </p>
                </div>

                <div x-show="activeTab === 'admin'" x-cloak>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        🔒 Akses pentadbir dipantau dan dikawal selia. Akaun disediakan secara dalaman oleh pengurusan institusi TVET.
                    </p>
                </div>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('svg');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const inputs = this.querySelectorAll('[required]');
            let valid = true;

            inputs.forEach(input => {
                input.setCustomValidity('');
                if (!input.checkValidity()) {
                    input.setCustomValidity('Sila isi ruangan ini.');
                    valid = false;
                }
            });

            if (!valid) {
                e.preventDefault();
                this.reportValidity();
            }
        });

        // Reset custom message bila user mula taip
        document.querySelectorAll('#loginForm [required]').forEach(input => {
            input.addEventListener('input', function () {
                this.setCustomValidity('');
            });
        });
    </script>
</x-guest-layout>