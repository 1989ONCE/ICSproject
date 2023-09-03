<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ICS污水管理系統') }} - @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="img/icon.png">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="w-screen min-h-screen overflow-x-hidden bg-white grid content-center my-auto font-sans text-gray-900 antialiased">
        <div class="h-full flex flex-col justify-center items-center bg-white dark:bg-gray-900 overflow-x-hidden overflow-y-auto">
            <div class="w-72">
                <a href="/" class="flex justify-center">
                    <img src="{{ asset('img/logo.png') }}" class="w-full" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 py-4 px-6 bg-indigo-100 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <footer class="sticky top-[100vh] z-10 w-full">@include('layouts.footer')</footer>
    </body>
</html>
