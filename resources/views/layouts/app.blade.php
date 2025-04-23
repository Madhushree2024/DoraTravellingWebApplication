<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Adventure Trips - Explore exciting destinations and plan your next adventure">
        <meta name="theme-color" content="#4f46e5">

        <title>{{ config('app.name', 'Adventure Trips') }}</title>

        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="Adventure Trips" />
        <link rel="manifest" href="/site.webmanifest" />
        
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Preload critical assets -->
        <link rel="preload" href="{{ asset('images/hero-bg.jpg') }}" as="image" fetchpriority="high">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gradient-to-b from-blue-100 to-blue-150">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-purple shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                        <div>{{ $header }}</div>
                        @if(View::hasSection('header_actions'))
                            <div class="header-actions">
                                @yield('header_actions')
                            </div>
                        @endif
                    </div>
                </header>
            @endisset

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-auto max-w-7xl mt-4 rounded shadow-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-auto max-w-7xl mt-4 rounded shadow-sm" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Page Content -->
            <main class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>

        </div>

        <!-- Back to top button -->
        <button id="back-to-top" class="fixed bottom-4 right-4 bg-indigo-600 text-white p-2 rounded-full shadow-lg opacity-0 invisible transition-all duration-300" aria-label="Back to top">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </button>

        <script>
            // Back to top functionality
            document.addEventListener('DOMContentLoaded', function() {
                const backToTopButton = document.getElementById('back-to-top');
                
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        backToTopButton.classList.remove('opacity-0', 'invisible');
                        backToTopButton.classList.add('opacity-100', 'visible');
                    } else {
                        backToTopButton.classList.remove('opacity-100', 'visible');
                        backToTopButton.classList.add('opacity-0', 'invisible');
                    }
                });
                
                backToTopButton.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    </body>
</html>