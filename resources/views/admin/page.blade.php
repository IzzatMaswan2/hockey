<x-admin-layout>
    <div class="flex min-h-screen w-full">
        <!-- Sidebar -->
        {{-- <div class="w-1/5 bg-gray-400"> --}}
            @include('layouts.sidebar')
        {{-- </div> --}}

        <!-- Main Content -->
        <div class="flex-1 p-6 min-w-0">
            <!-- Tabs -->
            <div class="flex rounded-lg overflow-hidden space-x-2 mb-4">
                <button class="tablink flex-1 py-2 text-white bg-red-500 hover:bg-red-600" onclick="openPage('Home', this, 'red')" id="defaultOpen">Home</button>
                <button class="tablink flex-1 py-2 text-white bg-green-500 hover:bg-green-600" onclick="openPage('FAQ', this, 'green')">FAQ</button>
                <button class="tablink flex-1 py-2 text-white bg-orange-500 hover:bg-orange-600" onclick="openPage('About', this, 'orange')">About</button>
                <button class="tablink flex-1 py-2 text-white bg-blue-500 hover:bg-blue-600" onclick="openPage('Contact', this, 'blue')">Contact</button>
                <button class="tablink flex-1 py-2 text-white bg-purple-500 hover:bg-purple-600" onclick="openPage('Footer', this, 'purple')">Footer</button>
            </div>

            <!-- HOME TAB -->
            <div id="Home" class="tabcontent hidden w-full">
                <h1 class="text-2xl font-bold">Home Management</h1>
                @if (session('success')) <div class="text-green-600">{{ session('success') }}</div> @endif

                <!-- Home Banner Form -->
                <form action="{{ route('home.update', $homeArr['home']->home_id) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div class="bg-white rounded-lg shadow p-4 space-y-4">
                        <div>
                            <label class="font-semibold">Banner Upper Header:</label>
                            <input type="text" name="banner_s_header" class="w-full border rounded p-2" value="{{ old('banner_s_header', $homeArr['home']->banner_s_header) }}">
                            @error('banner_s_header') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="font-semibold">Banner Lower Header:</label>
                            <input type="text" name="banner_b_header" class="w-full border rounded p-2" value="{{ old('banner_b_header', $homeArr['home']->banner_b_header) }}">
                            @error('banner_b_header') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="font-semibold">Banner Paragraph:</label>
                            <textarea name="banner_paragraph" class="w-full border rounded p-2">{{ old('banner_paragraph', $homeArr['home']->banner_paragraph) }}</textarea>
                            @error('banner_paragraph') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Home</button>
                    </div>
                </form>

                <!-- Achievements Form -->
                <div>
                    <h2 class="text-xl font-semibold mb-2">Achievement Management</h2>
                    <form action="{{ route('achievements.update') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($homeArr['Achievement'] as $achievement)
                                <div class="bg-white p-4 rounded-lg shadow space-y-2">
                                    <input type="hidden" name="achievements[{{ $loop->index }}][achievement_id]" value="{{ old('achievements.' . $loop->index . '.achievement_id', $achievement->achievement_id) }}">
                                    <div>
                                        <label class="font-semibold">Title:</label>
                                        <input type="text" name="achievements[{{ $loop->index }}][title]" class="w-full border rounded p-2" value="{{ old('achievements.' . $loop->index . '.title', $achievement->title) }}">
                                        @error('achievements.' . $loop->index . '.title') <div class="text-red-500">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <label class="font-semibold">Description:</label>
                                        <input type="text" name="achievements[{{ $loop->index }}][description]" class="w-full border rounded p-2" value="{{ old('achievements.' . $loop->index . '.description', $achievement->description) }}">
                                        @error('achievements.' . $loop->index . '.description') <div class="text-red-500">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <label class="font-semibold">Icon:</label>
                                        <select name="achievements[{{ $loop->index }}][icon]" class="w-full border rounded p-2">
                                            <option value="" disabled {{ old('achievements.' . $loop->index . '.icon') ? '' : 'selected' }}>Select an icon</option>
                                            @foreach (['bi-star','bi-people','bi-calendar-check','bi-geo-alt','bi-heart','bi-trophy','bi-lightning','bi-bell'] as $icon)
                                                <option value="bi {{ $icon }}" {{ old('achievements.' . $loop->index . '.icon', $achievement->icon) == "bi $icon" ? 'selected' : '' }}>
                                                    {{ ucfirst(str_replace('-', ' ', $icon)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('achievements.' . $loop->index . '.icon') <div class="text-red-500">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Achievements</button>
                    </form>
                </div>

                <!-- Team Form -->
                <div>
                    <h2 class="text-xl font-semibold mb-2">Team Management</h2>
                    <form action="{{ route('meetTeams.update') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($homeArr['meet'] as $index => $meetTeam)
                                <div class="bg-white p-4 rounded-lg shadow space-y-2">
                                    <h3 class="font-semibold">Team Member {{ $index + 1 }}</h3>
                                    <input type="hidden" name="meet_id[]" value="{{ old('meet_id.' . $index, $meetTeam->meet_id) }}">
                                    <div>
                                        <label class="font-semibold">Name:</label>
                                        <input type="text" name="name[]" class="w-full border rounded p-2" value="{{ old('name.' . $index, $meetTeam->name) }}">
                                    </div>
                                    <div>
                                        <label class="font-semibold">Position:</label>
                                        <input type="text" name="position[]" class="w-full border rounded p-2" value="{{ old('position.' . $index, $meetTeam->position) }}">
                                    </div>
                                    <div>
                                        <label class="font-semibold">Image:</label>
                                        <input type="file" name="img[]" class="w-full border rounded p-2">
                                        @if($meetTeam->img)
                                            <img src="{{ asset('storage/' . $meetTeam->img) }}" class="w-36 h-36 rounded-full mt-2 object-cover">
                                        @endif
                                    </div>
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div>
                                            <label class="font-semibold">Link {{ $i }}:</label>
                                            <input type="text" name="link{{ $i }}[]" class="w-full border rounded p-2" value="{{ old('link' . $i . '.' . $index, $meetTeam->{'link' . $i}) }}">
                                        </div>
                                        <div>
                                            <label class="font-semibold">Icon Link {{ $i }}:</label>
                                            <select name="icon_link{{ $i }}[]" class="w-full border rounded p-2">
                                                <option value="null" {{ old('icon_link' . $i . '.' . $index, $meetTeam->{'icon_link' . $i}) == 'null' ? 'selected' : '' }}>None</option>
                                                @foreach (['bi-facebook','bi-twitter','bi-instagram','bi-linkedin'] as $icon)
                                                    <option value="bi {{ $icon }}" {{ old('icon_link' . $i . '.' . $index, $meetTeam->{'icon_link' . $i}) == "bi $icon" ? 'selected' : '' }}>
                                                        {{ ucfirst(substr($icon, strpos($icon, '-') + 1)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Team Members</button>
                    </form>
                </div>
            </div>

            <!-- FAQ TAB -->
            <div id="FAQ" class="tabcontent hidden w-full">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">FAQ Management</h1>
                    <button onclick="document.getElementById('id01').classList.remove('hidden')" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Add Question</button>
                </div>
                @if(session('success')) <p class="text-green-600">{{ session('success') }}</p> @endif

                <form action="{{ route('faq.update') }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    @foreach($faqs as $faq)
                        <div class="bg-white p-4 rounded-lg shadow space-y-2">
                            <input type="hidden" name="faq_ids[]" value="{{ $faq->id }}">
                            <div>
                                <label class="font-semibold">Question:</label>
                                <input type="text" name="questions[]" class="w-full border rounded p-2" value="{{ old('questions.' . $loop->index, $faq->question) }}">
                                @error('questions.' . $loop->index) <div class="text-red-500">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="font-semibold">Answer:</label>
                                <textarea name="answers[]" class="w-full border rounded p-2 h-32">{{ old('answers.' . $loop->index, $faq->answer) }}</textarea>
                                @error('answers.' . $loop->index) <div class="text-red-500">{{ $message }}</div> @enderror
                            </div>
                            <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 mt-2" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    @endforeach
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update FAQs</button>
                </form>

                <!-- Add FAQ Modal -->
                <div id="id01" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-start justify-center p-6 z-50">
                    <form action="{{ route('faqs.store') }}" method="POST" class="bg-white p-6 rounded-lg w-full max-w-md space-y-4">
                        @csrf
                        <span onclick="document.getElementById('id01').classList.add('hidden')" class="absolute top-2 right-4 text-2xl cursor-pointer">&times;</span>
                        <div>
                            <label class="font-semibold">Question:</label>
                            <input type="text" name="question" class="w-full border rounded p-2" required>
                            @error('question') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="font-semibold">Answer:</label>
                            <textarea name="answer" class="w-full border rounded p-2" required></textarea>
                            @error('answer') <div class="text-red-500">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add FAQ</button>
                    </form>
                </div>
            </div>

            <!-- ABOUT TAB -->
            <div id="About" class="tabcontent hidden w-full">
                <h1 class="text-2xl font-bold">About Management</h1>
                @if(session('success')) <p class="text-green-600">{{ session('success') }}</p> @endif
                <form action="{{ route('about.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="font-semibold">Banner:</label>
                        <input type="text" name="banner" class="w-full border rounded p-2" value="{{ old('banner', $about->banner) }}">
                        @error('banner') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="font-semibold">We Are:</label>
                        <textarea name="we_are" class="w-full border rounded p-2 h-32">{{ old('we_are', $about->we_are) }}</textarea>
                        @error('we_are') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="font-semibold">We Offer:</label>
                        <textarea name="we_offer" class="w-full border rounded p-2 h-32">{{ old('we_offer', $about->we_offer) }}</textarea>
                        @error('we_offer') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                </form>
            </div>

            <!-- CONTACT TAB -->
            <div id="Contact" class="tabcontent hidden w-full">
                <h1 class="text-2xl font-bold">Contact Management</h1>
                @if(session('success')) <p class="text-green-600">{{ session('success') }}</p> @endif
                <form action="{{ route('contact.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="font-semibold">Location:</label>
                        <input type="text" name="location" class="w-full border rounded p-2" value="{{ old('location', $contactArr['contact']->location) }}">
                        @error('location') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="font-semibold">Phone Numbers:</label>
                        @foreach($contactArr['phones'] as $phone_id => $phone)
                            <div class="flex items-center space-x-2 mb-2">
                                <input type="hidden" name="phone_numbers[{{ $phone_id }}][id]" value="{{ $phone_id }}">
                                <input type="text" name="phone_numbers[{{ $phone_id }}][number]" class="w-full border rounded p-2" value="{{ old('phone_numbers.' . $phone_id . '.number', $phone) }}">
                                @error('phone_numbers.' . $phone_id . '.number') <div class="text-red-500">{{ $message }}</div> @enderror
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <label class="font-semibold">Emails:</label>
                        @foreach($contactArr['emails'] as $email_id => $email)
                            <div class="flex items-center space-x-2 mb-2">
                                <input type="hidden" name="emails[{{ $email_id }}][id]" value="{{ $email_id }}">
                                <input type="email" name="emails[{{ $email_id }}][address]" class="w-full border rounded p-2" value="{{ old('emails.' . $email_id . '.address', $email) }}">
                                @error('emails.' . $email_id . '.address') <div class="text-red-500">{{ $message }}</div> @enderror
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                </form>
            </div>

            <!-- FOOTER TAB -->
            <div id="Footer" class="tabcontent hidden w-full">
                <h1 class="text-2xl font-bold">Footer Management</h1>
                @if(session('success')) <p class="text-green-600">{{ session('success') }}</p> @endif
                <form action="{{ route('footer.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="font-semibold">Tagline:</label>
                        <input type="text" name="tagline" class="w-full border rounded p-2" value="{{ old('tagline', $footer->tagline) }}">
                        @error('tagline') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="font-semibold">Phone:</label>
                        <input type="text" name="phone" class="w-full border rounded p-2" value="{{ old('phone', $footer->phone) }}">
                        @error('phone') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="font-semibold">Email:</label>
                        <input type="email" name="email" class="w-full border rounded p-2" value="{{ old('email', $footer->email) }}">
                        @error('email') <div class="text-red-500">{{ $message }}</div> @enderror
                    </div>
                    <div>
                        <label class="font-semibold">Logo:</label>
                        <input type="file" name="logo" class="w-full border rounded p-2">
                        @if($footer->logo)
                            <img src="{{ asset('storage/' . $footer->logo) }}" class="w-36 h-36 mt-2 object-contain">
                        @endif
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Footer</button>
                </form>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openPage(pageName, elmnt, color) {
            document.querySelectorAll(".tabcontent").forEach(tc => tc.classList.add('hidden'));
            document.querySelectorAll(".tablink").forEach(tl => tl.style.backgroundColor = '');
            document.getElementById(pageName).classList.remove('hidden');
            elmnt.style.backgroundColor = color;
        }
        document.getElementById("defaultOpen").click();

        // Close modal on outside click
        window.onclick = function(event) {
            var modal = document.getElementById('id01');
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
</x-admin-layout>
