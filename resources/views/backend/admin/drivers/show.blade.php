@extends('backend.layout.master')

@section('title', 'Driver Details')

@section('content')
    @php
        $contract = $driver->activeWorkAndPayContract;
    @endphp

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">
                {{ $driver->name }}

                {{-- Scheme badge --}}
                @if($driver->scheme_type === 'sales_only')
                    <span class="ml-2 px-2 py-0.5 rounded-full text-[10px] bg-blue-100 text-blue-700">
                        Sales Only
                    </span>
                @elseif($driver->scheme_type === 'work_and_pay')
                    <span class="ml-2 px-2 py-0.5 rounded-full text-[10px] bg-purple-100 text-purple-700">
                        Work &amp; Pay
                    </span>
                @elseif($driver->scheme_type === 'mixed')
                    <span class="ml-2 px-2 py-0.5 rounded-full text-[10px] bg-green-100 text-green-700">
                        Mixed
                    </span>
                @endif
            </h1>

            <div class="text-sm text-gray-500 mt-1">
                Status: <span class="capitalize">{{ $driver->status }}</span>
            </div>
        </div>

        <a href="{{ route('admin.drivers.index') }}" class="text-sm underline">
            ← Back to Drivers
        </a>
    </div>

    {{-- Top summary cards --}}
    <div class="grid md:grid-cols-3 gap-4 mb-8">
        {{-- Driver / Contact --}}
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Driver Profile</h2>
            <div class="space-y-1 text-sm">
                <div><span class="font-semibold">Name:</span> {{ $driver->name }}</div>
                <div><span class="font-semibold">Phone:</span> {{ $driver->phone ?? '—' }}</div>
                <div><span class="font-semibold">Email:</span> {{ optional($driver->user)->email ?? '—' }}</div>
                <div><span class="font-semibold">License:</span> {{ $driver->license_number ?? '—' }}</div>
                <div class="text-xs text-gray-500">
                    Expires: {{ $driver->license_expiry ?? '—' }}
                </div>
            </div>
        </div>

        {{-- Vehicle assignment --}}
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Assigned Vehicle</h2>
            @if($driver->vehicle)
                <div class="text-sm space-y-1">
                    <div class="font-semibold">
                        {{ $driver->vehicle->plate_number }}
                    </div>
                    <div>
                        {{ $driver->vehicle->make }} {{ $driver->vehicle->model }}
                    </div>
                    <div class="text-xs text-gray-500">
                        Year: {{ $driver->vehicle->year ?? '—' }}
                    </div>
                </div>
            @else
                <div class="text-sm text-gray-500">No vehicle assigned.</div>
            @endif
        </div>

        {{-- Work & Pay summary --}}
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold text-gray-500 mb-2">Work &amp; Pay Summary</h2>

            @if($contract)
                @php
                    $total   = $contract->total_amount ?? 0;
                    $paid    = $contract->amount_paid ?? 0;
                    $balance = $contract->balance ?? max($total - $paid, 0);
                    $percent = $contract->progress_percent ?? ($total > 0 ? round(($paid / $total) * 100) : 0);
                @endphp

                <div class="text-sm space-y-1">
                    <div>Total: GH₵ {{ number_format($total, 2) }}</div>
                    <div>Paid: GH₵ {{ number_format($paid, 2) }}</div>
                    <div>Balance: GH₵ {{ number_format($balance, 2) }}</div>
                    <div class="text-xs text-gray-500">
                        Status: {{ ucfirst($contract->status) }}
                    </div>
                </div>

                <div class="mt-3">
                    <div class="flex justify-between text-xs mb-1">
                        <span>Progress</span>
                        <span>{{ $percent }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded h-2 overflow-hidden">
                        <div class="h-2 bg-[#f53003]" style="width: {{ $percent }}%;"></div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('admin.contracts.show', $contract) }}" class="text-xs underline">
                        View Contract
                    </a>
                    <span class="mx-1 text-xs text-gray-400">•</span>
                    <a href="{{ route('admin.contracts.payments.create', $contract) }}" class="text-xs underline">
                        Record Payment
                    </a>
                </div>
            @else
                <div class="text-sm text-gray-500">
                    No active Work &amp; Pay contract for this driver.
                </div>
                <div class="mt-2">
                    <a href="{{ route('admin.contracts.create') }}"
                       class="text-xs underline">
                        Create Work &amp; Pay Contract
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Sales Payments (for sales_only / mixed drivers) --}}
    @if(in_array($driver->scheme_type, ['sales_only','mixed']))
        <section class="mb-8">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-gray-500">Sales Payments</h2>

                <a href="{{ route('admin.drivers.sales-payments.create', $driver) }}"
                   class="px-3 py-1.5 text-xs bg-[#f53003] text-white rounded hover:bg-black transition">
                    Record Sales Payment
                </a>
            </div>

            <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
                @php
                    $totalSales = $driver->salesPayments->sum('amount');
                @endphp

                <div class="flex items-center justify-between mb-3 text-sm">
                    <div>
                        <div class="text-xs text-gray-500 uppercase">Total Sales Payments</div>
                        <div class="text-xl font-bold">
                            GH₵ {{ number_format($totalSales, 2) }}
                        </div>
                    </div>
                    <div class="text-xs text-gray-400">
                        Scheme: {{ ucfirst(str_replace('_',' ', $driver->scheme_type ?? 'sales_only')) }}
                    </div>
                </div>

                <h3 class="text-xs font-semibold text-gray-500 mb-2">Recent Sales Payments</h3>

                @if($driver->salesPayments->isEmpty())
                    <p class="text-xs text-gray-500">No sales payments recorded yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-xs">
                            <thead class="border-b text-gray-500">
                            <tr>
                                <th class="px-2 py-1 text-left">Date</th>
                                <th class="px-2 py-1 text-left">Vehicle</th>
                                <th class="px-2 py-1 text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($driver->salesPayments as $sp)
                                <tr class="border-b last:border-0">
                                    <td class="px-2 py-1">
                                        {{ optional($sp->payment_date)->toDateString() ?? '—' }}
                                    </td>
                                    <td class="px-2 py-1">
                                        {{ optional($sp->vehicle)->plate_number ?? '—' }}
                                    </td>
                                    <td class="px-2 py-1 text-right">
                                        GH₵ {{ number_format($sp->amount, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <div class="grid lg:grid-cols-2 gap-6">
        {{-- Work & Pay Contracts list --}}
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold mb-3">Work &amp; Pay Contracts</h2>

            @if($driver->workAndPayContracts->isEmpty())
                <p class="text-sm text-gray-500">No contracts found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs text-left">
                        <thead class="border-b text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="px-3 py-2">ID</th>
                            <th class="px-3 py-2">Vehicle</th>
                            <th class="px-3 py-2">Total</th>
                            <th class="px-3 py-2">Paid</th>
                            <th class="px-3 py-2">Balance</th>
                            <th class="px-3 py-2">Status</th>
                            <th class="px-3 py-2"></th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
                        @foreach($driver->workAndPayContracts as $c)
                            @php
                                $cTotal   = $c->total_amount ?? 0;
                                $cPaid    = $c->amount_paid ?? 0;
                                $cBalance = $c->balance ?? max($cTotal - $cPaid, 0);
                            @endphp
                            <tr>
                                <td class="px-3 py-2">#{{ $c->id }}</td>
                                <td class="px-3 py-2">
                                    {{ $c->vehicle->plate_number ?? '—' }}
                                </td>
                                <td class="px-3 py-2">
                                    GH₵ {{ number_format($cTotal, 2) }}
                                </td>
                                <td class="px-3 py-2">
                                    GH₵ {{ number_format($cPaid, 2) }}
                                </td>
                                <td class="px-3 py-2">
                                    GH₵ {{ number_format($cBalance, 2) }}
                                </td>
                                <td class="px-3 py-2 text-xs capitalize">
                                    {{ $c->status }}
                                </td>
                                <td class="px-3 py-2 text-right text-xs">
                                    <a href="{{ route('admin.contracts.show', $c) }}" class="underline">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Payments --}}
        <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
            <h2 class="text-sm font-semibold mb-3">Recent Payments</h2>

            @if($driver->payments->isEmpty())
                <p class="text-sm text-gray-500">No payments recorded.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs text-left">
                        <thead class="border-b text-gray-600 dark:text-gray-300">
                        <tr>
                            <th class="px-3 py-2">Date</th>
                            <th class="px-3 py-2">Amount</th>
                            <th class="px-3 py-2">Type</th>
                            <th class="px-3 py-2">Notes</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
                        @foreach($driver->payments as $p)
                            <tr>
                                <td class="px-3 py-2">
                                    {{ \Illuminate\Support\Carbon::parse($p->payment_date)->format('Y-m-d') }}
                                </td>
                                <td class="px-3 py-2">
                                    GH₵ {{ number_format($p->amount, 2) }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $p->payment_type ?? '—' }}
                                </td>
                                <td class="px-3 py-2">
                                    {{ $p->notes ?? '—' }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Trips section --}}
    <div class="mt-8 bg-white dark:bg-[#161615] rounded-lg shadow p-4">
        <h2 class="text-sm font-semibold mb-3">Recent Trips</h2>

        @if($driver->trips->isEmpty())
            <p class="text-sm text-gray-500">No trips recorded.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs text-left">
                    <thead class="border-b text-gray-600 dark:text-gray-300">
                    <tr>
                        <th class="px-3 py-2">Date</th>
                        <th class="px-3 py-2">Origin</th>
                        <th class="px-3 py-2">Destination</th>
                        <th class="px-3 py-2">Revenue</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
                    @foreach($driver->trips as $t)
                        <tr>
                            <td class="px-3 py-2">
                                {{ \Illuminate\Support\Carbon::parse($t->created_at)->format('Y-m-d') }}
                            </td>
                            <td class="px-3 py-2">{{ $t->origin ?? '—' }}</td>
                            <td class="px-3 py-2">{{ $t->destination ?? '—' }}</td>
                            <td class="px-3 py-2">
                                GH₵ {{ number_format($t->revenue_amount ?? 0, 2) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
