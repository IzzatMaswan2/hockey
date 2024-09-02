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
    <div class="login-bg">
        <div class="regis-wrapper">
            
            <div class="form-box register">
                <div class="logores-row">
                    <img src="{{asset('img/Logo Latest 1.png')}}" alt="HokiArenaLogo">
                </div>
                <h2>REGISTRATION</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- First Row: Name and Email -->
                    <div class="row">
                        <div class="input-box">
                            <span class="icon"><i class="bi bi-person"></i></span>
                            <x-text-input id="regis-name" class="regis-name" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="Name" />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div class="input-box">
                            <span class="icon"><i class="bi bi-envelope"></i></span>
                            <x-text-input id="email" class="regis-email" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Email"/>
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                    </div>
            
                    <!-- Second Row: Team Name and Country -->
                    <div class="row">
                        <div class="input-box">
                            <span class="icon"><i class="bi bi-people"></i></span>
                            <x-text-input id="teamName" class="regis-team" type="text" name="teamName" :value="old('teamName')" required autocomplete="teamName" placeholder="Team Name" />
                            <x-input-error :messages="$errors->get('teamName')" />
                        </div>
                        <div class="input-box">
                            <span class="icon"><i class="bi bi-geo-alt"></i></span>
                            <x-select
                                id="country"
                                name="country"
                                :value="old('country')"
                                required
                                autocomplete="country"
                                class="regis-country"
                            >
                                <option value="" disabled selected hidden>Select a country</option>
                                <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>United States</option>
                                <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('country')" />
                        </div>
                    </div>
            
                    <!-- Third Row: Password -->
                    <div class="row">
                        <div class="input-box">
                            <span class="icon"><i class="bi bi-lock"></i></span>
                            <x-text-input id="password" class="regis-password" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>
                    </div>
            
                    <!-- Fourth Row: Confirm Password -->
                    <div class="row">
                        <div class="input-box">
                            <span class="icon"><i id="confirm-icon" class="bi bi-check2-circle"></i></span>
                            <x-text-input id="password_confirmation" class="regis-password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" />
                        </div>
                    </div>
            
                    <!-- Fifth Row: Already Have an Account -->
                    <div class="row">
                        <div class="flex items-center justify-center w-full mt-4">
                            <a class="login-register" href="{{ route('login') }}">
                                {{ __('Already have an Account?') }}
                            </a>
                        </div>
                    </div>
            
                    <!-- Sixth Row: Register Button -->
                    <div class="row">
                        <div class="flex items-center justify-center w-full mt-4">
                            <x-primary-button class="btn">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>    
    </div>
    @include('profile.partials.footer')
</body>

