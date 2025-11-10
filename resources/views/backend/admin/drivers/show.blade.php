@extends('backend.layout.master')
@section('title','Driver Details')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Driver Details</h1>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-[#161615] rounded p-4 shadow">
            <h2 class="font-semibold mb-3">Profile</h2>
            <p><strong>Name:</strong> {{ $driver->name }}</p>
            <p><strong>Email:</strong> {{ $driver->email }}</p>
            <p><strong>Phone:</strong> {{ $driver->phone }}</p>
            <p><strong>License #:</strong> {{ $driver->license_number }}</p>
            <p><strong>Address:</strong> {{ $driver->address }}</p>
            <p><strong>Vehicle:</strong> {{ optional($driver->vehicle)->plate_number ?? 'Unassigned' }}</p>
        </div>

        <div class="bg-white dark:bg-[#161615] rounded p-4 shadow">
            <h2 class="font-semibold mb-3">Payments</h2>
            @forelse($driver->payments as $p)
                <div class="border-b py-2">
                    <p><strong>Date:</strong> {{ \Illuminate\Support\Carbon::parse($p->payment_date)->toDateString() }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($p->amount, 2) }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($p->payment_type) }}</p>
                </div>
            @empty
                <p class="text-gray-500">No payments yet.</p>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.drivers.index') }}" class="px-4 py-2 border rounded">Back</a>
    </div>
@endsection
