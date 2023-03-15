<!DOCTYPE html>
<html>
    <head>
        <title>水汙管理</title>
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        @livewireStyles
        <!-- tailwindcss -->
        <!-- @vite('resources/css/app.css') -->
        <style>
            body {
  background-color: #f3ecb0;
}
.container {
    display: flex;
    flex-direction: row;
    height: 100vh;
}
.box {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}
.box:hover {
    background-color: #eee;
}
.box a {
    color: #000;
    font-family: '標楷體', serif;
    font-size: 24px;
    text-decoration: none;
}

/* 每個區塊的背景顏色 */
.box:nth-child(1) {
    background-color: #f7eac5; /* 淡黃色 */
}
.box:nth-child(2) {
    background-color: hsl(105, 70%, 80%); /* 淡綠色 */
}
.box:nth-child(3) {
    background-color: #f8b5b5; /* 淡粉色 */
}
.box:nth-child(4) {
    background-color: #7ecff5; /* 淡藍色 */
}
.box:nth-child(5) {
    background-color: #df96f1; /* 淡藍色 */
}
        </style>

    </head>
    <body>
        <!-- <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand mr-auto" href="#">Integrated Control System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->
        @guest
        <div class="container">
            <div class="box">
                <a href="{{route('warning')}}">告警管理</a>
            </div>
            <div class="box">
                <a href="{{route('rt')}}">即時資料</a>
            </div>
            <div class="box">
                <a href="{{route('chart')}}">報表</a>
            </div>
            <div class="box">
                <a href="{{route('login')}}">登入/註冊</a>
            </div>
        </div>
                    <!-- <div class="content-evenly">
                        <div>
                            <a class="content-evenly" href="{{route('warning')}}">告警管理</a>
                        </div>
                        <div>
                            <a class="content-evenly" href="{{route('rt')}}">即時資料</a>
                        </div>
                        <div>
                            <a class="content-evenly" href="{{route('chart')}}">報表</a>
                        </div>
                        <div>
                            <a class="content-evenly" href="{{route('login')}}">登入/註冊</a>
                        </div>
                    </div> -->
                        
                    @else
                    <div class="content-evenly">
                        <div>
                            <a class="content-evenly" href="{{route('warning')}}">告警管理</a>
                        </div>
                        <div>
                            <a class="content-evenly" href="{{route('rt')}}">即時資料</a>
                        </div>
                        <div>
                            <a class="content-evenly" href="{{route('chart')}}">報表</a>
                        </div>
                        <div>
                            <a class="content-evenly" href="{{route('info')}}">個人資料</a>
                        </div>
                    </div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                        </li>
                    @endguest
        <!-- @yield('content') -->
        @livewireScripts
    </body>
</html>