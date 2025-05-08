@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Contact Us</h1>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 border border-[#dbd3c8]">
        <p class="text-gray-700 text-lg mb-4">
            We would love to hear from you! Whether you have questions, feedback, or just want to share your experience using Memory Mapper, feel free to reach out to us.
        </p>

        <!-- Contact Form -->
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-gray-800">Your Name</label>
                <input type="text" id="name" name="name" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
            </div>

            <div>
                <label for="email" class="block text-gray-800">Your Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
            </div>

            <div>
                <label for="message" class="block text-gray-800">Message</label>
                <textarea id="message" name="message" rows="5" required
                          class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#008080] bg-white text-gray-800"></textarea>
            </div>

            <button type="submit" class="w-full bg-[#374151] text-white py-2 rounded-md hover:bg-[#2c3843] transition-all">
                Send Message
            </button>
        </form>
    </div>
</div>
@endsection
