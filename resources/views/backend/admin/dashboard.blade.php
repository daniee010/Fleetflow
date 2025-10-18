@extends('backend.layout.master')
@section('title', 'Dashboard')

@section('content')
    <div class="space-y-10">
        {{-- Fleet Summary --}}
        <section>
            <h2 class="text-xl font-bold text-[#f53003] mb-4">Fleet Overview</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-[#161615] rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600 dark:text-gray-300">Total Vehicles</h4>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">48</p>
                </div>
                <div class="bg-white dark:bg-[#161615] rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600 dark:text-gray-300">Active Drivers</h4>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">27</p>
                </div>
                <div class="bg-white dark:bg-[#161615] rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600 dark:text-gray-300">Pending Maintenance</h4>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">5</p>
                </div>
                <div class="bg-white dark:bg-[#161615] rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600 dark:text-gray-300">Active Rentals</h4>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">21</p>
                </div>
            </div>
        </section>

        {{-- Finance Summary --}}
        <section>
            <h2 class="text-xl font-bold text-[#f53003] mb-4">Financial Overview</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-[#161615] rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600 dark:text-gray-300">Total Income</h4>
                    <p class="text-3xl font-bold text-green-600 mt-2">$12,580</p>
                </div>
                <div class="bg-white dark:bg-[#161615] rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600 dark:text-gray-300">Total Expenses</h4>
                    <p class="text-3xl font-bold text-red-500 mt-2">$4,320</p>
                </div>
                <div class="bg-white dark:bg-[#161615] rounded-lg p-5 shadow text-center">
                    <h4 class="text-gray-600 dark:text-gray-300">Net Profit</h4>
                    <p class="text-3xl font-bold text-blue-600 mt-2">$8,260</p>
                </div>
            </div>
        </section>
    </div>
@endsection
