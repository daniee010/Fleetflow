@extends('backend.layout.master')
@section('title','Edit Payment #'.$payment->id)

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Payment #{{ $payment->id }}</h1>

    <form method="POST"
          action="{{ route('admin.payments.update', $payment) }}"
          class="max-w-lg space-y-5">
        @csrf
        @method('PUT')

        {{-- Amount --}}
        <div>
            <label class="block text-sm mb-1">Amount (GH₵)</label>
            <input
                type="number"
                step="0.01"
                name="amount"
                value="{{ old('amount', $payment->amount) }}"
                class="w-full border rounded px-3 py-2"
                required
            >
            @error('amount')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Payment Date --}}
        <div>
            <label class="block text-sm mb-1">Payment Date</label>
            <input
                type="date"
                name="payment_date"
                value="{{ old('payment_date', \Illuminate\Support\Carbon::parse($payment->payment_date)->toDateString()) }}"
                class="w-full border rounded px-3 py-2"
                required
            >
            @error('payment_date')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Type: rental / contract / sales --}}
        <div>
            <label class="block text-sm mb-1">Type</label>
            <select name="payment_type" class="w-full border rounded px-3 py-2">
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
            <label class="block text-sm mb-1">Notes</label>
            <textarea
                name="notes"
                rows="3"
                class="w-full border rounded px-3 py-2"
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
