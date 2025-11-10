@extends('backend.layout.master')
@section('title','Payments')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Payments</h1>

    @if($payments->count() === 0)
        <div class="p-4 rounded bg-yellow-50 text-yellow-800">No payments found.</div>
    @else
        <div class="overflow-x-auto bg-white dark:bg-[#161615] rounded shadow">
            <table class="min-w-full text-left">
                <thead class="text-sm text-gray-600 dark:text-gray-300 border-b">
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
                        <td class="px-4 py-3">{{ optional($p->driver)->name ?? '—' }}</td>
                        <td class="px-4 py-3">${{ number_format($p->amount, 2) }}</td>
                        <td class="px-4 py-3">{{ \Illuminate\Support\Carbon::parse($p->payment_date)->toFormattedDateString() }}</td>
                        <td class="px-4 py-3 capitalize">{{ $p->payment_type }}</td>
                        <td class="px-4 py-3 space-x-3">
                            <a href="{{ route('admin.payments.show', $p) }}" class="underline">View</a>
                            <a href="{{ route('admin.payments.edit', $p) }}" class="underline">Edit</a>
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
