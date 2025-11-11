@extends('backend.driver.layout.master')

@section('content')
<div class="min-h-screen text-white px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Performance Overview --}}
        <div class="bg-[#111] rounded-lg shadow p-6">
            <h3 class="text-[#f53003] text-xl font-semibold mb-4">Performance Overview</h3>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div class="bg-gray-800 rounded p-4">
                    <h5 class="text-gray-400">Rating</h5>
                    <h2 class="text-2xl font-bold">{{ $performance['rating'] }}/5</h2>
                </div>
                <div class="bg-gray-800 rounded p-4">
                    <h5 class="text-gray-400">Completed Trips</h5>
                    <h2 class="text-2xl font-bold">{{ $performance['completed_trips'] }}</h2>
                </div>
                <div class="bg-gray-800 rounded p-4">
                    <h5 class="text-gray-400">On-Time Rate</h5>
                    <h2 class="text-2xl font-bold">{{ $performance['on_time_rate'] }}</h2>
                </div>
            </div>
        </div>

        {{-- My Trips --}}
        <div class="bg-[#111] rounded-lg shadow p-6">
            <h3 class="text-[#f53003] text-xl font-semibold mb-4">My Trips</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-800 text-gray-300">
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Destination</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trips as $trip)
                        <tr class="border-b border-gray-700">
                            <td class="px-4 py-2">{{ $trip['date'] }}</td>
                            <td class="px-4 py-2">{{ $trip['destination'] }}</td>
                            <td class="px-4 py-2">{{ $trip['status'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Breakdowns --}}
        <div class="bg-[#111] rounded-lg shadow p-6">
            <h3 class="text-[#f53003] text-xl font-semibold mb-4">Breakdowns</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-800 text-gray-300">
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Issue</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($breakdowns as $b)
                        <tr class="border-b border-gray-700">
                            <td class="px-4 py-2">{{ $b['date'] }}</td>
                            <td class="px-4 py-2">{{ $b['issue'] }}</td>
                            <td class="px-4 py-2">{{ $b['status'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Work & Pay Installments --}}
        <div class="bg-[#111] rounded-lg shadow p-6">
            <h3 class="text-[#f53003] text-xl font-semibold mb-4">Work & Pay Installments</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-800 text-gray-300">
                        <tr>
                            <th class="px-4 py-2">Month</th>
                            <th class="px-4 py-2">Amount ($)</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($installments as $i)
                        <tr class="border-b border-gray-700">
                            <td class="px-4 py-2">{{ $i['month'] }}</td>
                            <td class="px-4 py-2">${{ $i['amount'] }}</td>
                            <td class="px-4 py-2">{{ $i['status'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
