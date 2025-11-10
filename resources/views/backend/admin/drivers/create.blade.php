@extends('backend.layout.master')
@section('title','Add Driver')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add New Driver</h1>

    <form action="{{ route('admin.drivers.store') }}" method="POST" class="max-w-lg space-y-5">
        @csrf

        <div>
            <label class="block text-sm mb-1">Name</label>
            <input name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm mb-1">Email</label>
            <input name="email" type="email" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Phone</label>
            <input name="phone" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">License #</label>
            <input name="license_number" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm mb-1">Address</label>
            <textarea name="address" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">Save</button>
    </form>
@endsection
