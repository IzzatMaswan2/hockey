<x-admin-layout>
    <div class="flex w-full min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6 min-w-0 bg-gray-100 space-y-6">

            <!-- Header -->
            <div>
                <h2 class="text-2xl font-bold text-purple-700">OFFICER MANAGEMENT</h2>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                    {{ session('success') }}
                    <span class="absolute top-1 right-2 cursor-pointer" onclick="this.parentElement.remove();">&times;</span>
                </div>
            @endif

            <!-- Officer Form -->
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <div class="text-lg font-semibold text-white bg-purple-800 p-2 rounded-t-xl">Officer Form</div>
                <form method="POST" action="{{ route('referee.store') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="Name" class="block font-medium mb-1">Officer Name</label>
                            <input type="text" id="Name" name="Name" placeholder="Enter Officer Name" required
                                   class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="Role" class="block font-medium mb-1">Officer Role</label>
                            <input type="text" id="Role" name="Role" placeholder="Enter Officer Role" required
                                   class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Submit</button>
                    </div>
                </form>
            </div>

            <!-- Officer List -->
            <div class="bg-white rounded-2xl shadow p-6 space-y-4">
                <div class="text-lg font-semibold text-white bg-purple-800 p-2 rounded-t-xl">Officer List</div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Officer Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Officer Role</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($referee as $ref)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $ref->Name }}</td>
                                <td class="px-4 py-2">{{ $ref->Role }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                                            onclick="openModal('editRefereeModal{{ $ref->id }}')">Edit</button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div id="editRefereeModal{{ $ref->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                                <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
                                    <button class="absolute top-2 right-2 text-gray-600 text-2xl" onclick="closeModal('editRefereeModal{{ $ref->id }}')">&times;</button>
                                    <h3 class="text-xl font-semibold mb-4">Edit Officer</h3>
                                    <form action="{{ route('referee.update', $ref->id) }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label for="name{{ $ref->id }}" class="block font-medium mb-1">Full Name</label>
                                            <input type="text" id="name{{ $ref->id }}" name="name" value="{{ $ref->Name }}" required
                                                   class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label for="role{{ $ref->id }}" class="block font-medium mb-1">Role</label>
                                            <input type="text" id="role{{ $ref->id }}" name="role" value="{{ $ref->Role }}" required
                                                   class="w-full border rounded p-2 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-admin-layout>
