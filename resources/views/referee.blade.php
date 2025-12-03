<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Referee</title>
</head>
<body>
@include('layouts.navbar')
    <div class="container-fluid" style="height: 90%;">
        <div class="row">
            <div class="col-3" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>
            <div class="col-9">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm my-4">
                    <div class="card-header text-white" style="background-color: #4B006E;">
                        <h5 class="card-title mb-0">Referee Form</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('referee.store')}}">
                            @csrf
                            <!-- Referee Section -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Referee Name</label>
                                    <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Referee Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Role" class="form-label">Referee Role</label>
                                    <input type="text" class="form-control" id="Role" name="Role" placeholder="Enter Referee Role" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn" style="background-color: #00FF87;">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- resources/views/referee/index.blade.php -->
                <div class="card shadow-sm my-4">
                    <div class="card-header text-white" style="background-color: #4B006E;">
                        <h5 class="card-title mb-0">Referee List</h5>
                    </div>
                    <div class="card-body">
                        <!-- Referee Table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Referee Name</th>
                                    <th>Referee Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($referee as $referee)  <!-- Using $referee from the controller -->
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $referee->Name }}</td>  <!-- Referencing 'name' field -->
                                        <td>{{ $referee->Role }}</td>  <!-- Referencing 'role' field -->
                                        <td>
                                            <!-- Edit Button (can open a modal for editing) -->
                                            <!-- Edit Button (opens a modal for editing) -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRefereeModal{{ $referee->id }}">Edit</button>


                                        </td>
                                    </tr>

                                    <!-- Edit Modal for Referee -->
                                   
                                    <!-- Modal for editing referee -->
                                        <div class="modal fade" id="editRefereeModal{{ $referee->id }}" tabindex="-1" aria-labelledby="editRefereeModalLabel{{ $referee->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editRefereeModalLabel{{ $referee->id }}">Edit Referee</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form  action="{{ route('referee.update', $referee->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-3">
                                                                <label for="name{{ $referee->id }}" class="form-label">Full Name</label>
                                                                <input type="text" class="form-control" id="name{{ $referee->id }}" name="name" value="{{ $referee->name }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="role{{ $referee->id }}" class="form-label">Role</label>
                                                                <!-- You can change this to a select if you want to limit roles -->
                                                                <input type="text" class="form-control" id="role{{ $referee->id }}" name="role" value="{{ $referee->role }}" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript to trigger the modal -->
    <script>
        document.getElementById('openModalButton').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('editRefereeModal{{ $referee->id }}'));
            modal.show();
        });

        

    </script>

    @include('layouts.footer')
</body>
</html>