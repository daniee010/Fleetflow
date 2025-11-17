@extends('frontend.layout.master')

@section('title', 'Register')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-[#FDFDFC] px-6 py-16">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            {{-- Header --}}
            <h1 class="text-3xl font-bold text-center text-[#f53003] mb-6">Create Your Account</h1>
            <p class="text-center text-gray-600 mb-8">
                Join FleetFlow to manage your fleet, drivers, and finances efficiently.
            </p>

            {{-- Registration Form --}}
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Enter your name"
                        value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none"
                        required
                    >
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none"
                        required
                    >
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Create a password"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none"
                        required
                    >
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Re-enter your password"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none"
                        required
                    >
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full bg-[#f53003] text-white font-semibold py-2 rounded-md hover:bg-black transition"
                >
                    Register
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center justify-center my-6">
                <div class="h-px bg-gray-300 w-1/4"></div>
                <span class="px-3 text-sm text-gray-500">or</span>
                <div class="h-px bg-gray-300 w-1/4"></div>
            </div>

            {{-- Login Redirect --}}
            <p class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#f53003] font-semibold hover:underline">Login here</a>
            </p>
        </div>
    </section>
@endsection
