<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Give2Grow
        </h2>
    </x-slot>

    @php
        $activities = \App\Models\Activity::latest('start_date')->take(6)->get();
        $recentActivities = \App\Models\Activity::latest('start_date')->take(9)->get();

        $activitiesCount = \App\Models\Activity::count();
        $orgCount = \App\Models\Company::count();

        function activity_image($a) {
            if (!$a || empty($a->image_url)) return asset('images/default.jpg');
            if (filter_var($a->image_url, FILTER_VALIDATE_URL)) return $a->image_url;
            return asset($a->image_url);
        }
    @endphp

    <div class="py-8 space-y-20">

        {{-- ================= HERO CAROUSEL ================= --}}
        <section>
            <div class="relative overflow-hidden rounded-[2.5rem] shadow-2xl">
                <div id="carouselInner" class="flex transition-transform duration-700">
                    @foreach($activities as $a)
                        <div class="min-w-full relative">
                            <img src="{{ activity_image($a) }}"
                                 class="w-full h-[520px] object-cover">

                            {{-- layered overlay --}}
                            <div class="absolute inset-0
                                        bg-gradient-to-r
                                        from-indigo-900/60
                                        via-purple-900/30
                                        to-transparent"></div>

                            {{-- TEXT --}}
                            <div class="absolute bottom-16 left-16 text-white max-w-xl">
                                <span class="inline-block mb-4 px-4 py-1
                                             bg-gradient-to-r from-indigo-500 to-purple-500
                                             rounded-full text-xs font-semibold shadow">
                                    {{ $a->category ?? 'Activity' }}
                                </span>

                                <h3 class="text-5xl font-black mb-4 leading-tight drop-shadow-xl">
                                    {{ $a->title }}
                                </h3>

                                <p class="mb-8 text-lg opacity-95 drop-shadow">
                                    {{ \Illuminate\Support\Str::limit($a->description, 120) }}
                                </p>

                                <a href="{{ route('activities.show', $a->id) }}"
                                   class="inline-flex items-center px-9 py-4
                                          bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600
                                          text-white font-bold rounded-2xl shadow-2xl
                                          hover:scale-105 transition">
                                    View Activity →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ================= QUICK STATS ================= --}}
        <section class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Activities --}}
                <div class="relative p-9 rounded-3xl
                            bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-600
                            text-white shadow-2xl overflow-hidden
                            transition-all duration-300
                            hover:-translate-y-2 hover:shadow-3xl">
                    <div class="absolute -top-10 -right-10 text-white/20 text-[120px]">🤝</div>
                    <p class="uppercase tracking-widest text-sm opacity-80">Activities</p>
                    <h3 class="text-5xl font-black my-2">{{ $activitiesCount }}</h3>
                    <p class="text-lg">Volunteer Programs</p>
                </div>

                {{-- Organizations --}}
                <div class="relative p-9 rounded-3xl
                            bg-gradient-to-br from-emerald-500 via-teal-500 to-green-500
                            text-white shadow-2xl overflow-hidden
                            transition-all duration-300
                            hover:-translate-y-2 hover:shadow-3xl">
                    <div class="absolute -top-10 -right-10 text-white/20 text-[120px]">🏢</div>
                    <p class="uppercase tracking-widest text-sm opacity-80">Partners</p>
                    <h3 class="text-5xl font-black my-2">{{ $orgCount }}</h3>
                    <p class="text-lg">Organizations</p>
                </div>

                {{-- Impact --}}
                <div class="relative p-9 rounded-3xl
                            bg-gradient-to-br from-amber-400 via-yellow-400 to-orange-500
                            text-gray-900 shadow-2xl overflow-hidden
                            transition-all duration-300
                            hover:-translate-y-2 hover:shadow-3xl">
                    <div class="absolute -top-10 -right-10 text-black/20 text-[120px]">🌍</div>
                    <p class="uppercase tracking-widest text-sm opacity-80">Impact</p>
                    <h3 class="text-5xl font-black my-2">100%</h3>
                    <p class="text-lg">Positive Change</p>
                </div>

            </div>
        </section>

        {{-- ================= MAIN ACTION CARDS ================= --}}
        <section class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Activities --}}
                <a href="{{ route('activities.index') }}" class="group">
                    <div class="relative bg-white dark:bg-gray-800 p-8 rounded-2xl
                                shadow hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <div class="w-14 h-14 rounded-full
                                    bg-indigo-100 text-indigo-600
                                    flex items-center justify-center mb-6">
                            🔍
                        </div>
                        <h3 class="text-xl font-bold mb-2">Find Activities</h3>
                        <p class="text-gray-500 mb-4">
                            Discover opportunities that match your passion.
                        </p>
                        <span class="inline-block text-sm px-3 py-1 rounded
                                     bg-indigo-50 text-indigo-700">
                            {{ $activitiesCount }} activities
                        </span>
                    </div>
                </a>

                {{-- Organizations --}}
                <a href="{{ route('organizations.index') }}" class="group">
                    <div class="relative bg-white dark:bg-gray-800 p-8 rounded-2xl
                                shadow hover:shadow-2xl transition duration-300 hover:-translate-y-1">
                        <div class="w-14 h-14 rounded-full
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center mb-6">
                            🏢
                        </div>
                        <h3 class="text-xl font-bold mb-2">Find Organizations</h3>
                        <p class="text-gray-500 mb-4">
                            Explore trusted partners making impact.
                        </p>
                        <span class="inline-block text-sm px-3 py-1 rounded
                                     bg-emerald-50 text-emerald-700">
                            {{ $orgCount }} organizations
                        </span>
                    </div>
                </a>

                {{-- Donations --}}
                <a href="{{ url('/donations') }}" class="group">
                    <div class="relative bg-white dark:bg-gray-800 p-8 rounded-2xl
                                shadow hover:shadow-2xl transition duration-300 hover:-translate-y-1">
                        <div class="w-14 h-14 rounded-full
                                    bg-amber-100 text-amber-600
                                    flex items-center justify-center mb-6">
                            💛
                        </div>
                        <h3 class="text-xl font-bold mb-2">Donations</h3>
                        <p class="text-gray-500 mb-4">
                            Support causes through transparent giving.
                        </p>
                        <span class="inline-block text-sm px-3 py-1 rounded
                                     bg-amber-50 text-amber-700">
                            Support now
                        </span>
                    </div>
                </a>

            </div>
        </section>

        {{-- ================= LATEST ACTIVITIES ================= --}}
        <section>
            <h3 class="text-3xl font-extrabold mb-10">Latest Activities</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($recentActivities as $a)
                    <a href="{{ route('activities.show', $a->id) }}"
                       class="group bg-white dark:bg-gray-800 rounded-2xl
                              shadow hover:-translate-y-1 hover:shadow-2xl transition duration-300
                              h-full flex flex-col">
                        <img src="{{ activity_image($a) }}"
                             class="w-full h-48 object-cover rounded-t-2xl">

                        <div class="p-5 space-y-2">
                            <span class="inline-block text-xs px-3 py-1
                                         bg-gradient-to-r from-indigo-500 via-purple-500 to-blue-500
                                         text-white rounded-full">
                                {{ $a->category }}
                            </span>

                            <h4 class="font-bold text-lg">
                                {{ $a->title }}
                            </h4>

                            <div class="mt-auto pt-3 border-t text-xs text-gray-500">
                                <div class="grid grid-cols-3 items-center text-center">
                                    <div class="flex items-center justify-start gap-1">
                                        <span class="leading-none">📅</span>
                                        <span>{{ \Carbon\Carbon::parse($a->start_date)->format('d M Y') }}</span>
                                    </div>

                                    <div class="flex items-center justify-center gap-1 truncate">
                                        <span class="leading-none">🏢</span>
                                        <span class="truncate">
                                            {{ $companies[$a->company_code] ?? $a->organizer ?? 'Organization' }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-end gap-1">
                                        <span class="leading-none">👤</span>
                                        <span>{{ $a->registrations()->count() }}/{{ $a->quota ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- ================= BIG CTA ================= --}}
        <section class="bg-gradient-to-br from-indigo-700 via-purple-700 to-blue-700 py-32">
            <div class="max-w-4xl mx-auto text-center text-white px-4">
                <h3 class="text-5xl font-black mb-6 drop-shadow-xl">
                    Ready to Grow Together?
                </h3>
                <p class="opacity-90 text-xl mb-12">
                    Join volunteers creating meaningful change.
                </p>

                <div class="flex justify-center gap-6 flex-wrap">
                    <a href="{{ route('activities.index') }}"
                       class="px-10 py-4 bg-white text-indigo-700
                              rounded-2xl font-bold shadow-xl
                              hover:scale-105 transition">
                        Find Activities
                    </a>
                    <a href="{{ route('organizations.index') }}"
                       class="px-10 py-4 border-2 border-white
                              rounded-2xl font-bold
                              hover:bg-white hover:text-indigo-700 transition">
                        Explore Organizations
                    </a>
                </div>
            </div>
        </section>

    </div>

    {{-- AUTO SLIDE --}}
    <script>
        const inner = document.getElementById('carouselInner');
        let index = 0;
        const total = inner.children.length;

        setInterval(() => {
            index = (index + 1) % total;
            inner.style.transform = `translateX(-${index * 100}%)`;
        }, 4500);
    </script>
</x-app-layout>
