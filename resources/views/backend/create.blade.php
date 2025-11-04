@extends('backend.layout.master')
@section('title','Add Vehicle')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Add Vehicle</h1>

        <form action="{{ route('admin.vehicles.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('backend.vehicles.partials.form', ['mode' => 'create'])
            <button class="px-4 py-2 bg-[#f53003] text-white rounded">Save</button>
        </form>
    </div>
@endsection
