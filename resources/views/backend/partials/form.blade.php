@php
    /** @var \App\Models\Vehicle|null $vehicle */
    $v = $vehicle ?? null;
    $mode = $mode ?? 'create';
@endphp

<div class="space-y-5">
    {{-- Plate Number --}}
    <div>
        <label class="block text-sm font-medium mb-1">Plate Number</label>
        <input type="text"
               name="plate_number"
               class="w-full border rounded px-3 py-2"
               value="{{ old('plate_number', $v->plate_number ?? '') }}"
               required>
        @error('plate_number')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Make --}}
    <div>
        <label class="block text-sm font-medium mb-1">Make</label>
        <input type="text"
               name="make"
               class="w-full border rounded px-3 py-2"
               value="{{ old('make', $v->make ?? '') }}"
               required>
        @error('make')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Model --}}
    <div>
        <label class="block text-sm font-medium mb-1">Model</label>
        <input type="text"
               name="model"
               class="w-full border rounded px-3 py-2"
               value="{{ old('model', $v->model ?? '') }}"
               required>
        @error('model')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Year --}}
    <div>
        <label class="block text-sm font-medium mb-1">Year</label>
        <input type="number"
               name="year"
               class="w-full border rounded px-3 py-2"
               value="{{ old('year', $v->year ?? '') }}">
        @error('year')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Color --}}
    <div>
        <label class="block text-sm font-medium mb-1">Color</label>
        <input type="text"
               name="color"
               class="w-full border rounded px-3 py-2"
               value="{{ old('color', $v->color ?? '') }}">
        @error('color')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div>
        <label class="block text-sm font-medium mb-1">Status</label>
        @php
            $statusValue = old('status', $v->status ?? 'available');
        @endphp
        <select name="status" class="w-full border rounded px-3 py-2">
            <option value="available"   {{ $statusValue === 'available' ? 'selected' : '' }}>Available</option>
            <option value="rented"      {{ $statusValue === 'rented' ? 'selected' : '' }}>Rented</option>
            <option value="maintenance" {{ $statusValue === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            <option value="sales"       {{ $statusValue === 'sales' ? 'selected' : '' }}>Sales</option>
            <option value="contract"    {{ $statusValue === 'contract' ? 'selected' : '' }}>Work &amp; Pay (Contract)</option>
        </select>
        @error('status')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Rate --}}
    <div>
        <label class="block text-sm font-medium mb-1">
            Rate (GH₵)
        </label>
        <input type="number"
               step="0.01"
               name="daily_rate"
               class="w-full border rounded px-3 py-2"
               value="{{ old('daily_rate', $v->daily_rate ?? '') }}">
        <p class="text-[11px] text-gray-500 mt-1">
            For <span class="font-semibold">rented</span> vehicles this is used as a <span class="italic">daily rate</span>.<br>
            For <span class="font-semibold">sales</span> / <span class="font-semibold">contract</span> vehicles you can treat this as the
            <span class="italic">weekly payment</span>.
        </p>
        @error('daily_rate')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>
