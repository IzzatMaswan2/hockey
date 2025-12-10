<!-- View Manager Modal -->
<div class="modal fade" id="managerModal" tabindex="-1" aria-labelledby="managerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="modal-header flex justify-between items-center p-4 border-b border-gray-200">
                <h5 class="text-xl font-bold text-purple-700" id="managerModalLabel">Manager Details</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body p-4 space-y-2">
                <p><strong>Name:</strong> <span id="modalManagerName"></span></p>
                <p><strong>Email:</strong> <span id="modalManagerEmail"></span></p>
                <p><strong>Team Name:</strong> <span id="modalManagerTeam"></span></p>
                <p><strong>Occupation:</strong> <span id="modalManagerOccupation"></span></p>
                <p><strong>Address:</strong> <span id="modalManagerAddress"></span></p>
                <p><strong>Country:</strong> <span id="modalManagerCountry"></span></p>
            </div>
            <div class="modal-footer flex justify-end p-4 border-t border-gray-200">
                <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Manager Modal -->
<div class="modal fade" id="editManagerModal" tabindex="-1" aria-labelledby="editManagerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="modal-header flex justify-between items-center p-4 border-b border-gray-200">
                <h5 class="text-xl font-bold text-purple-700" id="editManagerModalLabel">Edit Manager</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="editManagerForm" method="POST" action="{{ route('manageuser.update', ':id') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="editFullName">Name</label>
                        <input id="editFullName" type="text" name="fullName" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="editEmail">Email Address</label>
                        <input id="editEmail" type="email" name="email" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="editOccupation">Occupation</label>
                        <input id="editOccupation" type="text" name="occupation" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="editTeamName">Team Name</label>
                        <input id="editTeamName" type="text" name="teamName" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="editAddress">Address</label>
                        <textarea id="editAddress" name="address" rows="3" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="editCountry">Country</label>
                        <input id="editCountry" type="text" name="country" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded-lg hover:bg-purple-800">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Manager Modal -->
<div class="modal fade" id="addManagerModal" tabindex="-1" aria-labelledby="addManagerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered max-w-2xl">
        <div class="modal-content bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="modal-header flex justify-between items-center p-4 border-b border-gray-200">
                <h5 class="text-xl font-bold text-purple-700" id="addManagerModalLabel">Add Manager</h5>
                <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('manageuser.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="Manager">

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="fullName">Name</label>
                        <input id="fullName" type="text" name="fullName" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="email">Email Address</label>
                        <input id="email" type="email" name="email" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="occupation">Occupation</label>
                        <input id="occupation" type="text" name="occupation" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="tournament_id">Tournament</label>
                        <select id="tournament_id" name="tournament_id" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="" disabled selected>Select a tournament</option>
                            @foreach ($tournaments as $tournament)
                                <option value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="teamName">Team Name</label>
                        <input id="teamName" type="text" name="teamName" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="address">Address</label>
                        <input id="address" type="text" name="address" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="country">Country</label>
                        <input id="country" type="text" name="country" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="password">Password</label>
                        <input id="password" type="password" name="password" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div>
                        <label class="block font-semibold text-purple-700 mb-1" for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="w-full border-gray-300 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded-lg hover:bg-purple-800">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
