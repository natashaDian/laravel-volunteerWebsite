<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Points History
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-4">

        <div class="mb-6 p-4 rounded-lg bg-purple-50 border border-purple-200">
            <strong>Your Total Points:</strong>
            <span class="text-purple-700 font-semibold">
                {{ auth()->user()->total_points }}
            </span>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions as $tx)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $tx->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ ucfirst($tx->source_type) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $tx->description }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 text-right
                                {{ $tx->points > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $tx->points > 0 ? '+' : '' }}{{ $tx->points }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No transactions yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
