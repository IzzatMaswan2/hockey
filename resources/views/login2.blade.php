<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
      
      <div class="form-box login">
          <h2>Login</h2>
          <form action="{{ route('login') }}" method="post">
              @csrf
              <div class="input-box">
                  <span class="icon"><i class="bi bi-envelope-fill"></i></span>
                  <x-text-input id="email" type="email" required placeholder="E-Mail" name="email" :value="old('email')" />
                  <x-input-error :messages="$errors->get('email')" />
              </div>
              
              <div class="input-box">
                  <span class="icon"><i class="bi bi-lock-fill"></i></span>
                  <x-text-input id="password" type="password" required placeholder="Password" name="password" autocomplete="current-password" />
                  <x-input-error :messages="$errors->get('password')" />
              </div>
              
              <div class="remember-forget">
                  <label><input id="remember_me" type="checkbox" name="remember"> Remember Me</label>
                  <a href="{{ route('password.request') }}">Forget Password</a>
              </div>
              
              <button type="submit" class="btn">Login</button>
              
              <div class="login-register">
                  <p>Don't have an Account? <a href="/register2" class="register-link">Register</a></p>
              </div>
          </form>
      </div>

  </div>
  <script src="js/script.js"></script>
</body>
</html>
