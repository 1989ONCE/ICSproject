<!DOCTYPE html>
<html>
    <head>
        <title>水汙ICS - Realtime Data</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        @guest
            <livewire:navbar />
        @else
            <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand mr-auto" href="{{route('rt')}}">Integrated Control System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('rt')}}">即時資料</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('chart')}}">報表</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('warning') }}">告警管理</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('info')}}">個人中心</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">登出</a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
        @endguest    
        <main class="login-form">
            <div class="cotainer">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="card-header text-center">Realtime Data</h3>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>