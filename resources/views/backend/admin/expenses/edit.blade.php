@extends('backend.layout.master')
@section('title','Edit Expense')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Expense #{{ $expense->id }}</h1>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.expenses.update', $expense) }}"
          class="grid md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PATCH')

        <label class="block">
            <span class="text-sm">Date</span>
            <input type="date" name="expense_date" value="{{ old('expense_date', $expense->expense_date) }}"
                   class="mt-1 w-full rounded border p-2 bg-transparent">
        </label>

        <label class="block">
            <span class="text-sm">Category</span>
            <select name="category" class="mt-1 w-full rounded border p-2 bg-transparent">
                @foreach(['fuel','maintenance','insurance','tax','toll','parking','salary','other'] as $c)
                    <option value="{{ $c }}" @selected($expense->category===$c)>{{ ucfirst($c) }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="text-sm">Amount (USD)</span>
            <input type="number" step="0.01" min="0" name="amount"
                   value="{{ old('amount', $expense->amount) }}" class="mt-1 w-full rounded border p-2 bg-transparent">
        </label>

        <label class="block">
            <span class="text-sm">Vehicle (optional)</span>
            <select name="vehicle_id" class="mt-1 w-full rounded border p-2 bg-transparent">
                <option value="">— None —</option>
                @foreach($vehicles as $v)
                    <option value="{{ $v->id }}" @selected($expense->vehicle_id==$v->id)>
                        {{ $v->plate_number }} — {{ $v->make }} {{ $v->model }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="block md:col-span-2">
            <span class="text-sm">Notes</span>
            <textarea name="notes" rows="3" class="mt-1 w-full rounded border p-2 bg-transparent">{{ old('notes', $expense->notes) }}</textarea>
        </label>

        <div class="md:col-span-2 flex gap-3">
            <button class="px-4 py-2 rounded bg-[#f53003] text-white hover:bg-black">Update</button>
            <a class="px-4 py-2 rounded border" href="{{ route('admin.expenses.index') }}">Cancel</a>
        </div>
    </form>
@endsection
