<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-init="if (localStorage.getItem('darkMode') === 'true') {    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweet-alert.css') }}">

    @stack('styles')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 dark:text-white">
    <div x-data="{ open: false, sidebarOpen: window.innerWidth >= 640 }">
        @include('layouts.navigation')
        @include('layouts.sidebar')
        <div :class="sidebarOpen ? 'sm:ml-64' : ''" class="px-3 sm:px-5 py-16 min-h-full transition-all duration-300">
            {{ $slot }}
        </div>

        <!-- Global Page Loader -->
        <div x-data="{ loading: false }" x-show="loading" x-transition
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60" x-cloak
            @page-loading.window="loading = $event.detail">
            <div class="flex flex-col items-center space-y-3">
                <svg class="animate-spin h-12 w-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span class="text-white text-lg font-semibold">Loading...</span>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="{{ asset('assets/js/sweet_alert.min.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const toggleButtons = document.querySelectorAll("[data-collapse-toggle]");

            toggleButtons.forEach((button) => {
                button.addEventListener("click", () => {
                    const targetId = button.getAttribute("data-collapse-toggle");
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        targetElement.classList.toggle("hidden");
                    }
                });
            });
        });
    </script>
</body>

</html>
