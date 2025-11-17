@extends('backend.layout.master')

@section('title', 'Edit Customer')

@section('content')
    <div class="max-w-6xl mx-auto space-y-10">

        {{-- Customer form --}}
        <section class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Edit Customer</h1>

            <form method="POST" action="{{ route('admin.customers.update', $customer) }}" class="grid sm:grid-cols-2 gap-4">
                @csrf @method('PATCH')

                <label class="block">
                    <span class="text-sm">Name</span>
                    <input name="name" value="{{ old('name', $customer->name) }}" class="mt-1 w-full rounded border p-2 bg-transparent">
                </label>

                <label class="block">
                    <span class="text-sm">Email</span>
                    <input name="email" value="{{ old('email', $customer->email) }}" class="mt-1 w-full rounded border p-2 bg-transparent">
                </label>

                <label class="block">
                    <span class="text-sm">Phone</span>
                    <input name="phone" value="{{ old('phone', $customer->phone) }}" class="mt-1 w-full rounded border p-2 bg-transparent">
                </label>

                <label class="block sm:col-span-2">
                    <span class="text-sm">Address</span>
                    <input name="address" value="{{ old('address', $customer->address) }}" class="mt-1 w-full rounded border p-2 bg-transparent">
                </label>

                <div class="sm:col-span-2">
                    <button class="px-4 py-2 bg-[#f53003] text-white rounded">Save Customer</button>
                </div>
            </form>
        </section>

        {{-- Rental history --}}
        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Rental History</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="text-gray-600">
                    <tr>
                        <th class="p-2">Vehicle</th>
                        <th class="p-2">Start</th>
                        <th class="p-2">End</th>
                        <th class="p-2">Total</th>
                        <th class="p-2">Status</th>
                        <th class="p-2"></th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($customer->rentals as $rental)
                        <tr>
                            <td class="p-2">
                                {{ $rental->vehicle->plate_number ?? '—' }} —
                                {{ $rental->vehicle->make ?? '' }} {{ $rental->vehicle->model ?? '' }}
                            </td>
                            <td class="p-2">{{ $rental->start_date }}</td>
                            <td class="p-2">{{ $rental->end_date }}</td>
                            <td class="p-2">${{ number_format($rental->total_cost, 2) }}</td>
                            <td class="p-2">
                                <form method="POST" action="{{ route('admin.rentals.update', $rental) }}" class="flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <select name="status" class="rounded border bg-transparent p-1">
                                        @foreach(['pending','approved','completed','cancelled'] as $s)
                                            <option value="{{ $s }}" @selected($rental->status === $s)>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                    <button class="px-3 py-1 rounded bg-gray-200">Save</button>
                                </form>
                            </td>
                            <td class="p-2">
                                <form method="POST" action="{{ route('admin.customers.rentals.destroy', [$customer, $rental]) }}">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add Rental --}}
            <div class="mt-6">
                <h3 class="font-semibold mb-2">Add Rental</h3>
                <form method="POST" action="{{ route('admin.customers.rentals.store', $customer) }}" class="flex flex-wrap gap-3 items-end">
                    @csrf
                    <label class="block">
                        <span class="text-sm">Vehicle</span>
                        <select name="vehicle_id" class="mt-1 rounded border bg-transparent p-2">
                            @foreach($vehicles as $v)
                                <option value="{{ $v->id }}">{{ $v->plate_number }} • {{ $v->make }} {{ $v->model }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-sm">Start</span>
                        <input type="date" name="start_date" class="mt-1 rounded border bg-transparent p-2">
                    </label>
                    <label class="block">
                        <span class="text-sm">End</span>
                        <input type="date" name="end_date" class="mt-1 rounded border bg-transparent p-2">
                    </label>
                    <label class="block">
                        <span class="text-sm">Status</span>
                        <select name="status" class="mt-1 rounded border bg-transparent p-2">
                            @foreach(['pending','approved','completed','cancelled'] as $s)
                                <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-sm">Total ($)</span>
                        <input type="number" step="0.01" min="0" name="total_cost" class="mt-1 rounded border bg-transparent p-2">
                    </label>
                    <button class="px-4 py-2 bg-[#f53003] text-white rounded">Add Rental</button>
                </form>
            </div>
        </section>
    </div>
@endsection

