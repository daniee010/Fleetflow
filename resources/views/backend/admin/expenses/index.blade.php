@extends('backend.layout.master')
@section('title','Expenses')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Expenses</h1>
        <a href="{{ route('admin.expenses.create') }}"
           class="px-4 py-2 rounded bg-[#f53003] text-white hover:bg-black">Add Expense</a>
    </div>

    @if(session('status'))
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">{{ session('status') }}</div>
    @endif

    <div class="mb-4 text-sm text-gray-700">
        <span class="mr-6">Total records: <strong>{{ $totals['count'] }}</strong></span>
        <span>Total amount: <strong>${{ number_format($totals['amount'],2) }}</strong></span>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-left">
            <thead class="border-b">
            <tr class="text-sm text-gray-600">
                <th class="p-3">Date</th>
                <th class="p-3">Category</th>
                <th class="p-3">Amount</th>
                <th class="p-3">Vehicle</th>
                <th class="p-3">Notes</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y">
            @forelse($expenses as $e)
                <tr class="text-sm">
                    <td class="p-3">{{ \Illuminate\Support\Carbon::parse($e->expense_date)->toFormattedDateString() }}</td>
                    <td class="p-3 capitalize">{{ str_replace('_',' ',$e->category) }}</td>
                    <td class="p-3 font-semibold">${{ number_format($e->amount,2) }}</td>
                    <td class="p-3">
                        @if($e->vehicle)
                            {{ $e->vehicle->plate_number }} — {{ $e->vehicle->make }} {{ $e->vehicle->model }}
                        @else
                            —
                        @endif
                    </td>
                    <td class="p-3 truncate max-w-[320px]">{{ $e->notes }}</td>
                    <td class="p-3 text-right">
                        <a href="{{ route('admin.expenses.edit', $e) }}" class="underline mr-3">Edit</a>
                        <form action="{{ route('admin.expenses.destroy', $e) }}" method="POST" class="inline"
                              onsubmit="return confirm('Delete this expense?')">
                            @csrf @method('DELETE')
                            <button class="underline text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td class="p-3" colspan="6">No expenses yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $expenses->links() }}
    </div>
@endsection
