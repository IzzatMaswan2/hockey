<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css/loginstyles(old).css">
</head>
<body>
  <header>
    <img src="img/Logo Latest 1.png" alt="Logo" class="logo">
    <nav class="navigation">
      <a href="#">Tournament</a>
      <a href="#">Group</a>
      <a href="#">Forum</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
      <button class="btnlogin-popup">LOGIN</button>
    </nav>
  </header>
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div class="wrapper">
      <!-- Use button instead of <img> for navigation -->
      <a href="/" class="back-btn">
          <img src="{{ asset('img/back-arrow-svgrepo-com.png') }}" alt="Back">
      </a>

      <div class="form-box register">
        <h2>Registeration</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-box">
              <span class="icon"><i class="bi bi-person-fill"></i></span>
              <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="input-box">
                <span class="icon"><i class="bi bi-envelope-fill"></i></span>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            
            <div class="input-box">
                <span class="icon"><i class="bi bi-lock-fill"></i></span>
                <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div class="input-box">
              <span class="icon"><i id="confirm-icon" class="bi bi-check2-circle"></i></span>
              <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
            
            <div class="remember-forget">
                <label><input id="term_agree" type="checkbox" name="termagree"> I agree to the term & Condition</label>
            </div>
            
            <x-primary-button class="btn">
              {{ __('Register') }}
            </x-primary-button>
            
            <div class="login-register">
                <p>Already have an Account? <a href="/login2" class="login-link">Login</a></p>
            </div>
        </form>
    </div>
  </div>
  <script src="js/script.js"></script>
</body>
</html>
