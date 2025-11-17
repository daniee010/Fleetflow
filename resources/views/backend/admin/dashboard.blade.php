@extends('backend.layout.master')
@section('title', 'Dashboard')

@section('content')
    <div class="space-y-10">

        {{-- Driver Overview --}}
        <section>
            <h2 class="text-xl font-bold text-[#f53003] mb-4">Driver Overview</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Sales Only Drivers</h4>
                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ number_format($stats['sales_only']) }}
                    </p>
                </div>

                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Work & Pay Drivers</h4>
                    <p class="text-3xl font-bold text-purple-600 mt-2">
                        {{ number_format($stats['work_and_pay']) }}
                    </p>
                </div>

                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Mixed Scheme Drivers</h4>
                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ number_format($stats['mixed']) }}
                    </p>
                </div>

            </div>
        </section>


        {{-- Fleet Summary --}}
        <section>
            <h2 class="text-xl font-bold text-[#f53003] mb-4">Fleet Overview</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Total Vehicles</h4>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ number_format($stats['vehicles']) }}
                    </p>
                </div>
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Total Customers</h4>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ number_format($stats['customers']) }}
                    </p>
                </div>
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Maintenance Records</h4>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ number_format($stats['maintenance']) }}
                    </p>
                </div>
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Active Rentals</h4>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ number_format($stats['activeRentals']) }}
                    </p>
                </div>
            </div>
        </section>

        {{-- Finance Summary --}}
        <section>
            <h2 class="text-xl font-bold text-[#f53003] mb-4">Financial Overview</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600">Total Revenue</h4>
                    <p class="text-3xl font-bold text-green-600 mt-2">
                        ${{ number_format($stats['revenue'], 2) }}
                    </p>
                </div>
            </div>
        </section>

        {{-- Recent Rentals --}}
        <section>
            <h2 class="text-xl font-bold text-[#f53003] mb-4">Recent Rentals</h2>
            <div class="bg-white rounded-lg p-5 shadow overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="border-b border-gray-200">
                    <tr>
                        <th class="py-2 px-4">Customer</th>
                        <th class="py-2 px-4">Vehicle</th>
                        <th class="py-2 px-4">Start Date</th>
                        <th class="py-2 px-4">End Date</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Total Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentRentals as $rental)
                        <tr class="border-b border-gray-100">
                            <td class="py-2 px-4">{{ $rental->customer->name ?? '—' }}</td>
                            <td class="py-2 px-4">
                                {{ $rental->vehicle->plate_number ?? '—' }}
                                @if($rental->vehicle)
                                    ({{ $rental->vehicle->make }} {{ $rental->vehicle->model }})
                                @endif
                            </td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($rental->start_date)->toDateString() }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($rental->end_date)->toDateString() }}</td>
                            <td class="py-2 px-4 capitalize">{{ $rental->status }}</td>
                            <td class="py-2 px-4">${{ number_format($rental->total_cost, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">No rentals found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
@endsection
