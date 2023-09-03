<!DOCTYPE html>
<html>
    <head>
        <title>ICS污水管理系統</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="img/icon.png">
        <meta charset="UTF-8">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="w-screen min-h-screen overflow-x-hidden bg-white grid content-start md:content-center my-auto">
        <div class="flex flex-col h-screen justify-between w-full">
          <div class="h-full grid content-centent overflow-x-hidden overflow-y-auto">
            <div class="flex justify-center items-start lg:items-center bg-white">
                <a href="/" class="link relative mt-auto">
                    <img class="object-scale-down" src="{{ asset('img/biglogo.png') }}" alt="Logo">
                </a>
            </div>

             
            <div class="flex flex-col md:flex-row h-full md:h-48 max-h-screen outline-none">
                <div style="background-image: url({{ asset('img/warning.png') }})" class="h-auto flex-1 relative cursor-pointer text-white text-2xl font-bold text-center focus:outline-none transform transition-all duration-300 hover:scale-110 hover:z-10 z-0">
                    <div class="overlay relative top-0 left-0 w-full h-full bg-black bg-opacity-25 flex justify-center items-center backdrop-blur-md">
                        <a href="{{route('warning')}}" class="w-full h-full flex justify-center items-center hover:text-sky-300">告警管理</a>
                    </div>
                </div>

                <div style="background-image: url({{ asset('img/realtime.png') }})" class="h-auto md:h-44 flex-1 relative cursor-pointer text-white text-2xl font-bold text-center focus:outline-none transform transition-all duration-300 hover:scale-110 hover:z-10 z-0">
                    <div class="overlay relative top-0 left-0 w-full h-full bg-black bg-opacity-25 flex justify-center items-center backdrop-blur-md">
                        <a href="{{route('rt')}}" class="link w-full h-full flex justify-center items-center hover:text-sky-300">即時資料</a>
                    </div>
                </div>

                <div style="background-image: url({{ asset('img/chart.png') }})" class="h-auto md:h-44 flex-1 relative cursor-pointer text-white text-2xl font-bold text-center focus:outline-none transform transition-all duration-300 hover:scale-110 hover:z-10 z-0">
                    <div class="overlay relative top-0 left-0 w-full h-full bg-black bg-opacity-25 flex justify-center items-center backdrop-blur-md">
                        <a href="{{route('chart')}}" class="link w-full h-full flex justify-center items-center hover:text-sky-300">歷史報表</a>
                    </div>
                </div>
                @guest
                <div style="background-image: url({{ asset('img/login.png') }})" class="h-auto md:h-44 flex-1 relative cursor-pointer text-white text-2xl font-bold text-center transform-none focus:outline-none transform transition-all duration-300 hover:scale-110 hover:z-10 z-0">
                    <div class="overlay relative top-0 left-0 w-full h-full bg-black bg-opacity-25 flex justify-center items-center backdrop-blur-md">
                        <a href="{{route('login')}}" class="link w-full h-full flex justify-center items-center hover:text-sky-300">登入/註冊</a>
                    </div>
                </div>
                @else
                <div style="background-image: url({{ asset('img/info.png') }})" class="h-auto md:h-44 flex-1 relative cursor-pointer text-white text-2xl font-bold text-center transform-none focus:outline-none transform transition-all duration-300 hover:scale-110 hover:z-10 z-0">
                    <div class="overlay relative top-0 left-0 w-full h-full bg-black bg-opacity-25 flex justify-center items-center backdrop-blur-md">
                        <a href="{{route('profile.edit')}}" class="link w-full h-full flex justify-center items-center hover:text-sky-300">個人中心</a>
                    </div>
                </div>
                <div style="background-image: url({{ asset('img/login.png') }})" class="h-auto md:h-44 flex-1 relative cursor-pointer text-white text-2xl font-bold text-center  transform-none focus:outline-none transform transition-all duration-300 hover:scale-110 hover:z-10 z-0">
                    <div class="overlay relative top-0 left-0 w-full h-full bg-black bg-opacity-25 flex justify-center items-center backdrop-blur-md">
                        <a href="{{route('logout')}}" class="link w-full h-full flex justify-center items-center hover:text-sky-300">登出</a>
                    </div>
                </div>
                @endguest
            </div>
       	  </div>
     
            <footer class="sticky top-[100vh] z-10 w-full">
                <div class="flex justify-center">
                    <span class="font-serif text-sm text-gray-400">© 2023 NCU MIS ICS Team All Rights Reserved</span>
                </div>
            </footer>
        </div>
    </body>
    
</html>
