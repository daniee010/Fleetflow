<?php
@extends('backend.layout.master')
@section('title','Customers')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Customers</h1>

    <div class="bg-white dark:bg-[#161615] rounded-lg shadow p-4">
        <table class="min-w-full text-sm">
            <thead class="text-left text-gray-600 dark:text-gray-300">
            <tr>
                <th class="py-2">ID</th>
                <th class="py-2">Name</th>
                <th class="py-2">Email</th>
                <th class="py-2">Phone</th>
                <th class="py-2">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-[#2a2a2a]">
            @foreach($customers as $c)
                <tr>
                    <td class="py-2">{{ $c->id }}</td>
                    <td class="py-2">{{ $c->name }}</td>
                    <td class="py-2">{{ $c->email }}</td>
                    <td class="py-2">{{ $c->phone }}</td>
                    <td class="py-2">
                        <a href="{{ route('admin.customers.show',$c) }}" class="text-[#f53003]">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $customers->links() }}</div>
    </div>
@endsection
