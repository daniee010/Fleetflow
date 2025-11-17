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
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-gray-800 dark:text-gray-100">

{{-- Top Navigation --}}
{{-- FleetFlow Admin Navigation --}}
{{-- FleetFlow Admin Navigation --}}
<nav class="bg-[#ffffff] dark:bg-[#1a1a1a] border-b border-gray-200 dark:border-[#333] shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between px-4 py-3">

        {{-- Brand --}}
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-[#f53003]">
            FleetFlow Admin
        </a>

        {{-- Navigation Links --}}
        <ul class="flex flex-wrap items-center space-x-6 font-medium text-gray-800 dark:text-gray-100">

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
                    class="absolute bg-white dark:bg-[#2b2b2b] text-gray-800 dark:text-gray-100 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                    <li><a href="{{ route('admin.vehicles.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Vehicles</a></li>
                    <li><a href="{{ route('admin.maintenance.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Maintenance</a></li>
                </ul>
            </li>

            {{-- Drivers --}}
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                    Drivers <i class="fas fa-angle-down ml-1"></i>
                </button>
                <ul x-show="open" @click.away="open = false"
                    class="absolute bg-white dark:bg-[#2b2b2b] text-gray-800 dark:text-gray-100 shadow-lg rounded-md mt-2 w-52 p-2 space-y-1 z-50">
                    <li><a href="{{ route('admin.drivers.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Driver List</a></li>
                    <li><a href="{{ route('admin.contracts.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Work & Pay Contracts</a></li>
                </ul>
            </li>

            {{-- Finance --}}
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                    Finance <i class="fas fa-angle-down ml-1"></i>
                </button>
                <ul x-show="open" @click.away="open = false"
                    class="absolute bg-white dark:bg-[#2b2b2b] text-gray-800 dark:text-gray-100 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                    <li><a href="{{ route('admin.payments.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Income</a></li>
                    <li><a href="{{ route('admin.expenses.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Expenses</a></li>
                    <li><a href="{{ route('admin.reports.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Reports</a></li>
                </ul>
            </li>

            {{-- Rentals --}}
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                    Rentals <i class="fas fa-angle-down ml-1"></i>
                </button>
                <ul x-show="open" @click.away="open = false"
                    class="absolute bg-white dark:bg-[#2b2b2b] text-gray-800 dark:text-gray-100 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                    <li><a href="{{ route('admin.rentals.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Bookings</a></li>
                    <li><a href="{{ route('admin.customers.index') }}" class="block px-3 py-1 hover:text-[#f53003] transition">Customers</a></li>
                </ul>
            </li>

            {{-- Settings --}}
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                    Settings <i class="fas fa-angle-down ml-1"></i>
                </button>
                <ul x-show="open" @click.away="open = false"
                    class="absolute bg-white dark:bg-[#2b2b2b] text-gray-800 dark:text-gray-100 shadow-lg rounded-md mt-2 w-48 p-2 space-y-1 z-50">
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-[#f53003] transition">
                            Users
                        </a>
                    </li>
                    <li><a href="#" class="block px-3 py-1 hover:text-[#f53003] transition">Company Profile</a></li>
                    <li><a href="#" class="block px-3 py-1 hover:text-[#f53003] transition">Notifications</a></li>
                </ul>
            </li>
        </ul>


        {{-- Logout --}}
        <button class="px-4 py-2 bg-[#f53003] text-white rounded-md hover:bg-black transition">
            Logout
        </button>
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
