<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Adventure Trip') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|montserrat:600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Additional Styles -->
        <style>
            .auth-container {
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
                background-size: cover;
                background-position: center;
            }
            
            .brand-name {
                font-family: 'Montserrat', sans-serif;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 auth-container">
            <div class="text-center mb-8">
                <a href="/" class="flex flex-col items-center">
                    <h1 class="text-2xl font-bold text-white mt-2 brand-name">ADVENTURE TRIPS</h1>
                </a>
                <p class="text-white text-sm mt-2 max-w-sm mx-auto">Discover extraordinary destinations and create unforgettable memories</p>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg backdrop-blur-sm bg-opacity-95">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-white text-sm">
                <p>&copy; {{ date('Y') }} Adventure Trips. All rights reserved.</p>
                <div class="mt-2">
                    <a href="#" class="text-yellow-300 hover:text-yellow-100 mx-2">Terms</a>
                    <a href="#" class="text-yellow-300 hover:text-yellow-100 mx-2">Privacy</a>
                    <a href="#" class="text-yellow-300 hover:text-yellow-100 mx-2">Support</a>
                </div>
            </div>
        </div>
    </body>
</html>