<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('css/loginstyles.css') }}">
    <link href='https://unpkg.com/boxicons/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        body {
            background: url('/img/logreg.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="form-box">
            <div class="logo">
                <img src="{{ asset('img/Logo Latest 1.png') }}" alt="HokiArenaLogo" style="height:90px;">
            </div>
            <h2 class="form-title" style="color: white;font-weight:bold;">REGISTRATION</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-group">
                    <label for="name">
                        <i class='bx bx-user' style="color: white;font-weight:bold;"></i> Name
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="error" />
                </div>

                <!-- Email Address -->
                <div class="input-group">
                    <label for="email">
                        <i class='bx bx-envelope' style="color: white;font-weight:bold;"></i> Email Address
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="error" />
                </div>

                <!-- Role -->
                <div class="input-group">
                    <label for="role">
                        <i class='bx bx-user-circle' style="color: white;font-weight:bold;"></i> Role
                    </label>
                    <select id="role" name="role" required autocomplete="role" onchange="toggleFields()">
                        <option value="" disabled selected>Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Manager">Manager</option>
                        <option value="Player">Player</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="error" />
                </div>

                <!-- Team Name and Country -->
                <div id="team-fields" class="input-group" style="display: none;">
                    <label for="teamName">
                        <i class='bx bx-trophy' style="color: white;font-weight:bold;"></i> Team Name
                    </label>
                    <input id="teamName" type="text" name="teamName" value="{{ old('teamName') }}" autofocus autocomplete="teamName">
                    <x-input-error :messages="$errors->get('teamName')" class="error" />
                </div>

                <div id="country-fields" class="input-group" style="display: none;">
                    <label for="country">
                        <i class='bx bx-globe' style="color: white;font-weight:bold;"></i> Country
                    </label>
                    <input id="country" type="text" name="country" value="{{ old('country') }}" autofocus autocomplete="country">
                    <x-input-error :messages="$errors->get('country')" class="error" />
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password">
                        <i class='bx bx-lock' style="color: white;font-weight:bold;"></i> Password
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="error" />
                </div>

                <!-- Confirm Password -->
                <div class="input-group">
                    <label for="password_confirmation">
                        <i class='bx bx-lock-alt' style="color: white;font-weight:bold;"></i> Confirm Password
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
                </div>

                <div class="form-actions">
                    <a href="{{ route('login') }}" style="color:white;font-size:12px">Already have an Account?</a>
                </div>
 
                <div class="row">
                    <div class="flex items-center justify-center w-full mt-4" style="color:white;font-weight:bold">
                        <x-primary-button class="btn">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            const teamFields = document.getElementById('team-fields');
            const countryFields = document.getElementById('country-fields');
            
            if (role === 'Admin') {
                teamFields.style.display = 'none';
                countryFields.style.display = 'none';
            } else {
                teamFields.style.display = 'block';
                countryFields.style.display = 'block';
            }
        }
    </script>
</body>
</html>
