@extends('layouts.app')

@section('content')
<main class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
    <section class="w-full max-w-lg bg-white shadow-lg rounded-2xl p-8">
        <header class="mb-6 text-center">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Akun Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Isi data di bawah untuk membuat akun pembeli</p>
        </header>

        <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
            @csrf

            {{-- Username --}}
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">
                    Username
                </label>
                <input
                    id="username"
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="contoh: himmel123"
                >
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="contoh: himmel@email.com"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
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
                    placeholder="Minimal 6 karakter"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password
                </label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="Ulangi password"
                >
            </div>

            {{-- Informasi Opsional --}}
            <fieldset class="border-t border-gray-200 pt-5">
                <legend class="text-sm text-gray-500 px-2">Informasi Tambahan (Opsional)</legend>
                
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input
                            id="birth_date"
                            type="date"
                            name="birth_date"
                            value="{{ old('birth_date') }}"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        >
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select
                            id="gender"
                            name="gender"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        >
                            <option value="">Pilih</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input
                            id="phone_number"
                            type="text"
                            name="phone_number"
                            value="{{ old('phone_number') }}"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                            placeholder="+62..."
                        >
                    </div>

                    <div>
                        <label for="paypal_id" class="block text-sm font-medium text-gray-700">PayPal ID</label>
                        <input
                            id="paypal_id"
                            type="text"
                            name="paypal_id"
                            value="{{ old('paypal_id') }}"
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                            placeholder="contoh: himmel@paypal.com"
                        >
                    </div>
                </div>

                <div class="mt-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input
                        id="address"
                        type="text"
                        name="address"
                        value="{{ old('address') }}"
                        class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Jl. Contoh No. 123"
                    >
                </div>

                <div class="mt-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">Kota</label>
                    <input
                        id="city"
                        type="text"
                        name="city"
                        value="{{ old('city') }}"
                        class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Jakarta, Bandung, dll"
                    >
                </div>
            </fieldset>

            {{-- Tombol Submit --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors duration-150"
                >
                    Daftar Sekarang
                </button>
            </div>

            <div class="text-center text-sm text-gray-500 mt-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Masuk di sini</a>
            </div>
        </form>
    </section>
</main>
@endsection
