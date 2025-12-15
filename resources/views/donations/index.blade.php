<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Donations</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-12 px-4">

        {{-- HERO --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-indigo-600 mb-3">
                Support Give2Grow 💜💙
            </h1>
            <p class="text-slate-600 max-w-2xl mx-auto">
                Your contribution helps communities grow through meaningful activities.
            </p>
        </div>

        {{-- DONATION METHODS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            @foreach($methods as $m)
                <div class="bg-white p-6 rounded-2xl shadow border">
                    <h3 class="text-lg font-semibold mb-1">{{ $m['name'] }}</h3>
                    <p class="text-sm text-slate-600 mb-6">{{ $m['detail'] }}</p>

                    {{-- 🔥 BUTTON FIX --}}
                    <a href="{{ route('donations.method', ['method' => $m['name']]) }}"
                    class="block text-center py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700">
                        Donate via {{ $m['name'] }}
                    </a>

                </div>
            @endforeach
        </div>
        
        </div>

    </div>
</x-app-layout>
