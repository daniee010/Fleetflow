@extends('backend.layout.master')

@section('title', 'Work & Pay Contract Details')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">
            Contract #{{ $contract->id }}
        </h1>

        <a href="{{ route('admin.contracts.index') }}" class="text-sm underline">
            ← Back to Contracts
        </a>
    </div>

    {{-- Top summary card --}}
    <div class="grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Driver</h2>
            <div class="text-lg font-semibold">
                {{ $contract->driver->name ?? 'Driver #'.$contract->driver_id }}
            </div>
            <div class="text-xs text-gray-500 mt-1">
                Phone: {{ $contract->driver->phone ?? '—' }}
            </div>
        </div>

        <div class="bg-white rounded shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Vehicle</h2>
            <div class="text-lg font-semibold">
                {{ $contract->vehicle->plate_number ?? 'Vehicle #'.$contract->vehicle_id }}
            </div>
            <div class="text-xs text-gray-500 mt-1">
                {{ $contract->vehicle->make ?? '' }} {{ $contract->vehicle->model ?? '' }}
            </div>
        </div>

        <div class="bg-white rounded shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Contract</h2>
            @php
                $total   = $contract->total_amount;
                $paid    = $contract->amount_paid;
                $balance = $total - $paid;
                $percent = $total > 0 ? round(($paid / $total) * 100) : 0;
            @endphp

            <div class="text-sm">
                <div>Total: <span class="font-semibold">GH₵ {{ number_format($total, 2) }}</span></div>
                <div>Paid: <span class="font-semibold text-green-600">GH₵ {{ number_format($paid, 2) }}</span></div>
                <div>Balance: <span class="font-semibold text-red-600">GH₵ {{ number_format($balance, 2) }}</span></div>
                <div class="mt-1 text-xs text-gray-500">
                    Status: <span class="uppercase">{{ $contract->status }}</span>
                </div>
            </div>

            {{-- Progress bar --}}
            <div class="mt-3">
                <div class="flex justify-between text-xs mb-1">
                    <span>Progress</span>
                    <span>{{ $percent }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded h-2 overflow-hidden">
                    <div class="h-2 bg-[#f53003]" style="width: {{ $percent }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Dates --}}
    <div class="bg-white rounded shadow p-4 mb-6 text-sm">
        <div>Start date: <strong>{{ $contract->start_date }}</strong></div>
        <div>End date: <strong>{{ $contract->end_date ?? '—' }}</strong></div>
    </div>

    {{-- Record payment button --}}
    <div class="mb-4">
        <a href="{{ route('admin.contracts.payments.create', $contract) }}"
           class="px-3 py-1 text-xs bg-[#f53003] text-white rounded">
            Record Payment
        </a>

    </div>

    {{-- Payments table --}}
    <div class="bg-white rounded shadow">
        <div class="border-b px-4 py-3 font-semibold">
            Payment History
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="border-b text-gray-600">
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Notes</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($contract->payments as $p)
                    <tr>
                        <td class="px-4 py-2">
                            {{ \Illuminate\Support\Carbon::parse($p->payment_date)->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-2">
                            GH₵ {{ number_format($p->amount, 2) }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $p->payment_type ?? '—' }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $p->notes ?? '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                            No payments recorded yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
