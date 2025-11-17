@extends('backend.layout.master')

@section('title', 'Create Work & Pay Contract')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Create Work &amp; Pay Contract</h1>

    <form action="{{ route('admin.contracts.store') }}" method="POST" class="max-w-xl space-y-5">
        @csrf

        {{-- Driver --}}
        <div>
            <label class="block text-sm font-medium mb-1">Driver</label>
            <select name="driver_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select driver...</option>
                @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                        {{ $driver->name }}
                        @if($driver->vehicle)
                            — {{ $driver->vehicle->plate_number }} ({{ $driver->vehicle->make }} {{ $driver->vehicle->model }})
                        @endif
                        [{{ ucfirst(str_replace('_', ' ', $driver->scheme_type)) }}]
                    </option>
                @endforeach
            </select>
            @error('driver_id')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Vehicle --}}
        <div>
            <label class="block text-sm font-medium mb-1">Vehicle</label>
            <select name="vehicle_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select vehicle...</option>
                @foreach($vehicles as $v)
                    <option value="{{ $v->id }}" {{ old('vehicle_id') == $v->id ? 'selected' : '' }}>
                        {{ $v->plate_number }} — {{ $v->make }} {{ $v->model }}
                    </option>
                @endforeach
            </select>
            @error('vehicle_id')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Total Amount --}}
        <div>
            <label class="block text-sm font-medium mb-1">Total Amount (GH₵)</label>
            <input type="number" step="0.01" name="total_amount"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('total_amount') }}" required>
            @error('total_amount')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Weekly Payment (optional helper) --}}
        <div>
            <label class="block text-sm font-medium mb-1">Weekly Payment (optional)</label>
            <input type="number" step="0.01" name="weekly_payment"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('weekly_payment') }}">
            @error('weekly_payment')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Start Date --}}
        <div>
            <label class="block text-sm font-medium mb-1">Start Date</label>
            <input type="date" name="start_date"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('start_date', now()->toDateString()) }}" required>
            @error('start_date')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- End Date --}}
        <div>
            <label class="block text-sm font-medium mb-1">End Date (optional)</label>
            <input type="date" name="end_date"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('end_date') }}">
            @error('end_date')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="terminated" {{ old('status') === 'terminated' ? 'selected' : '' }}>Terminated</option>
            </select>
            @error('status')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Notes --}}
        <div>
            <label class="block text-sm font-medium mb-1">Notes</label>
            <textarea name="notes" rows="3"
                      class="w-full border rounded px-3 py-2">{{ old('notes') }}</textarea>
            @error('notes')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Save Contract
        </button>
    </form>
@endsection
