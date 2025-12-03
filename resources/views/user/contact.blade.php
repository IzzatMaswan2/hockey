<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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

    <div class="main-container">
        <section>
            <div class="contactbanner-row">
                <div class="contact-banner">
                    <img src="img/contact.png" alt="contact-banner">
                    <div class="overlay">
                    </div>
                    <div class="text-container">
                        <h1 class="main-text">Contact us</h1>
                        <p class="sub-text">Need help with something? Feel free to ask</p>
                        <button onclick="scrollToSection('message')" class="btn-contactus">Contact Us</button>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="contactinfo-row">
                <div class="contactinfo-header">
                    <h1>Contact Information</h1>
                    <p>Know More About Us</p>
                </div>
                <div class="column-container">
                    <div class="column">
                        <div class="circle">
                            <div class="symbol">
                            <i class="bi bi-telephone-fill" style="font-size: 3rem; color: blue; "></i>
                            </div>
                        </div>
                        <div class="info">
                            <h1> OUR NUMBER </h1>
                                @foreach($phones as $phone)
                                    <p>{{ $phone }}</p>
                                @endforeach
                        </div>
                        <div class="link-info" >
                        <a href="javascript:void(0);" onclick="copyToClipboard('{{ $phone }}')">Copy Number</a>
                        </div>
                    </div>
                    <div class="column">
                        <div class="circle">
                                    <div class="symbol">
                                        <i class="bi bi-geo-alt-fill" style="font-size: 3rem; color:red;"></i>
                                    </div>
                            </div>
                            <div class="info">
                                <h1> OUR LOCATION </h1>
                                <p style="word-warp: break-word; line-height: 1.2rem;">{{$contact ->location}}</p>
                            </div>
                            <div class="link-info"> 
                            <a href="javascript:void(0);" onclick="openLocation()">Open in Google Maps</a>
                            </div>
                        </div>
                    <div class="column">
                        <div class="circle">
                            <div class="symbol">
                                <i class="bi bi-envelope-fill" style="font-size: 3rem; color: white;"></i>
                            </div>
                        </div>
                        <div class="info">
                            <h1> OUR E-MAIL </h1>
                                @foreach($emails as $email)
                                    <p>{{ $email }}</p>
                                @endforeach
                        </div>
                        <div class="link-info" >
                        <a href="javascript:void(0);" onclick="copyToClipboard('{{ $email }}')">Copy Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="message" id="message">
        <div class="text-container2">
            <p class="sub-text2">HAVE QUESTION?</p>
            <h1 class="main-text2">DROP US A MESSAGE</h1>
        </div>
        <div class="message-container">
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="input-container">
                <input type="text" id="name" name="name" placeholder="NAME" value="{{ old('name') }}" required>
                <input type="text" id="phone" name="phone" placeholder="PHONE NUMBER" value="{{ old('phone') }}" required>
                <input type="email" id="email" name="email" placeholder="E-MAIL" value="{{ old('email') }}" required>
            </div>
            <textarea id="subject" name="subject" placeholder="Message" style="height:200px" required>{{ old('subject') }}</textarea>
            <input type="submit" value="Submit">
        </form>
        </div>
    </div>
    <script>
        function scrollToSection(id) {
            const element = document.getElementById(id);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Function to copy text to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert("Copied to clipboard: " + text);
    }, function(err) {
        console.error("Failed to copy text: ", err);
    });
}

// Function to open location in Google Maps
function openLocation() {
    window.open('https://www.google.com/maps/place/Stadium+Hoki+Tun+Razak,+2,+Persiaran+Tuanku+Syed+Sirajuddin,+Bukit+Tunku,+50480+Kuala+Lumpur,+Wilayah+Persekutuan+Kuala+Lumpur/@3.1701538,101.670949,17z/data=!3m1!4b1!4m6!3m5!1s0x31cc4842c784554b:0xaa536b6dd80c92f!8m2!3d3.1701538!4d101.6735293!16s%2Fg%2F12hml4wzm?entry=ttu&g_ep=EgoyMDI0MTAyMC4xIKXMDSoASAFQAw%3D%3D', '_blank');
}
    </script>
    @include('profile.partials.footer')
</body>
