{{--@extends('backend.layout.master')--}}
{{--@section('title','Customer Details')--}}

{{--@section('content')--}}
{{--    <h1 class="text-2xl font-bold mb-2">{{ $customer->name }}</h1>--}}
{{--    <p class="text-gray-600 mb-6">{{ $customer->email }} • {{ $customer->phone }}</p>--}}

{{--    @if($customer->address)--}}
{{--        <p class="mb-6"><span class="font-medium">Address:</span> {{ $customer->address }}</p>--}}
{{--    @endif--}}

{{--    <div class="grid md:grid-cols-2 gap-8">--}}
{{--        --}}{{-- Rentals --}}
{{--        <div>--}}
{{--            <h2 class="text-xl font-semibold mb-3">Rentals</h2>--}}
{{--            <div class="bg-white rounded-lg overflow-hidden">--}}
{{--                <table class="min-w-full text-left">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th class="px-4 py-3">#</th>--}}
{{--                        <th class="px-4 py-3">Vehicle</th>--}}
{{--                        <th class="px-4 py-3">Start</th>--}}
{{--                        <th class="px-4 py-3">End</th>--}}
{{--                        <th class="px-4 py-3">Status</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="divide-y divide-gray-200/60">--}}
{{--                    @forelse($customer->rentals as $r)--}}
{{--                        <tr>--}}
{{--                            <td class="px-4 py-3">{{ $r->id }}</td>--}}
{{--                            <td class="px-4 py-3">{{ optional($r->vehicle)->plate_number }}</td>--}}
{{--                            <td class="px-4 py-3">{{ $r->start_date }}</td>--}}
{{--                            <td class="px-4 py-3">{{ $r->end_date }}</td>--}}
{{--                            <td class="px-4 py-3">{{ $r->status }}</td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr><td class="px-4 py-3" colspan="5">No rentals yet.</td></tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Payments --}}
{{--        <div>--}}
{{--            <h2 class="text-xl font-semibold mb-3">Payments</h2>--}}
{{--            <div class="bg-white rounded-lg overflow-hidden">--}}
{{--                <table class="min-w-full text-left">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th class="px-4 py-3">#</th>--}}
{{--                        <th class="px-4 py-3">Date</th>--}}
{{--                        <th class="px-4 py-3">Amount</th>--}}
{{--                        <th class="px-4 py-3">Type</th>--}}
{{--                        <th class="px-4 py-3">Vehicle</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="divide-y divide-gray-200/60">--}}
{{--                    @forelse($customer->payments as $p)--}}
{{--                        <tr>--}}
{{--                            <td class="px-4 py-3">{{ $p->id }}</td>--}}
{{--                            <td class="px-4 py-3">{{ $p->payment_date }}</td>--}}
{{--                            <td class="px-4 py-3">${{ number_format($p->amount,2) }}</td>--}}
{{--                            <td class="px-4 py-3">{{ $p->payment_type }}</td>--}}
{{--                            <td class="px-4 py-3">{{ optional(optional($p->rental)->vehicle)->plate_number }}</td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr><td class="px-4 py-3" colspan="5">No payments recorded.</td></tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="mt-6">--}}
{{--        <a href="{{ route('admin.customers.edit', $customer) }}" class="px-4 py-2 bg-[#f53003] text-white rounded-md hover:bg-black">Edit</a>--}}
{{--        <a href="{{ route('admin.customers.index') }}" class="ml-3 underline">Back</a>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('backend.layout.master')
@section('title','Customer')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Customer: {{ $customer->name }}</h1>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="bg-white rounded p-4 shadow">
            <h3 class="font-semibold mb-2">Profile</h3>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Phone:</strong> {{ $customer->phone ?? '—' }}</p>
            <p><strong>Address:</strong> {{ $customer->address ?? '—' }}</p>

            <div class="mt-4 grid grid-cols-3 gap-3 text-center">
                <div class="bg-gray-50 p-3 rounded">
                    <div class="text-sm text-gray-500">Rentals</div>
                    <div class="text-xl font-bold">{{ $stats['rentals_count'] }}</div>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <div class="text-sm text-gray-500">Active</div>
                    <div class="text-xl font-bold">{{ $stats['active_rentals'] }}</div>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <div class="text-sm text-gray-500">Spent</div>
                    <div class="text-xl font-bold">${{ number_format($stats['total_spent'],2) }}</div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded p-4 shadow">
                <h3 class="font-semibold mb-3">Rentals</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Vehicle</th>
                            <th class="px-3 py-2">Start</th>
                            <th class="px-3 py-2">End</th>
                            <th class="px-3 py-2">Cost</th>
                            <th class="px-3 py-2">Status</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse($customer->rentals as $r)
                            <tr class="text-sm">
                                <td class="px-3 py-2">{{ $r->id }}</td>
                                <td class="px-3 py-2">
                                    {{ $r->vehicle?->plate_number }} —
                                    {{ $r->vehicle?->make }} {{ $r->vehicle?->model }}
                                </td>
                                <td class="px-3 py-2">{{ $r->start_date }}</td>
                                <td class="px-3 py-2">{{ $r->end_date }}</td>
                                <td class="px-3 py-2">${{ number_format($r->total_cost,2) }}</td>
                                <td class="px-3 py-2">{{ $r->status }}</td>
                            </tr>
                        @empty
                            <tr><td class="px-3 py-4 text-gray-500" colspan="6">No rentals.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded p-4 shadow">
                <h3 class="font-semibold mb-3">Payments</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Amount</th>
                            <th class="px-3 py-2">Date</th>
                            <th class="px-3 py-2">Type</th>
                            <th class="px-3 py-2">Notes</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse($customer->payments as $p)
                            <tr class="text-sm">
                                <td class="px-3 py-2">{{ $p->id }}</td>
                                <td class="px-3 py-2">${{ number_format($p->amount,2) }}</td>
                                <td class="px-3 py-2">{{ $p->payment_date }}</td>
                                <td class="px-3 py-2">{{ $p->payment_type }}</td>
                                <td class="px-3 py-2">{{ \Illuminate\Support\Str::limit($p->notes, 60) }}</td>
                            </tr>
                        @empty
                            <tr><td class="px-3 py-4 text-gray-500" colspan="5">No payments.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
