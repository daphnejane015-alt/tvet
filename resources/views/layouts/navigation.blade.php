<nav x-data="{ open: false }" class="bg-gradient-to-r from-theme-dark via-theme-blue to-[#133d63] backdrop-blur-md border-b border-theme-teal/30 shadow-xl sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center">
                <!-- Logo: Larger and positioned flush left -->
                <div class="shrink-0 flex items-center -ms-1 sm:-ms-2">
                    <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('admin.dashboard') : route('welcome') }}" class="flex items-center group py-1">
                        <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ file_exists(public_path('images/logo-acetvet-new.png')) ? filemtime(public_path('images/logo-acetvet-new.png')) : time() }}" 
                             alt="AceTVET" 
                             class="h-14 sm:h-16 w-auto max-w-[190px] sm:max-w-[230px] object-contain group-hover:scale-105 transition-transform duration-200 drop-shadow-md">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-7 sm:-my-px sm:ms-8 sm:flex">
                    @if(!auth()->check() || !auth()->user()->isAdmin())
                        <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                            {{ __('Utama') }}
                        </x-nav-link>

                        <!-- Pautan Pengenalan Baharu -->
                        <x-nav-link :href="route('pengenalan')" :active="request()->routeIs('pengenalan')">
                            {{ __('Pengenalan') }}
                        </x-nav-link>
                    @endif

                    @auth
                        @if(!auth()->user()->isAdmin())
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.index')">
                        {{ __('Kursus') }}
                    </x-nav-link>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Admin Panel') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.*')">
                                {{ __('Urus Kursus') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                {{ __('Senarai Pengguna') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.up-tvet.index')" :active="request()->routeIs('admin.up-tvet.*')">
                                {{ __('Permohonan Kursus TVET') }}
                            </x-nav-link>
                        @endif
                    @endauth

                    @if(!auth()->check() || !auth()->user()->isAdmin())
                        <div class="flex items-center">
                            <button type="button" @click="$dispatch('open-up-tvet-modal')"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-bold rounded-lg transition-all duration-200 shadow-sm cursor-pointer {{ auth()->check() && auth()->user()->hasCompletedUpTvet() ? 'bg-theme-yellow/20 text-theme-yellow border border-theme-yellow/40 hover:bg-theme-yellow/30' : 'bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark hover:from-theme-yellow hover:to-theme-accent hover:shadow-md hover:scale-105' }}">
                                @if(auth()->check() && auth()->user()->hasCompletedUpTvet())
                                    <span>✓ TVET Selesai</span>
                                @else
                                    <span>Mohon TVET</span>
                                    <span class="text-[9px] bg-slate-950/20 px-1.5 py-0.5 rounded font-extrabold uppercase">Borang</span>
                                @endif
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown (LOGIN SAHAJA) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3.5 py-2 border border-theme-purple/40 text-sm leading-4 font-medium rounded-lg text-slate-200 bg-theme-purple/10 hover:bg-theme-purple/20 hover:text-white focus:outline-none transition ease-in-out duration-150">
                                <span class="w-2 h-2 rounded-full bg-theme-yellow mr-2"></span>
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profil
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    Log Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex gap-2.5 items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-theme-purple/40 text-sm leading-4 font-medium rounded-lg text-slate-300 bg-theme-purple/10 hover:text-white hover:bg-theme-purple/20 focus:outline-none transition ease-in-out duration-150">
                                    <span>Log Masuk</span>
                                    <svg class="ms-1 fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('login', ['role' => 'student'])" class="flex items-center gap-2">
                                    <span>🎓</span>
                                    <span>Log Masuk Pelajar</span>
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.login')" class="flex items-center gap-2">
                                    <span>🛡️</span>
                                    <span>Log Masuk Pentadbir</span>
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>

                        <a href="{{ route('register') }}" class="text-sm bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark font-bold px-4 py-2 rounded-lg hover:shadow-lg hover:shadow-theme-accent/30 transition transform hover:-translate-y-0.5">
                            {{ __('Daftar') }}
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-white hover:bg-theme-purple focus:outline-none focus:bg-theme-purple transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-theme-dark border-b border-theme-purple/20">
        <div class="pt-2 pb-3 space-y-1">
            @if(!auth()->check() || !auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                    {{ __('Utama') }}
                </x-responsive-nav-link>

                <!-- Pautan Pengenalan Mobile Baharu -->
                <x-responsive-nav-link :href="route('pengenalan')" :active="request()->routeIs('pengenalan')">
                    {{ __('Pengenalan') }}
                </x-responsive-nav-link>
            @endif

            @auth
                @if(!auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            <x-responsive-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.index')">
                {{ __('Kursus') }}
            </x-responsive-nav-link>

            @auth
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Admin Panel') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.*')">
                        {{ __('Urus Kursus') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Senarai Pengguna') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.up-tvet.index')" :active="request()->routeIs('admin.up-tvet.*')">
                        {{ __('Permohonan Kursus TVET') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            @if(!auth()->check() || !auth()->user()->isAdmin())
                <div class="px-4 py-2">
                    <button type="button" @click="open = false; $dispatch('open-up-tvet-modal')"
                            class="w-full text-center py-2.5 px-4 text-xs font-bold rounded-lg transition {{ auth()->check() && auth()->user()->hasCompletedUpTvet() ? 'bg-theme-yellow/20 text-theme-yellow border border-theme-yellow/40' : 'bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark hover:from-theme-yellow hover:to-theme-accent shadow-sm' }}">
                        @if(auth()->check() && auth()->user()->hasCompletedUpTvet())
                            ✓ Permohonan TVET Selesai
                        @else
                            Mohon TVET (Borang) ↗
                        @endif
                    </button>
                </div>
            @endif
        </div>

        <!-- Responsive Settings Options (LOGIN SAHAJA) -->
        @auth
            <div class="pt-4 pb-1 border-t border-theme-purple/30">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-theme-purple">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        Profil
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            Log Keluar
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-theme-purple/30 px-4 space-y-1">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-2 mb-1">Pilihan Log Masuk</div>
                <x-responsive-nav-link :href="route('login', ['role' => 'student'])" class="flex items-center gap-2">
                    <span>🎓</span>
                    <span>{{ __('Log Masuk Pelajar') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.login')" class="flex items-center gap-2">
                    <span>🛡️</span>
                    <span>{{ __('Log Masuk Pentadbir') }}</span>
                </x-responsive-nav-link>
                <div class="pt-2">
                    <x-responsive-nav-link :href="route('register')" class="bg-gradient-to-r from-theme-accent to-theme-yellow text-theme-dark font-bold rounded-lg text-center justify-center">
                        {{ __('Daftar Akaun Baharu') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>