@extends('backend.layout.master')
@section('title','Users')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Users</h1>

    {{-- Role Filters --}}
    <div class="flex flex-wrap items-center gap-2 mb-6">
        @php
            $chips = [
                ['label' => 'All',      'role' => null,        'count' => $counts['all']],
                ['label' => 'Admins',   'role' => 'admin',     'count' => $counts['admin']],
                ['label' => 'Drivers',  'role' => 'driver',    'count' => $counts['driver']],
                ['label' => 'Customers','role' => 'customer',  'count' => $counts['customer']],
                ['label' => 'Mechanics','role' => 'mechanic',  'count' => $counts['mechanic']],
            ];
        @endphp
        @foreach($chips as $c)
            <a href="{{ route('admin.users.index', array_filter(['role' => $c['role']])) }}"
               class="px-3 py-1 rounded-full border text-sm
                      {{ ($role === ($c['role'] ?? null)) ? 'bg-[#f53003] text-white border-[#f53003]' : 'bg-white dark:bg-[#161615] border-gray-200 dark:border-gray-700' }}">
                {{ $c['label'] }}
                <span class="ml-1 text-xs opacity-75">({{ $c['count'] }})</span>
            </a>
        @endforeach
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white dark:bg-[#161615] rounded-lg shadow">
        <table class="min-w-full text-left">
            <thead class="text-sm uppercase text-gray-500 dark:text-gray-300">
            <tr>
                <th class="px-4 py-3">#</th>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3">Created</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            @forelse($users as $u)
                <tr class="text-sm">
                    <td class="px-4 py-3">{{ $u->id }}</td>
                    <td class="px-4 py-3 font-medium">{{ $u->name }}</td>
                    <td class="px-4 py-3">{{ $u->email }}</td>
                    <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs
                                @class([
                                    'bg-gray-100 text-gray-800'   => $u->role === 'customer',
                                    'bg-blue-100 text-blue-800'   => $u->role === 'driver',
                                    'bg-green-100 text-green-800' => $u->role === 'mechanic',
                                    'bg-orange-100 text-orange-800' => $u->role === 'admin',
                                ])">
                                {{ ucfirst($u->role ?? '—') }}
                            </span>
                    </td>
                    <td class="px-4 py-3">{{ $u->created_at?->format('Y-m-d') }}</td>
                    <td class="px-4 py-3 text-right">
                        {{-- Stubs; wire later if needed --}}
                        <a href="#" class="text-blue-600 hover:underline mr-3">View</a>
                        <a href="#" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <button class="text-red-600 hover:underline" onclick="alert('Delete stub')">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-6 text-center text-gray-500" colspan="6">
                        No users found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endsection
