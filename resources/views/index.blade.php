<!DOCTYPE html>
<html>
    <head>
        <title>水汙ICS @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand mr-auto" href="{{route('rt')}}">Integrated Control System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    @guest
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rt') }}">即時資料</a>
                        </li>
                        <div class="nav-item">
                            <a class="nav-link" href="{{route('chart')}}">報表</a>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('warning') }}">告警管理</a>
                        </li>
                        <div class="nav-item">
                            <a class="nav-link" href="{{route('info')}}">個人中心</a>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">登出</a>
                        </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @guest
            <div class="container1">
                <div class="box">
                    <a href="{{route('rt')}}">即時資料</a>
                </div>
                <div class="box">
                    <a href="{{route('chart')}}">報表</a>
                </div>
                <div class="box">
                    <a href="{{route('login')}}">告警管理</a>
                </div>
                <div class="box">
                    <a href="{{route('login')}}">登入/註冊</a>
                </div>
            </div>
                @yield('content')
            @else
                @yield('function')
            @endguest
    </body>
</html>