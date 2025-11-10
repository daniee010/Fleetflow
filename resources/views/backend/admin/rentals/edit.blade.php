@extends('backend.layout.master')
@section('title','Edit Rental')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Rental #{{ $rental->id }}</h1>

    <form method="POST" action="{{ route('admin.rentals.update', $rental) }}" class="space-y-4 max-w-xl">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-sm mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                @foreach(['pending','approved','completed','cancelled'] as $s)
                    <option value="{{ $s }}" @selected($rental->status === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            @error('status')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <button class="px-4 py-2 bg-[#f53003] text-white rounded">Save</button>
        <a href="{{ route('admin.rentals.index') }}" class="ml-3 underline">Cancel</a>
    </form>
@endsection
