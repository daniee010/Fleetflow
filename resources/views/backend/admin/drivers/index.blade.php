@extends('backend.layout.master')
@section('title','Drivers')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Drivers</h1>
        <a href="{{ route('admin.drivers.create') }}" class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Add Driver
        </a>
    </div>

    @if($drivers->count() === 0)
        <div class="p-4 bg-yellow-50 text-yellow-800 rounded">No drivers found.</div>
    @else
        <div class="overflow-x-auto bg-white dark:bg-[#161615] rounded shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="border-b text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Vehicle</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
                @foreach($drivers as $d)
                    <tr class="hover:bg-gray-50/70 dark:hover:bg-[#1a1a1a]">
                        <td class="px-4 py-3">{{ $d->id }}</td>
                        <td class="px-4 py-3">{{ $d->name }}</td>
                        <td class="px-4 py-3">{{ $d->email }}</td>
                        <td class="px-4 py-3">{{ $d->phone }}</td>
                        <td class="px-4 py-3">{{ optional($d->vehicle)->plate_number ?? '—' }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.drivers.show', $d) }}" class="underline">View</a>
                            <a href="{{ route('admin.drivers.edit', $d) }}" class="underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $drivers->links() }}
        </div>
    @endif
@endsection
