<?php
@extends('backend.layout.master')
@section('title','Maintenance')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Maintenance</h1>

    <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600 dark:text-gray-300">
            <tr>
                <th class="py-2">ID</th>
                <th class="py-2">Vehicle</th>
                <th class="py-2">Service Date</th>
                <th class="py-2">Type</th>
                <th class="py-2">Cost</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
            @foreach($maintenances as $m)
                <tr>
                    <td class="py-2">{{ $m->id }}</td>
                    <td class="py-2">
                        {{ optional($m->vehicle)->plate_number ? $m->vehicle->plate_number.' ('.$m->vehicle->make.' '.$m->vehicle->model.')' : '—' }}
                    </td>
                    <td class="py-2">{{ $m->service_date }}</td>
                    <td class="py-2">{{ $m->service_type }}</td>
                    <td class="py-2">${{ number_format($m->cost,2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $maintenances->links() }}</div>
    </div>
@endsection
