<x-app-layout>
    <div class="max-w-xl mx-auto py-20 text-center">
        <div class="bg-white p-10 rounded-2xl shadow border">

            <h2 class="text-2xl font-bold text-indigo-600 mb-4">
                Thank You 💜
            </h2>

            <p class="text-slate-600 mb-6">
                Your donation of
                <strong>Rp {{ number_format($amount,0,',','.') }}</strong>
                has been recorded.
            </p>

            <a href="{{ route('donations.index') }}"
               class="inline-block px-6 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700">
                Back to Donations
            </a>

        </div>
    </div>
</x-app-layout>
