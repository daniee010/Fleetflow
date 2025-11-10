@extends('backend.layout.master')
@section('title','Edit Payment #'.$payment->id)

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Payment #{{ $payment->id }}</h1>

    <form method="POST" action="#" class="max-w-lg space-y-5">
        @csrf
        {{-- Wire up PUT/PATCH route when you’re ready --}}
        <div>
            <label class="block text-sm mb-1">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount', $payment->amount) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Payment Date</label>
            <input type="date" name="payment_date" value="{{ old('payment_date', $payment->payment_date) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Type</label>
            <select name="payment_type" class="w-full border rounded px-3 py-2">
                @foreach(['rental','contract'] as $t)
                    <option value="{{ $t }}" @selected(old('payment_type', $payment->payment_type)===$t)>{{ ucfirst($t) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm mb-1">Notes</label>
            <textarea name="notes" rows="3" class="w-full border rounded px-3 py-2">{{ old('notes', $payment->notes) }}</textarea>
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">Save</button>
    </form>
@endsection
