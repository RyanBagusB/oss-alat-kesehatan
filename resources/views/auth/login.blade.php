@extends('layouts.app')

@section('body')
<main class="min-h-screen flex items-center justify-center bg-gray-50 p-4 sm:p-6 lg:p-8">
    <section class="w-full max-w-md md:max-w-lg lg:max-w-md bg-white shadow-xl rounded-2xl p-8 md:p-10 transition-all duration-300">
        <header class="mb-6 text-center">
            <h1 class="text-3xl font-semibold text-gray-800">Masuk ke Akun</h1>
            <p class="text-sm text-gray-500 mt-2">Gunakan email atau username kamu</p>
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
                    class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                    placeholder="contoh: himmel@email.com atau himmel123"
                >
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
                    class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition-all"
                    placeholder="••••••••"
                >
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg 
                           transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer"
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
