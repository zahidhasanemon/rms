<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Department of CSE, JU</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/util.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 40px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
        @endif

        <div class="content">

            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100 p-t-50 p-b-90">
                        <img src="{{ asset('images/JU-logo.png') }}" alt="{{ config('app.name', 'JU') }}" class="ju-logo">
                        <span class="title m-b-md">
                            Department of CSE, JU
                        </span>
                        <br><br>
                        <form class="login100-form validate-form flex-sb flex-w" action="{{ route('login') }}" method="POST">
                            @csrf


                            <div class="wrap-input100 validate-input m-b-16" data-validate = "Username is Required">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input100" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100"></span>
                            </div>


                            <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input100" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <span class="focus-input100"></span>
                            </div>

                            <div class="flex-sb-m w-full p-t-3 p-b-24">
                                <div class="contact100-form-checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    
                                </div>

                                <div>
                                    <a href="{{ route('password.request') }}" class="txt1">
                                        Forget Password?
                                    </a>
                                </div>
                            </div>

                            <div class="container-login100-form-btn m-t-17">
                                <button class="login100-form-btn" type="submit">
                                    Login
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
