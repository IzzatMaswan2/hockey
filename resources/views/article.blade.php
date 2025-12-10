<x-admin-layout>
    <div class="flex w-full min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6 min-w-0 bg-gray-100 space-y-6">
            
            <!-- Header -->
            <div>
                <h2 class="text-2xl font-bold text-purple-700">ARTICLE MANAGEMENT</h2>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                    {{ session('success') }}
                    <span class="absolute top-1 right-2 cursor-pointer" onclick="this.parentElement.remove();">&times;</span>
                </div>
            @endif

            <!-- Post Form -->
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <div class="text-lg font-semibold">Write a Post</div>
                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label for="title" class="block font-medium mb-1">Article Title:</label>
                        <input type="text" id="title" name="title" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="image" class="block font-medium mb-1 flex items-center space-x-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 30 30" class="fill-current text-gray-700">
                                <path d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z"></path>
                                <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                            </svg>
                            <span>Upload Image</span>
                        </label>
                        <input type="file" id="image" name="image" class="hidden">
                    </div>

                    <div>
                        <label for="place" class="block font-medium mb-1">Location:</label>
                        <input type="text" id="place" name="place" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="summary" class="block font-medium mb-1">Summary:</label>
                        <textarea id="summary" name="summary" rows="5" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <label for="content" class="block font-medium mb-1">Content:</label>
                        <textarea id="content" name="content" rows="10" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">Save</button>
                </form>
            </div>

            <!-- Articles List Tabs -->
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-purple-700">ARTICLES LIST</h2>

                <!-- Tabs -->
                <div class="flex border-b border-gray-300">
                    <button class="tablink px-4 py-2 -mb-px font-medium text-purple-700 border-b-2 border-purple-700" onclick="openArticleTab('Unarchived', this)" id="defaultArticleOpen">Unarchived Articles</button>
                    <button class="tablink px-4 py-2 font-medium text-gray-600 hover:text-purple-700" onclick="openArticleTab('Archived', this)">Archived Articles</button>
                </div>

                <!-- Tab Contents -->
                <div id="Unarchived" class="tabcontent space-y-4 hidden">
                    @foreach($recentArticles as $article)
                        @if ($article->archived === 1)
                            <div class="bg-white rounded-xl shadow p-4 flex space-x-4">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }} Image" class="w-48 h-48 object-cover rounded-lg">
                                <div class="flex-1 space-y-2">
                                    <h5 class="text-lg font-semibold"><i class="fas fa-newspaper"></i> {{ \Illuminate\Support\Str::limit($article->title, 30) }}</h5>
                                    <p><b>Location:</b> {{ $article->place }}</p>
                                    <p><b>Summary:</b> {{ \Illuminate\Support\Str::limit($article->summary, 30) }}</p>
                                    <div class="space-x-2">
                                        <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700" onclick="openModal('articleModal{{ $article->id }}')">Read More</button>
                                        <button class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600" onclick="openModal('editArticleModal{{ $article->id }}')">Edit</button>
                                        <form method="POST" action="{{ route('article.archive', $article->id) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Archive</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div id="Archived" class="tabcontent space-y-4 hidden">
                    @foreach($recentArticles as $article)
                        @if ($article->archived === 0)
                            <div class="bg-white rounded-xl shadow p-4 flex space-x-4">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }} Image" class="w-48 h-48 object-cover rounded-lg">
                                <div class="flex-1 space-y-2">
                                    <h5 class="text-lg font-semibold"><i class="fas fa-newspaper"></i> {{ $article->title }}</h5>
                                    <p><b>Location:</b> {{ $article->place }}</p>
                                    <p><b>Summary:</b> {{ \Illuminate\Support\Str::limit($article->summary, 30) }}</p>
                                    <div class="space-x-2">
                                        <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700" onclick="openModal('articleModal{{ $article->id }}')">Read More</button>
                                        <form method="POST" action="{{ route('article.unarchive', $article->id) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Unarchive</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @foreach($recentArticles as $article)
        <!-- View Article Modal -->
        <div id="articleModal{{ $article->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-6 relative">
                <button class="absolute top-2 right-2 text-gray-600 text-2xl" onclick="closeModal('articleModal{{ $article->id }}')">&times;</button>
                <h3 class="text-xl font-semibold mb-4">{{ $article->title }}</h3>
                <img src="{{ asset('storage/' . $article->image) }}" class="w-48 h-48 object-cover rounded-lg mb-4">
                <p><b>Location:</b> {{ $article->place }}</p>
                <p><b>Summary:</b> {{ $article->summary }}</p>
                <p><b>Content:</b> {{ $article->content }}</p>
            </div>
        </div>

        <!-- Edit Article Modal -->
        <div id="editArticleModal{{ $article->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl p-6 relative">
                <button class="absolute top-2 right-2 text-gray-600 text-2xl" onclick="closeModal('editArticleModal{{ $article->id }}')">&times;</button>
                <h3 class="text-xl font-semibold mb-4">Edit {{ $article->title }}</h3>
                <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block font-medium mb-1">Title:</label>
                        <input type="text" name="title" value="{{ $article->title }}" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Image:</label>
                        <input type="file" name="image" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Location:</label>
                        <input type="text" name="place" value="{{ $article->place }}" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Summary:</label>
                        <textarea name="summary" rows="5" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $article->summary }}</textarea>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Content:</label>
                        <textarea name="content" rows="10" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ $article->content }}</textarea>
                    </div>
                    <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">Save Changes</button>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Scripts -->
    <script>
        function openArticleTab(tabName, elmnt) {
            document.querySelectorAll('.tabcontent').forEach(tc => tc.classList.add('hidden'));
            document.querySelectorAll('.tablink').forEach(tl => {
                tl.classList.remove('border-purple-700', 'text-purple-700', '-mb-px');
                tl.classList.add('text-gray-600');
            });
            document.getElementById(tabName).classList.remove('hidden');
            elmnt.classList.add('border-purple-700', 'text-purple-700', '-mb-px');
            elmnt.classList.remove('text-gray-600');
        }

        document.getElementById("defaultArticleOpen").click();

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-admin-layout>
