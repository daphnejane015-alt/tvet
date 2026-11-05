<x-guest-layout>
    <div class="mb-5 text-center">
        <span class="inline-block px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-[10px] font-extrabold uppercase tracking-wider mb-2 border border-amber-200">
            Pilih Kata Laluan
        </span>
        <h2 class="text-xl font-bold text-slate-900">Lupa Kata Laluan?</h2>
        <p class="text-xs text-slate-500 mt-2 max-w-xs mx-auto leading-relaxed">
            Tiada masalah. Beritahu kami alamat emel anda dan kami akan hantar pautan tetapan semula kata laluan yang membolehkan anda memilih kata laluan baharu.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat E-mel" class="text-xs font-semibold text-slate-700" />
            <div class="relative mt-1">
                <x-text-input id="email"
                              class="block w-full text-sm pl-10 pr-3 py-2.5 rounded-lg border-slate-300 focus:border-theme-accent focus:ring focus:ring-theme-accent/20"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required autofocus
                              placeholder="nama@contoh.com" />
                <span class="absolute left-3 top-3 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                </span>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}" class="text-xs text-slate-500 hover:text-theme-blue hover:underline transition">
                ← Kembali ke Log Masuk
            </a>
            <x-primary-button class="bg-theme-blue hover:bg-theme-purple text-white text-sm font-bold py-2.5 px-4 rounded-xl shadow-md transition duration-200">
                Hantar Pautan
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>