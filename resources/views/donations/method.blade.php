<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Choose Amount</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-12 px-4">
        <div class="bg-white p-8 rounded-2xl shadow border">

            <h3 class="text-lg font-semibold mb-2">
                Donation via {{ $method }}
            </h3>
            <p class="text-slate-600 mb-6">
                Select the amount you want to donate.
            </p>

            <div class="grid grid-cols-2 gap-4 mb-8">
                @foreach([50000, 100000, 250000, 500000] as $amount)
                    <a href="{{ route('donations.checkout', [
                            'method' => $method,
                            'amount' => $amount
                        ]) }}"
                       class="text-center py-3 rounded-xl border hover:border-indigo-500 hover:bg-indigo-50 font-medium">
                        Rp {{ number_format($amount,0,',','.') }}
                    </a>
                @endforeach
            </div>

            <a href="{{ route('donations.index') }}"
               class="text-sm text-slate-500 hover:underline">
                ← Back to donation methods
            </a>

        </div>
    </div>
</x-app-layout>
