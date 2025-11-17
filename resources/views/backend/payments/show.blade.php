@extends('backend.layout.master')
@section('title','Payment Details')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Payment #{{ $payment->id }}</h1>

    <div class="bg-white rounded-lg p-5 shadow max-w-2xl space-y-2">
        <div><strong>Driver:</strong> {{ optional($payment->driver)->name ?? '—' }}</div>
        <div><strong>Amount:</strong> {{ number_format($payment->amount,2) }}</div>
        <div><strong>Date:</strong> {{ \Illuminate\Support\Carbon::parse($payment->payment_date)->toFormattedDateString() }}</div>
        <div><strong>Type:</strong> {{ ucfirst($payment->payment_type) }}</div>
        <div><strong>Notes:</strong> {{ $payment->notes ?: '—' }}</div>
        <div class="text-sm text-gray-500">Created: {{ $payment->created_at }} • Updated: {{ $payment->updated_at }}</div>
    </div>

    <div class="mt-6 flex gap-3">
        <a href="{{ route('admin.payments.edit', $payment) }}" class="px-4 py-2 bg-black text-white rounded">Edit</a>
        <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 border rounded">Back</a>
    </div>
@endsection
