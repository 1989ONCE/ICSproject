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
    <body class="w-fit h-screen font-sans antialiased flex flex-col justify-center">
        <div class="flex flex-col h-screen justify-between w-full bg-white dark:bg-gray-900">
            <div class="h-full grid content-start">
	    	@include('layouts.navigation')

            	<!-- Page Content -->
            	<main class="border-x border-gray-100 rounded">
            
                	{{ $slot }}
                	{{ $scripts }}
            	</main>
            </div>
        </div>
        <footer class="sticky bottom-0 right-0">@include('layouts.footer')</footer>
    </body>

</html>
