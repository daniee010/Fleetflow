@extends('backend.layout.master')
@section('title', 'Reports')

@section('content')
    <div class="space-y-8">

        {{-- PAGE TITLE --}}
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-[#f53003]">Reports</h1>
            <span class="text-xs text-gray-500">
                Overview of revenue, fleet, and maintenance
            </span>
        </div>

        {{-- 1) REVENUE SUMMARY --}}
        <section>
            <h2 class="text-lg font-semibold mb-3">Revenue Overview</h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Rental income --}}
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-xs text-gray-500 uppercase">Rental Revenue</p>
                    <p class="text-xl font-bold mt-1">
                        GH₵ {{ number_format($rentalRevenue, 2) }}
                    </p>
                    <p class="text-[11px] text-gray-400 mt-1">
                        Payments from customer rentals
                    </p>
                </div>

                {{-- Work & Pay contracts --}}
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-xs text-gray-500 uppercase">Work &amp; Pay Revenue</p>
                    <p class="text-xl font-bold mt-1">
                        GH₵ {{ number_format($workAndPayRevenue, 2) }}
                    </p>
                    <p class="text-[11px] text-gray-400 mt-1">
                        Driver payments on Work &amp; Pay contracts
                    </p>
                </div>

                {{-- Sales-only / non-contract driver payments --}}
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-xs text-gray-500 uppercase">Sales Driver Revenue</p>
                    <p class="text-xl font-bold mt-1">
                        GH₵ {{ number_format($salesRevenue, 2) }}
                    </p>
                    <p class="text-[11px] text-gray-400 mt-1">
                        Driver payments without contract (sales-only)
                    </p>
                </div>

                {{-- Total --}}
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-xs text-gray-500 uppercase">Total Revenue</p>
                    <p class="text-2xl font-bold mt-1 text-green-600">
                        GH₵ {{ number_format($totalRevenue, 2) }}
                    </p>
                    <p class="text-[11px] text-gray-400 mt-1">
                        All recorded income
                    </p>
                </div>
            </div>

        </section>

        {{-- 2) FLEET OVERVIEW --}}
        <section>
            <h2 class="text-lg font-semibold mb-3">Fleet Overview</h2>

            <div class="grid sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <p class="text-xs text-gray-500 uppercase">Total Vehicles</p>
                    <p class="text-2xl font-bold mt-1">{{ $fleet['total'] }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <p class="text-xs text-gray-500 uppercase">Available</p>
                    <p class="text-2xl font-bold mt-1 text-green-600">{{ $fleet['available'] }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <p class="text-xs text-gray-500 uppercase">Rented</p>
                    <p class="text-2xl font-bold mt-1 text-blue-600">{{ $fleet['rented'] }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <p class="text-xs text-gray-500 uppercase">Maintenance</p>
                    <p class="text-2xl font-bold mt-1 text-yellow-600">{{ $fleet['maintenance'] }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <p class="text-xs text-gray-500 uppercase">Contract</p>
                    <p class="text-2xl font-bold mt-1 text-purple-600">{{ $fleet['contract'] }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <p class="text-xs text-gray-500 uppercase">Sales</p>
                    <p class="text-2xl font-bold mt-1 text-orange-600">{{ $fleet['sales'] }}</p>
                </div>
            </div>
        </section>

        {{-- 3) MAINTENANCE SUMMARY --}}
        <section>
            <h2 class="text-lg font-semibold mb-3">Maintenance Overview</h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-xs text-gray-500 uppercase">Maintenance Records</p>
                    <p class="text-2xl font-bold mt-1">{{ $maintenanceCount }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-xs text-gray-500 uppercase">Total Maintenance Cost</p>
                    <p class="text-2xl font-bold mt-1 text-red-600">
                        GH₵ {{ number_format($maintenanceTotalCost, 2) }}
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-xs text-gray-500 uppercase">Most Maintained Vehicle</p>
                    @if($topMaintenanceVehicle && $topMaintenanceVehicle->vehicle)
                        <p class="text-sm font-semibold mt-1">
                            {{ $topMaintenanceVehicle->vehicle->plate_number }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $topMaintenanceVehicle->vehicle->make }}
                            {{ $topMaintenanceVehicle->vehicle->model }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $topMaintenanceVehicle->total }} maintenance records
                        </p>
                    @else
                        <p class="text-sm mt-1 text-gray-500">No data yet.</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- 4) RECENT PAYMENTS --}}
        <section>
            <h2 class="text-lg font-semibold mb-3">Recent Payments</h2>

            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="border-b text-gray-600">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Vehicle</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentPayments as $p)
                        @php
                            $isRental   = $p->payment_type === 'rental';
                            $isContract = $p->payment_type === 'contract';
                            $isSales    = $p->payment_type === 'sales';

                            // Name: customer for rental, driver for contract/sales
                            $displayName = $isRental
                                ? optional(optional($p->rental)->customer)->name
                                : optional($p->driver)->name;

                            // Vehicle label: prefer direct vehicle, then rental->vehicle
                            $vehicleLabel = $p->vehicle
                                ? $p->vehicle->plate_number
                                : (optional(optional($p->rental)->vehicle)->plate_number ?? '—');

                            // Type label
                            if ($isRental) {
                                $typeLabel = 'Customer Rental';
                            } elseif ($isContract) {
                                $typeLabel = 'Work & Pay Contract';
                            } elseif ($isSales) {
                                $typeLabel = 'Sales Driver Payment';
                            } else {
                                $typeLabel = ucfirst((string) $p->payment_type ?: 'Unknown');
                            }
                        @endphp

                        <tr class="border-b last:border-0">
                            <td class="px-4 py-3">{{ $p->id }}</td>

                            {{-- Name --}}
                            <td class="px-4 py-3">
                                {{ $displayName ?? '—' }}
                            </td>

                            {{-- Vehicle --}}
                            <td class="px-4 py-3">
                                {{ $vehicleLabel ?? '—' }}
                            </td>

                            {{-- Amount --}}
                            <td class="px-4 py-3">
                                GH₵ {{ number_format($p->amount, 2) }}
                            </td>

                            {{-- Date --}}
                            <td class="px-4 py-3">
                                {{ optional($p->payment_date)->toFormattedDateString() ?? '—' }}
                            </td>

                            {{-- Type badge --}}
                            <td class="px-4 py-3">
            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px]
                @class([
                    'bg-blue-100 text-blue-700'      => $isRental,
                    'bg-purple-100 text-purple-700'  => $isContract,
                    'bg-orange-100 text-orange-700'  => $isSales,
                    'bg-gray-100 text-gray-700'      => ! $isRental && ! $isContract && ! $isSales,
                ])">
                {{ $typeLabel }}
            </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                No payments recorded yet.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </section>

    </div>
@endsection
