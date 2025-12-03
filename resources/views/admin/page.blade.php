<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .tablink {
            background-color: #555;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 20%;
        }
        .tablink:hover {
            background-color: #777;
        }
        .tabcontent {
            display: none;
        }
        .success-message {
            color: green;
        }
        .error-message {
            color: red;
        }
        .achievements-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        }
        .achievement-form {
            flex: 1 1 calc(25% - 20px); /* Adjust based on how many you want per row */
            box-sizing: border-box;
        }
        .modal {
        display: none; 
        position: fixed; 
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: #474e5d;
        padding-top: 50px;
        }

        /* Modal Content/Box */
        .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 80% !important; 
        }

        /* Style the horizontal ruler */
        hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
        }
        
        /* The Close Button (x) */
        .close {
        position: absolute;
        right: 35px;
        top: 15px;
        font-size: 40px;
        font-weight: bold;
        color: #f1f1f1;
        }

        .close:hover,
        .close:focus {
        color: #f44336;
        cursor: pointer;
        }

        /* Clear floats */
        .clearfix::after {
        content: "";
        clear: both;
        display: table;
        }

        button:hover {
        opacity:1;
        }

        /* Change styles for cancel button and signup button on extra small screens */
        @media screen and (max-width: 300px) {
        .cancelbtn, .signupbtn {
            width: 100%;
        }
        }

        .row-faq {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .add-question-button {
            border-radius: 15px;
            width: 150px;
            background-color: #59f436
        }

        .add-question-button:hover {
            border-radius: 15px;
            width: 150px;
            background-color: #59f43698
        }

        .form-control {
            height: fit-content;
        }

        .tablink[data-color="red"] {
            background-color: red;
        }

        .tablink[data-color="green"] {
            background-color: green;
        }

        .tablink[data-color="orange"] {
            background-color: orange;
        }

        .tablink[data-color="blue"] {
            background-color: blue;
        }

        .tablink[data-color="purple"] {
            background-color: purple;
        }


    </style>
</head>
<body style="background-color: #f4f7f6;">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container-fluid" style="width: 100%; height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <!-- Center Content -->
            <div class="col-8" style="width: 80%;">
                <div class="container-fluid">
                <div class="container" style="min-height: 500px;">
                    <div class="tablinkcollection" style="border-radius: 20px; overflow:hidden; margin: 10px 0 ;">
                        <button class="tablink" onclick="openPage('Home', this, 'red')" id="defaultOpen">Home</button>
                        <button class="tablink" onclick="openPage('FAQ', this, 'green')">FAQ</button>
                        <button class="tablink" onclick="openPage('About', this, 'orange')">About</button>
                        <button class="tablink" onclick="openPage('Contact', this, 'blue')">Contact</button>
                        <button class="tablink" onclick="openPage('Footer', this, 'purple')">Footer</button>
                    </div>
            
                    <div id="Home" class="tabcontent">
                        <div class="row" style="margin: 10px;">
                            <h1>Home Management</h1>
                        </div>
                    
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    
                        <!-- Home Update Form -->
                        <form action="{{ route('home.update', $homeArr['home']->home_id) }}" method="POST" class="mb-4">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header">
                                    <h5>Update Home Banner</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="banner_s_header" class="form-label">Banner Upper Header:</label>
                                        <input type="text" id="banner_s_header" name="banner_s_header" class="form-control" value="{{ old('banner_s_header', $homeArr['home']->banner_s_header) }}">
                                        @error('banner_s_header')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="banner_b_header" class="form-label">Banner Lower Header:</label>
                                        <input type="text" id="banner_b_header" name="banner_b_header" class="form-control" value="{{ old('banner_b_header', $homeArr['home']->banner_b_header) }}">
                                        @error('banner_b_header')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="banner_paragraph" class="form-label">Banner Paragraph:</label>
                                        <textarea id="banner_paragraph" name="banner_paragraph" class="form-control">{{ old('banner_paragraph', $homeArr['home']->banner_paragraph) }}</textarea>
                                        @error('banner_paragraph')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Home</button>
                                </div>
                            </div>
                        </form>
                    
                        <!-- Achievement Update Form -->
                        <div class="row" style="margin: 10px;">
                            <h1>Achievement Management</h1>
                        </div>
                        <form action="{{ route('achievements.update') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h5>Update Achievements</h5>
                                </div>
                                <div class="card-body">
                                    <div class="achievements-container">
                                        @foreach ($homeArr['Achievement'] as $achievement)
                                            <div class="mb-3">
                                                <input type="hidden" name="achievements[{{ $loop->index }}][achievement_id]" value="{{ old('achievements.' . $loop->index . '.achievement_id', $achievement->achievement_id) }}">
                                                <label for="title{{ $loop->index }}" class="form-label">Title:</label>
                                                <input type="text" id="title{{ $loop->index }}" name="achievements[{{ $loop->index }}][title]" class="form-control" value="{{ old('achievements.' . $loop->index . '.title', $achievement->title) }}">
                                                @error('achievements.' . $loop->index . '.title')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                    
                                                <label for="description{{ $loop->index }}" class="form-label">Description:</label>
                                                <input type="text" id="description{{ $loop->index }}" name="achievements[{{ $loop->index }}][description]" class="form-control" value="{{ old('achievements.' . $loop->index . '.description', $achievement->description) }}">
                                                @error('achievements.' . $loop->index . '.description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                    
                                                <label for="icon{{ $loop->index }}" class="form-label">Icon:</label>
                                                <select id="icon{{ $loop->index }}" name="achievements[{{ $loop->index }}][icon]" class="form-control">
                                                    <option value="" disabled {{ old('achievements.' . $loop->index . '.icon') ? '' : 'selected' }}>Select an icon</option>
                                                    @foreach (['bi-star', 'bi-people', 'bi-calendar-check', 'bi-geo-alt', 'bi-heart', 'bi-trophy', 'bi-lightning', 'bi-bell'] as $icon)
                                                        <option value="bi {{ $icon }}" {{ old('achievements.' . $loop->index . '.icon', $achievement->icon) == "bi $icon" ? 'selected' : '' }}>
                                                            <i class="bi {{ $icon }}"></i> {{ ucfirst(str_replace('-', ' ', $icon)) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('achievements.' . $loop->index . '.icon')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Achievements</button>
                                </div>
                            </div>
                        </form>
                    
                        <!-- Meet Team Update Form -->
                        <div class="row" style="margin: 10px;">
                            <h1>Team Management</h1>
                        </div>
                        <form action="{{ route('meetTeams.update') }}" method="POST" class="mb-4">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h5>Update Team Members</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($homeArr['meet'] as $index => $meetTeam)
                                            <div class="col-md-4 mb-3">
                                                <div class="card p-3">
                                                    <h5>Team Member {{ $index + 1 }}</h5>
                                                    <input type="hidden" name="meet_id[]" value="{{ old('meet_id.' . $index, $meetTeam->meet_id) }}">
                                                    <div class="mb-3">
                                                        <label for="name_{{ $index }}" class="form-label">Name:</label>
                                                        <input type="text" id="name_{{ $index }}" name="name[]" class="form-control" value="{{ old('name.' . $index, $meetTeam->name) }}">
                                                        @error('name.' . $index)
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                    
                                                    <div class="mb-3">
                                                        <label for="position_{{ $index }}" class="form-label">Position:</label>
                                                        <input type="text" id="position_{{ $index }}" name="position[]" class="form-control" value="{{ old('position.' . $index, $meetTeam->position) }}">
                                                        @error('position.' . $index)
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                    
                                                    <div class="mb-3">
                                                        <label for="img_{{ $index }}" class="form-label">Image:</label>
                                                        <input type="file" id="img_{{ $index }}" name="img[]" class="form-control">
                                                        @if($meetTeam->img)
                                                            <div class="text-center mb-3">
                                                                <img src="{{ asset('storage/' . $meetTeam->img) }}" alt="Current Image" class="img-thumbnail" style="width: 150px; height: 150px; border-radius: 50%; margin-top: 20px;">
                                                            </div>
                                                        @endif
                                                        @error('img.' . $index)
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                    
                                                    @for ($i = 1; $i <= 3; $i++)
                                                        <div class="mb-3">
                                                            <label for="link{{ $i }}_{{ $index }}" class="form-label">Link {{ $i }}:</label>
                                                            <input type="text" id="link{{ $i }}_{{ $index }}" name="link{{ $i }}[]" class="form-control" value="{{ old('link' . $i . '.' . $index, $meetTeam->{'link' . $i}) }}">
                                                            @error('link' . $i . '.' . $index)
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                    
                                                        <div class="mb-3">
                                                            <label for="icon_link{{ $i }}_{{ $index }}" class="form-label">Icon Link {{ $i }}:</label>
                                                            <select id="icon_link{{ $i }}_{{ $index }}" name="icon_link{{ $i }}[]" class="form-control">
                                                                <option value="null" {{ old('icon_link' . $i . '.' . $index, $meetTeam->{'icon_link' . $i}) == 'null' ? 'selected' : '' }}>None</option>
                                                                @foreach (['bi-facebook', 'bi-twitter', 'bi-instagram', 'bi-linkedin'] as $icon)
                                                                    <option value="bi {{ $icon }}" {{ old('icon_link' . $i . '.' . $index, $meetTeam->{'icon_link' . $i}) == "bi $icon" ? 'selected' : '' }}>
                                                                        {{ ucfirst(substr($icon, strpos($icon, '-') + 1)) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('icon_link' . $i . '.' . $index)
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="home_id" value="{{ old('home_id', $homeArr['home']->home_id) }}">
                                    <button type="submit" class="btn btn-primary">Update Meet Team Members</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
            
                    <div id="FAQ" class="tabcontent" style="margin:10px;">
                        <div class="row-faq" style="margin:10px;">
                            <h1>FAQ Management</h1>
                            <button onclick="document.getElementById('id01').style.display='block'" class="add-question-button">Add Question</button>
                        </div>
                        @if (session('success'))
                            <p class="success-message">{{ session('success') }}</p>
                        @endif
                    
                        <!-- Form to update existing FAQs -->
                        <form action="{{ route('faq.update') }}" method="POST" class="mb-4">
                            @csrf
                            @method('PUT')
                        
                            <h2 class="mb-4">Manage FAQs</h2>
                        
                            @foreach ($faqs as $faq)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <strong>FAQ #{{ $loop->iteration }}</strong>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="faq_ids[]" value="{{ $faq->id }}">
                                        
                                        <div class="mb-3">
                                            <label for="question_{{ $faq->id }}" class="form-label">Question:</label>
                                            <input type="text" id="question_{{ $faq->id }}" name="questions[]" class="form-control" value="{{ old('questions.' . $loop->index, $faq->question) }}">
                                            @error('questions.' . $loop->index)
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                        
                                        <div class="mb-3">
                                            <label for="answer_{{ $faq->id }}" class="form-label">Answer:</label>
                                            <textarea id="answer_{{ $faq->id }}" name="answers[]" class="form-control" style="height: 150px;">{{ old('answers.' . $loop->index, $faq->answer) }}</textarea>
                                            @error('answers.' . $loop->index)
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                        
                                        <!-- Delete Button -->
                                        <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this FAQ?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        
                            <button type="submit" class="btn btn-primary">Update FAQs</button>
                        </form>
                        <br>
                    
                        <div class="modal" id="id01">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <form action="{{ route('faqs.store') }}" method="POST" class="modal-content">
                                @csrf
                                <div class="mb-3">
                                    <label for="question" class="form-label">Question:</label>
                                    <input type="text" id="question" name="question" class="form-control" required>
                                    @error('question')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="answer" class="form-label">Answer:</label>
                                    <textarea id="answer" name="answer" class="form-control" required></textarea>
                                    @error('answer')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add FAQ</button>
                            </form>
                        </div>
                    </div>

                    <div id="About" class="tabcontent">
                        <div class="row" style="margin:10px;">
                            <h1>About Management</h1>
                        </div>
                        @if (session('success'))
                            <p class="success-message">{{ session('success') }}</p>
                        @endif
                        <form action="{{ route('about.update') }}" method="POST" style="margin-bottom:10px;">
                            @csrf
                            <div class="mb-3">
                                <label for="banner" class="form-label">Banner:</label>
                                <input type="text" id="banner" name="banner" class="form-control"  style="height: 50px; overflow-wrap: break-word;" value="{{ old('banner', $about->banner) }}">
                                @error('banner')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="we_are" class="form-label">We Are:</label>
                                <textarea id="we_are" name="we_are" class="form-control" style="height: 150px;">{{ old('we_are', $about->we_are) }}</textarea>
                                @error('we_are')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="we_offer" class="form-label">We Offer:</label>
                                <textarea id="we_offer" name="we_offer" class="form-control" style="height: 150px;">{{ old('we_offer', $about->we_offer) }}</textarea>
                                @error('we_offer')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
            
                    <div id="Contact" class="tabcontent">
                        <div class="row" style="margin:10px;">
                            <h1>Contact Management</h1>
                        </div>
                        @if (session('success'))
                            <p class="success-message">{{ session('success') }}</p>
                        @endif
                        <form action="{{ route('contact.update') }}" method="POST" style="margin-bottom:10px;">
                            @csrf
                            <div class="mb-3">
                                <label for="location" class="form-label">Location:</label>
                                <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $contactArr['contact']->location )}}">
                                @error('location')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Phone Numbers:</label>
                                @foreach ($contactArr['phones'] as $phone_id => $phone)
                                    <div class="mb-2">
                                        <input type="hidden" name="phone_numbers[{{ $phone_id }}][id]" value="{{ $phone_id }}">
                                        <input type="text" name="phone_numbers[{{ $phone_id }}][number]" class="form-control" value="{{ old('phone_numbers.' . $phone_id . '.number', $phone) }}">
                                        @error('phone_numbers.' . $phone_id . '.number')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label>Emails:</label>
                                @foreach ($contactArr['emails']  as $email_id => $email)
                                    <div class="mb-2">
                                        <input type="hidden" name="emails[{{ $email_id }}][id]" value="{{ $email_id }}">
                                        <input type="email" name="emails[{{ $email_id }}][address]" class="form-control" value="{{ old('emails.' . $email_id . '.address', $email) }}">
                                        @error('emails.' . $email_id . '.address')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
            
                    <div id="Footer" class="tabcontent">
                        <div class="row" style="margin:10px;">
                            <h1>Update Footer Information</h1>
                        </div>
                        @if (session('success'))
                            <p class="success-message">{{ session('success') }}</p>
                        @endif
                        <form action="{{ route('footer.update') }}" method="POST" enctype="multipart/form-data" style="margin-bottom:10px;">
                            @csrf
                    
                            <div class="mb-3">
                                <label for="tagline" class="form-label">Tagline:</label>
                                <input type="text" id="tagline" name="tagline" class="form-control" style="height: 50px;" value="{{ old('tagline', $footer->tagline) }}">
                                @error('tagline')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" id="phone" name="phone" class="form-control" style="height: 50px;" value="{{ old('phone', $footer->phone) }}">
                                @error('phone')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" style="height: 50px;" value="{{ old('email', $footer->email) }}">
                                @error('email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <textarea id="address" name="address" class="form-control" style="height: 100px;">{{ old('address', $footer->address) }}</textarea>
                                @error('address')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="privacy" class="form-label">Privacy Policy:</label>
                                <textarea id="privacy" name="privacy" class="form-control" style="height: 100px;">{{ old('privacy', $footer->privacy) }}</textarea>
                                @error('privacy')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="term" class="form-label">Terms and Conditions:</label>
                                <textarea id="term" name="term" class="form-control" style="height: 100px;">{{ old('term', $footer->term) }}</textarea>
                                @error('term')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo:</label>
                                <input type="file" id="logo" name="logo" class="form-control">
                                @if($footer->logo)
                                    <img src="{{ asset('storage/' . $footer->logo) }}" alt="Current Logo" style="max-width: 150px; margin-top: 10px;">
                                @endif
                                @error('logo')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                    
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>



    </div>
    <script>
        var modal = document.getElementById('id01');
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>
    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = color;
        }
        
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
   
</body>
@include('layouts.footer')
</html>
