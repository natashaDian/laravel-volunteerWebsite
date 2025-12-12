<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Browse Activities
        </h2>
    </x-slot>

    @php
        // helper: check route name exists
        if (! function_exists('route_exists')) {
            function route_exists($name) {
                try { return \Illuminate\Support\Facades\Route::has($name); } catch (\Throwable $e) { return false; }
            }
        }

        // helper: resolve image URL
        if (! function_exists('activity_image_url')) {
            function activity_image_url($activity) {
                if (!$activity) return asset('images/default.jpg');
                $img = $activity->image_url ?? null;
                if (!$img) return asset('images/default.jpg');
                if (filter_var($img, FILTER_VALIDATE_URL)) return $img;
                return asset($img);
            }
        }

        // helper: resolve company name
        if (! function_exists('company_display_name')) {
            function company_display_name($activity, $companies) {
                if (!empty($activity->organizer)) return $activity->organizer;
                if (!empty($activity->company_code) && isset($companies[$activity->company_code])) {
                    return $companies[$activity->company_code];
                }
                return null;
            }
        }

        // Ensure controller variables exist
        $companies = $companies ?? [];
        $categories = $categories ?? [];
        $activitiesCount = isset($activities) ? $activities->total() : 0;

        // Get current query filters
        $qCategory = request()->query('category');
        $qLocation = request()->query('location');
        $qCompany  = request()->query('company');
        $qStart    = request()->query('start_date');
        $qEnd      = request()->query('end_date');
        $qSearch   = request()->query('q');
    @endphp

    <div class="container mx-auto py-10 px-4">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <p class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4 sm:mb-0">
                Browse Activities, <strong>{{ $activitiesCount }}</strong> activities need your help
            </p>

            <div class="flex gap-2 items-center">
                {{-- Filter button --}}
                <button id="openFilterBtn"
                        class="flex items-center px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707v3.414a1 1 0 01-1.55 1.832l-3.25-1.083A1 1 0 018 17v-3.414a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </button>
            </div>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ url()->current() }}" class="flex mb-8 gap-3">
            <input name="q" value="{{ old('q', $qSearch) }}" type="text"
                   class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Search activities..." />

            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Search</button>

            @if(request()->query())
                <a href="{{ url()->current() }}" class="px-4 py-2 border rounded-lg text-gray-700">Reset</a>
            @endif
        </form>

        {{-- Activities Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($activities as $activity)
                @php
                    $categoryColorClasses = [
                        'seni dan budaya' => 'bg-indigo-100 text-indigo-800',
                        'penanggulangan bencana' => 'bg-red-100 text-red-800',
                        'pengembangan anak muda' => 'bg-yellow-100 text-yellow-800',
                        'pendidikan' => 'bg-green-100 text-green-800',
                    ];
                    $categoryKey = strtolower($activity->category ?? '');
                    $categoryColor = $categoryColorClasses[$categoryKey] ?? 'bg-gray-100 text-gray-800';
                    $typeColor = (strtolower($activity->type ?? '') == 'event') ? 'bg-blue-500' : 'bg-red-500';

                    $companyName = company_display_name($activity, $companies);
                @endphp

                <a href="{{ route_exists('activities.show') ? route('activities.show', $activity->id) : url('/activities/'.$activity->id) }}">
                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition h-full flex flex-col">
                        <div class="relative w-full h-48">
                            <img src="{{ activity_image_url($activity) }}" class="w-full h-full object-cover" />
                            <div class="absolute top-2 left-2 flex gap-1">
                                <span class="{{ $typeColor }} text-white text-xs font-semibold px-2 py-1 rounded">
                                    {{ $activity->type ?? 'Event' }}
                                </span>
                                @if($activity->category)
                                    <span class="{{ $categoryColor }} text-xs px-2 py-1 rounded">
                                        {{ $activity->category }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-4 flex flex-col flex-1">
                            <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $activity->title }}</h5>

                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-3 line-clamp-3">
                                {{ $activity->description }}
                            </p>

                            @if($companyName)
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">{{ $companyName }}</p>
                            @endif

                            <div class="mt-auto text-xs text-gray-600 dark:text-gray-300 border-t pt-2">
                                @php
                                    $start = $activity->start_date ? \Carbon\Carbon::parse($activity->start_date) : null;
                                    $end = $activity->end_date ? \Carbon\Carbon::parse($activity->end_date) : null;
                                @endphp

                                @if($start)
                                    <div class="flex items-center mb-1">
                                        <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>

                                        {{ $end && $end != $start ? $start->format('d M Y').' - '.$end->format('d M Y') : $start->format('d M Y') }}
                                    </div>
                                @endif

                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $activity->location ?? 'Virtual activity' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            @empty
                <p class="text-gray-500">No activities found.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $activities->links() }}
        </div>
    </div>

    {{-- FILTER MODAL --}}
    <div id="filterModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4">
        <div class="absolute inset-0 bg-black/40" id="modalBackdrop"></div>

        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-2xl z-10 overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Filter Activities</h3>
                <button id="closeFilterBtn" class="text-gray-600 dark:text-gray-300 text-xl">&times;</button>
            </div>

            <form method="GET" action="{{ url()->current() }}" class="p-4 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                        <select name="category" class="w-full rounded border px-3 py-2 bg-white dark:bg-gray-700">
                            <option value="">-- Any category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $qCategory == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Company --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Organization</label>
                        <select name="company" class="w-full rounded border px-3 py-2 bg-white dark:bg-gray-700">
                            <option value="">-- Any organization --</option>
                            @foreach($companies as $code => $name)
                                <option value="{{ $code }}" {{ $qCompany == $code ? 'selected' : '' }}>
                                    {{ $name }} ({{ $code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Location --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location contains</label>
                        <input name="location" class="w-full rounded border px-3 py-2 bg-white dark:bg-gray-700"
                               value="{{ $qLocation }}" placeholder="e.g. Surabaya">
                    </div>

                    {{-- Date Range --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date range</label>
                        <div class="flex gap-2">
                            <input type="date" name="start_date" value="{{ $qStart }}" class="w-1/2 rounded border px-3 py-2 bg-white dark:bg-gray-700">
                            <input type="date" name="end_date" value="{{ $qEnd }}" class="w-1/2 rounded border px-3 py-2 bg-white dark:bg-gray-700">
                        </div>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="flex justify-end gap-3 border-t pt-3">
                    <a href="{{ url()->current() }}" class="px-4 py-2 text-sm border rounded">Reset</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>

    {{-- FILTER MODAL JS --}}
    <script>
        (function() {
            const modal = document.getElementById("filterModal");
            const openBtn = document.getElementById("openFilterBtn");
            const closeBtn = document.getElementById("closeFilterBtn");
            const backdrop = document.getElementById("modalBackdrop");

            const openModal = () => {
                modal.classList.remove("hidden");
                modal.classList.add("flex");
                document.body.classList.add("overflow-hidden");
            };

            const closeModal = () => {
                modal.classList.remove("flex");
                modal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            };

            openBtn.addEventListener("click", openModal);
            closeBtn.addEventListener("click", closeModal);
            backdrop.addEventListener("click", closeModal);

            document.addEventListener("keydown", e => {
                if (e.key === "Escape") closeModal();
            });
        })();
    </script>

</x-app-layout>
