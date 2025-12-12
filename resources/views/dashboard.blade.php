<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Give 2 Grow') }}
        </h2>
    </x-slot>

    @php
        // helper: route_exists
        if (! function_exists('route_exists')) {
            function route_exists($name) {
                try {
                    return \Illuminate\Support\Facades\Route::has($name);
                } catch (\Throwable $e) {
                    return false;
                }
            }
        }

        // helper: activity_image_url
        if (! function_exists('activity_image_url')) {
            function activity_image_url($activity) {
                if (!$activity) return asset('images/default.jpg');

                $img = $activity->image_url ?? null;
                if (!$img) return asset('images/default.jpg');

                // if image_url already full URL, return as-is
                if (filter_var($img, FILTER_VALIDATE_URL)) return $img;

                // else assume path under public (e.g. img/xxx.jpg)
                return asset($img);
            }
        }

        // safe counts
        $activitiesCount = class_exists(\App\Models\Activity::class) ? \App\Models\Activity::count() : 0;
        $orgCount = class_exists(\App\Models\Company::class) ? \App\Models\Company::count() : (class_exists(\App\Models\Organization::class) ? \App\Models\Organization::count() : 0);

        // carousel items (up to 6) - prefer activities with image_url
        $activitiesForCarousel = class_exists(\App\Models\Activity::class)
            ? \App\Models\Activity::whereNotNull('image_url')->where('image_url', '!=', '')->latest('start_date')->take(6)->get()
            : collect();

        // If no activity images, fallback to any activities (to keep carousel indicators correct)
        if ($activitiesForCarousel->isEmpty() && class_exists(\App\Models\Activity::class)) {
            $activitiesForCarousel = \App\Models\Activity::latest('start_date')->take(6)->get();
        }

        // recent activities (6 latest)
        $recentActivities = class_exists(\App\Models\Activity::class)
            ? \App\Models\Activity::latest('start_date')->take(6)->get()
            : collect();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- CAROUSEL --}}
            @if($activitiesForCarousel->isNotEmpty())
                <div id="default-carousel" class="relative w-full mb-8" data-carousel="slide">
                    <div class="relative h-64 overflow-hidden rounded-lg md:h-96">
                        @foreach ($activitiesForCarousel as $index => $activity)
                            <div class="{{ $index === 0 ? '' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                                <img src="{{ activity_image_url($activity) }}"
                                     alt="{{ $activity->title ?? 'Activity' }}"
                                     loading="lazy"
                                     class="absolute block w-full h-full object-cover top-0 left-0">
                                <div class="absolute left-4 bottom-4 bg-black/50 text-white rounded px-3 py-2">
                                    <span class="font-semibold">{{ \Illuminate\Support\Str::limit($activity->title ?? 'Untitled', 40) }}</span>
                                    @if(!empty($activity->start_date))
                                        <span class="text-xs ml-2">{{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- indicators --}}
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                        @foreach ($activitiesForCarousel as $i => $it)
                            <button type="button"
                                    class="w-3 h-3 rounded-full bg-white/60"
                                    aria-label="Slide {{ $i+1 }}"
                                    data-carousel-slide-to="{{ $i }}"></button>
                        @endforeach
                    </div>

                    {{-- prev/next --}}
                    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/40 hover:bg-black/60 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </span>
                    </button>

                    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-black/40 hover:bg-black/60 text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </button>
                </div>
            @else
                {{-- fallback banner --}}
                <div class="relative w-full mb-8">
                    <div class="relative h-64 overflow-hidden rounded-lg md:h-96">
                        <img src="{{ asset('images/default-carousel.jpg') }}" alt="No featured activities" class="absolute block w-full h-full object-cover top-0 left-0">
                        <div class="absolute left-4 bottom-4 bg-black/50 text-white rounded px-3 py-2">
                            <span class="font-semibold">No featured activities yet</span>
                            <div class="text-xs">Add activities with images to show here.</div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- THREE MAIN CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Find Activities -->
                <a href="{{ route_exists('activities.index') ? route('activities.index') : url('/activities') }}" class="block group">
                    <div class="bg-white dark:bg-gray-800 shadow-sm hover:shadow-lg transition p-6 rounded-lg h-full flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h6M9 17H5a2 2 0 01-2-2V7a2 2 0 012-2h14"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Find Activities</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Browse volunteer activities near you or online.</p>
                                </div>
                            </div>

                            <div class="text-sm">
                                <span class="inline-flex items-center px-2 py-1 rounded bg-green-50 text-green-700 text-xs font-semibold">{{ $activitiesCount }} open</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="inline-flex items-center text-sm px-3 py-2 rounded bg-green-600 text-white group-hover:bg-green-700">
                                Browse Activities
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Find Organizations -->
                <a href="{{ route_exists('organizations.index') ? route('organizations.index') : url('/organizations') }}" class="block group">
                    <div class="bg-white dark:bg-gray-800 shadow-sm hover:shadow-lg transition p-6 rounded-lg h-full flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 10-8 0v4M4 20h16v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Find Organizations</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Explore organizations and see the activities they run.</p>
                                </div>
                            </div>

                            <div class="text-sm">
                                <span class="inline-flex items-center px-2 py-1 rounded bg-indigo-50 text-indigo-700 text-xs font-semibold">{{ $orgCount }} orgs</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="inline-flex items-center text-sm px-3 py-2 rounded bg-indigo-600 text-white group-hover:bg-indigo-700">
                                Browse Organizations
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <!-- Donation -->
                <a href="{{ route_exists('donations.index') ? route('donations.index') : url('/donations') }}" class="block group">
                    <div class="bg-white dark:bg-gray-800 shadow-sm hover:shadow-lg transition p-6 rounded-lg h-full flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zM6 21h12"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Donation</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Support organizations and activities with donations.</p>
                                </div>
                            </div>

                            <div class="text-sm">
                                <span class="inline-flex items-center px-2 py-1 rounded bg-yellow-50 text-yellow-700 text-xs font-semibold">Support now</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="inline-flex items-center text-sm px-3 py-2 rounded bg-yellow-600 text-white group-hover:bg-yellow-700">
                                Donate
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- RECENT ACTIVITIES --}}
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Recent Activities</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @if($recentActivities->isNotEmpty())
                        @foreach($recentActivities as $a)
                            <a href="{{ route_exists('activities.show') ? route('activities.show', $a->id) : url('/activities/'.$a->id) }}" class="block group">
                                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm hover:shadow-md transition">
                                    <div class="flex gap-4">
                                        <img src="{{ activity_image_url($a) }}" class="w-20 h-20 object-cover rounded" alt="{{ $a->title ?? 'Activity' }}" loading="lazy">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ $a->title }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($a->description, 60) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p class="text-gray-500">No activities found.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
