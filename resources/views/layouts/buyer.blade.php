@extends('layouts.app')

@section('body')
{{-- Header --}}
<header class="bg-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4 sm:py-6">
        {{-- Logo / Home --}}
        <a href="{{ route('buyer.products.index') }}" class="flex items-center gap-3 text-2xl font-extrabold text-indigo-600 hover:text-indigo-500 transition-colors">
            <i class="fa-regular fa-house fa-lg"></i>
            <span class="leading-none text-lg">AlkesStore</span>
        </a>

        {{-- Navigation --}}
        <nav class="flex items-center gap-6">
            {{-- Keranjang --}}
            <a href="{{ route("buyer.cart.index") }}" class="flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                <span class="text-base font-medium">Keranjang</span>
            </a>

            {{-- Orders --}}
            <a href="{{ route("buyer.orders.index") }}" class="flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <span class="text-base font-medium">Orders</span>
            </a>

            {{-- Profile Dropdown --}}
            @php
                $user = Auth::user();
            @endphp
            <div class="relative" id="profileDropdown">
                <button id="dropdownButton" class="flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="text-base font-medium">Profil</span>
                </button>

                {{-- Dropdown menu --}}
                <div id="dropdownMenu"
                     class="hidden absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-lg shadow-lg overflow-hidden z-50 opacity-0 transform scale-95 transition-all duration-200 ease-out">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">{{ $user->username }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                    </div>

                    <ul class="py-1 text-sm text-gray-700">
                        <li>
                            <a href="{{ route('buyer.profile.show') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50 transition">
                                <i class="fa fa-user text-indigo-500"></i>
                                Lihat Profil
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('buyer.profile.edit') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50 transition">
                                <i class="fa fa-edit text-indigo-500"></i>
                                Edit Profil
                            </a>
                        </li>
                    </ul>

                    <div class="border-t border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                <i class="fa fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

{{-- Main Content --}}
<main class="flex-1 bg-white px-6 pb-10">
    @yield('content')
</main>

{{-- Native JS untuk dropdown --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    dropdownButton.addEventListener("click", (e) => {
        e.stopPropagation();
        const isOpen = !dropdownMenu.classList.contains("hidden");
        if (isOpen) {
            closeDropdown();
        } else {
            openDropdown();
        }
    });

    document.addEventListener("click", (e) => {
        if (!dropdownMenu.contains(e.target) && !dropdownButton.contains(e.target)) {
            closeDropdown();
        }
    });

    function openDropdown() {
        dropdownMenu.classList.remove("hidden");
        setTimeout(() => {
            dropdownMenu.classList.remove("opacity-0", "scale-95");
            dropdownMenu.classList.add("opacity-100", "scale-100");
        }, 10);
    }

    function closeDropdown() {
        dropdownMenu.classList.remove("opacity-100", "scale-100");
        dropdownMenu.classList.add("opacity-0", "scale-95");
        setTimeout(() => dropdownMenu.classList.add("hidden"), 150);
    }
});
</script>
@endsection
