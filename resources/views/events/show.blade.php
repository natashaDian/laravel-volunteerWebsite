<x-app-layout>
    <div class="py-12 max-w-6xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            <div class="flex flex-col md:flex-row gap-6">

                <!-- LEFT: IMAGE -->
                <div class="md:w-1/2">
                    <img src="https://picsum.photos/500/600?random={{ $event->id }}"
                         class="rounded-lg w-full object-cover h-[500px] md:h-[600px]"
                         alt="event image">
                </div>

                <!-- RIGHT: DETAILS -->
                <div class="md:w-1/2 flex flex-col">
                    <div class="flex flex-col justify-center">
                        <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                            {{ $event->title }}
                        </h1>

                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            {{ $event->description }}
                        </p>

                        <div class="space-y-2 text-gray-800 dark:text-gray-200">
                            <p><strong>Location:</strong> {{ $event->location }}</p>
                            <p><strong>Date:</strong> {{ $event->date }}</p>
                            <p><strong>Time:</strong> {{ $event->time }}</p>
                            <p><strong>Quota:</strong> {{ $event->quota }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="#"
                           class="inline-flex px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">
                           Register Now
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
