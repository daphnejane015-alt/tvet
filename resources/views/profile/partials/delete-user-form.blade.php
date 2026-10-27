<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600">
            Padam Akaun
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Setelah akaun dipadam, semua sumber dan data akan dipadam secara kekal. Sila muat turun data yang anda mahu simpan sebelum meneruskan.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Padam Akaun</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-gray-900">
                Adakah anda pasti mahu memadam akaun anda?
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Setelah akaun dipadam, semua sumber dan data akan dipadam secara kekal. Sila masukkan kata laluan anda untuk sahkan tindakan ini.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Kata Laluan" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 focus:border-red-400 focus:ring-red-400"
                    placeholder="Kata Laluan"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Padam Akaun
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>