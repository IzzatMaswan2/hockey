<!-- resources/views/player/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 style="color:#5D3CB8;font-weight:bold;">Edit Player</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('player.update', $player->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fullName">Full Name: </label>
                <input type="text" class="form-control @error('fullName') is-invalid @enderror" id="fullName" name="fullName" value="{{ old('fullName', $player->name) }}" required>
                @error('fullName')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
    <label for="displayName">Display Name: </label>
    <input type="text" class="form-control @error('displayName') is-invalid @enderror" id="displayName" name="displayName" value="{{ old('displayName', $player->displayName) }}" required>
    @error('displayName')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            <div class="form-group">
                <label for="contact">Contact Number: </label>
                <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact', $player->contact) }}" required>
                @error('contact')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jerseyNumber">Jersey Number: </label>
                <input type="number" class="form-control @error('jerseyNumber') is-invalid @enderror" id="jerseyNumber" name="jerseyNumber" value="{{ old('jerseyNumber', $player->jerseyNumber) }}" required>
                @error('jerseyNumber')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="position">Position: </label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $player->position) }}" required>
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="background-color:#5D3CB8;font-weight:bold;color:white;border: #5D3CB8 1px solid;">Update Player</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
