<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/loginstyles.css">
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
      <img src="img\back-arrow-svgrepo-com.png" alt="back" class="back-btn" href="/">
      <div class="form-box login">
        <h2>Login</h2>
        <form action="{{route('login')}}" method="post">
          @csrf

        <div class="input-box">
          <span class="icon"><i class="bi bi-envelope-fill"></i></span>
          <x-text-input id="email" type="email" required placeholder="E-Mail" name="email" :value="old('email)"/>
          <x-input-error :messages="$errors->get('email')"  />
        </div>
        <div class="input-box">
          <span class="icon"><i class="bi bi-lock-fill"></i></span>
        <x-text-input id="password" type="password" required placeholder="Password" name="password" required autocomplete="current-password"/>
        <x-input-error :messages="$errors->get('password')" />
        </div>
        <div class="remeber-forget">
          <label><input id="remember_me" type="checkbox" name="remember">Remember Me</label>
          <a href="{{ route('password.request') }}">Forget Password</a>
        </div>
        <button type="submit" class="btn"> Login</button>
        <div class="login-register">
          <p>Don't have an Account? <a href="#" class="register-link">Register</a></p>
        </div>
        </form>
      </div>
    </div>
</body>
</html>
