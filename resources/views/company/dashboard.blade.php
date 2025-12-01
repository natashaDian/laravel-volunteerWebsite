<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hello {{ __(auth('company')->user()->name) }} !
        </h2>
    </x-slot>

     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @foreach ($events as $event)

                    @php
                        $registered = $event->registrations->count();   // jumlah user yang daftar
                        $quota = $event->quota;
                        $percentage = $quota > 0 ? ($registered / $quota) * 100 : 0;
                    @endphp

                    <div class="flex items-center gap-4 border-b border-gray-300 py-4">
                        {{-- LEFT: IMAGE --}}
                        <img src="https://picsum.photos/120/120?random={{ $event->id }}"
                            alt="event image"
                            class="object-cover rounded-lg w-28 h-28">

                        {{-- MIDDLE: INFO --}}
                        <div class="flex-1 flex flex-col justify-center">
                            <p class="font-bold text-lg text-gray-900 dark:text-white">
                                {{ $event->title }}
                            </p>

                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">
                                {{ $event->date }} — Quota: {{ $registered }}/{{ $quota }}
                            </p>

                            {{-- PROGRESS BAR --}}
                            <div class="w-2/5 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>

                        {{-- RIGHT SIDE SMALL BUTTON --}}
                        <div class="flex items-center gap-2">
                            <a href="{{ route('company.events.edit', $event->id) }}"
                                class="px-3 py-1 text-sm bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                                Edit
                            </a>
                            <form action="{{ route('company.events.delete', $event->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this event?')">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit"
                                    class="px-3 py-1 text-sm bg-red-600 hover:bg-red-700 text-white rounded-md">
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
