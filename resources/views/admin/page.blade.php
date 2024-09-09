<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @include('admin.navbar')
    @include('admin.sidebar')
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>Contact Management</h1>
        </div>

        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <form action="{{ route('contact.update') }}" method="POST">
            @csrf

            <div>
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="{{ old('location', $contact->location) }}">
                @error('location')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="phone-numbers">
                <label>Phone Numbers:</label>
                @foreach ($phones as $phone_id => $phone)
                    <input type="hidden" name="phone_numbers[{{ $phone_id }}][id]" value="{{ $phone_id }}">
                    <input type="text" name="phone_numbers[{{ $phone_id }}][number]" value="{{ old('phone_numbers.' . $phone_id . '.number', $phone) }}">
                @endforeach
                @error('phone_numbers.*.number')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="emails">
                <label>Emails:</label>
                @foreach ($emails as $email_id => $email)
                    <input type="hidden" name="emails[{{ $email_id }}][id]" value="{{ $email_id }}">
                    <input type="email" name="emails[{{ $email_id }}][address]" value="{{ old('emails.' . $email_id . '.address', $email) }}">
                @endforeach
                @error('emails.*.address')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
    @include('layouts.footer')
</body>
</html>
