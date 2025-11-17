@extends('backend.layout.master')
@section('title','Drivers')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Drivers</h1>
        <a href="{{ route('admin.drivers.create') }}" class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Add Driver
        </a>

    </div>
    {{-- Filter Buttons --}}
    <div class="mb-4 space-x-4">
        <a href="{{ route('admin.drivers.index') }}"
           class="underline text-sm {{ request('scheme') ? 'text-gray-500' : 'text-black dark:text-white' }}">
            All
        </a>

        <a href="{{ route('admin.drivers.index', ['scheme' => 'sales_only']) }}"
           class="underline text-sm {{ request('scheme') === 'sales_only' ? 'font-bold text-blue-600' : 'text-gray-500' }}">
            Sales Only
        </a>

        <a href="{{ route('admin.drivers.index', ['scheme' => 'work_and_pay']) }}"
           class="underline text-sm {{ request('scheme') === 'work_and_pay' ? 'font-bold text-purple-600' : 'text-gray-500' }}">
            Work & Pay
        </a>

        <a href="{{ route('admin.drivers.index', ['scheme' => 'mixed']) }}"
           class="underline text-sm {{ request('scheme') === 'mixed' ? 'font-bold text-green-600' : 'text-gray-500' }}">
            Mixed
        </a>
    </div>


    @if($drivers->count() === 0)
        <div class="p-4 bg-yellow-50 text-yellow-800 rounded">No drivers found.</div>
    @else
        <div class="overflow-x-auto bg-white dark:bg-[#161615] rounded shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="border-b text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">Driver</th>
                    <th class="px-4 py-3">Contact</th>
                    <th class="px-4 py-3">Vehicle</th>
                    <th class="px-4 py-3">License</th>
                    <th class="px-4 py-3">Payments</th>
                    <th class="px-4 py-3">Trips</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
                @foreach($drivers as $d)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold">{{ $d->name }}</span>

                                {{-- Scheme badge --}}
                                @if($d->scheme_type === 'sales_only')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-700">
                Sales Only
            </span>
                                @elseif($d->scheme_type === 'work_and_pay')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-purple-100 text-purple-700">
                Work &amp; Pay
            </span>
                                @elseif($d->scheme_type === 'mixed')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-green-100 text-green-700">
                Mixed
            </span>
                                @endif
                            </div>

                            <div class="text-xs text-gray-500 capitalize">{{ $d->status }}</div>

                            @if($d->activeWorkAndPayContract)
                                @php
                                    $c = $d->activeWorkAndPayContract;
                                @endphp
                                <div class="mt-1 text-xs text-gray-600">
                                    W&P: GH₵ {{ number_format($c->amount_paid, 2) }} / {{ number_format($c->total_amount, 2) }}
                                    ({{ $c->progress_percent }}%),
                                    Bal: GH₵ {{ number_format($c->balance, 2) }}
                                </div>
                            @endif
                        </td>


                        <td class="px-4 py-3">
                            <div>{{ $d->phone }}</div>
                            <div class="text-xs text-gray-500">{{ optional($d->user)->email }}</div>
                        </td>

                        <td class="px-4 py-3">
                            {{ optional($d->vehicle)->plate_number ?? '—' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $d->license_number }}
                            <div class="text-xs text-gray-500">
                                Expires: {{ $d->license_expiry ?? '—' }}
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            GH₵ {{ number_format($d->totalPaid(), 2) }}
                            <div class="text-xs text-gray-500">
                                Last:
                                {{ $d->latestPayment?->payment_date ?? '—' }}
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            {{ $d->trips_count ?? 0 }} trips
                            <div class="text-xs text-gray-500">
                                This month: {{ $d->tripsThisMonth() }}
                            </div>
                        </td>

                        <td class="px-4 py-3 text-right space-x-3 text-xs">
                            <a href="{{ route('admin.drivers.show', $d) }}" class="underline">View</a>
                            <a href="{{ route('admin.drivers.edit', $d) }}" class="underline">Edit</a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="mt-4">
            {{ $drivers->links() }}
        </div>
    @endif
@endsection
