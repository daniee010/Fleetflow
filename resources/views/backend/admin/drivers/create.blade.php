@extends('backend.layout.master')
@section('title','Add Driver')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add New Driver</h1>

    <form action="{{ route('admin.drivers.store') }}" method="POST" class="max-w-lg space-y-5">
        @csrf

        {{-- NAME --}}
        <div>
            <label class="block text-sm font-medium mb-1">Full Name</label>
            <input name="name" class="w-full border rounded px-3 py-2"
                   value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- EMAIL (optional user account) --}}
        <div>
            <label class="block text-sm font-medium mb-1">Email (optional)</label>
            <input type="email" name="email"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('email') }}">
            @error('email') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- PHONE --}}
        <div>
            <label class="block text-sm font-medium mb-1">Phone Number</label>
            <input name="phone" class="w-full border rounded px-3 py-2"
                   value="{{ old('phone') }}">
            @error('phone') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- LICENSE NUMBER --}}
        <div>
            <label class="block text-sm font-medium mb-1">License Number</label>
            <input name="license_number" class="w-full border rounded px-3 py-2"
                   value="{{ old('license_number') }}">
            @error('license_number') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- LICENSE EXPIRY --}}
        <div>
            <label class="block text-sm font-medium mb-1">License Expiry</label>
            <input type="date" name="license_expiry"
                   class="w-full border rounded px-3 py-2"
                   value="{{ old('license_expiry') }}">
            @error('license_expiry') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- ADDRESS --}}
        <div>
            <label class="block text-sm font-medium mb-1">Address</label>
            <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address') }}</textarea>
            @error('address') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- CITY --}}
        <div>
            <label class="block text-sm font-medium mb-1">City</label>
            <input name="city" class="w-full border rounded px-3 py-2"
                   value="{{ old('city') }}">
            @error('city') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- COUNTRY --}}
        <div>
            <label class="block text-sm font-medium mb-1">Country</label>
            <input name="country" class="w-full border rounded px-3 py-2"
                   value="{{ old('country') }}">
            @error('country') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- STATUS --}}
        <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ old('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
            @error('status') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        {{-- SCHEME TYPE --}}
        <div>
            <label class="block text-sm font-medium mb-1">Scheme Type</label>
            <select name="scheme_type" class="w-full border rounded px-3 py-2">
                <option value="sales_only" {{ old('scheme_type') === 'sales_only' ? 'selected' : '' }}>Sales Only</option>
                <option value="work_and_pay" {{ old('scheme_type') === 'work_and_pay' ? 'selected' : '' }}>Work &amp; Pay</option>
                <option value="mixed" {{ old('scheme_type') === 'mixed' ? 'selected' : '' }}>Mixed</option>
            </select>
            @error('scheme_type') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>


        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Save Driver
        </button>
    </form>
@endsection
