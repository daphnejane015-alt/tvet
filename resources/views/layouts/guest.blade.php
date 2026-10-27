<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}">

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
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-theme-dark to-theme-blue">
            <div>
                <a href="{{ route('welcome') }}" class="flex flex-col items-center gap-2">
                    <img src="{{ asset('images/logo-acetvet-new.png') }}?v={{ time() }}" alt="AceTVET" class="w-24 h-auto drop-shadow-md">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-lg border-t-4 border-theme-accent">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>