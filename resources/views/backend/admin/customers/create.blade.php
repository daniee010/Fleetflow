@extends('backend.layout.master')
@section('title','Add Customer')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add Customer</h1>

    <form action="{{ route('admin.customers.store') }}" method="POST" class="max-w-xl space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Name</label>
            <input name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Phone</label>
            <input name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Address (optional)</label>
            <input name="address" value="{{ old('address') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="pt-2">
            <button class="px-4 py-2 bg-[#f53003] text-white rounded-md hover:bg-black">Save</button>
            <a href="{{ route('admin.customers.index') }}" class="ml-3 underline">Cancel</a>
        </div>
    </form>
@endsection
