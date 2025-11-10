<?php
@extends('backend.layout.master')
@section('title','Expenses')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Expenses</h1>

    <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600 dark:text-gray-300">
            <tr>
                <th class="py-2">ID</th>
                <th class="py-2">Category</th>
                <th class="py-2">Amount</th>
                <th class="py-2">Date</th>
                <th class="py-2">Notes</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
            @foreach($expenses as $e)
                <tr>
                    <td class="py-2">{{ $e->id }}</td>
                    <td class="py-2">{{ $e->category }}</td>
                    <td class="py-2">${{ number_format($e->amount,2) }}</td>
                    <td class="py-2">{{ $e->expense_date }}</td>
                    <td class="py-2">{{ Str::limit($e->notes, 40) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $expenses->links() }}</div>
    </div>
@endsection
