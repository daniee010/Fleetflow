@extends('backend.layout.master')
@section('title','Edit Driver')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Driver</h1>

    <form action="#" method="POST" class="max-w-lg space-y-5">
        @csrf
        @method('PUT')
        <!-- Add same inputs here, prefilled with {{ $driver->... }} -->
    </form>
@endsection
