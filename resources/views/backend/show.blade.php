@extends('backend.layout.master')
@section('title','Vehicle')

@section('content')
    <div class="max-w-3xl mx-auto space-y-2">
        <h1 class="text-2xl font-bold">Vehicle: {{ $vehicle->plate_number }}</h1>
        <div class="bg-white p-4 rounded shadow">
            <p><strong>Make/Model:</strong> {{ $vehicle->make }} {{ $vehicle->model }}</p>
            <p><strong>Year:</strong> {{ $vehicle->year }}</p>
            <p><strong>Color:</strong> {{ $vehicle->color }}</p>
            <p><strong>Daily Rate:</strong> ${{ number_format($vehicle->daily_rate,2) }}</p>
            <p><strong>Status:</strong> <span class="capitalize">{{ $vehicle->status }}</span></p>
        </div>
    </div>
@endsection
