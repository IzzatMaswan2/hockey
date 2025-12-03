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
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
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
            <form method="POST" action="{{ route('register') }}" id="registrationForm">
                @csrf

                <!-- Hidden Role (Automatically set to Manager) -->
                <input type="hidden" name="role" value="Manager">

                <!-- Personal Information Section -->
                <div class="form-section active" id="personalInfo">
                    <div class="input-group">
                        <label for="fullName">
                            <i class='bx bx-user' style="color: white;font-weight:bold;"></i> Name
                        </label>
                        <input id="fullName" type="text" name="fullName" value="{{ old('fullName') }}" required autofocus autocomplete="fullName">
                        <x-input-error :messages="$errors->get('fullName')" class="error" />
                    </div>

                    <div class="input-group">
                        <label for="occupation">
                        <i class='bx bxs-phone-call'style="color: white;font-weight:bold;"></i> Occupation:
                        </label>
                        <input id="occupation" type="text" name="occupation" value="{{ old('occupation') }}" required autocomplete="occupation">
                        <x-input-error :messages="$errors->get('occupation')" class="error" />
                    </div>
                    <div class="input-group">
                                    <label for="tournament_id">
                                        <i class='bx bx-trophy' style="color: #7A5DCA;font-weight:bold;"></i> Tournament: &nbsp;&nbsp;
                                    </label>
                                    <select id="tournament_id" name="tournament_id">
                                                                    <option value="" disabled selected>Select a tournament</option>
                                                                    @foreach ($tournaments as $tournament)
                                                                        <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                                                    @endforeach
                                                                </select>
                                    <x-input-error :messages="$errors->get('tournament_id')" class="error" />
                                </div>

                    <div class="input-group">
                        <label for="teamName">
                            <i class='bx bxs-flag-alt' style="color: white;font-weight:bold;"></i> Team Name:
                        </label>
                        <input id="teamName" type="text" name="teamName" value="{{ old('teamName') }}" required autocomplete="teamName">
                        <x-input-error :messages="$errors->get('teamName')" class="error" />
                    </div>

                    <div class="input-group">
                        <label for="address">
                            <i class='bx bx-home' style="color: white;font-weight:bold;"></i> Address:
                        </label>
                        <input id="address" type="text" name="address" value="{{ old('address') }}" required autocomplete="address">
                        <x-input-error :messages="$errors->get('address')" class="error" />
                    </div>

                    <div class="input-group">
                        <label for="country">
                            <i class='bx bx-globe' style="color: white;font-weight:bold;"></i> Country:
                        </label>
                        <input id="country" type="text" name="country" value="{{ old('country') }}" required autocomplete="country">
                        <x-input-error :messages="$errors->get('country')" class="error" />
                    </div>

                    <div class="form-actions">
                        <button type="button" class="next-button" onclick="showNextSection()">Next</button>
                    </div>
                </div>

<!-- Email and Password Section -->
<div class="form-section" id="emailPassword">
    <div class="input-group">
        <label for="email">
            <i class='bx bx-envelope' style="color: white;font-weight:bold;"></i> Email Address
        </label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
        <x-input-error :messages="$errors->get('email')" class="error" />
    </div>

    <div class="input-group">
        <label for="password">
            <i class='bx bx-lock' style="color: white;font-weight:bold;"></i> Password
        </label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
        <x-input-error :messages="$errors->get('password')" class="error" />
    </div>

    <div class="input-group">
        <label for="password_confirmation">
            <i class='bx bx-lock-alt' style="color: white;font-weight:bold;"></i> Confirm Password
        </label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
        <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
    </div>

    <div class="form-actions">
        <button type="button" class="back-button" onclick="showPreviousSection()">Back</button>
        <a href="{{ route('login') }}" style="color:white;font-size:12px">Already have an Account?</a>
    </div>

    <div class="row">
        <div class="flex items-center justify-center w-full mt-4" style="color:white;font-weight:bold">
            <x-primary-button class="btn">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </div>
</div>

            </form>
        </div>
    </div>

    <script>
        function showNextSection() {
            document.getElementById('personalInfo').classList.remove('active');
            document.getElementById('emailPassword').classList.add('active');
        }

        function showPreviousSection() {
    document.getElementById('emailPassword').classList.remove('active');
    document.getElementById('personalInfo').classList.add('active');
}
    </script>
</body>
</html>
