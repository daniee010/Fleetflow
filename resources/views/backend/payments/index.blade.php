
@php use Illuminate\Support\Carbon; @endphp

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Payments</h1>
        <a href="{{ route('admin.payments.create') }}"
           class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            New Payment
        </a>
    </div>

    @if ($payments->count() === 0)
        <div class="bg-white border rounded p-6 text-center">
            <p class="text-gray-600">No payments found yet.</p>
            <a href="{{ route('admin.payments.create') }}" class="inline-block mt-3 underline">Create your first payment</a>
        </div>
    @else
        <div class="overflow-x-auto bg-white border rounded">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Driver</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3 w-px"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($payments as $p)
                    <tr class="hover:bg-gray-50/70">
                        <td class="px-4 py-3 font-medium">#{{ $p->id }}</td>
                        <td class="px-4 py-3">{{ optional($p->driver)->name ?? '—' }}</td>
                        <td class="px-4 py-3">
                            {{ number_format($p->amount, 2) }}
                        </td>
                        <td class="px-4 py-3">
                            {{ \Illuminate\Support\Carbon::parse($p->payment_date)->toFormattedDateString() }}
                        </td>
                        <td class="px-4 py-3 capitalize">{{ $p->payment_type }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.payments.show', $p) }}" class="underline">View</a>
                                <a href="{{ route('admin.payments.edit', $p) }}" class="underline">Edit</a>
                            </div>
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
