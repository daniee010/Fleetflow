@extends('backend.layout.master')
@section('title', 'Record Sales Payment')

@section('content')
    <h1 class="text-2xl font-bold mb-4">
        Record Sales Payment for
        <span class="text-[#f53003]">
            {{ $driver->name }}
        </span>
    </h1>

    <div class="mb-4 text-sm text-gray-600">
        Scheme:
        <span class="font-semibold">
            {{ ucfirst(str_replace('_',' ', $driver->scheme_type ?? 'sales_only')) }}
        </span>
    </div>

    <form method="POST"
          action="{{ route('admin.drivers.sales-payments.store', $driver) }}"
          class="space-y-4 max-w-md">
        @csrf

        {{-- Vehicle (optional) --}}
        <div>
            <label class="block text-sm font-medium mb-1">Vehicle (optional)</label>
            <select name="vehicle_id" class="w-full border rounded px-3 py-2">
                <option value="">— None —</option>
                @foreach($vehicles as $v)
                    <option value="{{ $v->id }}" @selected(old('vehicle_id') == $v->id)>
                        {{ $v->plate_number }} — {{ $v->make }} {{ $v->model }}
                    </option>
                @endforeach
            </select>
            @error('vehicle_id')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Amount --}}
        <div>
            <label class="block text-sm font-medium mb-1">Amount (GH₵)</label>
            <input type="number" step="0.01" name="amount"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('amount') }}" required>
            @error('amount')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Payment date --}}
        <div>
            <label class="block text-sm font-medium mb-1">Payment Date</label>
            <input type="date" name="payment_date"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('payment_date', now()->toDateString()) }}">
            @error('payment_date')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Notes --}}
        <div>
            <label class="block text-sm font-medium mb-1">Notes</label>
            <textarea name="notes" class="w-full border rounded px-3 py-2" rows="3">{{ old('notes') }}</textarea>
            @error('notes')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Save Payment
        </button>
    </form>
@endsection
