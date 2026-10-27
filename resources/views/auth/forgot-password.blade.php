<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Terlupa kata laluan anda? Tiada masalah. Cuma beritahu kami alamat emel anda dan kami akan hantar pautan tetapan semula kata laluan yang membolehkan anda memilih kata laluan baharu.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Emel" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-theme-accent focus:ring-theme-accent" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Hantar Pautan Tetapan Semula Kata Laluan
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>