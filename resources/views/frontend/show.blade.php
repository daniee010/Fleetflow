@extends('frontend.layout.master')
@section('title','Vehicle')

@section('content')
    <div class="wrapper py-10">
        <h1 class="text-3xl font-bold mb-4">{{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->year }})</h1>
        <p class="mb-2">Plate: {{ $vehicle->plate_number }}</p>
        <p class="mb-2">Color: {{ $vehicle->color }}</p>
        <p class="mb-2">Rate: ${{ number_format($vehicle->daily_rate,2) }} / day</p>
        <p class="mb-6">Status: <span class="capitalize">{{ $vehicle->status }}</span></p>

        {{-- Example CTA --}}
        <a href="{{ route('vehicles.public.index') }}" class="px-4 py-2 bg-gray-900 text-white rounded">Back to list</a>
    </div>
@endsection
