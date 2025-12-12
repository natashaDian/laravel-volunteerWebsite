<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $company->name }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <div class="mb-4">
                <div class="text-sm text-gray-500">{{ $company->company_code }}</div>
                <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $company->address ?? 'Address not provided.' }}</p>
                @if(!empty($company->phone))
                    <p class="text-sm text-gray-500 mt-1">Phone: {{ $company->phone }}</p>
                @endif
            </div>

            <hr class="my-4">

            <h3 class="text-lg font-semibold mb-4">Activities by {{ $company->name }}</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($activities as $activity)
                    <a href="{{ route('activities.show', $activity->id) }}" class="block">
                        <div class="border rounded-lg p-3 bg-gray-50 dark:bg-gray-700">
                            <div class="font-semibold">{{ $activity->title }}</div>
                            <div class="text-xs text-gray-500">{{ $activity->start_date ? \Carbon\Carbon::parse($activity->start_date)->format('d M Y') : '-' }}</div>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">No activities listed for this organization.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
