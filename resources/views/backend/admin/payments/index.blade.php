@extends('backend.layout.master')
@section('title','Payments')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Payments</h1>

    @if($payments->count() === 0)
        <div class="p-4 rounded bg-yellow-50 text-yellow-800">No payments found.</div>
    @else
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-left">
                <thead class="text-sm text-gray-600 border-b">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Driver</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3"></th>
                </tr>
                </thead>
                <tbody class="text-sm">
                @foreach($payments as $p)
                    <tr class="border-b last:border-0">
                        <td class="px-4 py-3">{{ $p->id }}</td>

                        {{-- Driver or Customer --}}
                        <td class="px-4 py-3">
                            @if($p->payment_type === 'rental')
                                {{-- Customer Rental Payment --}}
                                @if(optional($p->rental)->customer)
                                    {{ $p->rental->customer->name }}
                                    <div class="text-xs text-gray-500">
                                        Rental • {{ optional($p->vehicle)->plate_number }}
                                    </div>
                                @else
                                    Customer (Rental)
                                @endif

                            @elseif($p->payment_type === 'contract')
                                {{-- Work & Pay Contract Payment --}}
                                {{ optional($p->driver)->name ?? 'Driver —' }}
                                <div class="text-xs text-gray-500">
                                    {{ optional($p->vehicle)->plate_number }} • Work &amp; Pay Contract
                                </div>

                            @elseif($p->payment_type === 'sales')
                                {{-- Sales Driver Payment --}}
                                {{ optional($p->driver)->name ?? 'Driver —' }}
                                <div class="text-xs text-gray-500">
                                    {{ optional($p->vehicle)->plate_number }} • Sales Driver
                                </div>
                            @else
                                {{-- Unknown (fallback) --}}
                                <span class="text-gray-400 italic">Unknown</span>
                            @endif
                        </td>


                        {{-- Amount --}}
                        <td class="px-4 py-3">
                            GH₵ {{ number_format($p->amount, 2) }}
                        </td>

                        {{-- Date --}}
                        <td class="px-4 py-3">
                            {{ optional($p->payment_date)->toFormattedDateString() ?? '—' }}
                        </td>

                        {{-- Type --}}
                        <td class="px-4 py-3">
            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px]
                @class([
                    'bg-blue-100 text-blue-700'   => $p->payment_type === 'rental',
                    'bg-purple-100 text-purple-700' => $p->payment_type === 'contract',
                    'bg-gray-100 text-gray-700'   => ! in_array($p->payment_type, ['rental','contract']),
                ])">
                {{ $p->type_label }}
            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-3 space-x-3">
                            <a href="{{ route('admin.payments.show', $p) }}" class="underline text-xs">View</a>
                            <a href="{{ route('admin.payments.edit', $p) }}" class="underline text-xs">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    @endif
@endsection
