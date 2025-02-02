<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="relative min-h-screen bg-gradient-to-br from-indigo-100 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="absolute top-0 right-0 p-6">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 font-medium text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-800 transition-colors">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="container mx-auto px-4 flex flex-col items-center justify-center min-h-screen">
            <div class="text-center mb-16">
                <h1 class="text-5xl sm:text-6xl font-bold tracking-tight text-gray-900 dark:text-white mb-6">
                    Lost & Found
                </h1>
                <p class="text-xl sm:text-2xl text-gray-600 dark:text-gray-300">
                    Connecting lost items with their rightful owners
                </p>
            </div>

            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl">
                <div class="p-8 bg-white rounded-xl shadow-lg dark:bg-gray-800 hover:shadow-xl transition-shadow">
                    <div class="mb-4 text-indigo-600 dark:text-indigo-400">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Lost Something?</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Report your lost item and let our community help you find it.</p>
                </div>

                <div class="p-8 bg-white rounded-xl shadow-lg dark:bg-gray-800 hover:shadow-xl transition-shadow">
                    <div class="mb-4 text-green-600 dark:text-green-400">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Found Something?</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Help others by reporting items you've found.</p>
                </div>

                <div class="p-8 bg-white rounded-xl shadow-lg dark:bg-gray-800 hover:shadow-xl transition-shadow">
                    <div class="mb-4 text-blue-600 dark:text-blue-400">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Join Our Community</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Be part of a helpful community dedicated to reuniting lost items with their owners.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
