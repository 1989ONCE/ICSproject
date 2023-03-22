<!DOCTYPE html>
<html>
    <head>
        <title>水汙ICS - 註冊</title>
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        @livewireStyles
        <!-- tailwindcss -->
        <!-- @vite('resources/css/app.css') -->
    </head>
    <body>
    @guest
        <livewire:navbar />
        <main class="signup-form">
            <div class="cotainer">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="card-header text-center">Register User</h3>
                            <div class="card-body">
                                <form action="{{ route('register.post') }}" method="POST">
                                @csrf
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="Name" id="user_name" class="form-control" name="user_name" required autofocus>
                                            @if ($errors->has('user_name'))
                                            <span class="text-danger">{{ $errors->first('user_name') }}</span>
                                            @endif
                                    </div>
                                    <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                    <input type="text" placeholder="Phone" id="phone" class="form-control" name="phone" required>
                                        @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <select id="group" name="group">
                                            <option value="1">主管</option>
                                            <option value="2">維修部門</option>
                                            <option value="3">廠商</option>
                                            <option value="4">主任</option>
                                        </select>
                                        @if ($errors->has('group'))
                                        <span class="text-danger">{{ $errors->first('group') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="d-grid mx-auto">
                                        <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <a href="{{route('login')}}">登入</a>
                <a href="#">註冊</a>
            </center>

        </main>
        @else
        @endguest
        @livewireScripts
    </body>
</html>