<x-admin-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6 min-w-0 bg-gray-100">
            <div class="space-y-6">
                <!-- Header -->
                <div class="bg-white rounded-2xl p-6">
                    <h4 class="text-xl font-semibold">Write Some News</h4>
                    <p class="text-gray-500">Write some news for users to see</p>
                </div>

                <!-- Post Form -->
                <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                    <div class="text-lg font-semibold">Write a Post</div>
                    <form method="POST" action="" class="space-y-4">
                        @csrf
                        <div>
                            <label for="postTitle" class="block font-medium mb-1">News Title:</label>
                            <input type="text" id="postTitle" name="postTitle" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="postImage" class="block font-medium mb-1 flex items-center space-x-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 30 30" class="fill-current text-gray-700">
                                    <path d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z"></path>
                                    <path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z"></path>
                                </svg>
                                <span>Upload Image</span>
                            </label>
                            <input type="file" id="postImage" name="postImage" class="hidden">
                        </div>

                        <div>
                            <label for="postContent" class="block font-medium mb-1">Content:</label>
                            <textarea id="postContent" name="postContent" rows="10" class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>

                        <button type="submit" class="bg-indigo-700 text-white px-4 py-2 rounded hover:bg-indigo-800">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
