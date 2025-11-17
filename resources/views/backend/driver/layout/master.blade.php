<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | FleetFlow Driver</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="bg-[#FDFDFC] text-gray-800">

{{-- Top Navigation --}}
{{-- FleetFlow Driver Navigation --}}
{{-- FleetFlow Driver Navigation --}}
<nav class="bg-[#ffffff] border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between px-4 py-3">

        {{-- Brand --}}
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-[#f53003]">
            FleetFlow Driver
        </a>

        {{-- Navigation Links --}}
        <ul class="flex flex-wrap items-center space-x-6 font-medium text-gray-800">

            {{-- Dashboard --}}
            <li>
                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#f53003] transition">
                    Performance Overview
                </a>
            </li>

            {{-- Fleet Management --}}
            <li x-data="{ open: false }" class="relative">
                <button class="hover:text-[#f53003] transition flex items-center">
                    My Trips
                </button>
            </li>

            {{-- Drivers --}}
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                    Breakdowns
                </button>
            </li>

            {{-- Finance --}}
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="hover:text-[#f53003] transition flex items-center">
                    Work & Pay Installments
                </button>
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
