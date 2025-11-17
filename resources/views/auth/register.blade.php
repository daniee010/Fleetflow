@extends('backend.layout.master')

@section('title', 'Register')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center">
        <div class="bg-white dark:bg-[#161615] shadow rounded-lg w-full max-w-md p-6">
            <h1 class="text-2xl font-bold mb-4 text-center text-[#f53003]">
                Create Account
            </h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror"
                    >
                    @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                <button
                    class="w-full mt-2 px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
                    Register
                </button>

                <p class="text-xs text-center text-gray-500 mt-3">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#f53003] underline">
                        Login
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
