@extends('backend.layout.master')
@section('title','Mechanic Details')

@section('content')
    <h1 class="text-2xl font-bold mb-4">
        {{ optional($mechanic->user)->name ?? 'Mechanic #'.$mechanic->id }}
    </h1>

    <div class="bg-white rounded-lg p-5 shadow mb-6">
        <div>Email: {{ optional($mechanic->user)->email ?? '—' }}</div>
        <div>Phone: {{ $mechanic->phone ?? '—' }}</div>
        <div>Specialization: <strong>{{ $mechanic->specialization }}</strong></div>
    </div>

    <h2 class="text-xl font-semibold mb-3">Assigned Maintenances</h2>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-left">
            <thead class="text-sm uppercase text-gray-500">
            <tr>
                <th class="px-4 py-3">#</th>
                <th class="px-4 py-3">Vehicle</th>
                <th class="px-4 py-3">Service</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Cost</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($mechanic->maintenances as $m)
                <tr class="text-sm">
                    <td class="px-4 py-3">{{ $m->id }}</td>
                    <td class="px-4 py-3">
                        @if($m->vehicle)
                            {{ $m->vehicle->plate_number }} — {{ $m->vehicle->make }} {{ $m->vehicle->model }}
                        @else — @endif
                    </td>
                    <td class="px-4 py-3">{{ $m->service_type }}</td>
                    <td class="px-4 py-3">{{ \Illuminate\Support\Str::of($m->service_date)->substr(0,10) }}</td>
                    <td class="px-4 py-3">${{ number_format($m->cost,2) }}</td>
                </tr>
            @empty
                <tr><td class="px-4 py-6 text-center text-gray-500" colspan="5">No assignments yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
