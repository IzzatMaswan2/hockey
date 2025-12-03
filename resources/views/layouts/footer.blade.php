<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    .contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px; /* Adjusts space between each item */
}

.contact-item i {
    margin-right: 8px; /* Space between icon and text */
}

.text-decoration-none {
    word-wrap: break-word; /* Ensures long email or address text wraps properly */
}

</style>
    
</head>
<body>

<footer class="py-5" style="background-color: #4B006E; width: 100%; font-size:16px ">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 mb-3 d-flex align-items-center">
                <img class="logo mr-3" src="{{asset('img/Logo Latest 1.png')}}" alt="Footer Logo" style="width: 120px; height: 90px;">
                <p class="text-white mb-0">{{$footer->tagline}}</p>
            </div>
            <div class="col-md-2 col-sm-6 mb-3">
                <h5 class="text-white"><strong>Useful Links</strong></h5>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-decoration-none" style="color: #FFFFFF;">Home</a></li>
                    <li><a href="/tournamentlist" class="text-decoration-none" style="color: #FFFFFF;">Tournament</a></li>
                    <li><a href="/forum" class="text-decoration-none" style="color: #FFFFFF;">Forum</a></li>
                    <li><a href="/about" class="text-decoration-none" style="color: #FFFFFF;">About</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 mb-3 ">
                <h5 class="text-white"><strong>Contact Us</strong></h5>
                <ul class="list-unstyled">
                    <li class="contact-item">
                        <a href="javascript:void(0)" class="text-decoration-none" style="color: #FFFFFF;" onclick="copyToClipboard('{{$footer->phone}}')">
                            <i class="fa-solid fa-phone-volume" style="margin-right: 8px"></i> {{$footer->phone}} 
                        </a>
                    </li>
                    <li class="contact-item">
                        <a href="javascript:void(0)" class="text-decoration-none" style="color: #FFFFFF;" onclick="copyToClipboard('{{$footer->email}}')">
                            <i class="fa-regular fa-envelope" style="margin-right: 8px"></i> {{$footer->email}} 
                        </a>
                    </li>
                    <li class="contact-item">
                        <a href="#" class="text-decoration-none" style="color: #FFFFFF;">
                            <i class="fa-solid fa-location-dot" style="margin-right: 8px"></i> {{$footer->address}}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-2 col-sm-6 mb-3">
                <h5 class="text-white"><strong>Follow Us</strong></h5>
                <ul class="list-unstyled d-flex gap-3">
                    <li><a href="#" target="_blank"><i class="fa-brands fa-facebook" style="color: #b197fc;"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa-brands fa-x-twitter" style="color: #b197fc;"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa-brands fa-instagram" style="color: #b197fc;"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="row border-top pt-4 mt-4">
            <div class="col-md-6 text-center text-md-left">
                <p style="color: #929292;">&copy; 2024, Inc. All rights reserved.</p>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end justify-content-center">
                <a href="#" class="text-body-secondary text-decoration-none mx-2" style="color: #929292;">Privacy Policy</a>
                <a href="#" class="text-body-secondary text-decoration-none mx-2" style="color: #929292;">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>
<script>
    function copyToClipboard(text) {
        const tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = text;
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert(text + " copied to clipboard!");
    }
</script>

</body>
</html>