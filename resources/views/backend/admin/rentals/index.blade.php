@extends('backend.layout.master')
@section('title', 'Rentals')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Rentals</h1>

    <div class="overflow-x-auto bg-white dark:bg-[#161615] rounded-lg shadow">
        <table class="min-w-full text-left">
            <thead class="text-sm uppercase text-gray-500 dark:text-gray-300">
            <tr>
                <th class="px-4 py-3">#</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Vehicle</th>
                <th class="px-4 py-3">Start</th>
                <th class="px-4 py-3">End</th>
                <th class="px-4 py-3">Total Cost</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            @forelse($rentals as $rental)
                <tr class="text-sm">
                    <td class="px-4 py-3">{{ $rental->id }}</td>

                    {{-- Customer Info --}}
                    <td class="px-4 py-3">
                        {{ optional($rental->customer)->name ?? '—' }}<br>
                        <span class="text-xs text-gray-500">{{ optional($rental->customer)->email }}</span>
                    </td>

                    {{-- Vehicle Info --}}
                    <td class="px-4 py-3">
                        @if($rental->vehicle)
                            {{ $rental->vehicle->plate_number }}
                            — {{ $rental->vehicle->make }} {{ $rental->vehicle->model }}
                        @else
                            —
                        @endif
                    </td>

                    {{-- Dates --}}
                    <td class="px-4 py-3">{{ $rental->start_date }}</td>
                    <td class="px-4 py-3">{{ $rental->end_date }}</td>

                    {{-- Total --}}
                    <td class="px-4 py-3 font-semibold">
                        ${{ number_format($rental->total_cost, 2) }}
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs
                                @class([
                                    'bg-yellow-100 text-yellow-800' => $rental->status === 'pending',
                                    'bg-blue-100 text-blue-800'     => $rental->status === 'approved',
                                    'bg-green-100 text-green-800'   => $rental->status === 'completed',
                                    'bg-red-100 text-red-800'       => $rental->status === 'cancelled',
                                ])
                            ">
                                {{ ucfirst($rental->status) }}
                            </span>
                    </td>

                    {{-- Actions --}}
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.rentals.edit', $rental) }}"
                           class="text-blue-600 hover:underline mr-2">
                            Edit
                        </a>

                        <form action="{{ route('admin.rentals.destroy', $rental) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Delete this rental?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-6 text-center text-gray-500" colspan="8">
                        No rentals yet.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $rentals->links() }}
    </div>
@endsection
