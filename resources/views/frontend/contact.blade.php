@extends('frontend.layout.master')

@section('title', 'Contact FleetFlow')

@section('content')
    <section class="bg-[#FDFDFC] text-[#1b1b18] py-16 px-8">
        <div class="max-w-5xl mx-auto">
            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold mb-4">Get in Touch</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Have questions about FleetFlow, partnership opportunities, or technical support?
                    We’d love to hear from you. Reach out using the form below.
                </p>
            </div>

            {{-- Contact Form --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Form --}}
                <form action="{{ route('contact.submit') }}" method="POST" class="bg-white rounded-lg shadow-lg p-8">
                    @csrf
                    @if(session('success'))
                        <div class="mb-4 text-green-600 font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-5">
                        <label for="name" class="block font-semibold mb-2">Full Name</label>
                        <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none" required>
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none" required>
                    </div>
                    <div class="mb-5">
                        <label for="message" class="block font-semibold mb-2">Message</label>
                        <textarea name="message" id="message" rows="5" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#f53003] focus:outline-none" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#f53003] text-white font-semibold py-2 rounded-md hover:bg-black transition">Send Message</button>
                </form>

                {{-- Contact Info --}}
                <div class="flex flex-col justify-center">
                    <h2 class="text-2xl font-semibold mb-4 text-[#f53003]">Contact Details</h2>
                    <p class="mb-2"><strong>Email:</strong> support@fleetflow.com</p>
                    <p class="mb-2"><strong>Phone:</strong> +233 55 123 4567</p>
                    <p class="mb-6"><strong>Address:</strong> 12 Transport Avenue, Accra, Ghana</p>
                    <p class="text-gray-600">
                        Our support team is available Monday–Friday, 8:00 AM–6:00 PM GMT.
                        We respond to all inquiries within 24 hours.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
