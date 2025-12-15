<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Donation Checkout
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-12 px-4">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- LEFT : SUMMARY --}}
            <div class="md:col-span-2">
                <div class="bg-white p-8 rounded-2xl shadow border">

                    <h3 class="text-lg font-semibold mb-6">
                        Donation Details
                    </h3>

                    {{-- METHOD --}}
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-slate-600">Payment Method</span>
                        <span class="font-medium text-indigo-600">
                            {{ request('method') }}
                        </span>
                    </div>

                    {{-- AMOUNT --}}
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-slate-600">Donation Amount</span>
                        <span class="font-semibold text-indigo-600 text-lg">
                            Rp {{ number_format($amount,0,',','.') }}
                        </span>
                    </div>

                    <hr class="my-6">

                    {{-- NOTE --}}
                    <p class="text-sm text-slate-500">
                        This is a donation simulation. No real payment will be processed.
                    </p>
                </div>
            </div>

            {{-- RIGHT : ACTION --}}
            <div>
                <div class="bg-white p-6 rounded-2xl shadow border sticky top-24">

                    <h4 class="font-semibold mb-4">
                        Confirm Donation
                    </h4>

                    <div class="flex justify-between mb-6 text-sm">
                        <span>Total</span>
                        <span class="font-semibold text-indigo-600">
                            Rp {{ number_format($amount,0,',','.') }}
                        </span>
                    </div>

                    <form method="POST" action="{{ route('donations.confirm') }}">
                        @csrf

                        <input type="hidden" name="method" value="{{ request('method') }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">

                        <button type="submit"
                                class="w-full py-3 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700">
                            Confirm Donation
                        </button>
                    </form>


                    <a href="{{ route('donations.method', ['method' => request('method')]) }}"
                       class="block text-center text-sm text-slate-500 mt-4 hover:underline">
                        ← Change Amount
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
