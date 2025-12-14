<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-16 pb-14 px-4 space-y-14">

        {{-- ================= ORGANIZATION HEADER ================= --}}
        <div class="relative rounded-3xl shadow-xl overflow-hidden">

            {{-- GRADIENT BACKGROUND --}}
            <div class="absolute inset-0
                        bg-gradient-to-br
                        from-indigo-600 via-purple-600 to-violet-600
                        opacity-90"></div>

            {{-- CONTENT --}}
            <div class="relative bg-white/90 dark:bg-gray-900/80 backdrop-blur
                        p-10 rounded-3xl">

                <div class="flex flex-col lg:flex-row gap-10 items-start">

                    {{-- LOGO --}}
                    @php
                        $imgPath = asset('images/company-default.jpg');

                        if (!empty($company->logo)) {
                            $imgPath = filter_var($company->logo, FILTER_VALIDATE_URL)
                                ? $company->logo
                                : asset($company->logo);
                        } else {
                            $normalized = strtolower($company->name);
                            $normalized = preg_replace('/[^a-z0-9]+/', '_', $normalized);
                            $normalized = trim($normalized, '_');

                            foreach (['png','jpg','jpeg','webp'] as $ext) {
                                if (file_exists(public_path("img/{$normalized}.{$ext}"))) {
                                    $imgPath = asset("img/{$normalized}.{$ext}");
                                    break;
                                }
                            }
                        }
                    @endphp

                    <div class="w-full lg:w-56">
                        <div class="h-44 rounded-2xl bg-white
                                    ring-2 ring-indigo-200
                                    p-5 flex items-center justify-center
                                    shadow-md">
                            <img src="{{ $imgPath }}"
                                 alt="{{ $company->name }}"
                                 class="w-full h-full object-cover rounded-xl">
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="flex-1 space-y-5">

                        <div>
                            <h1 class="text-4xl font-black text-indigo-700 dark:text-indigo-300">
                                {{ $company->name }}
                            </h1>
                            <p class="text-xs uppercase tracking-widest text-indigo-400 mt-1">
                                {{ $company->company_code }}
                            </p>
                        </div>

                        <p class="text-gray-700 dark:text-gray-300 max-w-3xl">
                            {{ $company->address ?? 'Address not provided.' }}
                        </p>

                        <div class="flex flex-wrap gap-6 text-sm text-gray-700 dark:text-gray-400">
                            <span class="flex items-center gap-2">
                                📞 <strong class="text-gray-900 dark:text-gray-200">
                                    {{ $company->phone ?? '-' }}
                                </strong>
                            </span>

                            <span class="flex items-center gap-2">
                                ✉️ {{ $company->email ?? '-' }}
                            </span>
                        </div>

                        {{-- STATS (UNCHANGED STYLE) --}}
                        <div class="flex gap-4 pt-4">
                            <span class="px-5 py-2 rounded-full bg-emerald-100 text-emerald-800 text-sm font-semibold">
                                {{ $ongoingCount ?? 0 }} Ongoing Activities
                            </span>
                            <span class="px-5 py-2 rounded-full bg-amber-100 text-amber-800 text-sm font-semibold">
                                {{ $upcomingCount ?? 0 }} Upcoming Activities
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= ACTIVITIES SECTION ================= --}}
        <section class="space-y-8">

            <h3 class="text-2xl font-bold text-indigo-700 dark:text-indigo-300">
                Activities by {{ $company->name }}
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($activities as $activity)
                    <a href="{{ route('activities.show', $activity->id) }}"
                       class="group relative rounded-2xl p-6
                              bg-gradient-to-br
                              from-indigo-50 via-purple-50 to-violet-50
                              dark:from-gray-800 dark:via-gray-800 dark:to-gray-800
                              shadow hover:shadow-2xl
                              transition hover:-translate-y-1">

                        {{-- TOP ACCENT --}}
                        <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl
                                    bg-gradient-to-r from-indigo-500 to-purple-500"></div>

                        <h4 class="font-bold text-lg text-gray-900 dark:text-white
                                   group-hover:text-indigo-600 transition">
                            {{ $activity->title }}
                        </h4>

                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}
                        </p>

                        <div class="mt-5 inline-flex items-center gap-2
                                    text-sm text-indigo-600 font-semibold">
                            View Details →
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500 col-span-full">
                        No activities available for this organization.
                    </p>
                @endforelse
            </div>
        </section>

    </div>
</x-app-layout>
