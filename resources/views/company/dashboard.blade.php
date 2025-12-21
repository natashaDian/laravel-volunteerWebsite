<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hello {{ auth('company')->user()->name }} !
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @foreach ($activities as $activity)

                    @php
                        $today = \Carbon\Carbon::today();

                        if ($activity->end_date && \Carbon\Carbon::parse($activity->end_date)->lt($today)) {
                            $status = 'past';
                            $badge = 'Past';
                            $badgeClass = 'bg-gray-200 text-gray-600';
                            $rowClass = 'opacity-50 grayscale';
                        } elseif (\Carbon\Carbon::parse($activity->start_date)->gt($today)) {
                            $status = 'upcoming';
                            $badge = 'Upcoming';
                            $badgeClass = 'bg-yellow-100 text-yellow-800';
                            $rowClass = '';
                        } else {
                            $status = 'ongoing';
                            $badge = 'Ongoing';
                            $badgeClass = 'bg-green-100 text-green-800';
                            $rowClass = '';
                        }
                    @endphp

                    <div class="flex items-center gap-4 border-b border-gray-300 py-4 {{ $rowClass }}">

                        {{-- LEFT: IMAGE --}}
                        <img src="{{ $activity->image_src }}"
                             alt="activity image"
                             class="object-cover rounded-lg w-28 h-28">

                        {{-- MIDDLE: INFO --}}
                        <div class="flex-1 flex flex-col justify-center">
                            <p class="font-bold text-lg text-gray-900 dark:text-white">
                                {{ $activity->title }}
                            </p>

                            <span class="inline-block w-fit mt-1 px-2 py-1 text-xs font-semibold rounded {{ $badgeClass }}">
                                {{ $badge }}
                            </span>

                            <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                                {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}
                            </p>
                        </div>

                        {{-- RIGHT: ACTION BUTTON --}}
                        <div class="flex items-center gap-2">

                            @if ($status !== 'past')
                                <a href="{{ route('company.activities.edit', $activity->id) }}"
                                   class="px-3 py-1 text-sm bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                                    Edit
                                </a>
                            @endif

                            <form action="{{ route('company.activities.destroy', $activity->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this activity?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-3 py-1 text-sm bg-red-600 text-white rounded">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
