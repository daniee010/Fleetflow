@extends('backend.layout.master')

@section('title','Vehicles')

@section('content')
    <h1 class="mb-4">Vehicles</h1>
    <table class="w-full text-left">
        <thead><tr>
            <th>Platy3i3yie</th><th>Make</th><th>Model</th><th>Year</th><th>Status</th><th>Rate</th>
        </tr></thead>
        <tbody>
        @foreach($vehicles as $v)
            <tr class="border-t">
                <td class="py-2">{{ $v->plate_number }}</td>
                <td class="py-2">{{ $v->make }}</td>
                <td class="py-2">{{ $v->model }}</td>
                <td class="py-2">{{ $v->year }}</td>
                <td class="py-2">{{ $v->status }}</td>
                <td class="py-2">${{ number_format($v->daily_rate,2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $vehicles->links() }}
    </div>
@endsection
