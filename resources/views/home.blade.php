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
                <!-- Team Member 1 -->
                <div class="col-md-4 mb-4">
                    <div class="team-member member1">
                        <div class="member-photo"></div>
                        <h4>John Doe</h4>
                        <p>Head Coach</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="col-md-4 mb-4">
                    <div class="team-member member2">
                        <div class="member-photo"></div>
                        <h4>Jane Smith</h4>
                        <p>Assistant Coach</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="col-md-4 mb-4">
                    <div class="team-member member3">
                        <div class="member-photo"></div>
                        <h4>Sam Wilson</h4>
                        <p>Team Manager</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="faq">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What is the registration process?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>The registration process is simple. Just click on the 'Register Now' button, fill in your
                            details, and submit the form. You'll receive a confirmation email with further instructions.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How can I contact support?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>You can contact support through our 'Contact' page. Fill out the contact form or reach us
                            directly at support@example.com.</p>
                    </div>
                </div>
                <!-- Add more FAQ items as needed -->
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What are the requirements for registering a team?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Include any specific criteria or documents needed.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How can I view fixtures and schedules?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Explain where users can find fixtures and how to navigate the schedule.
                        </p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Are there any fees associated with registration or participation?</h3>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Detail any costs involved and payment methods accepted.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('profile.partials.footer')

</body>