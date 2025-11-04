@extends('frontend.layout.master')
@section('title','Vehicles')

@section('content')
    <div class="wrapper py-10">
        <h1 class="text-3xl font-bold mb-6">Available Vehicles</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($vehicles as $v)
                <a href="{{ route('vehicles.public.show',$v) }}" class="block bg-white shadow rounded p-4">
                    <div class="font-semibold">{{ $v->make }} {{ $v->model }} ({{ $v->year }})</div>
                    <div class="text-sm text-gray-500 mt-1">Plate: {{ $v->plate_number }}</div>
                    <div class="mt-2 font-bold">${{ number_format($v->daily_rate,2) }} / day</div>
                </a>
            @empty
                <p>No vehicles available right now.</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $vehicles->links() }}</div>
    </div>
@endsection
