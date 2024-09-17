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
            <span class="welcoming">Welcome to the</span>
            <h1 class="display-4">Hockey Tournament!</h1>
            <p class="lead">Experience the thrill of the ultimate hockey tournament organizer! <br class="brspace"> 
                Register your team effortlessly and receive real-time updates on scores and schedules. <br class="brspace">
                Stay connected with live game stats and never miss a moment of the action. <br class="brspace">
                Elevate your game and enjoy a seamless tournament experience like never before. <br class="brspace"><br class="brspace"><br class="brspace">
                Join us now and make every play count!
            </p>
            <a href="{{ route('register') }}" class="btn-home btn-primary" style="border-radius: 20px">Register Now</a>
        </div>
    </div>

    <!-- Statistics / Our Achievements Section -->
    <section class="achievements bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Achievements</h2>
            <div class="row text-center">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <div class="icon"><i class="bi bi-people mb-3"></i></div>
                        
                        <h4>User Friendliness</h4>
                        <p>Our app is designed for an intuitive and seamless user experience.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <div class="icon"><i class="bi bi-star mb-3"></i></div>
                        
                        <h4>Positive Review</h4>
                        <p>Rated highly by users for its functionality and reliability.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <div class="icon"><i class="bi bi-calendar-check mb-3"></i></div>
                        
                        <h4>Expert Tournament Organizer</h4>
                        <p>Trusted by experts for organizing and managing tournaments effectively.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <div class="icon"><i class="bi bi-geo-alt mb-3"></i></div>
                        
                        <h4>Amazing Venue</h4>
                        <p>Featuring state-of-the-art venues for an unforgettable experience.</p>
                    </div>
                </div>
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
                        <form class="register-team">
                            <div class="mb-3">
                                <label for="teamName" class="form-label">Team Name</label>
                                <input type="text" class="form-control" id="teamName" placeholder="Enter team name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone"
                                    placeholder="Enter phone number">
                            </div>
                            <button type="submit" class="btn-regis btn-primary">Submit</button>
                        </form>
                    </div>
                    <img src="img/goalkeeper.png" alt="goal-keeper">
                </div>
                <!-- Right Column (Image Background) -->
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
    @include('profile.partials.footer')

</body>