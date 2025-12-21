<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Edit Activity
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10">
        <form method="POST"
              action="{{ route('company.activities.update', $activity->id) }}"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded-lg shadow space-y-4">

            @csrf
            @method('PUT')

            <div>
                <label class="text-sm">Title</label>
                <input type="text" name="title"
                       value="{{ $activity->title }}"
                       class="w-full border rounded p-2">
            </div>

            <div>
                <label class="text-sm">Description</label>
                <textarea name="description"
                          class="w-full border rounded p-2">{{ $activity->description }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm">Start Date</label>
                    <input type="date" name="start_date"
                           value="{{ $activity->start_date }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="text-sm">End Date</label>
                    <input type="date" name="end_date"
                           value="{{ $activity->end_date }}"
                           class="w-full border rounded p-2">
                </div>
            </div>

            <div>
                <label class="text-sm">Image (optional)</label>
                <input type="file" name="image"
                       class="w-full border rounded p-2">
            </div>

            {{-- preview image --}}
            <img src="{{ $activity->image_src }}"
                 class="w-40 h-40 object-cover rounded">

            <div class="flex justify-end gap-2">
                <a href="{{ route('company.dashboard') }}"
                   class="px-4 py-2 border rounded">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
