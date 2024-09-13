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
            width: 25%;
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
    </style>
    @include('admin.navbar')
    @include('admin.sidebar')
</head>
<body>
    <div class="container" style="min-height: 500px;">
        <div class="tablinkcollection" style="border-radius: 20px; overflow:hidden; margin: 10px 0 ;">
            <button class="tablink" onclick="openPage('Home', this, 'red')" id="defaultOpen">Home</button>
            <button class="tablink" onclick="openPage('FAQ', this, 'green')">FAQ</button>
            <button class="tablink" onclick="openPage('About', this, 'orange')">About</button>
            <button class="tablink" onclick="openPage('Contact', this, 'blue')">Contact</button>
        </div>

        <div id="Home" class="tabcontent">
            <div class="row">
                <h1>Home Management</h1>
            </div>
            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif
        
            <!-- Home Update Form -->
            <form action="{{ route('home.update', $homeArr['home']->home_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="banner_s_header" class="form-label">Banner S Header:</label>
                    <input type="text" id="banner_s_header" name="banner_s_header" class="form-control" value="{{ old('banner_s_header', $homeArr['home']->banner_s_header) }}">
                    @error('banner_s_header')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="banner_b_header" class="form-label">Banner B Header:</label>
                    <input type="text" id="banner_b_header" name="banner_b_header" class="form-control" value="{{ old('banner_b_header', $homeArr['home']->banner_b_header) }}">
                    @error('banner_b_header')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="banner_paragraph" class="form-label">Banner Paragraph:</label>
                    <textarea id="banner_paragraph" name="banner_paragraph" class="form-control">{{ old('banner_paragraph', $homeArr['home']->banner_paragraph) }}</textarea>
                    @error('banner_paragraph')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Home</button>
            </form>
        
            <!-- Achivement Update Form -->
            <div class="row">
                <h1>Achievement Management</h1>
            </div>
            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif
            <form action="{{ route('achievements.update') }}" method="POST">
                @csrf
                <div class="achievements-container">
                    @foreach ($homeArr['Achievement'] as $achievement)
                        <div class="achievement-form">
                            <input type="hidden" name="achievements[{{ $loop->index }}][achievement_id]" value="{{ old('achievements.' . $loop->index . '.achievement_id', $achievement->achievement_id) }}">
                            <div class="mb-3">
                                <label for="title{{ $loop->index }}" class="form-label">Title:</label>
                                <input type="text" id="title{{ $loop->index }}" name="achievements[{{ $loop->index }}][title]" class="form-control" value="{{ old('achievements.' . $loop->index . '.title', $achievement->title) }}">
                                @error('achievements.' . $loop->index . '.title')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description{{ $loop->index }}" class="form-label">Description:</label>
                                <input type="text" id="description{{ $loop->index }}" name="achievements[{{ $loop->index }}][description]" class="form-control" value="{{ old('achievements.' . $loop->index . '.description', $achievement->description) }}">
                                @error('achievements.' . $loop->index . '.description')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="icon{{ $loop->index }}" class="form-label">Icon:</label>
                                <input type="text" id="icon{{ $loop->index }}" name="achievements[{{ $loop->index }}][icon]" class="form-control" value="{{ old('achievements.' . $loop->index . '.icon', $achievement->icon) }}">
                                @error('achievements.' . $loop->index . '.icon')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="achievements[{{ $loop->index }}][home_id]" value="{{ old('achievements.' . $loop->index . '.home_id', $achievement->home_id) }}">
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Update Achievements</button>
            </form>
        
            <!-- Meet Team Update Form -->
            <div class="row">
                <h1>Meet Team Management</h1>
            </div>
            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif
        
            <form action="{{ route('meetTeams.update') }}" method="POST">
                @csrf
                <div class="row">
                    @foreach ($homeArr['meet'] as $index => $meetTeam)
                        <div class="col-md-4 mb-3">
                            <div class="card p-3">
                                <h4>Team Member {{ $index + 1 }}</h4>
                                <input type="hidden" name="meet_id[]" value="{{ old('meet_id.' . $index, $meetTeam->meet_id) }}">
                                
                                <div class="mb-3">
                                    <label for="name_{{ $index }}" class="form-label">Name:</label>
                                    <input type="text" id="name_{{ $index }}" name="name[]" class="form-control" value="{{ old('name.' . $index, $meetTeam->name) }}">
                                    @error('name.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="position_{{ $index }}" class="form-label">Position:</label>
                                    <input type="text" id="position_{{ $index }}" name="position[]" class="form-control" value="{{ old('position.' . $index, $meetTeam->position) }}">
                                    @error('position.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="img_{{ $index }}" class="form-label">Image URL:</label>
                                    <input type="text" id="img_{{ $index }}" name="img[]" class="form-control" value="{{ old('img.' . $index, $meetTeam->img) }}">
                                    @error('img.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="link1_{{ $index }}" class="form-label">Link 1:</label>
                                    <input type="text" id="link1_{{ $index }}" name="link1[]" class="form-control" value="{{ old('link1.' . $index, $meetTeam->link1) }}">
                                    @error('link1.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="link2_{{ $index }}" class="form-label">Link 2:</label>
                                    <input type="text" id="link2_{{ $index }}" name="link2[]" class="form-control" value="{{ old('link2.' . $index, $meetTeam->link2) }}">
                                    @error('link2.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="link3_{{ $index }}" class="form-label">Link 3:</label>
                                    <input type="text" id="link3_{{ $index }}" name="link3[]" class="form-control" value="{{ old('link3.' . $index, $meetTeam->link3) }}">
                                    @error('link3.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="icon_link1_{{ $index }}" class="form-label">Icon Link 1:</label>
                                    <input type="text" id="icon_link1_{{ $index }}" name="icon_link1[]" class="form-control" value="{{ old('icon_link1.' . $index, $meetTeam->icon_link1) }}">
                                    @error('icon_link1.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="icon_link2_{{ $index }}" class="form-label">Icon Link 2:</label>
                                    <input type="text" id="icon_link2_{{ $index }}" name="icon_link2[]" class="form-control" value="{{ old('icon_link2.' . $index, $meetTeam->icon_link2) }}">
                                    @error('icon_link2.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="icon_link3_{{ $index }}" class="form-label">Icon Link 3:</label>
                                    <input type="text" id="icon_link3_{{ $index }}" name="icon_link3[]" class="form-control" value="{{ old('icon_link3.' . $index, $meetTeam->icon_link3) }}">
                                    @error('icon_link3.' . $index)
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="home_id" value="{{ old('home_id', $homeArr['home']->home_id) }}">
                <button type="submit" class="btn btn-primary">Update Meet Team Members</button>
            </form>
        </div>

        <div id="FAQ" class="tabcontent">
            <div class="row">
                <h1>FAQ Management</h1>
            </div>
            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif
        </div>

        <div id="About" class="tabcontent">
            <div class="row">
                <h1>About Management</h1>
            </div>
            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif
            <form action="{{ route('about.update') }}" method="POST">
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
            <div class="row">
                <h1>Contact Management</h1>
            </div>
            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif
            <form action="{{ route('contact.update') }}" method="POST">
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
    </div>
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
    @include('layouts.footer')
</body>
</html>
