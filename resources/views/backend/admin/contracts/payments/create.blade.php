@extends('backend.layout.master')

@section('title', 'Record Work & Pay Payment')

@section('content')
    @php
        $total   = $contract->total_amount ?? 0;
        $paid    = $contract->amount_paid ?? 0;
        $balance = max($total - $paid, 0);
    @endphp

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">
            Record Payment for
            <span class="text-[#f53003]">
                {{ $contract->driver->name ?? 'Driver #'.$contract->driver_id }}
            </span>
            ({{ $contract->vehicle->plate_number ?? 'Vehicle #'.$contract->vehicle_id }})
        </h1>

        <a href="{{ route('admin.contracts.show', $contract) }}" class="text-sm underline">
            ← Back to Contract
        </a>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        Total: GH₵ {{ number_format($total, 2) }}<br>
        Paid so far: GH₵ {{ number_format($paid, 2) }}<br>
        Balance: GH₵ {{ number_format($balance, 2) }}
    </div>

    @if($balance <= 0)
        <div class="mb-4 p-3 rounded bg-green-50 text-green-700 text-sm">
            This contract appears to be fully paid. Recording more payments will push it above the agreed total.
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.contracts.payments.store', $contract) }}"
          class="space-y-4 max-w-md">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Amount (GH₵)</label>
            <input
                type="number"
                step="0.01"
                name="amount"
                class="w-full border rounded px-3 py-2"
                value="{{ old('amount') }}"
                min="0.01"
                @if($balance > 0) max="{{ $balance }}" @endif
                required
            >
            @error('amount')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Payment Date</label>
            <input
                type="date"
                name="payment_date"
                class="w-full border rounded px-3 py-2"
                value="{{ old('payment_date', now()->toDateString()) }}"
            >
            @error('payment_date')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Notes</label>
            <textarea
                name="notes"
                class="w-full border rounded px-3 py-2"
                rows="3">{{ old('notes') }}</textarea>
            @error('notes')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Save Payment
        </button>
    </form>
@endsection
