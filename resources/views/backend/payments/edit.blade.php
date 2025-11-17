@extends('backend.layout.master')
@section('title','Edit Payment')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Payment #{{ $payment->id }}</h1>

    <form action="{{ route('admin.payments.update', $payment) }}" method="POST" class="space-y-4 max-w-lg">
        @csrf
        @method('PUT')

        {{-- Amount --}}
        <div>
            <label class="block text-sm font-medium mb-1">Amount (GH₵)</label>
            <input
                name="amount"
                type="number"
                step="0.01"
                value="{{ old('amount', $payment->amount) }}"
                class="border rounded px-3 py-2 w-full"
                required
            >
            @error('amount')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Payment Date --}}
        <div>
            <label class="block text-sm font-medium mb-1">Payment Date</label>
            <input
                name="payment_date"
                type="date"
                value="{{ old('payment_date', \Illuminate\Support\Carbon::parse($payment->payment_date)->toDateString()) }}"
                class="border rounded px-3 py-2 w-full"
                required
            >
            @error('payment_date')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Type (rental / contract) --}}
        <div>
            <label class="block text-sm font-medium mb-1">Type</label>
            <select name="payment_type" class="border p-2 w-full">
                @foreach(['rental','contract','sales'] as $opt)
                    <option value="{{ $opt }}" @selected(old('payment_type', $payment->payment_type) === $opt)>
                        @if($opt === 'rental')
                            Customer Rental
                        @elseif($opt === 'contract')
                            Work &amp; Pay Contract
                        @else
                            Sales Driver Payment
                        @endif
                    </option>
                @endforeach
            </select>

            @error('payment_type')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Notes --}}
        <div>
            <label class="block text-sm font-medium mb-1">Notes</label>
            <textarea
                name="notes"
                class="border rounded px-3 py-2 w-full"
                rows="3"
            >{{ old('notes', $payment->notes) }}</textarea>
            @error('notes')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Save
        </button>
    </form>
@endsection
