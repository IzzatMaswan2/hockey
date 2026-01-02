<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="css/style.css">  --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Footer</title>
    <style>
        
footer {
    width: 100%;
    background: linear-gradient(to right, #4B006E, #000000);
    padding: 50px 0 30px;
    font-size: 13px;
    line-height: 20px;
}

.footer-row {
    width: 100%;
    margin: auto;
    display: flex;
    flex: wrap;
    align-items: flex-start;
    justify-content: space-between;
    background-color: none;
}

/* .sociallink {
        display: flex;
        justify-content: space-around; 
        gap: 50px;
    } */



.footer-row2 {
    display: none;
}

.footer-column {
    flex-basis: 25%;
    padding: 10px;
    background-color: none;
}

.footer-logo {
    width: 120px;
    background-color: none;
    margin-top: auto;
    margin-bottom: auto;
}

.footer-column h3 {
    width: fit-content;
    margin-bottom: 10px;
    position: relative;
    background-color: none;
    color: #ffffff;
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    margin-bottom: 10px;
}

.footer-column a {
    color: #FFF;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    background-color: none;
    margin-right: 15px;
    text-decoration: none;
    margin-bottom: 5px;
}


.footer-column p {
    color: #FFF;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    background-color: none;
}

    .sociallink {
        display: flex;
        justify-content: space-around; 
    }
    
    .sociallink h3 {
        font-size: 1rem;
        margin-bottom: 10px;
    }
    
    .sociallink a {
        color: #fff;
        font-size: 1rem;
        /* margin-right: 20px;  */
        text-decoration: none;
    }
    
    .sociallink a:hover {
        color: #007bff; /* Change color on hover */
    }



@media (max-width:605px) {
    footer {
        width: 100%;
        background: linear-gradient(to right, #4B006E, #000000);
        padding: 20px 0 30px;
        font-size: 13px;
        line-height: 20px;
    }
    
    .footer-row {
        display: none;
    }

    .footer-row2 {
        display: flex;
        flex-direction: column;
        padding: 20px;
        background-color: none; 
        color: #fff; 
    }
    
    .footer-desc {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .footer-logo {
        width: 120px;
        margin-right: 20px; 
    }
    
    .footer-desc h3 {
        font-size: 1.2rem;
        font-weight: bold;
    }
    
    .linkinfo {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 20px;
        overflow: auto;
    }
    
    .footer-column {
        width: 48%; 
        min-width: 175px;
    }
    
    .footer-column h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }
    
    .footer-column a {
        display: block;
        color: #fff;
        text-decoration: none;
        margin-bottom: 5px;
    }
    
    .footer-column a:hover {
        text-decoration: underline;
    }
    
    /* Styling for social links */
    .sociallink {
        display: flex;
        justify-content: space-around; 
        /* gap: 50px; */
    }
    
    .sociallink h3 {
        font-size: 1rem;
        margin-bottom: 10px;
    }
    
    .sociallink a {
        color: #fff;
        font-size: 1rem;
        margin-right: 15px; 
        text-decoration: none;
    }
    
    .sociallink a:hover {
        color: #007bff; /* Change color on hover */
    }

    .contact-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #000; 
}

}

.contact-icon {
    width: 24px; 
    height: auto; 
    margin-right: 10px; 
}

.contact-link img {
    display: inline-block; 
}
    </style>
</head>
<body>
        <footer>
            <div class="footer-row">
                <div class="footer-column">
                    <img src="{{asset('img/Logo Latest 1.png')}}" alt="Hoki Arena" class="footer-logo">
                </div>
                <div class="footer-column">
                    <h3>Description</h3>
                    <p style="width: 80%;">{{$footer->tagline}}</p>
                </div>
                <div class="footer-column">
                    <h3>Usefull Link</h3>
                    <a href="/">Home</a><br>
                    <a href="/tournamentlist">Tournament</a><br>
                    <a href="/forum">Forum</a><br>
                    <a href="/about">About</a><br>
                </div>
                <div class="footer-column">
                    <h3>Contact Info</h3>
                        <a class="contact-link">
                            <i class="bi bi-telephone-fill" style="margin-right: 5px"> </i> {{$footer->phone}}
                        </a><br>
                        <a  class="contact-link">
                            <i class="bi bi-envelope-fill" style="margin-right: 5px"> </i> {{$footer->email}}
                        </a><br>
                        <a class="contact-link">
                            <i class="bi bi-geo-alt-fill" style="margin-right: 5px"> </i> {{$footer->address}}
                        </a><br>
                </div>
                <div class="footer-column">
                    <h3>Social Network</h3>
                    <a href="facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="instagram">
                    <i class="bi bi-instagram"></i>
                    </a>
                    <a href="twiter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="youtube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="tiktok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>

            {{-- well this is for mobile view above will be hidden and this will be shown, css behavior --}}
            <div class="footer-row2">
                <div class="footer-desc">
                    <img src="{{asset('img/Logo Latest 1.png')}}" alt="Hoki Arena" class="footer-logo">
                    <div class="desc-column">
                        <h3>Description</h3><br>
                        <p style="width: 80%;">{{$footer->tagline}}</p>
                    </div>
                </div>
                <div class="linkinfo">
                    <div class="footer-column">
                        <h3>Usefull Link</h3>
                        <a href="/">Home</a><br>
                        <a href="/tournamentlist">Tournament</a><br>
                        <a href="/forum">Forum</a><br>
                        <a href="/about">About</a><br>
                    </div>
                    <div class="footer-column">
                        <h3>Contact Info</h3>
                            <a  class="contact-link">
                                <i class="bi bi-telephone-fill" style="margin-right: 5px"> </i>  {{$footer->phone}}
                            </a><br>
                            <a  class="contact-link">
                                <i class="bi bi-envelope-fill" style="margin-right: 5px"> </i> {{$footer->email}}
                            </a><br>
                            <a  class="contact-link">
                                <i class="bi bi-geo-alt-fill" style="margin-right: 5px"> </i> {{$footer->address}}
                            </a><br>
                    </div>
                </div>
                <div class="sociallink">
                    
                    <h3>Social Network</h3>
                    <a href="facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="instagram">
                    <i class="bi bi-instagram"></i>
                    </a>
                    <a href="twiter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="youtube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="tiktok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>
            <div class="row border-top pt-4 mt-4">
                <div class="col-md-6 text-center text-md-left">
                    <p style="color: #c0c0c0;">&copy; 2024, Inc. All rights reserved.</p>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end justify-content-center">
                    <a href="#" data-bs-toggle="modal" class="text-body-secondary text-decoration-none mx-2" data-bs-target="#privacyPolicyModal" style="color: #c0c0c0 !important; font-size:16px;">Privacy Policy</a>
                    <a href="#" data-bs-toggle="modal" class="text-body-secondary text-decoration-none mx-2" data-bs-target="#termModal" style="color: #c0c0c0 !important; font-size:16px;">Terms & Conditions</a>
                </div>
            </div>
        </footer>
        <div class="container">
            <div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="privacyPolicyModalLabel">Privacy Policy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p style="white-space: pre-wrap; justify-content:left;">{{$footer->privacy}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="modal fade" id="termModal" tabindex="-1" aria-labelledby="termModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="termModalLabel">Terms and Conditions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p style="white-space: pre-wrap; justify-content:left;">{{$footer->term}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
