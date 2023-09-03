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
        <link rel="icon" href="{{asset('img/icon.png')}}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>
        <script type="text/javascript" src="{{ asset('/js/echarts.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/flowbite.min.js') }}"></script>
    </head>
    <body class="w-screen min-h-screen overflow-x-hidden bg-white grid content-start my-auto font-sans text-gray-900 antialiased">
        <div class="w-full h-full flex flex-col items-center dark:bg-gray-900 overflow-x-auto overflow-y-auto">
            <div class="min-w-fit grid content-center place-items-center">
                @include('layouts.navigation')
                <!-- Page Content -->
                <main class="w-full">
                    {{ $slot }}
                    {{ $scripts }}
                </main>
            </div>
        </div>
        <footer class="sticky top-[100vh] z-10 w-full">@include('layouts.footer')</footer>
    </body>

</html>
