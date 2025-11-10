@extends('backend.layout.master')
@section('title','Edit Mechanic')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Mechanic</h1>

    <form action="{{ route('admin.mechanics.update',$mechanic) }}" method="POST" class="max-w-xl space-y-4">
        @csrf @method('PATCH')

        <p class="text-sm mb-2 text-gray-600">User: <strong>{{ $mechanic->user?->name }}</strong> ({{ $mechanic->user?->email }})</p>

        <label class="block">
            <span class="block text-sm mb-1">Phone</span>
            <input name="phone" class="w-full border rounded p-2" value="{{ old('phone',$mechanic->phone) }}">
            @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </label>

        <label class="block">
            <span class="block text-sm mb-1">Specialization</span>
            <input name="specialization" class="w-full border rounded p-2" value="{{ old('specialization',$mechanic->specialization) }}">
            @error('specialization') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </label>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded">Update</button>
    </form>
@endsection
