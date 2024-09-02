<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/tournament.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/about.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/loginstyles.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/match.css') }}">
    
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
        <div class="forum-title">Young Tigers lose all their matches in Australian-tower</div>
        <div class="directory-title">Most Read Today</div>
    </div>
    <div class="forumdivide-line"></div>
    <div class="forum-row">
        <div class="content-container">
            <div class="forum-img">
                <img src="img/news.jpg" alt="news">
            </div>
            <div class="summary">
                The Young Tigers' recent tour of Australia ended in a series of crushing defeats, 
                leaving the national youth hockey team reeling. With a string of losses to the Australian junior squad, 
                including a heavy 5-1 thrashing in their final match, questions arise about their readiness for the upcoming Sultan of Johor Cup. 
                As they prepare to face top international teams, will the Young Tigers bounce back or continue their struggle?<br>
                <span>Discover the full story behind their challenging tour Down Under.</span>
            </div>
        </div>
        <div class="forum-directory">
            <button>July Hockey News</button>
            <button>August Hockey News</button>
            <button>2024 Tournament Hockey News</button>
            <button>World Hockey News</button>
        </div>
    </div>
    
    <div class="date-news">August 12, 2024</div>
    <div class="news-info">
        <p>
            KUALA LUMPUR: The national youth hockey team, known as the Young Tigers, recently embarked on a playing tour in Australia, 
            where they faced a tough series of matches against the Australian junior team. 
            Unfortunately for the Young Tigers, the tour ended in disappointment as they lost all four of their friendly matches.
        </p><br>
        <p>
            In their time in Brisbane, the Malaysian side struggled against their Australian counterparts. 
            The first three matches saw the Young Tigers defeated with scores of 4-2, 5-2, and 2-0. 
            The trend continued with a final heavy loss of 5-1 in their most recent game.
        </p><br>
        <p>
            Led by coach I. Vickneswaran, the Young Tigers encountered formidable opponents and were unable to secure any victories. 
            The results of these matches raise concerns about their readiness for the upcoming Sultan of Johor Cup, scheduled to take place from October 19-26. 
            This prestigious tournament will feature teams from Australia, India, Britain, Japan, and New Zealand.</p><br>
        
        <p> Despite the challenges faced during the tour, the Young Tigers will need to regroup and address their shortcomings in preparation for the Sultan of Johor Cup.
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