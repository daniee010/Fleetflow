@extends('backend.layout.master')
@section('title','Payment #'.$payment->id)

@section('content')
    <h1 class="text-2xl font-bold mb-6">Payment #{{ $payment->id }}</h1>

    <div class="grid sm:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-[#161615] rounded p-4 shadow">
            <h2 class="font-semibold mb-3">Details</h2>
            <p><strong>Driver:</strong> {{ optional($payment->driver)->name ?? '—' }}</p>
            <p><strong>Amount:</strong> ${{ number_format($payment->amount, 2) }}</p>
            <p><strong>Date:</strong> {{ \Illuminate\Support\Carbon::parse($payment->payment_date)->toDayDateTimeString() }}</p>
            <p><strong>Type:</strong> {{ ucfirst($payment->payment_type) }}</p>
            <p><strong>Notes:</strong> {{ $payment->notes ?: '—' }}</p>
        </div>
    </div>
@endsection
