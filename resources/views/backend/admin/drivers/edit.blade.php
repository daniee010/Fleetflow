@extends('backend.layout.master')

@section('title', 'Edit Driver')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Driver</h1>

    <form action="{{ route('admin.drivers.update', $driver) }}" method="POST" class="max-w-lg space-y-5">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('name', $driver->name) }}" required>
            @error('name')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Phone --}}
        <div>
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="text" name="phone"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('phone', $driver->phone) }}">
            @error('phone')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- License Number --}}
        <div>
            <label class="block text-sm font-medium mb-1">License Number</label>
            <input type="text" name="license_number"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('license_number', $driver->license_number) }}">
            @error('license_number')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- License Expiry --}}
        <div>
            <label class="block text-sm font-medium mb-1">License Expiry</label>
            <input type="date" name="license_expiry"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('license_expiry', $driver->license_expiry) }}">
            @error('license_expiry')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Address --}}
        <div>
            <label class="block text-sm font-medium mb-1">Address</label>
            <input type="text" name="address"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('address', $driver->address) }}">
            @error('address')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- City --}}
        <div>
            <label class="block text-sm font-medium mb-1">City</label>
            <input type="text" name="city"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('city', $driver->city) }}">
        </div>

        {{-- Country --}}
        <div>
            <label class="block text-sm font-medium mb-1">Country</label>
            <input type="text" name="country"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('country', $driver->country) }}">
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="active"   {{ old('status', $driver->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $driver->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ old('status', $driver->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                <option value="pending"  {{ old('status', $driver->status) === 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
            @error('status')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Scheme Type --}}
        <div>
            <label class="block text-sm font-medium mb-1">Scheme Type</label>
            <select name="scheme_type" class="w-full border rounded px-3 py-2">
                <option value="sales_only"   {{ old('scheme_type', $driver->scheme_type) === 'sales_only' ? 'selected' : '' }}>Sales Only</option>
                <option value="work_and_pay" {{ old('scheme_type', $driver->scheme_type) === 'work_and_pay' ? 'selected' : '' }}>Work &amp; Pay</option>
                <option value="mixed"        {{ old('scheme_type', $driver->scheme_type) === 'mixed' ? 'selected' : '' }}>Mixed</option>
            </select>
            @error('scheme_type')
            <p class="text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Save Changes
        </button>
    </form>
@endsection
