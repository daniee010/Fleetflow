@php
    $v = $vehicle ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm mb-1">Plate Number</label>
        <input name="plate_number" value="{{ old('plate_number', $v->plate_number ?? '') }}" class="w-full border rounded p-2">
        @error('plate_number') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Make</label>
        <input name="make" value="{{ old('make', $v->make ?? '') }}" class="w-full border rounded p-2">
        @error('make') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Model</label>
        <input name="model" value="{{ old('model', $v->model ?? '') }}" class="w-full border rounded p-2">
        @error('model') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Year</label>
        <input type="number" name="year" value="{{ old('year', $v->year ?? '') }}" class="w-full border rounded p-2">
        @error('year') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Color</label>
        <input name="color" value="{{ old('color', $v->color ?? '') }}" class="w-full border rounded p-2">
        @error('color') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm mb-1">Daily Rate</label>
        <input type="number" step="0.01" name="daily_rate" value="{{ old('daily_rate', $v->daily_rate ?? '') }}" class="w-full border rounded p-2">
        @error('daily_rate') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm mb-1">Status</label>
        <select name="status" class="w-full border rounded p-2">
            @foreach(['available','maintenance','rented'] as $s)
                <option value="{{ $s }}" @selected(old('status', $v->status ?? 'available') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        @error('status') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>
</div>
