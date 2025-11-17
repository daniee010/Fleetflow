@extends('backend.layout.master')
@section('title','Customers')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Customers</h1>
        <a href="{{ route('admin.customers.create') }}"
           class="px-4 py-2 bg-[#f53003] text-white rounded-md hover:bg-black">Add Customer</a>
    </div>

    <table class="min-w-full text-left bg-white rounded-lg overflow-hidden">
        <thead>
        <tr>
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Phone</th>
            <th class="px-4 py-3">Rentals</th>
            <th class="px-4 py-3">Actions</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200/60">
        @foreach($customers as $c)
            <tr>
                <td class="px-4 py-3">{{ $c->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $c->name }}</td>
                <td class="px-4 py-3">{{ $c->email }}</td>
                <td class="px-4 py-3">{{ $c->phone }}</td>
                <td class="px-4 py-3">{{ $c->rentals()->count() }}</td>
                <td class="px-4 py-3 space-x-3">
                    <a href="{{ route('admin.customers.show', $c) }}" class="underline">View</a>
                    <a href="{{ route('admin.customers.edit', $c) }}" class="underline">Edit</a>
                    <form action="{{ route('admin.customers.destroy', $c) }}" method="POST" class="inline"
                          onsubmit="return confirm('Delete this customer?');">
                        @csrf @method('DELETE')
                        <button class="underline text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $customers->links() }}</div>
@endsection
