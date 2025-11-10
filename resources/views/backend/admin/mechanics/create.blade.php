@extends('backend.layout.master')
@section('title','Add Mechanic')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Add Mechanic</h1>

    <form action="{{ route('admin.mechanics.store') }}" method="POST" class="max-w-xl space-y-4">
        @csrf
        <label class="block">
            <span class="block text-sm mb-1">User (role: mechanic)</span>
            <select name="user_id" required class="w-full border rounded p-2">
                <option value="">-- Select user --</option>
                @foreach($availableUsers as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                @endforeach
            </select>
            @error('user_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </label>

        <label class="block">
            <span class="block text-sm mb-1">Phone</span>
            <input name="phone" class="w-full border rounded p-2" value="{{ old('phone') }}">
            @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </label>

        <label class="block">
            <span class="block text-sm mb-1">Specialization</span>
            <input name="specialization" class="w-full border rounded p-2" value="{{ old('specialization') }}">
            @error('specialization') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </label>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded">Save</button>
    </form>
@endsection
