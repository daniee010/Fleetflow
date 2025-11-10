
@extends('backend.layout.master')
@section('title','Edit Maintenance')


@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Maintenance #{{ $maintenance->id }}</h1>

    <form action="{{ route('admin.maintenance.update', $maintenance) }}" method="POST" class="space-y-4 max-w-xl">
        @csrf @method('PATCH')
        <div>
            <label class="block mb-1">Vehicle</label>
            <select name="vehicle_id" class="w-full border rounded p-2">
                @foreach($vehicles as $v)
                    <option value="{{ $v->id }}" @selected($maintenance->vehicle_id == $v->id)>
                        {{ $v->plate_number }} ({{ $v->make }} {{ $v->model }})
                    </option>
                @endforeach
            </select>
            @error('vehicle_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block mb-1">Service Date</label>
            <input type="date" name="service_date" class="w-full border rounded p-2"
                   value="{{ old('service_date', $maintenance->service_date) }}">
            @error('service_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <select name="service_type" class="w-full border rounded p-2">
            @foreach($types as $type)
                <option value="{{ $type }}" @selected(old('service_type', $maintenance->service_type) === $type)>
                    {{ Str::headline($type) }}
                </option>
            @endforeach
        </select>
        <div>
            <label class="block mb-1">Cost</label>
            <input type="number" step="0.01" name="cost" class="w-full border rounded p-2"
                   value="{{ old('cost', $maintenance->cost) }}">
            @error('cost') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block mb-1">Notes (optional)</label>
            <textarea name="notes" class="w-full border rounded p-2">{{ old('notes', $maintenance->notes) }}</textarea>
            @error('notes') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <button class="px-4 py-2 bg-[#f53003] text-white rounded">Update</button>
    </form>
@endsection

