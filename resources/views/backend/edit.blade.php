@extends('backend.layout.master')
@section('title','Edit Vehicle')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Vehicle</h1>

        <form action="{{ route('admin.vehicles.update',$vehicle) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            @include('backend.vehicles.partials.form', ['mode' => 'edit'])
            <button class="px-4 py-2 bg-[#f53003] text-white rounded">Update</button>
        </form>
    </div>
@endsection
