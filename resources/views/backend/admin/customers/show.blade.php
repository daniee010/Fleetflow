@extends('backend.layout.master')
@section('title','Customer Details')

@section('content')
    <h1 class="text-2xl font-bold mb-2">{{ $customer->name }}</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-6">{{ $customer->email }} • {{ $customer->phone }}</p>

    @if($customer->address)
        <p class="mb-6"><span class="font-medium">Address:</span> {{ $customer->address }}</p>
    @endif

    <div class="grid md:grid-cols-2 gap-8">
        {{-- Rentals --}}
        <div>
            <h2 class="text-xl font-semibold mb-3">Rentals</h2>
            <div class="bg-white dark:bg-[#161615] rounded-lg overflow-hidden">
                <table class="min-w-full text-left">
                    <thead>
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Vehicle</th>
                        <th class="px-4 py-3">Start</th>
                        <th class="px-4 py-3">End</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/60">
                    @forelse($customer->rentals as $r)
                        <tr>
                            <td class="px-4 py-3">{{ $r->id }}</td>
                            <td class="px-4 py-3">{{ optional($r->vehicle)->plate_number }}</td>
                            <td class="px-4 py-3">{{ $r->start_date }}</td>
                            <td class="px-4 py-3">{{ $r->end_date }}</td>
                            <td class="px-4 py-3">{{ $r->status }}</td>
                        </tr>
                    @empty
                        <tr><td class="px-4 py-3" colspan="5">No rentals yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Payments --}}
        <div>
            <h2 class="text-xl font-semibold mb-3">Payments</h2>
            <div class="bg-white dark:bg-[#161615] rounded-lg overflow-hidden">
                <table class="min-w-full text-left">
                    <thead>
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Vehicle</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/60">
                    @forelse($customer->payments as $p)
                        <tr>
                            <td class="px-4 py-3">{{ $p->id }}</td>
                            <td class="px-4 py-3">{{ $p->payment_date }}</td>
                            <td class="px-4 py-3">${{ number_format($p->amount,2) }}</td>
                            <td class="px-4 py-3">{{ $p->payment_type }}</td>
                            <td class="px-4 py-3">{{ optional(optional($p->rental)->vehicle)->plate_number }}</td>
                        </tr>
                    @empty
                        <tr><td class="px-4 py-3" colspan="5">No payments recorded.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.customers.edit', $customer) }}" class="px-4 py-2 bg-[#f53003] text-white rounded-md hover:bg-black">Edit</a>
        <a href="{{ route('admin.customers.index') }}" class="ml-3 underline">Back</a>
    </div>
@endsection
