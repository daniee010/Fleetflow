<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FleetFlow | Smart Transport Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen">
{{-- Navbar --}}
<header class="flex justify-between items-center px-8 py-4 border-b border-gray-200 dark:border-[#3E3E3A]">
    <h1 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">FleetFlow</h1>
    <nav class="flex gap-8 text-sm font-medium">
        <a href="/" class="hover:text-[#f53003] transition">Home</a>
        <a href="/about" class="hover:text-[#f53003] transition">About</a>
        <a href="/contact" class="hover:text-[#f53003] transition">Contact</a>
    </nav>
    <div class="flex gap-4">
        @auth
            <a href="{{ url('/dashboard') }}" class="px-4 py-2 border rounded-sm hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="px-4 py-2 border rounded-sm hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-[#f53003] text-white rounded-sm hover:bg-black transition">Register</a>
        @endauth
    </div>
</header>

{{-- Hero Section --}}
<section class="flex flex-col lg:flex-row items-center justify-between px-8 py-16 max-w-6xl mx-auto">
    <div class="max-w-lg text-center lg:text-left">
        <h2 class="text-4xl font-bold mb-4 dark:text-white">Manage your fleet, drivers & finances easily</h2>
        <p class="text-gray-600 dark:text-[#A1A09A] mb-6">
            FleetFlow helps you track vehicles, monitor drivers, manage contracts, and oversee finances — all in one intelligent dashboard.
        </p>
        <div class="flex gap-4 justify-center lg:justify-start">
            <a href="{{ route('register') }}" class="px-6 py-3 bg-[#f53003] text-white rounded-md hover:bg-black transition">Get Started</a>
            <a href="/about" class="px-6 py-3 border border-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-[#161615] transition">Learn More</a>
        </div>
    </div>
    <img src="{{ asset('assets/frontend/img/pngegg.png') }}" alt="FleetFlow Dashboard Illustration" class="w-full max-w-md mt-10 lg:mt-0">
</section>

{{-- Features Section --}}
<section class="bg-gray-50 dark:bg-[#161615] py-16 px-8">
    <h3 class="text-2xl font-semibold text-center mb-10 dark:text-white">Key Features</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
        @foreach([
            ['🚗','Fleet Management','Register and track vehicles, maintenance, and insurance.'],
            ['👨‍✈️','Driver Portal','Drivers log trips, payments, and performance.'],
            ['💰','Financial Dashboard','View income vs. expenses, and analyze trends.'],
            ['📅','Work & Pay Tracker','Track driver installments and payment progress.'],
            ['🧾','Rental System','Customers can view and reserve available vehicles.'],
            ['🛠️','Maintenance Logs','Track repairs, insurance renewals, and service schedules.'],
        ] as [$icon, $title, $desc])
            <div class="bg-white dark:bg-[#0a0a0a] rounded-lg p-6 shadow hover:shadow-lg transition">
                <div class="text-3xl mb-3">{{ $icon }}</div>
                <h4 class="text-lg font-semibold mb-2 dark:text-white">{{ $title }}</h4>
                <p class="text-gray-600 dark:text-[#A1A09A] text-sm">{{ $desc }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- Statistics Section --}}
<section class="py-16 px-8 max-w-6xl mx-auto text-center">
    <h3 class="text-2xl font-semibold mb-8 dark:text-white">FleetFlow at a Glance</h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-8">
        <div>
            <p class="text-4xl font-bold text-[#f53003]">120+</p>
            <p class="text-gray-600 dark:text-[#A1A09A]">Vehicles</p>
        </div>
        <div>
            <p class="text-4xl font-bold text-[#f53003]">45</p>
            <p class="text-gray-600 dark:text-[#A1A09A]">Active Drivers</p>
        </div>
        <div>
            <p class="text-4xl font-bold text-[#f53003]">200+</p>
            <p class="text-gray-600 dark:text-[#A1A09A]">Rentals Completed</p>
        </div>
        <div>
            <p class="text-4xl font-bold text-[#f53003]">98%</p>
            <p class="text-gray-600 dark:text-[#A1A09A]">Contract Success</p>
        </div>
    </div>
</section>

{{-- Call to Action --}}
<section class="bg-[#f53003] text-white text-center py-16 px-8">
    <h3 class="text-3xl font-semibold mb-4">Ready to Digitize Your Transport Business?</h3>
    <p class="mb-8">Join hundreds of transport operators managing smarter with FleetFlow.</p>
    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-[#f53003] font-semibold rounded-md hover:bg-gray-100 transition">Register Now</a>
</section>

{{-- Footer --}}
<footer class="flex justify-between items-center py-6 px-8 text-sm border-t border-gray-200 dark:border-[#3E3E3A]">
    <div class="flex gap-6">
        <a href="#">Terms & Conditions</a>
        <a href="#">Privacy Policy</a>
    </div>
    <p>© {{ date('Y') }} FleetFlow</p>
</footer>
</body>
</html>
