<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-red-600">
            Delete Company Account
        </h2>

        <p class="text-sm text-gray-600">
            This action is permanent and cannot be undone.
        </p>
    </header>

    <form method="POST" action="{{ route('company.profile.destroy') }}">
        @csrf
        @method('DELETE')

        <div>
            <x-input-label value="Password" />
            <x-text-input name="password" type="password"
                          class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <x-danger-button class="mt-4">
            Delete Account
        </x-danger-button>
    </form>
</section>
