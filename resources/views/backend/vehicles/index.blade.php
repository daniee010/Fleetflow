@extends('backend.layout.master')
@section('title', 'Vehicles')

@section('content')
    <h1 class="text-xl font-bold mb-4">Vehicles</h1>

    <table class="min-w-full text-left border-collapse">
        <thead>
        <tr class="border-b">
            <th class="py-2 px-3">Plate</th>
            <th class="py-2 px-3">Make</th>
            <th class="py-2 px-3">Model</th>
            <th class="py-2 px-3">Year</th>
            <th class="py-2 px-3">Status</th>
            <th class="py-2 px-3">Rate</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($vehicles as $v)
            <tr class="border-b">
                <td class="py-2 px-3">{{ $v->plate_number }}</td>
                <td class="py-2 px-3">{{ $v->make }}</td>
                <td class="py-2 px-3">{{ $v->model }}</td>
                <td class="py-2 px-3">{{ $v->year }}</td>
                <td class="py-2 px-3 capitalize">{{ $v->status }}</td>
                <td class="py-2 px-3">${{ number_format($v->daily_rate, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $vehicles->links() }}
    </div>
@endsection
