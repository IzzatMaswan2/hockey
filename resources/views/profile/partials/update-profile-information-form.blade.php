<section>
    <header>
        <h1 class="text-center fw-bold">Update Account Information</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-center">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}"enctype="multipart/form-data" class="mt-6 space-y-6 flex flex-col items-center justify-center">
        @csrf
        @method('patch')

        <div class="w-1/2">
            <x-input-label for="fullName" :value="__('Name:')" />
            <x-text-input style="border-radius:20px !important;" id="fullName" name="fullName" type="text" class="mt-1 block w-full text-center" :value="old('fullName', $user->fullName)" required autocomplete="fullName" />
            <x-input-error class="mt-2" :messages="$errors->get('fullName')" />
        </div>

        <div class="w-1/2">
            <x-input-label for="email" :value="__('Email:')" />
            <x-text-input style="border-radius:20px !important;" id="email" name="email" type="text" class="mt-1 block w-full text-center" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if ($user->role === 'Manager')
            <div class="w-1/2">
                <x-input-label for="occupation" :value="__('Occupation:')" />
                <x-text-input style="border-radius:20px !important;" id="occupation" name="occupation" type="text" class="mt-1 block w-full text-center" :value="old('occupation', $user->occupation)" required autocomplete="occupation" />
                <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="teamName" :value="__('Team Name:')" />
                <x-text-input style="border-radius:20px !important;" id="teamName" name="teamName" type="text" class="mt-1 block w-full text-center" :value="old('teamName', $user->team ? $user->team->name : 'N/A')" autocomplete="teamName" />
                <x-input-error class="mt-2" :messages="$errors->get('teamName')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="logo" :value="__('Team Logo:')" />
                <input type="file" id="logo" name="logo" class="mt-1 block w-full text-center" accept="image/*" />
                <x-input-error class="mt-2" :messages="$errors->get('logo')" />
            </div>


            <div class="w-1/2">
                <x-input-label for="address" :value="__('Address:')" />
                <x-text-input style="border-radius:20px !important;" id="address" name="address" type="text" class="mt-1 block w-full text-center" :value="old('address', $user->address)" required autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="country" :value="__('Country:')" />
                <x-text-input style="border-radius:20px !important;" id="country" name="country" type="text" class="mt-1 block w-full text-center" :value="old('country', $user->country)" required autocomplete="country" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        @elseif ($user->role === 'Player')
            <div class="w-1/2">
                <x-input-label for="dob" :value="__('Date of Birth:')" />
                <x-text-input style="border-radius:20px !important;" id="dob" name="dob" type="date" class="mt-1 block w-full text-center" :value="old('dob', $user->dob)" required autocomplete="dob" />
                <x-input-error class="mt-2" :messages="$errors->get('dob')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="displayName" :value="__('Display Name:')" />
                <x-text-input style="border-radius:20px !important;" id="displayName" name="displayName" type="text" class="mt-1 block w-full text-center" :value="old('displayName', $user->displayName)" required autocomplete="displayName" />
                <x-input-error class="mt-2" :messages="$errors->get('displayName')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="jerseyNumber" :value="__('Jersey Number:')" />
                <x-text-input style="border-radius:20px !important;" id="jerseyNumber" name="jerseyNumber" type="text" class="mt-1 block w-full text-center" :value="old('jerseyNumber', $user->jerseyNumber)" required autocomplete="jerseyNumber" />
                <x-input-error class="mt-2" :messages="$errors->get('jerseyNumber')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="position" :value="__('Position:')" />
                <x-text-input style="border-radius:20px !important;" id="position" name="position" type="text" class="mt-1 block w-full text-center" :value="old('position', $user->position)" required autocomplete="position" />
                <x-input-error class="mt-2" :messages="$errors->get('position')" />
            </div>

            <div class="w-1/2">
                <x-input-label for="contact" :value="__('Contact:')" />
                <x-text-input style="border-radius:20px !important;" id="contact" name="contact" type="text" class="mt-1 block w-full text-center" :value="old('contact', $user->contact)" required autocomplete="contact" />
                <x-input-error class="mt-2" :messages="$errors->get('contact')" />
            </div>
        @elseif ($user->role === 'Admin')
            <!-- Admin-specific fields can be added here if needed -->
            <p class="text-center">No additional fields for Admin role.</p>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color:#4B006E;border-radius:20px;">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
