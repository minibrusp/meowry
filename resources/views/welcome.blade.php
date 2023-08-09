<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    {{-- favicon  --}}
    <x-favicon />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 text-sm leading-loose uppercase tracking-widest">
                @auth
                    <a href="{{ route('meows.index') }}"
                        class="font-light text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">meows</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-light text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-light text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
            <div class="flex flex-col justify-center items-center min-h-full leading-loose uppercase">
                <x-application-logo class="w-30 h-30 fill-current" />
                <h1 class="text-5xl tracking-[1rem] mb-2">
                    Meowry
                </h1>
                <p class="text-gray-500 tracking-[0.7rem] text-sm">The Cat Diary</p>
            </div>

    </div>
</body>

</html>