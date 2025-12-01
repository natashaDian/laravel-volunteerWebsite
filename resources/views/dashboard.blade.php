<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $events = \App\Models\Event::take(6)->get(); // ambil beberapa event
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- ================= CAROUSEL ================= --}}
                <div id="default-carousel" class="relative w-full mb-8" data-carousel="slide">

                    <!-- Carousel wrapper -->
                    <div class="relative h-64 overflow-hidden rounded-lg md:h-96">

                        @foreach ($events as $index => $event)
                            <div class="{{ $index === 0 ? '' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                                <img src="https://picsum.photos/1200/400?random={{ $index+1 }}"
                                     class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                     alt="event image">
                            </div>
                        @endforeach
                    </div>

                    <!-- Indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                        @foreach ($events as $i => $event)
                            <button type="button" class="w-3 h-3 rounded-full bg-white/60"
                                aria-label="Slide {{ $i+1 }}" data-carousel-slide-to="{{ $i }}"></button>
                        @endforeach
                    </div>

                    <!-- Prev button -->
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4"
                        data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/40 hover:bg-black/60 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </span>
                    </button>

                    <!-- Next button -->
                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4"
                        data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/40 hover:bg-black/60 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </button>
                </div>

                {{-- ================= EVENT CARDS (2 KOLOM) ================= --}}
               <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    @foreach ($events as $event)
                        <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md md:flex-row">

                            <img class="object-cover w-full rounded-lg h-48 md:h-40 md:w-40 mb-4 md:mb-0"
                                src="https://picsum.photos/300/200?random={{ $event->id }}"
                                alt="event image">

                            <div class="flex flex-col justify-between md:ml-4 leading-normal">
                                <h5 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $event->title }}
                                </h5>

                                <p class="mb-4 text-gray-700 dark:text-gray-300">
                                    {{ Str::limit($event->description, 100) }}
                                </p>

                                <a href="{{ route('events.show', $event->id) }}"
                                class="inline-flex items-center text-sm px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg">
                                    View detail
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
