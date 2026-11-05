<x-guest-layout>
    <div class="mb-5 text-center">
        <span class="inline-block px-3 py-1 rounded-full bg-theme-accent/10 text-theme-accent text-[10px] font-extrabold uppercase tracking-wider mb-2 border border-theme-accent/30">
            Daftar Akaun Baharu
        </span>
        <h2 class="text-xl font-bold text-slate-900">Cipta Akaun Pelajar</h2>
        <p class="text-xs text-slate-500 mt-2 max-w-xs mx-auto leading-relaxed">
            Daftar akaun untuk memohon kursus kemahiran TVET dan semak status permohonan anda.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" novalidate id="registerForm">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Penuh" class="text-xs font-semibold text-slate-700" />
            <div class="relative mt-1">
                <x-text-input id="name"
                              class="block w-full text-sm pl-10 pr-3 py-2.5 rounded-lg border-slate-300 focus:border-theme-accent focus:ring focus:ring-theme-accent/20"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required autofocus autocomplete="name"
                              placeholder="Nama penuh anda" />
                <span class="absolute left-3 top-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Alamat E-mel" class="text-xs font-semibold text-slate-700" />
            <div class="relative mt-1">
                <x-text-input id="email"
                              class="block w-full text-sm pl-10 pr-3 py-2.5 rounded-lg border-slate-300 focus:border-theme-accent focus:ring focus:ring-theme-accent/20"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required autocomplete="username"
                              placeholder="nama@contoh.com" />
                <span class="absolute left-3 top-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                </span>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Kata Laluan" class="text-xs font-semibold text-slate-700" />

            <div class="relative mt-1">
                <x-text-input id="password"
                              class="block w-full text-sm pl-10 pr-10 py-2.5 rounded-lg border-slate-300 focus:border-theme-accent focus:ring focus:ring-theme-accent/20"
                              type="password"
                              name="password"
                              required autocomplete="new-password"
                              placeholder="••••••••" />

                <span class="absolute left-3 top-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </span>

                <button type="button"
                        onclick="togglePassword('password', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Sahkan Kata Laluan" class="text-xs font-semibold text-slate-700" />

            <div class="relative mt-1">
                <x-text-input id="password_confirmation"
                              class="block w-full text-sm pl-10 pr-10 py-2.5 rounded-lg border-slate-300 focus:border-theme-accent focus:ring focus:ring-theme-accent/20"
                              type="password"
                              name="password_confirmation"
                              required autocomplete="new-password"
                              placeholder="••••••••" />

                <span class="absolute left-3 top-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </span>

                <button type="button"
                        onclick="togglePassword('password_confirmation', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5,12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
        </div>

        <div class="flex items-center justify-between mt-5">
            <a class="text-xs text-slate-500 hover:text-theme-blue hover:underline transition font-medium" href="{{ route('login') }}">
                ← Sudah ada akaun? Log Masuk
            </a>

            <x-primary-button class="bg-theme-blue hover:bg-theme-purple text-white text-sm font-bold py-2.5 px-4 rounded-xl shadow-md transition duration-200">
                Daftar Akaun
            </x-primary-button>
        </div>
    </form>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('svg');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5,12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        document.getElementById('registerForm').addEventListener('submit', function (e) {
            const inputs = this.querySelectorAll('[required]');
            let valid = true;

            inputs.forEach(input => {
                input.setCustomValidity('');
                if (!input.checkValidity()) {
                    if (input.validity.valueMissing) {
                        input.setCustomValidity('Sila isi ruangan ini.');
                    } else if (input.validity.typeMismatch && input.type === 'email') {
                        input.setCustomValidity('Sila masukkan alamat emel yang sah.');
                    } else {
                        input.setCustomValidity('Ruangan ini tidak sah.');
                    }
                    valid = false;
                }
            });

            if (!valid) {
                e.preventDefault();
                this.reportValidity();
            }
        });

        document.querySelectorAll('#registerForm [required]').forEach(input => {
            input.addEventListener('input', function () {
                this.setCustomValidity('');
            });
        });
    </script>
</x-guest-layout>
