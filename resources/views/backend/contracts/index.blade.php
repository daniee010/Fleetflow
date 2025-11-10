@extends('backend.layout.master')
@section('title','Contracts')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <h1 class="text-2xl font-bold">Work & Pay Contracts</h1>

        @isset($contracts)
            <div class="overflow-auto bg-white dark:bg-[#161615] rounded-lg shadow">
                <table class="min-w-full text-sm">
                    <thead>
                    <tr class="text-left border-b">
                        <th class="p-3">#</th>
                        <th class="p-3">Driver</th>
                        <th class="p-3">Vehicle</th>
                        <th class="p-3">Start</th>
                        <th class="p-3">End</th>
                        <th class="p-3">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($contracts as $c)
                        <tr class="border-b">
                            <td class="p-3">{{ $c->id }}</td>
                            <td class="p-3">{{ optional($c->driver)->name }}</td>
                            <td class="p-3">
                                @if($c->vehicle)
                                    {{ $c->vehicle->plate_number }} ({{ $c->vehicle->make }} {{ $c->vehicle->model }})
                                @endif
                            </td>
                            <td class="p-3">{{ $c->start_date }}</td>
                            <td class="p-3">{{ $c->end_date }}</td>
                            <td class="p-3">{{ $c->status }}</td>
                        </tr>
                    @empty
                        <tr><td class="p-4" colspan="6">No contracts yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $contracts->links() }}</div>
        @endisset
    </div>
@endsection
