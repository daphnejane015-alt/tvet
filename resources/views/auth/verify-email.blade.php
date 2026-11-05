<x-guest-layout>
    <div class="mb-5 text-center">
        <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-[10px] font-extrabold uppercase tracking-wider mb-2 border border-blue-200">
            Pengesahan Emel
        </span>
        <h2 class="text-xl font-bold text-slate-900">Pengesahan Emel Tidak Diperlukan</h2>
        <p class="text-xs text-slate-500 mt-2 max-w-xs mx-auto leading-relaxed">
            Akaun anda telah disahkan secara automatik. Anda boleh terus menggunakan semua fungsi dalam sistem.
        </p>
    </div>

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto">
            <x-primary-button class="w-full sm:w-auto bg-theme-blue hover:bg-theme-purple text-white text-sm font-bold py-2.5 px-4 rounded-xl shadow-md transition duration-200">
                Pergi ke Dashboard
            </x-primary-button>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
            @csrf

            <button type="submit" class="w-full sm:w-auto text-xs text-slate-500 hover:text-theme-blue hover:underline transition font-medium">
                Log Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
