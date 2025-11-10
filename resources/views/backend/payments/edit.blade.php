@extends('backend.layout.master')
@section('title','Edit Payment')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Payment #{{ $payment->id }}</h1>

    <form action="{{ route('admin.payments.update', $payment) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <label class="block">
            <span>Amount</span>
            <input name="amount" type="number" step="0.01" value="{{ old('amount', $payment->amount) }}" class="border p-2 w-full">
        </label>

        <label class="block">
            <span>Payment Date</span>
            <input name="payment_date" type="date" value="{{ old('payment_date', \Illuminate\Support\Carbon::parse($payment->payment_date)->toDateString()) }}" class="border p-2 w-full">
        </label>

        <label class="block">
            <span>Type</span>
            <select name="payment_type" class="border p-2 w-full">
                @foreach(['rental','contract'] as $opt)
                    <option value="{{ $opt }}" @selected(old('payment_type', $payment->payment_type) === $opt)>
                        {{ ucfirst($opt) }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span>Notes</span>
            <textarea name="notes" class="border p-2 w-full">{{ old('notes', $payment->notes) }}</textarea>
        </label>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded">Save</button>
    </form>
@endsection

