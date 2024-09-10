<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/loginstyles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>

    <!-- Removed Bootstrap CSS and JS imports as they are not needed -->
    <!-- Removed Bootstrap Icons import -->

    <!-- Your CSS file for styling -->
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel='stylesheet'>
    <style>
        body {
    background: url('/img/logreg.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}

        </style>
</head>
<body>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-bg">
        <div class="register-container">
            <div class="form-box">
                <div class="logo">
                    <img src="{{asset('img/Logo Latest 1.png')}}" alt="HokiArenaLogo" style="height:90px;">
                </div>
                <h2 style="color:white;font-weight:bold">LOG-IN</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="input-group">
                        <label for="email">
                            <i class='bx bx-envelope'></i> Email Address
                        </label>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="error" />
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label for="password">
                            <i class='bx bx-lock'></i> Password
                        </label>
                        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="error" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-actions">
                        <label for="remember_me" style="color:white;font-size:12px;">
                            <input id="remember_me" type="checkbox" class="rounded" name="remember">
                            <span class="remember-me">Remember me</span>
                        </label>
                    </div>
                    <br>

                    <!-- Forgot Password and Register Link Side by Side -->
                    <div class="form-actions" style="color:white;font-size:12px;">
                        <div class="links-container">
                            @if (Route::has('password.request'))
                                <a class="request-password" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="login-register" href="{{ route('register') }}">
                                Don't have an Account?
                            </a>
                        </div>
                    </div>
                    <br>

                    <!-- Submit Button -->
                    <div class="input-group">
                        <x-primary-button class="btn">
                            LOG-IN
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
