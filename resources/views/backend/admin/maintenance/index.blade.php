@extends('backend.layout.master')
@section('title','Maintenance')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Maintenance</h1>

    <a href="{{ route('admin.maintenance.create') }}" class="px-3 py-2 bg-[#f53003] text-white rounded">Add Maintenance</a>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full text-left">
            <thead>
            <tr class="border-b">
                <th class="py-2 pr-4">#</th>
                <th class="py-2 pr-4">Vehicle</th>
                <th class="py-2 pr-4">Service Date</th>
                <th class="py-2 pr-4">Type</th>
                <th class="py-2 pr-4">Cost</th>
                <th class="py-2 pr-4"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($maintenances as $m)
                <tr class="border-b">
                    <td class="py-2 pr-4">{{ $m->id }}</td>
                    <td class="py-2 pr-4">
                        {{ optional($m->vehicle)->plate_number }}
                        <span class="text-sm text-gray-500">
                        ({{ optional($m->vehicle)->make }} {{ optional($m->vehicle)->model }})
                    </span>
                    </td>
                    <td class="py-2 pr-4">{{ $m->service_date }}</td>
                    <td class="py-2 pr-4">{{ $m->service_type }}</td>
                    <td class="py-2 pr-4">${{ number_format($m->cost,2) }}</td>
                    <td class="py-2 pr-4 space-x-3">
                        <a class="underline" href="{{ route('admin.maintenance.show', $m) }}">View</a>
                        <a class="underline" href="{{ route('admin.maintenance.edit', $m) }}">Edit</a>
                        <form action="{{ route('admin.maintenance.destroy', $m) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 underline"
                                    onclick="return confirm('Delete this maintenance?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $maintenances->links() }}
    </div>
@endsection
