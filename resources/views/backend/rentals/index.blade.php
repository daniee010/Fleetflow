@extends('backend.layout.master')
@section('title', 'Rentals')

@section('content')
    <h1 class="text-xl font-bold mb-4">Rentals</h1>

    <table class="min-w-full text-left border-collapse">
        <thead>
        <tr class="border-b">
            <th class="py-2 px-3">Customer</th>
            <th class="py-2 px-3">Vehicle</th>
            <th class="py-2 px-3">Start Date</th>
            <th class="py-2 px-3">End Date</th>
            <th class="py-2 px-3">Status</th>
            <th class="py-2 px-3">Total Cost</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rentals as $rental)
            <tr class="border-b">
                <td class="py-2 px-3">{{ $rental->customer->name ?? '—' }}</td>
                <td class="py-2 px-3">
                    {{ $rental->vehicle->plate_number ?? '—' }}
                    @if($rental->vehicle)
                        ({{ $rental->vehicle->make }} {{ $rental->vehicle->model }})
                    @endif
                </td>
                <td class="py-2 px-3">{{ \Carbon\Carbon::parse($rental->start_date)->toDateString() }}</td>
                <td class="py-2 px-3">{{ \Carbon\Carbon::parse($rental->end_date)->toDateString() }}</td>
                <td class="py-2 px-3 capitalize">{{ $rental->status }}</td>
                <td class="py-2 px-3">${{ number_format($rental->total_cost, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $rentals->links() }}
    </div>
@endsection
