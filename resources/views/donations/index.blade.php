<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Donations</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-4">Support Give2Grow</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">
                Thank you for supporting Give2Grow. Choose a method below to donate.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($methods as $m)
                    <div class="border rounded-lg p-4">
                        <div class="font-semibold">{{ $m['name'] }}</div>
                        <div class="text-sm text-gray-600 mt-1">{{ $m['detail'] }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-sm text-gray-500">
                Want to integrate online payments? Let me know and I can add a Stripe/PayPal integration example.
            </div>
        </div>
    </div>
</x-app-layout>
