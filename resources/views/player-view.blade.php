<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #D3D3D3;">
                @include('layouts.sidebar-manager')
            </div>

            <div class="col-9 mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-center"style="color:#5D3CB8;font-weight:bold;">Add Players</h1>
                    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
                    <!-- <a href="{{ url('player') }}" class="btn btn-primary" style="background-color:#5D3CB8;font-weight:bold;color:white;border: #5D3CB8 1px solid; ">Add Player</a> -->
                    <button class="btn btn-primary"  style="background-color:#5D3CB8;font-weight:bold;color:white;border: #5D3CB8 1px solid; "data-bs-toggle="modal" data-bs-target="#addPlayerModal">Add Player</button>
                    <a href="{{ route('players.export') }}" class="btn btn-success" style="background-color:#5D3CB8;font-weight:bold;color:white;border:#5D3CB8 1px solid;">Export CSV</a>

                    
                </div>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Contact Number</th>
                            <th>Jersey Number</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($players as $player)
        <tr>
            <td>{{ $player->id }}</td>
            <td>{{ $player->name }}</td>
            <td>{{ $player->contact }}</td>
            <td>{{ $player->jerseyNumber }}</td>
            <td>{{ $player->position }}</td>
            <td>
                <a href="{{ route('player.edit', $player->id) }}" class="btn btn-warning btn-sm" style="border:#00CF00 1px solid;background-color:#00CF00;color:white;font-weight:bold">Edit</a>
                <form method="POST" action="{{ route('player-view.archive', $player->id) }}" style="display:inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn-arc">Archive</button>
                                                            </form>
            </td>
        </tr>
    @endforeach
</tbody>
                </table>

                <div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPlayerModalLabel">Add Player</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add Player Form -->
                            <form method="POST" action="{{ route('player.store') }}">
                                @csrf
                                <input type="hidden" name="role" value="Player">

                                <!-- Name -->
                                <div class="input-group mb-3">
                                    <label for="fullName" >
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i>Full Name: &nbsp;&nbsp;
                                    </label>
                                    <input id="fullName" type="text" name="fullName" class="form-control" value="{{ old('fullName') }}" required autofocus autocomplete="fullName"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('fullName')" class="error" />
                                </div>

                                                                <!-- Email Address -->
                                                                <div class="input-group mb-3">
                                    <label for="email" >
                                        <i class='bx bx-envelope' style="color: #7A5DCA;font-weight:bold;"></i> Email Address: &nbsp;&nbsp;
                                    </label>
                                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('email')" class="error" />
</div>


                              <!-- Display Name-->
                                <div class="input-group mb-3" >
                                    <label for="displayName">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Display Name: &nbsp;&nbsp;
                                    </label>
                                    <input id="displayName" type="text" name="displayName" class="form-control" value="{{ old('displayName') }}" required autofocus autocomplete="displayName"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('displayName')" class="error" />
                                </div>

                              <!-- Contact-->
                              <div class="input-group mb-3" >
                                    <label for="contact">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Contact: &nbsp;&nbsp;
                                    </label>
                                    <input id="contact" type="text" name="contact" class="form-control" value="{{ old('contact') }}" required autofocus autocomplete="contact"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('contact')" class="error" />
                                </div>

                                <!-- Contact-->
                              <div class="input-group mb-3" >
                                    <label for="jerseyNumber">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Jersey Number: &nbsp;&nbsp;
                                    </label>
                                    <input id="jerseyNumber" type="number" name="jerseyNumber" class="form-control" value="{{ old('jerseyNumber') }}" required autofocus autocomplete="jerseyNumber"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('jerseyNumber')" class="error" />
                                </div>

                                                                <!-- Contact-->
                              <div class="input-group mb-3" >
                                    <label for="position">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Jersey Number: &nbsp;&nbsp;
                                    </label>
                                    <select class="form-control @error('position') is-invalid @enderror" id="position" name="position" required style="border-radius:20px">
                                        <option value="" disabled selected>Select a position</option>
                                        <option value="Goal Keeper">Goal Keeper</option>
                                        <option value="Defender">Defender</option>
                                        <option value="Midfielder">Midfielder</option>
                                        <option value="Inner">Inner</option>
                                        <option value="Forward">Forward</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('jerseyNumber')" class="error" />
                                </div>

                                                                <!-- Contact-->
                              <div class="input-group mb-3" >
                                    <label for="dob">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Date of Birth: &nbsp;&nbsp;
                                    </label>
                                    <input id="dob" type="date" name="dob" class="form-control" value="{{ old('dob') }}" required autofocus autocomplete="dob"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('dob')" class="error" />
                                </div>

                                <div class="input-group mb-3" >
                                    <label for="field_status">
                                        <i class='bx bx-user' style="color: #7A5DCA;font-weight:bold;"></i> Status on the Field: &nbsp;&nbsp;
                                    </label>
                                    <select class="form-control @error('field_status') is-invalid @enderror" id="field_status" name="field_status" required style="border-radius:20px">
                    <option value="" disabled selected>Select status</option>
                    <option value="Active">Active</option>
                    <option value="Injured">Subtitude</option>
                    <option value="Retired">Bench</option>
                    
                </select>
                                    <x-input-error :messages="$errors->get('field_status')" class="error" />
                                </div>
                                <!-- Password -->
                                <div class="input-group mb-3" >
                                    <label for="password">
                                        <i class='bx bx-lock' style="color: #7A5DCA;font-weight:bold;"></i> Password: &nbsp;&nbsp;
                                    </label>
                                    <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password"style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('password')" class="error" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="input-group mb-3" >
                                    <label for="password_confirmation">
                                        <i class='bx bx-lock-alt' style="color: #7A5DCA;font-weight:bold;"></i> Confirm Password: &nbsp;&nbsp;
                                    </label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" style="border-radius:20px">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
                                </div>

                                <div class="modal-footer" >
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <x-primary-button class="btn btn-primary">{{ __('Register') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
@include('layouts.footer')
</html>
