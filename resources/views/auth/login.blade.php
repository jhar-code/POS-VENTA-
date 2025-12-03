<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name', 'NexusPos') }} - Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }

        .login-container {
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .left-panel {
            background: url("{{ asset('img/fondo.jpg') }}") no-repeat center center;
            background-size: cover;
            color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 2rem;
        }

        .left-panel::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .left-panel img {
            max-width: 150px;
            margin-bottom: 2rem;
            filter: brightness(0) invert(1);
        }

        .left-panel h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .left-panel p {
            font-size: 1.2rem;
            text-align: center;
            opacity: 0.9;
        }

        .right-panel {
            background-color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            max-width: 600px; /* Limit width on large screens */
        }

        .login-form {
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .login-header h2 {
            font-weight: 700;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ff2d20;
            background-color: white;
        }

        .btn-primary {
            background-color: #ff2d20;
            border-color: #ff2d20;
            border-radius: 5px;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #e0281c;
            border-color: #e0281c;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #ddd;
            color: #666;
            border-radius: 5px;
            padding: 0.75rem;
            font-weight: 600;
            margin-top: 1rem;
        }

        .btn-outline:hover {
            background-color: #f8f9fa;
            color: #333;
        }

        .forgot-link {
            color: #ff2d20;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .left-panel {
                display: none;
            }
            .right-panel {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <h1>{{ config('app.name', 'nexuspos') }}</h1>
            <p>Bienvenido a tu sistema de ventas.</p>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <div class="login-form">
                <div class="login-header">
                    <h2>Login</h2>
                    <p class="text-muted">Ingresa tus credenciales para acceder</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group mb-4">
                        <label for="email" class="mb-2 font-weight-bold text-muted">Email address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="example@gmail.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="password" class="font-weight-bold text-muted mb-0">Password</label>
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    Forgot?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" id="remember_me">
                            <label class="custom-control-label" for="remember_me">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block w-100">
                        Log in
                    </button>

                    {{-- <button type="button" class="btn btn-outline btn-block w-100">
                        Sign up
                    </button> --}}
                </form>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
