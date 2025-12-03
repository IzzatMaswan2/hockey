<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> 
    
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
    <!-- Jumbotron -->
    <div class="jumbotron text-white py-5 my-0">
        <div class="container">
            <span class="welcoming">{{$homeArr['home']->banner_s_header}}</span>
            <h1 class="display-4">{{$homeArr['home']->banner_b_header}}</h1>
            <p class="lead">
                {{$homeArr['home']->banner_paragraph}} 
                <a href="{{ route('register') }}" class="btn-home btn-primary" style="border-radius: 20px">Register Now</a>
                @guest
                <a href="{{ route('register') }}" class="btn-home btn-primary" style="border-radius: 20px">Register Now</a>
                @endguest
            </p>
        </div>
    </div>

    <!-- Statistics / Our Achievements Section -->
    <section class="achievements bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Achievements</h2>
            <div class="row text-center">
                @forelse ($homeArr['Achievement'] as $achievement)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="achievement-item">
                            <div class="icon"><i class="{{ $achievement->icon }}"></i></div>
                            <h4>{{ $achievement->title }}</h4>
                            <p>{{ $achievement->description }}</p>
                        </div>
                    </div>
                @empty
                    <p>No achievements found.</p>
                @endforelse
            </div>
        </div>
    </section>
    
    <!-- Registration Section -->
    <section class="registration-section bg-dark py-5">
        <div class="container">
            <div class="row">
                <!-- Left Column (Form with Background) -->
                <div class="registration-form-container">
                    <div class="form-content">
                        <h2>Register Now</h2>
                        <p>Book a spot for your <br> Team Now!</p>
                        <form class="register-team" id="registerTeamForm">
                            <button type="submit" class="btn-regis btn-primary">Submit</button>
                        </form>
                    </div>
                    <img src="img/goalkeeper.png" alt="goal-keeper">
                </div>
                <div class="col-md-6 registration-image"> </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Meet Our Team</h2>
            <div class="row text-center">
                @forelse ($homeArr['meet'] as $meet)
                    <div class="col-md-4 mb-4">
                        <div class="team-member">
                            <div class="member-photo" style="background-image: url('{{ $meet->img }}');"></div>
                            <h4>{{ $meet->name }}</h4>
                            <p>{{ $meet->position }}</p>
                            <div class="social-icons">
                                @if($meet->icon_link1)
                                    <a href="{{ $meet->link1 ?? '#' }}" target="_blank"><i class="{{ $meet->icon_link1 }}"></i></a>
                                @endif
                                @if($meet->icon_link2)
                                    <a href="{{ $meet->link2 ?? '#' }}" target="_blank"><i class="{{ $meet->icon_link2 }}"></i></a>
                                @endif
                                @if($meet->icon_link3)
                                    <a href="{{ $meet->link3 ?? '#' }}" target="_blank"><i class="{{ $meet->icon_link3 }}"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No team members found.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="faq">
                @foreach ($faqs as $faq)
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>{{ $faq->question }}</h3>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    });
    </script>

    <script>
document.getElementById('registerTeamForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Call your API to check if the user is logged in
    fetch('/api/check-auth', {
        method: 'GET',
        credentials: 'include' // Ensures session cookies are sent with the request
    })
    .then(response => response.json())
    .then(data => {
        if (data.loggedIn) {
            // Redirect to /tournamentlist if the user is logged in
            window.location.href = '/tournamentlist';
        } else {
            // Redirect to /login if the user is not logged in
            window.location.href = '/login';
        }
    })
    .catch(error => {
        console.error('Error checking login status:', error);
        // Optionally, redirect to login page on error
        window.location.href = '/login';
    });
});
</script>
    @include('profile.partials.footer')

</body>