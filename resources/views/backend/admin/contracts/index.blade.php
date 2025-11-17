@extends('backend.layout.master')
@section('title', 'Contracts')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-[#f53003]">Work & Pay Contracts</h1>

            <a href="{{ route('admin.contracts.create') }}"
               class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition text-sm">
                Add Contract
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                <tr class="text-left">
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Driver</th>
                    <th class="px-4 py-3">Vehicle</th>
                    <th class="px-4 py-3">Start</th>
                    <th class="px-4 py-3">End</th>
                    <th class="px-4 py-3">Weekly Payment</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>  <thead class="bg-gray-50">
                <tbody>
                @forelse($contracts as $c)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-3">{{ $c->id }}</td>
                        <td class="px-4 py-3">
                            {{ optional($c->driver)->name ?? '—' }}
                        </td>
                        <td class="px-4 py-3">
                            @php $v = $c->vehicle; @endphp
                            {{ $v ? ($v->plate_number.' · '.$v->make.' '.$v->model) : '—' }}
                        </td>
                        <td class="px-4 py-3">
                            {{ \Illuminate\Support\Carbon::parse($c->start_date)->toDateString() }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $c->end_date ? \Illuminate\Support\Carbon::parse($c->end_date)->toDateString() : '—' }}
                        </td>
                        <td class="px-4 py-3">
                            ${{ number_format($c->weekly_payment, 2) }}
                        </td>
                        <td class="px-4 py-3">
            <span class="inline-block px-2 py-1 rounded text-xs
                @class([
                    'bg-yellow-100 text-yellow-700' => $c->status === 'pending',
                    'bg-green-100 text-green-700'   => $c->status === 'active',
                    'bg-gray-100 text-gray-700'     => $c->status === 'completed',
                    'bg-red-100 text-red-700'       => $c->status === 'cancelled',
                ])">
                {{ ucfirst($c->status) }}
            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.contracts.show', $c) }}"
                               class="text-sm underline">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                            No contracts found.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

        <div>
            {{ $contracts->links() }}
        </div>
    </div>
@endsection
