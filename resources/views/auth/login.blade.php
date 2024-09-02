<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/loginstyles.css">
</head>
<body>
    @include('components.side-nav')
    @include('profile.partials.navbar')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="login-bg">
        <div class="wrapper">
    
            <div class="form-box login">
                <div class="logo-row">
                    <img src="{{asset('img/Logo Latest 1.png')}}" alt="HokiArenaLogo">
                </div>
                <h2>Login</h2><br>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="input-box">
                        <span class="icon"><i class="bi bi-envelope"></i></span>
                        <x-text-input id="email" class="log-email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="regis-email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="input-box">
                        <span class="icon"><i class="bi bi-lock"></i></span>
                        <x-text-input id="password" class="password-input"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
            
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="remeber-me">{{ __('Remember me') }}</span>
                        </label>
                    </div>
        
                    <div class="request-password">
                        @if (Route::has('password.request'))
                            <a class="requestpassword-text" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="row">
                        <div class="flex items-center justify-center w-full mt-4">
                            <a class="login-register" href="{{ route('register') }}">
                                {{ __('Dont have an Account?') }}
                            </a>
                        </div>
                    </div><br>
            
                        <x-primary-button class="btn">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('profile.partials.footer')
</body>
