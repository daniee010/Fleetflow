<footer id="footer" class="bg-[#f9f9f9] border-t border-gray-200 py-8 px-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">

        {{-- Social Media Links --}}
        <div class="footer-socials flex space-x-6">
            <a href="#" class="text-gray-600 hover:text-[#f53003] transition text-lg">
                <i class="fa-regular fa-envelope"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-[#f53003] transition text-lg">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-[#f53003] transition text-lg">
                <i class="fa-brands fa-instagram"></i>
            </a>
        </div>

        {{-- Divider for small screens --}}
        <div class="w-full h-px bg-gray-200 md:hidden"></div>

        {{-- Footer Links --}}
        <div class="footer-end flex flex-wrap items-center justify-center space-x-3 text-sm text-gray-600">
            <a href="#" class="hover:text-[#f53003] transition">Terms & Conditions</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-[#f53003] transition">Privacy Policy</a>
            <span>&bull;</span>
            <p class="text-gray-500">&copy; {{ date('Y') }} <span class="font-semibold text-[#f53003]">FleetFlow</span></p>
        </div>
    </div>
</footer>
