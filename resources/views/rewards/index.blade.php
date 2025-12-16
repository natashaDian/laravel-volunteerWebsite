<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Reward Catalog
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-4">

        {{-- USER POINT --}}
        <div class="mb-6 p-4 rounded-lg bg-purple-50 border border-purple-200">
            <strong>Your Points:</strong>
            <span class="text-purple-700 font-semibold">
                {{ auth()->user()->total_points }}
            </span>
        </div>

        {{-- FLASH --}}
        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-800 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        {{-- REWARD GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($rewards as $reward)
                <div class="bg-white rounded-xl shadow
                            hover:shadow-xl transition
                            flex flex-col overflow-hidden">

                    <img src="{{ $reward->image_url ?? asset('images/reward-default.jpg') }}"
                         class="h-40 w-full object-cover">

                    <div class="p-4 flex flex-col flex-1">
                        <h4 class="font-semibold text-gray-900">
                            {{ $reward->name }}
                        </h4>

                        <p class="text-sm text-gray-500 mt-2">
                            {{ $reward->description }}
                        </p>

                        <div class="mt-auto pt-4">
                            <div class="text-sm font-semibold mb-2">
                                {{ $reward->required_points }} Points
                            </div>

                            <button type="button"
                                onclick="document.getElementById('redeemModal-{{ $reward->id }}').classList.remove('hidden')"
                                @disabled(auth()->user()->total_points < $reward->required_points)
                                class="w-full py-2 rounded-lg font-semibold
                                {{ auth()->user()->total_points >= $reward->required_points
                                    ? 'bg-indigo-600 hover:bg-indigo-700 text-white'
                                    : 'bg-gray-300 text-gray-600 cursor-not-allowed' }}">

                                Redeem
                            </button>
                        </div>
                    </div>
                </div>

                {{-- REDEEM MODAL --}}
                <div id="redeemModal-{{ $reward->id }}" class="fixed inset-0 z-50 hidden flex items-center justify-center">
                    <div class="absolute inset-0 bg-black/50"onclick="document.getElementById('redeemModal-{{ $reward->id }}').classList.add('hidden')">
                    </div>

                    <div class="bg-white rounded-lg p-6 w-full max-w-md z-10">
                        <h3 class="text-lg font-semibold mb-3">
                            Confirm Redemption
                        </h3>

                        <p class="text-sm text-gray-600 mb-4">
                            Are you sure you want to redeem
                            <strong>{{ $reward->name }}</strong>
                            for <strong>{{ $reward->required_points }} points</strong>?
                        </p>

                        {{-- size button cancel masih perlu diperbaiki --}}
                        <div class="flex justify-end gap-2">
                            <button
                                onclick="document.getElementById('redeemModal-{{ $reward->id }}').classList.add('hidden')"
                                class="px-4 py-2 border rounded-lg">
                                Cancel
                            </button>

                            <form method="POST" action="{{ route('rewards.redeem', $reward) }}">
                                @csrf
                                <button type="submit"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                                    Confirm Redeem
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</x-app-layout>
