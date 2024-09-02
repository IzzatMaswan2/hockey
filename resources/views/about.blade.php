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
    <div class="about-container">
        <section>
            <div class="about-banner">
                <h1>About Us</h1>
                <p>
                    Welcome to TechSolutions Inc., a leader in innovative technology solutions since 2010. 
                    Our dedicated team of engineers, designers, and strategists is committed to delivering exceptional service and groundbreaking products. 
                    We've successfully helped numerous clients achieve their business goals through tailored technology solutions
                </p>
            </div>
        </section>
        <section>
            <div class="about-row">
                <div class="about-column">
                    <div class="about-who">
                        <h1>
                            Who We Are?
                        </h1>
                        <div class="underline-about"> </div>
                        <p>
                        At TechSolutions Inc., we specialize in providing custom software development,
                        IT consulting, cloud services, cybersecurity, and AI and machine learning solutions. 
                        From concept to deployment, our bespoke software solutions are designed to meet your specific needs. 
                        Our expert consultants offer strategic advice to help you leverage technology for business growth.
                        We enhance efficiency and scalability with our cloud solutions, protect your data with robust cybersecurity measures,
                        and provide advanced AI and machine learning solutions to keep you ahead of the competition.
                        </p>
                    </div>
                </div>
                <div class="about-column">
                    <div class="rec-two">
                        <img src="img/about-who.png" alt="about-who" class="imgabout-who">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="about-row">
                <div class="about-column">
                    <div class="rec-three"></div>
                    <div class="rec-four">
                        <img src="img/about-who2.png" alt="offer">
                    </div>
                </div>
                <div class="about-column">
                    <div class="about-offer">
                        <h1>
                            What We offer? 
                        </h1>
                        <div class="underline-offer"></div>
                        <p>
                        TechSolutions Inc. provides cutting-edge technology solutions that drive innovation and efficiency. 
                        Our team of seasoned professionals brings extensive experience to every project, 
                        ensuring that our solutions are aligned with your business goals. 
                        We offer comprehensive support from initial consultation to deployment and have a proven track record of successful projects across various industries. 
                        Experience the TechSolutions Inc. difference and let us help transform your business with technology.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('profile.partials.footer')
</body>