<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Event: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-md sm:rounded-lg">

                <form action="{{ route('company.events.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- TITLE --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Event Title</label>
                        <input type="text" name="title" value="{{ $event->title }}"
                               class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>{{ $event->description }}</textarea>
                    </div>

                    {{-- LOCATION --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Location</label>
                        <input type="text" name="location" value="{{ $event->location }}"
                               class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    {{-- DATE & TIME --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Date</label>
                            <input type="date" name="date" value="{{ $event->date }}"
                                   class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Time</label>
                            <input type="time" name="time" value="{{ $event->time }}"
                                   class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>
                    </div>

                    {{-- QUOTA --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Quota</label>
                        <input type="number" name="quota" min="1" value="{{ $event->quota }}"
                               class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600" required>
                    </div>

                    <button type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                        Update Event
                    </button>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>
