@extends('backend.layout.master')

@section('title', 'Login')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center">
        <div class="bg-white dark:bg-[#161615] shadow rounded-lg w-full max-w-md p-6">
            <h1 class="text-2xl font-bold mb-4 text-center text-[#f53003]">
                FleetFlow Login
            </h1>

            @if(session('status'))
                <div class="mb-4 text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
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

                {{-- Remember --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a class="underline text-xs" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button
                    class="w-full mt-2 px-4 py-2 bg-[#f53003] text-white rounded hover:bg-black transition">
                    Log In
                </button>

                @if (Route::has('register'))
                    <p class="text-xs text-center text-gray-500 mt-3">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-[#f53003] underline">
                            Register
                        </a>
                    </p>
                @endif
            </form>
        </div>
    </div>
@endsection
