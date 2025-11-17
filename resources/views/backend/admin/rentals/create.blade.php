
@extends('backend.layout.master')
@section('title', 'Add Rental')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Add Rental</h1>

        <form action="{{ route('admin.rentals.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Customer --}}
            <div>
                <label class="block text-sm font-medium mb-1">Customer</label>
                <select name="customer_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}" @selected(old('customer_id') == $c->id)>
                            {{ $c->name }} ({{ $c->email }})
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Vehicle --}}
            <div>
                <label class="block text-sm font-medium mb-1">Vehicle</label>
                <select name="vehicle_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Select Vehicle --</option>
                    @foreach($vehicles as $v)
                        <option value="{{ $v->id }}" @selected(old('vehicle_id') == $v->id)>
                            {{ $v->plate_number }} — {{ $v->make }} {{ $v->model }}
                        </option>
                    @endforeach
                </select>
                @error('vehicle_id')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Dates --}}
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Start Date</label>
                    <input type="date" name="start_date"
                           value="{{ old('start_date') }}"
                           class="w-full border rounded px-3 py-2" required>
                    @error('start_date')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">End Date</label>
                    <input type="date" name="end_date"
                           value="{{ old('end_date') }}"
                           class="w-full border rounded px-3 py-2" required>
                    @error('end_date')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2" required>
                    @foreach(['pending','approved','completed','cancelled'] as $status)
                        <option value="{{ $status }}" @selected(old('status') == $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Total Cost --}}
            <div>
                <label class="block text-sm font-medium mb-1">Total Cost (GH₵)</label>
                <input type="number" step="0.01" name="total_cost"
                       value="{{ old('total_cost', 0) }}"
                       class="w-full border rounded px-3 py-2" required>
                @error('total_cost')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 mt-4">
                <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
                    Save Rental
                </button>
                <a href="{{ route('admin.rentals.index') }}" class="text-sm underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection
