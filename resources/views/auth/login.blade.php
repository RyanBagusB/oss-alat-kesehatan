@extends('layouts.app')

@section('content')
<main class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
    <section class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        <header class="mb-6 text-center">
            <h1 class="text-2xl font-semibold text-gray-800">Masuk ke Akun</h1>
            <p class="text-sm text-gray-500 mt-1">Silakan masuk dengan email atau username kamu</p>
        </header>

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            <div>
                <label for="login" class="block text-sm font-medium text-gray-700">
                    Email atau Username
                </label>
                <input
                    id="login"
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    required
                    autofocus
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="contoh: himmel@email.com atau himmel123"
                >
                @error('login')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors duration-150"
                >
                    Masuk
                </button>
            </div>

            <div class="text-center text-sm text-gray-500 mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar sekarang</a>
            </div>
        </form>
    </section>
</main>
@endsection
