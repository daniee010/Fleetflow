@extends('backend.layout.master')
@section('title','Maintenance Details')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Maintenance #{{ $maintenance->id }}</h1>

    <div class="space-y-2">
        <p><strong>Vehicle:</strong>
            {{ optional($maintenance->vehicle)->plate_number }}
            ({{ optional($maintenance->vehicle)->make }} {{ optional($maintenance->vehicle)->model }})
        </p>
        <p><strong>Date:</strong> {{ $maintenance->service_date }}</p>
        <p><strong>Type:</strong> {{ $maintenance->service_type }}</p>
        <p><strong>Cost:</strong> ${{ number_format($maintenance->cost,2) }}</p>
        <p><strong>Notes:</strong> {{ $maintenance->notes ?: '—' }}</p>
    </div>

    <div class="mt-6">
        <a class="underline" href="{{ route('admin.maintenance.edit', $maintenance) }}">Edit</a>
        <a class="underline ml-4" href="{{ route('admin.maintenance.index') }}">Back to list</a>
    </div>
@endsection
