<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create New Event
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-md sm:rounded-lg">

                {{-- SUCCESS MESSAGE --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- FORM --}}
                <form action="{{ route('company.events.store') }}" method="POST">
                    @csrf

                    {{-- TITLE --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Event Title</label>
                        <input type="text" name="title" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Description</label>
                        <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required></textarea>
                    </div>

                    {{-- LOCATION --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Location</label>
                        <input type="text" name="location" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    {{-- DATE & TIME --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Date</label>
                            <input type="date" name="date" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Time</label>
                            <input type="time" name="time" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>
                    </div>

                    {{-- QUOTA --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Quota</label>
                        <input type="number" name="quota" min="1" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <button type="submit"
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                        Create Event
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
