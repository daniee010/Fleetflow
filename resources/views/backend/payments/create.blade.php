@extends('backend.layout.master')
@section('title','New Payment')

@section('content')
    <h1 class="text-2xl font-bold mb-6">New Payment</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.payments.store') }}" class="space-y-5 max-w-xl">
        @csrf

        <label class="block">
            <span class="block mb-1">Driver</span>
            <select name="driver_id" class="border p-2 w-full rounded">
                <option value="">Select driver…</option>
                @foreach($drivers as $d)
                    <option value="{{ $d->id }}" @selected(old('driver_id')==$d->id)>{{ $d->name }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="block mb-1">Amount</span>
            <input name="amount" type="number" step="0.01" value="{{ old('amount') }}" class="border p-2 w-full rounded">
        </label>

        <label class="block">
            <span class="block mb-1">Payment Date</span>
            <input name="payment_date" type="date" value="{{ old('payment_date', now()->toDateString()) }}" class="border p-2 w-full rounded">
        </label>

        <label class="block">
            <span class="block mb-1">Type</span>
            <select name="payment_type" class="border p-2 w-full rounded">
                @foreach(['rental','contracts'] as $opt)
                    <option value="{{ $opt }}" @selected(old('payment_type')===$opt)>{{ ucfirst($opt) }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="block mb-1">Notes</span>
            <textarea name="notes" class="border p-2 w-full rounded" rows="3">{{ old('notes') }}</textarea>
        </label>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-[#f53003] text-white rounded">Save</button>
            <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 border rounded">Cancel</a>
        </div>
    </form>
@endsection
