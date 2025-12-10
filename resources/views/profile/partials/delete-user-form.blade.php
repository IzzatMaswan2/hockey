<section class="space-y-6 max-w-xl mx-auto p-6 bg-white rounded-2xl shadow-lg">
    <!-- Header -->
    <header>
        <h1 class="text-2xl font-bold text-center text-purple-700">Delete Account</h1>
        <p class="mt-2 text-sm text-gray-600 text-justify">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Delete Button -->
    <x-danger-button 
        class="w-full py-2 px-4 rounded-xl bg-purple-900 hover:bg-purple-800 transition-colors text-white font-semibold"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __('Delete Account') }}
    </x-danger-button>

    <!-- Confirmation Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">{{ __('Are you sure you want to delete your account?') }}</h2>

            <p class="text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div>
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>

            <div class="flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2 rounded-lg">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="px-4 py-2 rounded-lg bg-red-700 hover:bg-red-600">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
