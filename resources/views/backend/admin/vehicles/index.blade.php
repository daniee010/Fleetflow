@extends('backend.layout.master')
@section('title', 'Vehicles')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Vehicles</h1>
        <a href="{{ route('admin.vehicles.create') }}"
           class="px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
            Add Vehicle
        </a>
    </div>

    @if($vehicles->count() === 0)
        <div class="p-4 bg-yellow-50 text-yellow-800 rounded">No vehicles found.</div>
    @else
        <div class="overflow-x-auto bg-white dark:bg-[#161615] rounded shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="border-b text-gray-600 dark:text-gray-300">
                <tr>
                    <th class="py-2 px-3">Vehicle</th>
                    <th class="py-2 px-3">Year</th>
                    <th class="py-2 px-3">Status</th>
                    <th class="py-2 px-3">Scheme</th>
                    <th class="py-2 px-3">Rate</th>
                    <th class="py-2 px-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($vehicles as $v)
                    @php
                        $status = strtolower($v->status);
                    @endphp
                    <tr class="border-b hover:bg-gray-50/70 dark:hover:bg-[#1a1a1a]">
                        {{-- Vehicle --}}
                        <td class="py-2 px-3">
                            <div class="font-semibold">
                                {{ $v->plate_number }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $v->make }} {{ $v->model }}
                            </div>
                            @if($v->color)
                                <div class="text-xs text-gray-400">
                                    Color: {{ $v->color }}
                                </div>
                            @endif
                        </td>

                        {{-- Year --}}
                        <td class="py-2 px-3">
                            {{ $v->year ?? '—' }}
                        </td>

                        {{-- Status --}}
                        <td class="py-2 px-3 capitalize">
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[11px]
                                @class([
                                    'bg-green-100 text-green-700'   => $status === 'available',
                                    'bg-blue-100 text-blue-700'     => $status === 'rented',
                                    'bg-yellow-100 text-yellow-700' => $status === 'maintenance',
                                    'bg-purple-100 text-purple-700' => $status === 'contract',
                                    'bg-orange-100 text-orange-700' => $status === 'sales',
                                    'bg-gray-100 text-gray-700'     => ! in_array($status, ['available','rented','maintenance','contract','sales']),
                                ])">
                                {{ ucfirst($v->status) ?: 'Unknown' }}
                            </span>
                        </td>

                        {{-- Scheme (using accessor from model if set, fallback text otherwise) --}}
                        <td class="py-2 px-3 text-xs text-gray-700">
                            {{ $v->scheme_label ?? 'Pool / General Fleet' }}
                        </td>

                        {{-- Rate --}}
                        <td class="py-2 px-3">
                            @if(in_array($status, ['sales','contract']) && !is_null($v->daily_rate))
                                <div class="text-sm">
                                    GH₵ {{ number_format($v->daily_rate, 2) }}
                                </div>
                                <div class="text-[11px] text-gray-500">
                                    Weekly Payment
                                </div>
                            @elseif(!is_null($v->daily_rate))
                                <div class="text-sm">
                                    GH₵ {{ number_format($v->daily_rate, 2) }}
                                </div>
                                <div class="text-[11px] text-gray-500">
                                    Daily Rate
                                </div>
                            @else
                                <span class="text-xs text-gray-500">Not set</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="py-2 px-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.vehicles.show', $v) }}"
                               class="text-xs underline mr-2">
                                View
                            </a>

                            <a href="{{ route('admin.vehicles.edit', $v) }}"
                               class="text-xs underline mr-2">
                                Edit
                            </a>

                            <form action="{{ route('admin.vehicles.destroy', $v) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    @endif
@endsection
