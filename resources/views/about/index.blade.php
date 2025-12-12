<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $info['title'] ?? 'About' }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Mission</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $info['mission'] ?? '' }}</p>

            <h3 class="text-lg font-semibold mb-2">Vision</h3>
            <p class="text-gray-700 dark:text-gray-300">{{ $info['vision'] ?? '' }}</p>

            <div class="mt-6 text-sm text-gray-500">
                Reach out at <a href="mailto:hello@give2grow.example" class="text-indigo-600">hello@give2grow.example</a>.
            </div>
        </div>
    </div>
</x-app-layout>
