<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | FleetFlow Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="bg-[#FDFDFC] text-gray-800">

{{-- FleetFlow Admin Navigation --}}
<nav class="bg-[#ffffff] border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between px-4 py-3">

        {{-- Brand --}}
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-[#f53003]">
            FleetFlow Admin
        </a>

        <div class="flex items-center gap-6">
            {{-- Navigation Links --}}
            <ul class="flex flex-wrap items-center space-x-6 font-medium text-gray-800">

                {{-- Dashboard --}}
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f53003] transition">
                        Dashboard
                    </a>
                </li>

                {{-- Fleet Management --}}
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                        Fleet Management <i class="fas fa-angle-down ml-1"></i>
                    </button>
                    <ul x-show="open" @click.away="open = false"
                        class="absolute bg-white text-gray-800 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                        <li>
                            <a href="{{ route('admin.vehicles.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Vehicles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.maintenance.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Maintenance
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Drivers --}}
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                        Drivers <i class="fas fa-angle-down ml-1"></i>
                    </button>
                    <ul x-show="open" @click.away="open = false"
                        class="absolute bg-white text-gray-800 shadow-lg rounded-md mt-2 w-52 p-2 space-y-1 z-50">
                        <li>
                            <a href="{{ route('admin.drivers.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Driver List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contracts.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Work & Pay Contracts
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Finance --}}
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                        Finance <i class="fas fa-angle-down ml-1"></i>
                    </button>
                    <ul x-show="open" @click.away="open = false"
                        class="absolute bg-white text-gray-800 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                        <li>
                            <a href="{{ route('admin.payments.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Income
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.expenses.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Expenses
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reports.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Reports
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Rentals --}}
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                        Rentals <i class="fas fa-angle-down ml-1"></i>
                    </button>
                    <ul x-show="open" @click.away="open = false"
                        class="absolute bg-white text-gray-800 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                        <li>
                            <a href="{{ route('admin.rentals.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Bookings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.customers.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Customers
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Settings --}}
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                        Settings <i class="fas fa-angle-down ml-1"></i>
                    </button>
                    <ul x-show="open" @click.away="open = false"
                        class="absolute bg-white text-gray-800 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                               class="block px-3 py-1 hover:text-[#f53003] transition">
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block px-3 py-1 hover:text-[#f53003] transition">
                                Company Profile
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block px-3 py-1 hover:text-[#f53003] transition">
                                Notifications
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            {{-- User avatar + dropdown (Profile + Logout) --}}
            @auth
                <div x-data="{ open: false }" class="relative">

                    {{-- User Pill --}}
                    <button
                        @click="open = !open"
                        class="flex items-center gap-3 rounded-full border border-gray-200 bg-white px-3 py-1.5 shadow-sm hover:border-[#f53003] hover:shadow-md transition"
                    >
                        <div class="w-8 h-8 rounded-full bg-[#f53003] text-white flex items-center justify-center text-xs font-bold">
                            {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="flex flex-col items-start leading-tight">
            <span class="font-semibold text-gray-900 text-xs">
                {{ auth()->user()->name }}
            </span>

                            <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-gray-100 text-[10px] uppercase tracking-wide text-gray-600">
                {{ auth()->user()->role }}
            </span>
                        </div>

                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-500"></i>
                    </button>

                    {{-- Dropdown --}}
                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-white dark:bg-[#161615] border border-gray-200 dark:border-[#2a2a2a] rounded-xl shadow-lg py-2 text-sm z-50"
                        style="display: none;"
                    >

                        {{-- Header --}}
                        <div class="px-4 pb-2 border-b border-gray-100 dark:border-[#2a2a2a] mb-2">
                            <div class="font-semibold text-xs text-gray-900 dark:text-white">
                                {{ auth()->user()->name }}
                            </div>
                            <div class="text-[11px] uppercase tracking-wide text-gray-500">
                                {{ auth()->user()->role }}
                            </div>
                        </div>

                        {{-- Profile Link --}}
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50 dark:hover:bg-[#1f1f1f]">
                            <i class="fa-regular fa-user text-xs text-gray-500"></i>
                            <span>Profile</span>
                        </a>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-[#2a1515] text-sm">
                                <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>


{{-- Main Content --}}
<main class="max-w-7xl mx-auto py-10 px-6">
    @yield('content')
</main>

@if (session('status'))
    <div class="max-w-7xl mx-auto mt-4 px-6">
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-md px-4 py-3">
            {{ session('status') }}
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="max-w-7xl mx-auto mt-4 px-6">
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-md px-4 py-3">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

</body>
</html>
