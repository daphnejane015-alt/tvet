<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" novalidate id="registerForm">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input id="name" class="block mt-1 w-full focus:border-theme-accent focus:ring-theme-accent" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Emel" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-theme-accent focus:ring-theme-accent" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Kata Laluan" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10 focus:border-theme-accent focus:ring-theme-accent"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <button type="button"
                        onclick="togglePassword('password', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-theme-blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Sahkan Kata Laluan" />

            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10 focus:border-theme-accent focus:ring-theme-accent"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <button type="button"
                        onclick="togglePassword('password_confirmation', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-theme-blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-theme-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-theme-accent" href="{{ route('login') }}">
                Sudah ada akaun?
            </a>

            <x-primary-button class="ms-4">
                Daftar
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
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
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