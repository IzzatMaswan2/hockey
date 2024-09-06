<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
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

    <script src="js/faq.js"></script>
</head>
<body>
    @include('components.side-nav')
    @include('profile.partials.navbar')
    <div class="top-row">
        <div class="box-forum"></div>
        <div class="forum-header">
            Latest News
        </div>
    </div>
    <div class="last-update">3 minute Ago</div>
    <div class="forum-row">
        <div class="forum-title">{{$latestArticle->title}}</div>
        <div class="directory-title">Most Read Today</div>
    </div>
    <div class="forumdivide-line"></div>
    <div class="forum-row">
        <div class="content-container">
            <div class="forum-img">
                <img src="img/news.jpg" alt="news">
            </div>
            <div class="summary">
                {{$latestArticle->summary}}
                <br>
                <a href="#content">Discover the full story behind their challenging tour Down Under.</a>
            </div>
        </div>
        <div class="forum-directory">
            <button>July Hockey News</button>
            <button>August Hockey News</button>
            <button>2024 Tournament Hockey News</button>
            <button>World Hockey News</button>
        </div>
    </div>
    
    <div class="date-news">{{$latestArticle->date_news}}</div>
    <div class="news-info" id="content">
        <p>
            {!! $latestArticle->content !!}
        </p>
    </div>

    <div class="follow-list">Follow List</div>
    <div class="underline-follow"> </div>
    <div class="follow-icon">
        <i class="bi bi-facebook"></i>
        <i class="bi bi-twitter"></i>
        <i class="bi bi-youtube"></i>
    </div>
    
    @include('profile.partials.footer')
    
</body>