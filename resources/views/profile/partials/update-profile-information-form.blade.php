<section>
    <header>
        <h2 class="text-lg font-bold text-theme-blue">
            Maklumat Profil
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Kemaskini maklumat akaun dan alamat emel anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full focus:border-theme-accent focus:ring-theme-accent" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Emel" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full focus:border-theme-accent focus:ring-theme-accent" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Alamat emel anda belum disahkan.

                        <button form="send-verification" class="underline text-sm text-theme-purple hover:text-theme-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-theme-accent">
                            Klik di sini untuk hantar semula emel pengesahan.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Pautan pengesahan baharu telah dihantar ke alamat emel anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >Berjaya disimpan.</p>
            @endif
        </div>
    </form>
</section>