@extends('layouts.app')

@section('body')
<div class="bg-gray-50 min-h-screen">

    {{-- Hero Section --}}
    <div class="relative">
        <img src="{{ asset('images/hero.jpg') }}" alt="Hero" class="w-full h-[600px] object-cover">

        <div class="absolute inset-0 bg-black bg-opacity-25 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800">FIND YOUR PERFECT HOME WITH CONFIDENCE</h1>
                <p class="mt-4 text-gray-500 max-w-xl mx-auto">
                    Your dream home is just a few clicks away. Trusted agents, real photos, and complete details – no surprises.
                </p>
                <a href="#properties" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded">
                    Explore Properties
                </a>
            </div>

            {{-- Search Form --}}
            <div class="absolute top-1/2 right-10 transform -translate-y-1/2 bg-white shadow-xl rounded-lg p-6 w-80">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Find the best place</h2>
                <form action="#" method="GET" class="space-y-4">
                    <div>
                        <select class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option>Select Property Type</option>
                        </select>
                    </div>
                    <div>
                        <input type="text" placeholder="Location" class="w-full border border-gray-300 rounded px-3 py-2 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <input type="text" placeholder="Price" class="w-full border border-gray-300 rounded px-3 py-2 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded">Search</button>
                </form>
            </div>
        </div>
    </div>

    {{-- About Section --}}
    <section class="py-16 text-center">
        <h2 class="text-indigo-600 font-semibold mb-2">About Us</h2>
        <h3 class="text-3xl font-bold text-gray-800 mb-6">REDEFINING REAL ESTATE WITH PURPOSE & PASSION</h3>
        <p class="text-gray-500 max-w-2xl mx-auto mb-10">
            We're more than just a real estate company – we're passionate professionals dedicated to helping you find the perfect property, whether it's your first home, a luxury apartment, or a smart investment.
        </p>

        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg p-6">
                <h4 class="text-gray-800 font-semibold mb-2">Find Out How Much You Can Afford</h4>
                <ul class="text-gray-500 list-disc list-inside space-y-1">
                    <li>Find out much you can afford</li>
                    <li>Get help with your down payment</li>
                    <li>Rent with the option to buy</li>
                </ul>
            </div>
            <div class="bg-white shadow-xl rounded-lg p-6">
                <h4 class="text-gray-800 font-semibold mb-2">Find Out How Much You Can Afford</h4>
                <ul class="text-gray-500 list-disc list-inside space-y-1">
                    <li>Find out if it’s better to rent or buy</li>
                    <li>Buy now sell later</li>
                    <li>Track your home value</li>
                </ul>
            </div>
        </div>
    </section>

</div>
@endsection
