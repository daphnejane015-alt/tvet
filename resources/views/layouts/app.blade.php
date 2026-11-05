<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AceTVET</title>

        <!-- PWA Meta Tags -->
        <meta name="theme-color" content="#174871">
        <meta name="msapplication-TileColor" content="#174871">
        <meta name="msapplication-config" content="/browserconfig.xml">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="AceTVET">
        <meta name="description" content="Portal Pendidikan & Latihan Kemahiran Negara - Sistem Pengurusan & Permohonan TVET">

        <!-- PWA Manifest -->
        <link rel="manifest" href="{{ asset('manifest.json') }}?v={{ time() }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logo-acetvet-new.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/logo-acetvet-new.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind Config with New Theme Colors -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'theme-light': '#F2F3F4',
                            'theme-beige': '#DED1C6',
                            'theme-purple': '#A77693',
                            'theme-blue': '#174871',
                            'theme-dark': '#0F2D4D',
                            'theme-accent': '#FF6B35',
                            'theme-yellow': '#FFD93D',
                            'theme-cream': '#FFF8E7',
                            // New cheerful colors
                            'theme-teal': '#86E3CE',
                            'theme-green': '#D0E6A5',
                            'theme-warm-yellow': '#FFDD94',
                            'theme-coral': '#FAB97B',
                            'theme-lavender': '#CCABDB',
                        }
                    }
                }
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            html {
                background-color: #FFF8E7;
                color-scheme: light;
            }
        </style>

        @if(!auth()->check() || !auth()->user()->isAdmin())
            <style>
                #site-preloader {
                    position: fixed; inset: 0; 
                    background: linear-gradient(135deg, #0F2D4D 0%, #174871 50%, #A77693 100%); 
                    z-index: 999999;
                    display: flex; flex-direction: column; justify-content: center; align-items: center;
                    transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                }
                .site-loader-logo { 
                    animation: sitePulseGlow 1.8s infinite ease-in-out alternate; 
                }
                @keyframes sitePulseGlow {
                    0% { transform: scale(0.88); filter: drop-shadow(0 0 16px rgba(255, 107, 53, 0.5)); opacity: 0.8; }
                    100% { transform: scale(1.05); filter: drop-shadow(0 0 38px rgba(255, 107, 53, 0.95)); opacity: 1; }
                }
                .site-loader-bar {
                    width: 190px; height: 4px; background: rgba(255, 255, 255, 0.15);
                    border-radius: 99px; overflow: hidden; margin-top: 24px; position: relative;
                }
                .site-loader-bar::after {
                    content: ''; position: absolute; left: -100%; top: 0; height: 100%; width: 100%;
                    background: linear-gradient(90deg, transparent, #FFD93D, #FF6B35, #A77693, transparent);
                    animation: siteLoadingProgress 1.4s infinite;
                }
                @keyframes siteLoadingProgress { 0% { left: -100%; } 100% { left: 100%; } }
                .site-preloader-hidden { 
                    opacity: 0 !important; 
                    visibility: hidden !important; 
                    pointer-events: none !important; 
                }
            </style>
        @endif
    </head>
    <body class="font-sans antialiased">
        @if(!auth()->check() || !auth()->user()->isAdmin())
            <!-- USER SITE PRELOADER -->
            <div id="site-preloader" aria-live="polite" aria-label="AceTVET sedang dimuatkan">
                <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}" 
                     alt="AceTVET Loading" 
                     class="h-24 sm:h-36 w-auto site-loader-logo drop-shadow-2xl">
                <div class="site-loader-bar"></div>
                <p class="text-white/90 text-xs mt-3 tracking-wider font-semibold">AceTVET loading...</p>
            </div>
        @endif

        <div class="min-h-screen bg-theme-cream">
            @include('layouts.navigation')

            <!-- FLOATING WHATSAPP BUTTON (ONLY AT 'UTAMA' AND 'PENGENALAN' PAGES FOR USERS) -->
            @if((!auth()->check() || !auth()->user()->isAdmin()) && request()->routeIs('welcome', 'pengenalan'))
                <a href="https://wa.me/60164801473?text=Hai,%20saya%20berminat%20dengan%20kursus%20di%20AceTVET%20dan%20ingin%20bertanya%20lebih%20lanjut" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   aria-label="Hubungi Kami melalui WhatsApp"
                   class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 flex items-center gap-2 sm:gap-2.5 bg-gradient-to-r from-theme-accent to-theme-yellow hover:from-theme-yellow hover:to-theme-accent text-theme-dark px-3.5 py-2.5 sm:px-4 sm:py-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 group hover:scale-105 active:scale-95">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    <span class="font-extrabold text-xs tracking-wide">Hubungi Kami</span>
                </a>
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @if(!auth()->check() || !auth()->user()->isAdmin())
            <!-- Modal Permohonan UP_TVET (Hanya untuk pengguna biasa / tetamu) -->
            <x-up-tvet-modal />
        @endif

        @if(!auth()->check() || !auth()->user()->isAdmin())
            <script>
                (function() {
                    const preloader = document.getElementById('site-preloader');
                    if (!preloader) return;

                    function hidePreloader() {
                        preloader.classList.add('site-preloader-hidden');
                    }

                    function showPreloader() {
                        preloader.classList.remove('site-preloader-hidden');
                    }

                    // Hide preloader when page finishes loading
                    if (document.readyState === 'complete') {
                        setTimeout(hidePreloader, 350);
                    } else {
                        window.addEventListener('load', () => {
                            setTimeout(hidePreloader, 350);
                        });
                    }

                    // Handle bfcache (browser back/forward button restores page)
                    window.addEventListener('pageshow', (event) => {
                        if (event.persisted) {
                            hidePreloader();
                        }
                    });

                    // Trigger preloader when user clicks an internal link to navigate to other pages
                    document.addEventListener('click', (e) => {
                        const link = e.target.closest('a');
                        if (!link) return;

                        const href = link.getAttribute('href');
                        const target = link.getAttribute('target');
                        
                        // Ignore empty links, hashes, javascript:, mailto:, tel:, external tabs, or download
                        if (!href || 
                            href.startsWith('#') || 
                            href.startsWith('javascript:') || 
                            href.startsWith('mailto:') || 
                            href.startsWith('tel:') || 
                            target === '_blank' || 
                            link.hasAttribute('download')) {
                            return;
                        }

                        // Check if it's the same origin
                        try {
                            const url = new URL(link.href, window.location.origin);
                            if (url.origin === window.location.origin) {
                                // Do not trigger if clicking current exact URL with only hash changed
                                if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash !== '') {
                                    return;
                                }
                                showPreloader();
                            }
                        } catch (err) {
                            // If invalid URL, do nothing
                        }
                    });
                })();
            </script>
        @endif

        <!-- PWA Service Worker Registration -->
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js?version=acetvet-v9')
                        .then(function(registration) {
                            console.log('Service Worker registered with scope:', registration.scope);
                            // Force update service worker
                            registration.update();
                        }, function(err) {
                            console.log('Service Worker registration failed:', err);
                        });
                });
            }
        </script>
    </body>
</html>