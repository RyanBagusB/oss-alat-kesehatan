@extends('layouts.app')

@section('body')
<div class="flex min-h-screen bg-gray-50">

    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed sm:static w-64 bg-white flex flex-col transition-transform duration-300 -translate-x-full sm:translate-x-0">
        {{-- Logo / Brand --}}
        <div class="flex items-center justify-between px-6 py-4 mb-8">
            <a href="{{ route('admin.dashboard') }}" class="inline-block transition-all duration-300 origin-left text-xl md:text-2xl font-bold tracking-wide text-indigo-600">
                <i class="fas fa-cogs fa-xs"></i>
                <span>Bandar Admin</span>
            </a>
        </div>

        {{-- Sidebar Menu --}}
        <nav id="sidebarNav" class="flex-1 overflow-y-auto py-4 space-y-2 px-2">
            @php
                $menuItems = [
                    ['route' => 'admin.dashboard', 'icon' => 'fa-home', 'label' => 'Beranda', 'pattern' => 'admin/dashboard*'],
                    ['route' => 'admin.users', 'icon' => 'fa-users', 'label' => 'Pengguna', 'pattern' => 'admin/users*'],
                    ['route' => 'admin.categories.index', 'icon' => 'fa-folder', 'label' => 'Kategori', 'pattern' => 'admin/categories*'],
                    ['route' => 'admin.products.index', 'icon' => 'fa-box', 'label' => 'Produk', 'pattern' => 'admin/products*'],
                ];
            @endphp

            @foreach($menuItems as $item)
                @php
                    $isActive = Request::is($item['pattern']);
                    $baseClasses = [
                        "relative flex items-center gap-3 group px-6 sm:px-2 py-2 sm:rounded-full sm:border-4 transition-colors duration-300 focus:outline-none",
                        $isActive
                            ? "bg-gray-50 sm:bg-white sm:border-gray-50"
                            : "sm:border-transparent hover:bg-gray-100 sm:hover:bg-gray-50 focus:bg-gray-100 sm:focus:bg-gray-50"
                    ];
                    $iconClasses = [
                        "shrink-0 transition-transform duration-300 group-hover:text-indigo-600 group-focus:text-indigo-600",
                        $isActive ? "text-indigo-600" : "text-gray-400"
                    ];
                    $textClasses = [
                        "inline-block transition-all duration-300 origin-left text-base sm:text-lg group-hover:text-indigo-600 group-focus:text-indigo-600",
                        $isActive ? "sm:text-indigo-600" : "text-gray-800"
                    ];
                @endphp

                <a href="{{ route($item['route']) }}" class="{{ implode(' ', $baseClasses) }}">
                    {{-- Div shadow hanya muncul saat aktif --}}
                    @if($isActive)
                        <div role="presentation" aria-hidden="true" class="absolute hidden sm:flex -right-3 -top-15 -z-1 w-14 h-14 rounded-full bg-transparent shadow-[28px_28px_0_theme(colors.gray.50)]"></div>
                        <div role="presentation" aria-hidden="true" class="absolute hidden sm:flex -right-3 -bottom-15 -z-1 w-14 h-14 rounded-full bg-transparent shadow-[28px_-28px_0_theme(colors.gray.50)]"></div>
                    @endif

                    <i class="fa {{ $item['icon'] }} fa-xl {{ implode(' ', $iconClasses) }}"></i>
                    <span class="{{ implode(' ', $textClasses) }}">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col transition-all duration-300">

        {{-- Header --}}
        <header class="relative flex items-center justify-end bg-white px-6 py-2">
            <div role="presentation" aria-hidden="true" class="absolute bg-gray-50 z-1 hidden sm:flex left-0 -bottom-full w-14 h-14 rounded-full bg-transparent shadow-[-28px_-28px_0_theme(colors.white)]"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                    Logout
                </button>
            </form>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>
@endsection
