<header id="header" class="bg-white shadow-sm border-b border-gray-200">
    <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
        {{-- Brand / Logo --}}
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-[#f53003] hover:text-black transition">
                FleetFlow
            </a>
            {{-- Uncomment if you want to use a logo image --}}
            {{-- <img src="{{ asset('assets/img/logo.png') }}" alt="FleetFlow Logo" class="h-8"> --}}
        </div>

        {{-- Center Navigation Menu --}}
        <ul class="hidden md:flex items-center space-x-8 font-medium text-gray-700">
            <li>
                <a href="{{ route('home') }}" class="hover:text-[#f53003] transition">Home</a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="hover:text-[#f53003] transition">About</a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="hover:text-[#f53003] transition">Contact</a>
            </li>
        </ul>

        {{-- Right-side Auth Buttons --}}
        <div class="flex items-center space-x-4 text-sm font-medium">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-md bg-[#f53003] text-white hover:bg-black transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100 transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#f53003] text-white rounded-md hover:bg-black transition">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        {{-- Mobile Menu Button --}}
        <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </nav>

    {{-- Mobile Dropdown --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 bg-white">
        <ul class="flex flex-col items-center py-4 space-y-3 font-medium text-gray-700">
            <li><a href="{{ route('home') }}" class="hover:text-[#f53003] transition">Home</a></li>
            <li><a href="{{ route('about') }}" class="hover:text-[#f53003] transition">About</a></li>
            <li><a href="{{ route('contact') }}" class="hover:text-[#f53003] transition">Contact</a></li>
            @auth
                <li><a href="{{ url('/dashboard') }}" class="hover:text-[#f53003] transition">Dashboard</a></li>
            @else
                <li><a href="{{ route('login') }}" class="hover:text-[#f53003] transition">Login</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-[#f53003] transition">Register</a></li>
            @endauth
        </ul>
    </div>
</header>

{{-- Optional Mobile Menu Toggle Script --}}
<script>
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
