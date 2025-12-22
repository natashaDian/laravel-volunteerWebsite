<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Update Password
        </h2>
    </header>

    <form method="POST"
          action="{{ route('company.profile.password.update') }}"
          class="mt-6 space-y-6">

        @csrf
        @method('PUT')

        <div>
            <x-input-label value="Current Password" />
            <x-text-input name="current_password" type="password"
                          class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('current_password')" />
        </div>

        <div>
            <x-input-label value="New Password" />
            <x-text-input name="password" type="password"
                          class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label value="Confirm Password" />
            <x-text-input name="password_confirmation" type="password"
                          class="mt-1 block w-full" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">Saved.</p>
            @endif
        </div>
    </form>
</section>
