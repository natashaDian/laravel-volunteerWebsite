<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Organizations</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 space-y-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Partner Organizations</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Browse organizations that need volunteers.</p>
            </div>

            <form method="GET" action="{{ route('organizations.index') }}" class="flex gap-2 w-full md:w-auto">
                <input name="q" value="{{ $q ?? '' }}" placeholder="Search organizations..." class="px-3 py-2 border rounded w-full md:w-72" />
                <button class="px-3 py-2 bg-indigo-600 text-white rounded">Search</button>
            </form>
        </div>

        <div class="space-y-4">
            @forelse($companies as $company)
                <a href="{{ route('organizations.show', $company->id) }}" class="block">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow hover:shadow-lg transition">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            {{-- LEFT: logo / image --}}
                            <div class="flex-shrink-0 w-full sm:w-36 h-36 sm:h-24 rounded overflow-hidden bg-gray-100 dark:bg-gray-700">
                                @php
                                    // choose image: prefer company->logo (if exists), then public/img/company-<code>.jpg, else default
                                    $logo = $company->logo ?? null;
                                    $imgPath = $logo ? (filter_var($logo, FILTER_VALIDATE_URL) ? $logo : asset($logo)) : (file_exists(public_path("img/company-{$company->company_code}.jpg")) ? asset("img/company-{$company->company_code}.jpg") : asset('images/company-default.jpg'));
                                @endphp
                                <img src="{{ $imgPath }}" alt="{{ $company->name }}" class="w-full h-full object-cover">
                            </div>

                            {{-- RIGHT: info --}}
                            <div class="flex-1 w-full">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white leading-tight">
                                            {{ $company->name }}
                                        </h4>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ $company->company_code }}
                                        </div>
                                    </div>

                                    <div class="text-right sm:text-right">
                                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-800 text-sm font-medium">
                                            {{-- show open events count --}}
                                            {{ $company->activities_count ?? 0 }} open {{ \Illuminate\Support\Str::plural('event', $company->activities_count ?? 0) }}
                                        </div>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-3 line-clamp-3">
                                    {{ $company->address ?? 'Address not provided.' }}
                                </p>

                                <div class="mt-4 flex items-center gap-3">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        <strong class="text-gray-800 dark:text-gray-200">{{ $company->phone ?? '-' }}</strong>
                                    </span>

                                    <span class="text-sm text-gray-500 dark:text-gray-400">•</span>

                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $company->email ?? '' }}
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

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>
