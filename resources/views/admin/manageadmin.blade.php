<x-admin-layout :title="'Manage Admin'">

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <main class="flex-1 p-6 space-y-6 bg-gray-100 min-h-screen">

        <!-- Page Header -->
        <h2 class="text-3xl font-bold text-purple-700">REGISTER ADMIN</h2>

        <!-- Add Admin Button -->
        <button class="bg-purple-700 text-white font-bold py-2 px-6 rounded-lg hover:bg-purple-800" 
            data-bs-toggle="modal" data-bs-target="#addAdminModal">
            Add Admin
        </button>

        <!-- Admin List Header -->
        <h2 class="text-3xl font-bold text-purple-700 mt-8">ADMIN LIST</h2>

        <!-- Search -->
        <div class="my-4">
            <input type="text" id="adminSearchInput" placeholder="Search admins..."
                class="w-full md:w-1/3 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="unarchived-admin-tab" data-bs-toggle="tab" data-bs-target="#unarchived-admin" type="button" role="tab" aria-controls="unarchived-admin" aria-selected="true">Registered Admins</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="archived-admin-tab" data-bs-toggle="tab" data-bs-target="#archived-admin" type="button" role="tab" aria-controls="archived-admin" aria-selected="false">Archived Admins</button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="adminTabsContent">
            <!-- Registered Admins -->
            <div class="tab-pane fade show active" id="unarchived-admin" role="tabpanel" aria-labelledby="unarchived-admin-tab">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden table-fixed">
                        <thead class="bg-purple-700 text-white">
                            <tr>
                                <th class="py-2 px-4">Admin Name</th>
                                <th class="py-2 px-4">Email Address</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="unarchivedAdminTableBody" class="text-center">
                            @foreach ($users as $user)
                                @if ($user->role === 'Admin' && $user->archived === 1)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $user->fullName }}</td>
                                        <td class="py-2 px-4 break-all max-w-[150px] justify-start" title="{{ $user->email }}">
                                            {{ $user->email }}
                                        </td>
                                        <td class="py-2 px-4 space-x-2 max-w-[150px] justify-start">
                                            <button class="bg-blue-600 text-white px-1 py-1 rounded hover:bg-blue-700 btn-view text-sm w-16" 
                                                data-admin-name="{{ $user->fullName }}" 
                                                data-admin-email="{{ $user->email }}" 
                                                data-bs-toggle="modal" data-bs-target="#adminModal">
                                                View
                                            </button>

                                            <form method="POST" action="{{ route('manageadmin.archive', $user->id) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-red-600 text-white px-1 py-1 rounded hover:bg-red-700 text-sm w-16">Archive</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Archived Admins -->
            <div class="tab-pane fade" id="archived-admin" role="tabpanel" aria-labelledby="archived-admin-tab">
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-purple-700 text-white">
                            <tr>
                                <th class="py-2 px-4">Admin Name</th>
                                <th class="py-2 px-4">Email Address</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="archivedAdminTableBody" class="text-center">
                            @foreach ($users as $user)
                                @if ($user->role === 'Admin' && $user->archived === 0)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $user->fullName }}</td>
                                        <td class="py-2 px-4 break-words max-w-xs">{{ $user->email }}</td>
                                        <td class="py-2 px-4 space-x-2">
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 btn-view" 
                                                data-admin-name="{{ $user->fullName }}" 
                                                data-admin-email="{{ $user->email }}" 
                                                data-bs-toggle="modal" data-bs-target="#adminModal">
                                                View
                                            </button>

                                            <form method="POST" action="{{ route('manageadmin.unarchive', $user->id) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Unarchive</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- View Admin Modal -->
        <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-lg shadow-lg">
                    <div class="modal-header bg-purple-700 text-white">
                        <h5 class="modal-title" id="adminModalLabel">Admin Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> <span id="modalAdminName"></span></p>
                        <p><strong>Email:</strong> <span id="modalAdminEmail"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Admin Modal -->
        <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-lg shadow-lg">
                    <div class="modal-header bg-purple-700 text-white">
                        <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.manageadmin') }}">
                            @csrf
                            <input type="hidden" name="role" value="Admin">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Name</label>
                                <input id="fullName" type="text" name="fullName" value="{{ old('fullName') }}" class="form-control" required>
                                <x-input-error :messages="$errors->get('fullName')" class="error" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                <x-input-error :messages="$errors->get('email')" class="error" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control" required>
                                <x-input-error :messages="$errors->get('password')" class="error" />
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="error" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded" data-bs-dismiss="modal">Close</button>
                                <x-primary-button class="bg-purple-700 hover:bg-purple-800 text-white px-4 py-2 rounded">Register</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        // Populate modal with admin info
        const adminModal = document.getElementById('adminModal');
        adminModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const name = button.getAttribute('data-admin-name');
            const email = button.getAttribute('data-admin-email');
            document.getElementById('modalAdminName').textContent = name;
            document.getElementById('modalAdminEmail').textContent = email;
        });

        // Search admins
        const input = document.getElementById("adminSearchInput");
        input.addEventListener("input", function() {
            const filter = input.value.toLowerCase();
            document.querySelectorAll("#unarchivedAdminTableBody tr, #archivedAdminTableBody tr").forEach(row => {
                const cells = row.getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? "" : "none";
            });
        });
    </script>

</x-admin-layout>
