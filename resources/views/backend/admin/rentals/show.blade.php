@extends('backend.layout.master')
@section('title','Rental Details')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Rental #{{ $rental->id }}</h1>

    <ul class="space-y-2">
        <li><strong>Customer:</strong> {{ optional($rental->customer)->name }}</li>
        <li><strong>Vehicle:</strong>
            @if($rental->vehicle)
                {{ $rental->vehicle->plate_number }} — {{ $rental->vehicle->make }} {{ $rental->vehicle->model }}
            @endif
        </li>
        <li><strong>Start:</strong> {{ $rental->start_date }}</li>
        <li><strong>End:</strong> {{ $rental->end_date }}</li>
        <li><strong>Total Cost:</strong> ${{ number_format($rental->total_cost,2) }}</li>
        <li><strong>Status:</strong> {{ $rental->status }}</li>
    </ul>

    <div class="mt-6">
        <a href="{{ route('admin.rentals.index') }}" class="underline">Back</a>
    </div>
@endsection
