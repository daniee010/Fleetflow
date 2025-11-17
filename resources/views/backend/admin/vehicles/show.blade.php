@extends('backend.layout.master')
@section('title', 'Vehicle Details')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">
                {{ $vehicle->plate_number }}
            </h1>
            <div class="text-sm text-gray-500">
                {{ $vehicle->make }} {{ $vehicle->model }}
                @if($vehicle->year)
                    ({{ $vehicle->year }})
                @endif
            </div>
        </div>

        <a href="{{ route('admin.vehicles.index') }}" class="text-sm underline">
            ← Back to Vehicles
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        {{-- Basic info --}}
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Vehicle Info</h2>
            <div class="text-sm space-y-1">
                <div><span class="font-semibold">Plate:</span> {{ $vehicle->plate_number }}</div>
                <div><span class="font-semibold">Make:</span> {{ $vehicle->make }}</div>
                <div><span class="font-semibold">Model:</span> {{ $vehicle->model }}</div>
                <div><span class="font-semibold">Year:</span> {{ $vehicle->year ?? '—' }}</div>
                <div><span class="font-semibold">Color:</span> {{ $vehicle->color ?? '—' }}</div>
            </div>
        </div>

        {{-- Status / scheme / rate --}}
        <div class="bg-white rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Usage</h2>

            @php $status = strtolower($vehicle->status); @endphp

            <div class="mb-2">
                <span class="text-xs text-gray-500">Status</span><br>
                <span class="inline-flex px-2 py-0.5 rounded-full text-[11px]
                    @class([
                        'bg-green-100 text-green-700'   => $status === 'available',
                        'bg-blue-100 text-blue-700'     => $status === 'rented',
                        'bg-yellow-100 text-yellow-700' => $status === 'maintenance',
                        'bg-purple-100 text-purple-700' => $status === 'contract',
                        'bg-orange-100 text-orange-700' => $status === 'sales',
                        'bg-gray-100 text-gray-700'     => ! in_array($status, ['available','rented','maintenance','contract','sales']),
                    ])">
                    {{ ucfirst($vehicle->status) ?: 'Unknown' }}
                </span>
            </div>

            <div class="mb-2 text-sm">
                <span class="text-xs text-gray-500">Scheme</span><br>
                {{ $vehicle->scheme_label ?? 'Pool / General Fleet' }}
            </div>

            <div class="text-sm">
                <span class="text-xs text-gray-500">Rate</span><br>
                @if(in_array($status, ['sales','contract']) && !is_null($vehicle->daily_rate))
                    GH₵ {{ number_format($vehicle->daily_rate, 2) }}
                    <div class="text-[11px] text-gray-500">Weekly Payment</div>
                @elseif(!is_null($vehicle->daily_rate))
                    GH₵ {{ number_format($vehicle->daily_rate, 2) }}
                    <div class="text-[11px] text-gray-500">Daily Rate</div>
                @else
                    <span class="text-xs text-gray-500">Not set</span>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.vehicles.edit', $vehicle) }}"
           class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition text-sm">
            Edit Vehicle
        </a>
    </div>
@endsection
