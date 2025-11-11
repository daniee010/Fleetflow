@extends('frontend.layout.master')

@section('title', 'About FleetFlow')

@section('content')
    <section class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] py-16 px-8">
        <div class="max-w-5xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold mb-4">About <span class="text-[#f53003]">FleetFlow</span></h1>
                <p class="text-gray-600 dark:text-[#A1A09A] max-w-2xl mx-auto">
                    FleetFlow is a smart transport management system built to help transport operators, vehicle owners, and drivers
                    manage their entire fleet — from vehicles and drivers to finances and contracts — in one easy-to-use web platform.
                </p>
            </div>

            {{-- Mission Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center mb-16">
                <img src="{{ asset('assets/frontend/img/about-featured-img.jpg') }}" alt="FleetFlow System Overview" class="rounded-lg shadow-lg w-full">
                <div>
                    <h2 class="text-2xl font-semibold mb-3 text-[#f53003]">Our Mission</h2>
                    <p class="text-gray-700 dark:text-[#A1A09A] leading-relaxed">
                        Our mission is to digitize transport management across Africa, enabling operators to make data-driven decisions,
                        increase efficiency, and improve driver accountability. FleetFlow simplifies everything — from tracking work-and-pay contracts
                        to managing maintenance schedules and analyzing financial performance.
                    </p>
                </div>
            </div>

            {{-- Vision Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center flex-col-reverse md:flex-row-reverse">
                <div>
                    <h2 class="text-2xl font-semibold mb-3 text-[#f53003]">Our Vision</h2>
                    <p class="text-gray-700 dark:text-[#A1A09A] leading-relaxed">
                        We envision a future where every transport business, big or small, has access to digital tools
                        that help them grow, stay compliant, and operate transparently.
                        FleetFlow bridges the gap between technology and transportation, creating safer, smarter, and more connected journeys.
                    </p>
                </div>
                <img src="{{ asset('assets/frontend/img/2018-Honda-CR-V-LX.jpg') }}" alt="FleetFlow Vision Illustration" class="rounded-lg shadow-lg w-full">
            </div>

            {{-- Features Summary --}}
            <div class="mt-20 text-center">
                <h2 class="text-3xl font-semibold mb-6">What Makes FleetFlow Different?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-[#161615] p-6 rounded-lg shadow hover:shadow-lg transition">
                        <h3 class="font-semibold text-xl mb-2">Integrated Financial Tracking</h3>
                        <p class="text-gray-600 dark:text-[#A1A09A] text-sm">
                            Real-time income vs. expense tracking helps owners make smart financial decisions.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-[#161615] p-6 rounded-lg shadow hover:shadow-lg transition">
                        <h3 class="font-semibold text-xl mb-2">Smart Work-&-Pay Contracts</h3>
                        <p class="text-gray-600 dark:text-[#A1A09A] text-sm">
                            Predict contract completion rates and monitor driver installment progress.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-[#161615] p-6 rounded-lg shadow hover:shadow-lg transition">
                        <h3 class="font-semibold text-xl mb-2">Fleet Health Monitoring</h3>
                        <p class="text-gray-600 dark:text-[#A1A09A] text-sm">
                            Get alerts for maintenance, insurance renewal, and recurring issues.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
