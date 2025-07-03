<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 p-8 bg-white shadow-md overflow-hidden rounded-lg ">
            <a href="/" class="flex flex-row items-center justify-center gap-2">
                <div class="bg-orange-100 rounded-md p-2 mb-2">
                    <span class="text-4xl font-bold text-[rgb(255,126,27)]">U</span>
                </div>
                <span class="text-3xl font-bold">Uena</span>
            </a>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
