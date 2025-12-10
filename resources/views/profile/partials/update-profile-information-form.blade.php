<section class="space-y-6 max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-lg">
    <!-- Header -->
    <header>
        <h1 class="text-2xl font-bold text-center text-purple-700">Update Account Information</h1>
        <p class="mt-2 text-sm text-gray-600 text-center">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Email Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="fullName" :value="__('Name')" />
            <x-text-input
                id="fullName"
                name="fullName"
                type="text"
                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                :value="old('fullName', $user->fullName)"
                required
                autocomplete="fullName"
            />
            <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('fullName')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                :value="old('email', $user->email)"
                required
                autocomplete="email"
            />
            <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="mt-2 text-sm text-gray-800 text-center">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="underline text-purple-700 hover:text-purple-900 ml-1">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600 text-center">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Manager Fields -->
        @if ($user->role === 'Manager')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="occupation" :value="__('Occupation')" />
                    <x-text-input
                        id="occupation"
                        name="occupation"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('occupation', $user->occupation)"
                        required
                        autocomplete="occupation"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('occupation')" />
                </div>

                <div>
                    <x-input-label for="teamName" :value="__('Team Name')" />
                    <x-text-input
                        id="teamName"
                        name="teamName"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('teamName', $user->team ? $user->team->name : 'N/A')"
                        autocomplete="teamName"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('teamName')" />
                </div>

                <div>
                    <x-input-label for="logo" :value="__('Team Logo')" />
                    <input type="file" id="logo" name="logo" class="mt-1 block w-full text-center" accept="image/*" />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('logo')" />
                </div>

                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input
                        id="address"
                        name="address"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('address', $user->address)"
                        required
                        autocomplete="address"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('address')" />
                </div>

                <div>
                    <x-input-label for="country" :value="__('Country')" />
                    <x-text-input
                        id="country"
                        name="country"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('country', $user->country)"
                        required
                        autocomplete="country"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('country')" />
                </div>
            </div>
        @elseif ($user->role === 'Player')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="dob" :value="__('Date of Birth')" />
                    <x-text-input
                        id="dob"
                        name="dob"
                        type="date"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('dob', $user->dob)"
                        required
                        autocomplete="dob"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('dob')" />
                </div>

                <div>
                    <x-input-label for="displayName" :value="__('Display Name')" />
                    <x-text-input
                        id="displayName"
                        name="displayName"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('displayName', $user->displayName)"
                        required
                        autocomplete="displayName"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('displayName')" />
                </div>

                <div>
                    <x-input-label for="jerseyNumber" :value="__('Jersey Number')" />
                    <x-text-input
                        id="jerseyNumber"
                        name="jerseyNumber"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('jerseyNumber', $user->jerseyNumber)"
                        required
                        autocomplete="jerseyNumber"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('jerseyNumber')" />
                </div>

                <div>
                    <x-input-label for="position" :value="__('Position')" />
                    <x-text-input
                        id="position"
                        name="position"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('position', $user->position)"
                        required
                        autocomplete="position"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('position')" />
                </div>

                <div>
                    <x-input-label for="contact" :value="__('Contact')" />
                    <x-text-input
                        id="contact"
                        name="contact"
                        type="text"
                        class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 text-center"
                        :value="old('contact', $user->contact)"
                        required
                        autocomplete="contact"
                    />
                    <x-input-error class="mt-2 text-red-600 text-sm" :messages="$errors->get('contact')" />
                </div>
            </div>
        @elseif ($user->role === 'Admin')
            <p class="text-center text-gray-500">No additional fields for Admin role.</p>
        @endif

        <!-- Submit -->
        <div class="flex items-center justify-center gap-4 mt-4">
            <x-primary-button class="bg-purple-900 hover:bg-purple-800 text-white font-semibold px-6 py-2 rounded-xl">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 text-center"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
