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
    <title>Manage Article</title>
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

        .section{
            padding:30px;
        }

        .article-card {
            display: flex;
            padding: 10px;
        }


        .card-body {
            flex: 1;
        }
    </style>
</head>
<body style="background-color: #f4f7f6;">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <!-- Center Content -->
            <div class="col-8" style="width: 60%;">
                <div class="container-fluid">
                    <br>
                        <h2 style="color:#7A5DCA;font-weight:bold;">ADD NEW VENUE</h2>
                        <br>
                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <!-- First Part -->
                            <div id="main-content" class="container-fluid" style="margin-top:0;">
                                <div class="row">


                                    <!-- Post Form -->
                                    <div class="card">
                                        <div class="card-header" style="background-color:transparent;padding-top:20px;">
                                            <h5>Write a Post</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Article Title:</label>
                                                    <input type="text" class="form-control" id="title" name="title" style="background-color:#f5f5f5">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                            <path d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z"></path>
                                                            <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                                                        </svg>
                                                    </label>Image:
                                                    <input type="file" class="form-control" id="image" name="image">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="place" class="form-label">Location:</label>
                                                    <input type="text" class="form-control" id="place" name="place" style="background-color:#f5f5f5">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="summary" class="form-label">Summary:</label>
                                                    <textarea class="form-control" id="summary" name="summary" rows="5" style="background-color:#f5f5f5;"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Content:</label>
                                                    <textarea class="form-control" id="content" name="content" rows="10" style="background-color:#f5f5f5"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary" style="background-color:#5D3CB8">Save</button>
                                            </form>
                                        </div>
                                    </div>
<!-- ARTICLES LIST TABS -->
<div class="section">
    <h2 style="color:#7A5DCA;font-weight:bold;">ARTICLES LIST</h2>

    <!-- Tabs for Unarchived and Archived Articles -->
    <ul class="nav nav-tabs" id="articleTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="unarchived-article-tab" data-bs-toggle="tab" data-bs-target="#unarchived-article" type="button" role="tab" aria-controls="unarchived-article" aria-selected="true">Unarchived Articles</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="archived-article-tab" data-bs-toggle="tab" data-bs-target="#archived-article" type="button" role="tab" aria-controls="archived-article" aria-selected="false">Archived Articles</button>
        </li>
    </ul>

    <div class="tab-content" id="articleTabsContent">
        <!-- Unarchived Articles -->
        <div class="tab-pane fade show active" id="unarchived-article" role="tabpanel" aria-labelledby="unarchived-article-tab">
            <div class="row">
                @foreach($recentArticles as $article)
                    @if ($article->archived === 1) <!-- Unarchived articles -->
                        <div class="col-md-12 mb-3" >
                            <div class="card article-card d-flex flex-row">
                                <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }} Image" style="width:200px;height:200px;">
                                <div class="card-body">
                                    <h5 class="card-title mt-3"><i class="fas fa-newspaper"></i>{{ \Illuminate\Support\Str::limit($article->title, 30) }}</h5>
                                    <p><b>LOCATION:</b> {{ $article->place }}</p>
                                    <p><b>SUMMARY:</b> {{ \Illuminate\Support\Str::limit($article->summary, 30) }}</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#articleModal{{ $article->id }}">
    Read More
</button>
<button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editArticleModal{{ $article->id }}">
    Edit
</button>
                                    <form method="POST" action="{{ route('article.archive', $article->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Archive</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Archived Articles -->
        <div class="tab-pane fade" id="archived-article" role="tabpanel" aria-labelledby="archived-article-tab">
            <div class="row">
                @foreach($recentArticles as $article)
                    @if ($article->archived === 0) <!-- Archived articles -->
                        <div class="col-md-12 mb-3">
                            <div class="card article-card d-flex flex-row">
                                <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }} Image" style="width:200px;height:200px;">
                                <div class="card-body">
                                    <h5 class="card-title mt-3"><i class="fas fa-newspaper"></i> {{ $article->title }}</h5>
                                    <p><b>LOCATION:</b> {{ $article->place }}</p>
                                    <p><b>SUMMARY:</b> {{ \Illuminate\Support\Str::limit($article->summary, 30) }}</p>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#articleModal{{ $article->id }}">
                                        Read More
                                    </button>
                                    <form method="POST" action="{{ route('article.unarchive', $article->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Unarchive</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               

    <!-- View Article Modal (Read More) -->
@foreach($recentArticles as $article)
    <div class="modal fade" id="articleModal{{ $article->id }}" tabindex="-1" aria-labelledby="articleModalLabel{{ $article->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="articleModalLabel{{ $article->id }}">{{ $article->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" alt="{{ $article->title }} Image" style="width:200px;height:200px;">
                    <p><b>Location:</b> {{ $article->place }}</p>
                    <p><b>Summary:</b> {{ $article->summary }}</p>
                    <p><b>Content:</b> {{ $article->content }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Edit Article Modal -->
@foreach($recentArticles as $article)
    <div class="modal fade" id="editArticleModal{{ $article->id }}" tabindex="-1" aria-labelledby="editArticleModalLabel{{ $article->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editArticleModalLabel{{ $article->id }}">Edit {{ $article->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title{{ $article->id }}" class="form-label">Article Title:</label>
                            <input type="text" class="form-control" id="title{{ $article->id }}" name="title" value="{{ $article->title }}" style="background-color:#f5f5f5">
                        </div>
                        
                        <div class="mb-3">
                            <label for="image{{ $article->id }}" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="image{{ $article->id }}" name="image">
                        </div>

                        <div class="mb-3">
                            <label for="place{{ $article->id }}" class="form-label">Location:</label>
                            <input type="text" class="form-control" id="place{{ $article->id }}" name="place" value="{{ $article->place }}" style="background-color:#f5f5f5">
                        </div>

                        <div class="mb-3">
                            <label for="summary{{ $article->id }}" class="form-label">Summary:</label>
                            <textarea class="form-control" id="summary{{ $article->id }}" name="summary" rows="5" style="background-color:#f5f5f5">{{ $article->summary }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="content{{ $article->id }}" class="form-label">Content:</label>
                            <textarea class="form-control" id="content{{ $article->id }}" name="content" rows="10" style="background-color:#f5f5f5">{{ $article->content }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="background-color:#5D3CB8">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach



    <!-- Include Footer -->
  
</body>
@include('layouts.footer')
</html>
