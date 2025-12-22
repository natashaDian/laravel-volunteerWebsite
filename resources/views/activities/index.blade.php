<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Browse Activities
        </h2>
    </x-slot>

    @php
        $companies = $companies ?? [];

        $categoryColors = [
            'seni dan budaya' => 'bg-indigo-100 text-indigo-800',
            'penanggulangan bencana' => 'bg-red-100 text-red-800',
            'pengembangan anak muda' => 'bg-yellow-100 text-yellow-800',
            'pendidikan' => 'bg-green-100 text-green-800',
            'lingkungan' => 'bg-emerald-100 text-emerald-800',
        ];

        function img($a) {
        if (!empty($a->image_url)) {

            // kalau sudah full URL
            if (filter_var($a->image_url, FILTER_VALIDATE_URL)) {
                return $a->image_url;
            }

            // bersihin slash depan
            $path = ltrim($a->image_url, '/');

            // kalau cuma nama file → arahkan ke public/img
            if (!str_contains($path, '/')) {
                $path = 'img/' . $path;
            }

            // kalau sudah img/xxx.jpg
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        return asset('img/default.jpg');
    }


    @endphp

    {{-- ================= FILTER BAR ================= --}}
    <form method="GET" action="{{ route('activities.index') }}"
          class="max-w-7xl mx-auto px-4 pt-6">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4
                    grid grid-cols-1 md:grid-cols-5 gap-4 items-end">

            <div>
                <label class="text-sm font-medium text-gray-600">Keyword</label>
                <input type="text" name="q" value="{{ request('q') }}"
                       class="w-full mt-1 rounded border-gray-300"
                       placeholder="Search title / description">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Category</label>
                <select name="category" class="w-full mt-1 rounded border-gray-300">
                    <option value="">All</option>
                    @foreach(array_keys($categoryColors) as $cat)
                        <option value="{{ $cat }}" @selected(request('category') === $cat)>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Organization</label>
                <select name="company" class="w-full mt-1 rounded border-gray-300">
                    <option value="">All</option>
                    @foreach($companies as $code => $name)
                        <option value="{{ $code }}" @selected(request('company') === $code)>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Start After</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                       class="w-full mt-1 rounded border-gray-300">
            </div>

            <div class="flex gap-2">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Apply
                </button>
                <a href="{{ route('activities.index') }}"
                   class="px-4 py-2 border rounded-lg text-gray-600">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="max-w-7xl mx-auto py-10 px-4 space-y-14">

        {{-- ================= ONGOING ================= --}}
        @if($ongoing->count())
        <section>
            <h3 class="text-2xl font-bold mb-5">🔥 Ongoing Activities</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($ongoing as $a)
                    @php
                        $catKey = strtolower($a->category ?? '');
                        $catColor = $categoryColors[$catKey] ?? 'bg-gray-100 text-gray-800';
                        $companyName = $companies[$a->company_code] ?? 'Organization';
                    @endphp

                    <a href="{{ route('activities.show', $a->id) }}">
                        <div class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow
                                    hover:shadow-2xl hover:-translate-y-1 transition-all duration-300
                                    border border-transparent hover:border-green-300 h-full flex flex-col">

                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ img($a) }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition">

                                <div class="absolute top-2 left-2 flex gap-1">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Ongoing
                                    </span>

                                    @if($a->category)
                                        <span class="px-2 py-1 text-xs rounded {{ $catColor }}">
                                            {{ $a->category }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 flex flex-col flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $a->title }}
                                </h4>

                                <p class="text-sm text-gray-500 mt-2 line-clamp-3">
                                    {{ $a->description }}
                                </p>

                                <p class="text-sm text-gray-700 mt-3">
                                    🏢 {{ $companyName }}
                                </p>

                                <div class="mt-auto pt-3 text-xs text-gray-500 border-t flex">
                                    <span class="mr-auto">
                                        📅 {{ \Carbon\Carbon::parse($a->start_date)->format('d M Y') }}
                                    </span>

                                    <span>
                                        👤 {{ $a->registrations()->count() }}/{{ $a->quota ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ================= UPCOMING ================= --}}
        @if($upcoming->count())
        <section>
            <h3 class="text-2xl font-bold mb-5">⏳ Upcoming Activities</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($upcoming as $a)
                    @php
                        $catKey = strtolower($a->category ?? '');
                        $catColor = $categoryColors[$catKey] ?? 'bg-gray-100 text-gray-800';
                        $companyName = $companies[$a->company_code] ?? 'Organization';
                    @endphp

                    <a href="{{ route('activities.show', $a->id) }}">
                        <div class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow
                                    hover:shadow-xl hover:-translate-y-1 transition
                                    border border-transparent hover:border-yellow-300 h-full flex flex-col">

                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ img($a) }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition">

                                <div class="absolute top-2 left-2 flex gap-1">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Upcoming
                                    </span>

                                    @if($a->category)
                                        <span class="px-2 py-1 text-xs rounded {{ $catColor }}">
                                            {{ $a->category }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 flex flex-col flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $a->title }}
                                </h4>

                                <p class="text-sm text-gray-500 mt-2 line-clamp-3">
                                    {{ $a->description }}
                                </p>

                                <p class="text-sm text-gray-700 mt-3">
                                    🏢 {{ $companyName }}
                                </p>

                                <div class="mt-auto pt-3 text-xs text-gray-500 border-t">
                                    🕒 Starts {{ \Carbon\Carbon::parse($a->start_date)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ================= PAST ================= --}}
        @if($ended->count())
        <section>
            <h3 class="text-2xl font-bold mb-5">❌ Past Activities</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 opacity-70">
                @foreach($ended as $a)
                    @php
                        $companyName = $companies[$a->company_code] ?? 'Organization';
                    @endphp

                    <a href="{{ route('activities.show', $a->id) }}">
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow border h-full flex flex-col">
                            <div class="h-48 grayscale">
                                <img src="{{ img($a) }}" class="w-full h-full object-cover">
                            </div>

                            <div class="p-4 flex flex-col flex-1">
                                <h4 class="font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $a->title }}
                                </h4>

                                <p class="text-sm text-gray-600 mt-2">
                                    🏢 {{ $companyName }}
                                </p>

                                <div class="mt-auto pt-3 text-xs text-gray-500 border-t">
                                    Ended on {{ \Carbon\Carbon::parse($a->end_date)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

    </div>
</x-app-layout>
