<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/faq.js') }}"></script>
</head>
<body>
@include('components.side-nav')
@include('profile.partials.navbar')
    <div class="top-row">
        <div class="box-forum"></div>
        <div class="forum-header fw-bold">
            Latest News
        </div>
    </div>
    <div class="last-update">{{ $article->created_at->diffForHumans() }}</div>
    <div class="forum-row">
        <div class="forum-title"> {{ $article->title }}</div>
        <div class="directory-title">Other Recent News</div>
    </div>
    <div class="forumdivide-line"></div>
    <div class="forum-row">
        <div class="content-container">
            <div class="forum-img">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" >
            </div>
            <div class="summary">
                {{ $article->summary }}
            </div>
        </div>

        <div class="forum-directory">
            @forelse($recentArticles as $recentArticle)
                <button onclick="window.location.href='{{ route('article.show', $recentArticle->id) }}'">
                    {{ $recentArticle->title }}
                </button>
                @empty
                <p>No recent articles available.</p>
            @endforelse
        </div>

    </div>
    
    <div class="date-news">{{ $article->created_at->format('F j, Y') }}</div>
    <div class="news-info">
        <h5>{{ $article->place }}</h5>
        
        <p>{{ $article->content }}</p>
    </div>

    <div class="follow-list">Follow List</div>
    <div class="underline-follow"> </div>
    <div class="follow-icon" style="margin-bottom: 50px;">
        <i class="bi bi-facebook"></i>
        <i class="bi bi-twitter"></i>
        <i class="bi bi-youtube"></i>
    </div>
    
    @include('profile.partials.footer')
</body>
