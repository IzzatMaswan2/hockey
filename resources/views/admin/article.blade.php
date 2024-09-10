<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-6S3kS8Z2v3dHhe04cF0xtbB7t8Z6ZtQbCOkOqgRIse0dY+6BfVtA8tTu1Q8l10m4" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-DbfNwCApThcJe4fP5z5LfXz0cI0zTXh83Ge9pu6vxZyL2W1p7FSm5lZZjBX92W48" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        body {
            background-color: #f5f5f5;
        }

        .mb-4 {
            border-radius: 20px;
            background-color: white;
            padding: 20px 20px 0 20px;
            margin: 0;
        }

        .card {
            border-radius: 20px;
        }

        .sidebar {
            background-color: #929292;
            padding: 20px;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>

<body style="background-color: #f4f7f6;">

    <!-- Navbar -->


    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <div class="col-2 sidebar">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-md-9 content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- First Part -->
                        <div id="main-content" class="container-fluid">
                            <div class="row">
                                <!-- Header -->
                                <div class="mb-4">
                                    <h4>Write Some News</h4>
                                    <p class="text-muted">Write some news for users to see</p>
                                    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
                                </div>

                                <!-- Post Form -->
                                <div class="card">
                                    <div class="card-header" style="background-color:transparent;padding-top:20px;">
                                        <h5>Write a Post</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Article Title:</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" style="background-color:#f5f5f5" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="place" class="form-label">Place:</label>
                                                <input type="text" class="form-control" id="place" name="place" value="{{ old('place') }}" style="background-color:#f5f5f5" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: rgba(0, 0, 0, 1);">
                                                        <path d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z"></path>
                                                        <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                                                    </svg>
                                                </label>
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                            <div class="mb-3">
                                                <label for="summary" class="form-label">Summary:</label>
                                                <textarea class="form-control" id="summary" name="summary" rows="3" style="background-color:#f5f5f5" required>{{ old('summary') }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Content:</label>
                                                <textarea class="form-control" id="content" name="content" rows="10" style="background-color:#f5f5f5" required>{{ old('content') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="background-color:#5D3CB8">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    @include('layouts.footer')

</body>
</html>
