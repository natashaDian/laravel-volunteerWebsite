<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Organizations
        </h2>
    </x-slot>

    {{-- PAGE WRAPPER --}}
    <div class="max-w-7xl mx-auto pt-16 pb-12 px-4 space-y-10">

        {{-- HEADER + SEARCH --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                    Partner Organizations
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Browse organizations that need volunteers.
                </p>
            </div>

            <form method="GET" action="{{ route('organizations.index') }}"
                  class="flex gap-2 w-full md:w-auto">
                <input
                    name="q"
                    value="{{ $q ?? '' }}"
                    placeholder="Search organizations..."
                    class="px-4 py-2 border border-gray-300 rounded-xl
                           w-full md:w-72
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                />
                <button
                    class="px-5 py-2 bg-indigo-600 text-white
                           rounded-xl font-semibold hover:bg-indigo-700 transition">
                    Search
                </button>
            </form>
        </div>

        {{-- ORGANIZATION LIST --}}
        <div class="space-y-8">
            @forelse($companies as $company)

                @php
                    /**
                     * IMAGE DETECTION LOGIC
                     * 1. company->logo
                     * 2. public/img/{normalized_name}.(png|jpg|jpeg|webp)
                     * 3. default image
                     */

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

                <a href="{{ route('organizations.show', $company->id) }}"
                   class="block group">

                    <div class="relative bg-white dark:bg-gray-800
                                rounded-2xl p-6
                                shadow-md hover:shadow-2xl
                                transition hover:-translate-y-1">

                        {{-- LEFT ACCENT --}}
                        <div class="absolute left-0 top-6 bottom-6 w-1
                                    rounded-full bg-indigo-500/30"></div>

                        <div class="flex flex-col lg:flex-row gap-6">

                            {{-- LOGO --}}
                            <div class="flex-shrink-0 w-full lg:w-44">
                                <div class="h-32 lg:h-28 rounded-xl overflow-hidden
                                            bg-white p-4
                                            ring-1 ring-gray-200
                                            flex items-center justify-center">

                                    <img src="{{ $imgPath }}"
                                         alt="{{ $company->name }}"
                                         class="w-full h-full object-cover
                                                group-hover:scale-105 transition">
                                </div>
                            </div>

                            {{-- CONTENT --}}
                            <div class="flex-1 flex flex-col justify-between">

                                {{-- TOP --}}
                                <div class="flex flex-col md:flex-row md:justify-between gap-4">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 dark:text-white">
                                            {{ $company->name }}
                                        </h4>
                                        <p class="text-xs uppercase tracking-widest text-gray-400 mt-1">
                                            {{ $company->company_code }}
                                        </p>
                                    </div>

                                    {{-- STATUS BADGES --}}
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center gap-1.5
                                                     px-4 py-1.5 rounded-full
                                                     bg-emerald-50 text-emerald-700
                                                     text-xs font-semibold
                                                     border border-emerald-200">
                                            ● {{ $company->ongoing_count ?? 0 }} Ongoing
                                        </span>

                                        <span class="inline-flex items-center gap-1.5
                                                     px-4 py-1.5 rounded-full
                                                     bg-amber-50 text-amber-700
                                                     text-xs font-semibold
                                                     border border-amber-200">
                                            ● {{ $company->upcoming_count ?? 0 }} Upcoming
                                        </span>
                                    </div>
                                </div>

                                {{-- ADDRESS --}}
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-4 line-clamp-2">
                                    {{ $company->address ?? 'Address not provided.' }}
                                </p>

                                {{-- FOOTER --}}
                                <div class="mt-5 flex flex-wrap items-center gap-4
                                            text-sm text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center gap-2">
                                        📞
                                        <span class="font-medium text-gray-800 dark:text-gray-200">
                                            {{ $company->phone ?? '-' }}
                                        </span>
                                    </span>

                                    <span class="hidden sm:inline">•</span>

                                    <span class="flex items-center gap-2">
                                        ✉️ {{ $company->email ?? '-' }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>

            @empty
                <p class="text-gray-500">No organizations found.</p>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $companies->links() }}
        </div>

    </div>
</x-app-layout>
