<x-guest-layout>
    <div class="mb-5 text-center">
        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-[10px] font-extrabold uppercase tracking-wider mb-2 border border-blue-200">
            Sahkan Emel
        </span>
        <h2 class="text-xl font-bold text-slate-900">Sahkan Alamat Emel Anda</h2>
        <p class="text-xs text-slate-500 mt-2 max-w-xs mx-auto leading-relaxed">
            Terima kasih kerana mendaftar! Sebelum memulakan, sila sahkan alamat emel anda dengan mengklik pautan yang kami hantar melalui emel.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-xs text-emerald-800">
            <div class="flex items-start gap-2">
                <span class="text-lg">✓</span>
                <div>
                    <strong class="font-bold block mb-1">Pautan pengesahan baharu telah dihantar</strong>
                    Pautan pengesahan baharu telah dihantar ke alamat emel yang anda berikan semasa pendaftaran.
                </div>
            </div>
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf

            <x-primary-button class="w-full sm:w-auto bg-theme-blue hover:bg-theme-purple text-white text-sm font-bold py-2.5 px-4 rounded-xl shadow-md transition duration-200">
                Hantar Semula Emel Pengesahan
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
            @csrf

            <button type="submit" class="w-full sm:w-auto text-xs text-slate-500 hover:text-theme-blue hover:underline transition font-medium">
                Log Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
