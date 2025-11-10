@extends('layouts.app')

@section('body')
<div class="flex min-h-screen bg-gray-50">

    {{-- Sidebar --}}
    <aside id="sidebar" class="w-64 bg-white shadow-lg flex flex-col transition-transform duration-300 -translate-x-full sm:translate-x-0">
        {{-- Logo / Brand --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-indigo-600 font-bold text-xl">
                <i class="fas fa-cogs text-xl"></i>
                <span>Bandar Admin</span>
            </a>
            <button id="toggleSidebar" class="sm:hidden px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition-colors">☰</button>
        </div>

        {{-- Sidebar Menu --}}
        <nav id="sidebarNav" class="flex-1 overflow-y-auto p-4 space-y-2">
            <li class="pl-4 pr-3 py-2 list-none rounded-xl mb-0.5 last:mb-0 transition-colors duration-200
                {{ Request::is('admin/dashboard') ? 'bg-indigo-100 font-semibold' : 'hover:bg-indigo-50' }}">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center text-gray-800 transition-colors duration-200">
                    <i class="fa fa-home text-lg {{ Request::is('admin/dashboard') ? 'text-indigo-600' : 'text-gray-400' }}"></i>
                    <span class="text-sm font-medium ml-4 duration-200">Dashboard</span>
                </a>
            </li>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col transition-all duration-300">

        {{-- Header --}}
        <header class="flex shadow-sm items-center justify-between bg-white border-b border-gray-200 px-6 py-4 mb-4">
            <h2 class="text-lg">Dashboard</h2>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            <section class="bg-white rounded-2xl shadow-lg p-6 md:p-8 transition-all duration-300">
                @yield('content')
            </section>
        </main>
    </div>
</div>
@endsection
