<x-app-layout>
    @php
        // ===== IMAGE FALLBACK =====
        $img = $activity->image_url ?? null;
        if ($img && filter_var($img, FILTER_VALIDATE_URL)) {
            $imgUrl = $img;
        } elseif ($img && file_exists(public_path($img))) {
            $imgUrl = asset($img);
        } else {
            $imgUrl = asset('images/default.jpg');
        }

        // ===== COMPANY LOGO =====
        if (!empty($activity->company_code) && file_exists(public_path("img/company-{$activity->company_code}.jpg"))) {
            $companyLogo = asset("img/company-{$activity->company_code}.jpg");
        } else {
            $companyLogo = asset('images/company-default.jpg');
        }

        // ===== DATE LOGIC (NO `use`) =====
        $today = now()->startOfDay();
        $start = $activity->start_date ? \Carbon\Carbon::parse($activity->start_date) : null;
        $end   = $activity->end_date ? \Carbon\Carbon::parse($activity->end_date) : null;

        $isUpcoming = $start && $start->gt($today);
        $isOngoing  = $start && (!$end || $end->gte($today)) && $start->lte($today);
        $isEnded    = $end && $end->lt($today);
    @endphp


    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

            <div class="md:flex">

                {{-- LEFT : IMAGE --}}
                <div class="md:w-1/2 relative">
                    <img src="{{ $imgUrl }}" class="w-full h-80 md:h-full object-cover">

                    {{-- STATUS BADGE --}}
                    <div class="absolute top-4 left-4">
                        @if($isOngoing)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                Ongoing
                            </span>
                        @elseif($isUpcoming)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                Upcoming
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                Ended
                            </span>
                        @endif
                    </div>

                    {{-- ORGANIZER --}}
                    <div class="absolute bottom-4 left-4 flex items-center gap-3 bg-black/50 px-3 py-2 rounded-lg">
                        <img src="{{ $companyLogo }}" class="w-10 h-10 rounded-full object-cover">
                        <div class="text-white text-sm">
                            <div class="font-semibold">{{ $companyName ?? $activity->organizer }}</div>
                            <div class="opacity-80">{{ $activity->location ?? 'Virtual' }}</div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT : CONTENT --}}
                <div class="md:w-1/2 p-6 flex flex-col">

                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activity->title }}
                    </h1>

                    <p class="mt-3 text-gray-600 dark:text-gray-300">
                        {{ $activity->description }}
                    </p>

                    {{-- INFO --}}
                    <div class="mt-6 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                        <p><strong>Date:</strong>
                            {{ $start?->format('d M Y') }}
                            @if($end && $end != $start)
                                - {{ $end->format('d M Y') }}
                            @endif
                        </p>
                        <p><strong>Category:</strong> {{ $activity->category ?? '-' }}</p>
                        <p><strong>Type:</strong> {{ ucfirst($activity->type ?? 'event') }}</p>
                    </div>

                    {{-- ACTION --}}
                    <div class="mt-8 space-y-2">

                        {{-- ONGOING --}}
                        @if($isOngoing)
                            <button
                                onclick="document.getElementById('registerModal').classList.remove('hidden')"
                                class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                                Register Now
                            </button>
                            <p class="text-green-600 text-sm font-medium text-center">
                                ✔ Registration is open
                            </p>

                        {{-- UPCOMING --}}
                        @elseif($isUpcoming)
                            <button disabled
                                class="w-full py-3 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed">
                                Registration Not Open
                            </button>
                            <p class="text-yellow-600 text-sm font-medium text-center">
                                ⏳ Registration opens on {{ $start->format('d M Y') }}
                            </p>

                        {{-- ENDED --}}
                        @else
                            <button disabled
                                class="w-full py-3 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                                Event Ended
                            </button>
                            <p class="text-red-500 text-sm font-medium text-center">
                                ❌ This event has ended
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- REGISTER MODAL (UI ONLY) --}}
    <div id="registerModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50"
             onclick="document.getElementById('registerModal').classList.add('hidden')"></div>

        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md z-10">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                Register for Activity
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-300">
                Registration feature will be available soon.
            </p>

            <div class="mt-4 text-right">
                <button onclick="document.getElementById('registerModal').classList.add('hidden')"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Close
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
