<x-layout>
    <!-- Jumbotron -->
    <div class="jumbotron text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to the Hockey Tournament!</h1>
            <p class="lead">Stay on top of the action with the ultimate hockey tournament organizer. Register your
                team, get real-time updates, and enjoy the game like never before!</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register Now</a>
        </div>
    </div>

    <!-- Carousel for Features Section -->
    <section class="features-carousel my-0 py-0"> <!-- Adjusted margins and paddings -->
        <div id="featuresCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active feature1">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Exhilarating</h3>
                        <p>Experience thrilling matches with top teams competing for the championship.</p>
                    </div>
                </div>
                <div class="carousel-item feature2">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Instantaneous</h3>
                        <p>Get real-time updates on scores, schedules, and player statistics.</p>
                    </div>
                </div>
                <div class="carousel-item feature3">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Engaging</h3>
                        <p>Enjoy exclusive forum for after match discussions.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#featuresCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#featuresCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>

    <!-- Statistics / Our Achievements Section -->
    <section class="achievements bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Achievements</h2>
            <div class="row text-center">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <i class="bi bi-people mb-3"></i>
                        <h4>User Friendliness</h4>
                        <p>Our app is designed for an intuitive and seamless user experience.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <i class="bi bi-star mb-3"></i>
                        <h4>Positive Review</h4>
                        <p>Rated highly by users for its functionality and reliability.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <i class="bi bi-calendar-check mb-3"></i>
                        <h4>Expert Tournament Organizer</h4>
                        <p>Trusted by experts for organizing and managing tournaments effectively.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="achievement-item">
                        <i class="bi bi-geo-alt mb-3"></i>
                        <h4>Amazing Venue</h4>
                        <p>Featuring state-of-the-art venues for an unforgettable experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Section -->
    <section class="registration-section bg-light py-5">
        <div class="container">
            <div class="row">
                <!-- Left Column (Form with Background) -->
                <div class="col-md-6 registration-form-container">
                    <div class="form-content">
                        <h2>Register Now</h2>
                        <p>Book a spot for your team!</p>
                        <form>
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- Right Column (Image Background) -->
                <div class="col-md-6 registration-image"></div>
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

</x-layout>