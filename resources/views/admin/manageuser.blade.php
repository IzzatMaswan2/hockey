<x-admin-layout :title="'Manage Manager'">

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <main class="flex-1 p-6 space-y-6 bg-gray-100 min-h-screen">

        <!-- Page Header -->
        <h2 class="text-3xl font-bold text-purple-700">REGISTER MANAGER</h2>

        <!-- Add Manager Button -->
        <button class="bg-purple-700 text-white font-bold py-2 px-6 rounded-lg hover:bg-purple-800" 
            data-bs-toggle="modal" data-bs-target="#addManagerModal">
            Add Manager
        </button>

        <!-- Manager List Header -->
        <h2 class="text-3xl font-bold text-purple-700 mt-8">MANAGER LIST</h2>

        <!-- Search -->
        <div class="my-4">
            <input type="text" id="managerSearchInput" placeholder="Search managers..."
                class="w-full md:w-1/3 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="managerTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="unarchived-tab" data-bs-toggle="tab" data-bs-target="#unarchived" type="button" role="tab" aria-controls="unarchived" aria-selected="true">
                    Registered Managers
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab" aria-controls="archived" aria-selected="false">
                    Archived Managers
                </button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="managerTabsContent">
            <!-- Registered Managers -->
            <div class="tab-pane fade show active" id="unarchived" role="tabpanel" aria-labelledby="unarchived-tab">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-purple-700 text-white">
                            <tr>
                                <th class="py-2 px-4">Manager Name</th>
                                <th class="py-2 px-4">Email</th>
                                <th class="py-2 px-4">Team</th>
                                <th class="py-2 px-4">Country</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="unarchivedManagerTableBody" class="text-center">
                            @foreach ($users as $user)
                                @if ($user->role === 'Manager' && $user->archived === 1)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $user->fullName }}</td>
                                        <td class="py-2 px-4">{{ $user->email }}</td>
                                        <td class="py-2 px-4">{{ $user->team ? $user->team->name : 'N/A' }}</td>
                                        <td class="py-2 px-4">{{ $user->country }}</td>
                                        <td class="py-2 px-4 space-x-2">
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 btn-view" 
                                                data-manager-name="{{ $user->fullName }}" 
                                                data-manager-email="{{ $user->email }}" 
                                                data-manager-team-name="{{ $user->team ? $user->team->name : 'N/A' }}" 
                                                data-manager-occupation="{{ $user->occupation }}" 
                                                data-manager-address="{{ $user->address }}" 
                                                data-manager-country="{{ $user->country }}" 
                                                data-bs-toggle="modal" data-bs-target="#managerModal">
                                                View
                                            </button>

                                            <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 btn-edit" 
                                                data-manager-id="{{ $user->id }}" 
                                                data-manager-name="{{ $user->fullName }}" 
                                                data-manager-email="{{ $user->email }}" 
                                                data-manager-occupation="{{ $user->occupation }}" 
                                                data-manager-team-name="{{ $user->team ? $user->team->name : 'N/A' }}" 
                                                data-manager-address="{{ $user->address }}" 
                                                data-manager-country="{{ $user->country }}"
                                                data-bs-toggle="modal" data-bs-target="#editManagerModal">
                                                Edit
                                            </button>

                                            <form method="POST" action="{{ route('manageuser.archive', $user->id) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Archive</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Archived Managers -->
            <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-purple-700 text-white">
                            <tr>
                                <th class="py-2 px-4">Manager Name</th>
                                <th class="py-2 px-4">Email</th>
                                <th class="py-2 px-4">Team</th>
                                <th class="py-2 px-4">Country</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="archivedManagerTableBody" class="text-center">
                            @foreach ($users as $user)
                                @if ($user->role === 'Manager' && $user->archived === 0)
                                    <tr class="border-b">
                                        <td class="py-2 px-4">{{ $user->fullName }}</td>
                                        <td class="py-2 px-4">{{ $user->email }}</td>
                                        <td class="py-2 px-4">{{ $user->team ? $user->team->name : 'N/A' }}</td>
                                        <td class="py-2 px-4">{{ $user->country }}</td>
                                        <td class="py-2 px-4 space-x-2">
                                            <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 btn-view" 
                                                data-manager-name="{{ $user->fullName }}" 
                                                data-manager-email="{{ $user->email }}" 
                                                data-manager-team-name="{{ $user->team ? $user->team->name : 'N/A' }}" 
                                                data-manager-occupation="{{ $user->occupation }}" 
                                                data-manager-address="{{ $user->address }}" 
                                                data-manager-country="{{ $user->country }}" 
                                                data-bs-toggle="modal" data-bs-target="#managerModal">
                                                View
                                            </button>

                                            <form method="POST" action="{{ route('manageuser.unarchive', $user->id) }}" class="inline">
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

        <!-- Modals -->
        @include('admin.managers.modals')

    </main>

    <script>
        // Populate view manager modal
        const managerModal = document.getElementById('managerModal');
        managerModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            document.getElementById('modalManagerName').textContent = button.getAttribute('data-manager-name');
            document.getElementById('modalManagerEmail').textContent = button.getAttribute('data-manager-email');
            document.getElementById('modalManagerTeam').textContent = button.getAttribute('data-manager-team-name');
            document.getElementById('modalManagerOccupation').textContent = button.getAttribute('data-manager-occupation');
            document.getElementById('modalManagerAddress').textContent = button.getAttribute('data-manager-address');
            document.getElementById('modalManagerCountry').textContent = button.getAttribute('data-manager-country');
        });

        // Populate edit manager modal
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const managerId = this.getAttribute('data-manager-id');
                document.getElementById('editFullName').value = this.getAttribute('data-manager-name');
                document.getElementById('editEmail').value = this.getAttribute('data-manager-email');
                document.getElementById('editOccupation').value = this.getAttribute('data-manager-occupation');
                document.getElementById('editTeamName').value = this.getAttribute('data-manager-team-name');
                document.getElementById('editAddress').value = this.getAttribute('data-manager-address');
                document.getElementById('editCountry').value = this.getAttribute('data-manager-country');

                const form = document.getElementById('editManagerForm');
                form.action = form.action.replace(':id', managerId);
            });
        });

        // Manager search
        const input = document.getElementById("managerSearchInput");
        input.addEventListener("input", function() {
            const filter = input.value.toLowerCase();
            document.querySelectorAll("#unarchivedManagerTableBody tr, #archivedManagerTableBody tr").forEach(row => {
                const cells = row.getElementsByTagName("td");
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) { match = true; break; }
                }
                row.style.display = match ? "" : "none";
            });
        });

        $(document).ready(function() {
            $('#tournament_id').select2({ placeholder: "Select Tournament", allowClear: true });
        });
    </script>

</x-admin-layout>
