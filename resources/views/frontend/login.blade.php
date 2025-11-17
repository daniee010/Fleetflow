@extends('frontend.layout.master')

@section('title', 'Login')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-[#FDFDFC] px-6 py-16">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            {{-- Header --}}
            <h1 class="text-3xl font-bold text-center text-[#f53003] mb-6">Welcome Back</h1>
            <p class="text-center text-gray-600 mb-8">
                Sign in to manage your fleet and stay on top of your operations.
            </p>

            {{-- Login Form --}}
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Enter your email"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none"
                        required
                    >
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none"
                        required
                    >
                </div>

                {{-- Remember Me + Forgot Password --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2 text-gray-600">
                        <input type="checkbox" name="remember" class="text-[#f53003] focus:ring-[#f53003] rounded">
                        <span>Remember me</span>
                    </label>
{{--                    <a href="{{ route('password.request') }}" class="text-[#f53003] hover:underline">Forgot password?</a>--}}
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full bg-[#f53003] text-white font-semibold py-2 rounded-md hover:bg-black transition"
                >
                    Login
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center justify-center my-6">
                <div class="h-px bg-gray-300 w-1/4"></div>
                <span class="px-3 text-sm text-gray-500">or</span>
                <div class="h-px bg-gray-300 w-1/4"></div>
            </div>

            {{-- Register Link --}}
            <p class="text-center text-sm text-gray-600">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#f53003] font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </section>
@endsection
