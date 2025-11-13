@extends('layouts.buyer')

@section('content')
<div class="space-y-8 max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="border-b border-gray-200 pb-4 flex items-end justify-between">
        <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800">Edit Profil</h1>
            <p class="mt-2 text-gray-600">Perbarui informasi akun dan data pribadi kamu.</p>
        </div>

        <a href="{{ route('buyer.products.index') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white 
                  font-medium px-4 py-2.5 rounded-lg transition">
            <i class="fa fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    {{-- Card Form --}}
    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-8">
        <form action="{{ route('buyer.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Informasi Akun --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Informasi Akun</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input
                            id="username"
                            name="username"
                            type="text"
                            value="{{ old('username', $user->username) }}"
                            required
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        >
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        >
                    </div>
                </div>
            </div>

            {{-- Informasi Pribadi --}}
            <div class="pt-4 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pribadi</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Tanggal Lahir --}}
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input
                            id="birth_date"
                            name="birth_date"
                            type="date"
                            value="{{ old('birth_date', $buyer->birth_date) }}"
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        >
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select
                            id="gender"
                            name="gender"
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        >
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="male" {{ old('gender', $buyer->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender', $buyer->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input
                            id="phone_number"
                            name="phone_number"
                            type="text"
                            value="{{ old('phone_number', $buyer->phone_number) }}"
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            placeholder="Contoh: 08123456789"
                        >
                    </div>

                    {{-- Kota --}}
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Kota</label>
                        <input
                            id="city"
                            name="city"
                            type="text"
                            value="{{ old('city', $buyer->city) }}"
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            placeholder="Contoh: Bandung"
                        >
                    </div>

                    {{-- Alamat Lengkap --}}
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea
                            id="address"
                            name="address"
                            rows="3"
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            placeholder="Masukkan alamat lengkap">{{ old('address', $buyer->address) }}</textarea>
                    </div>

                    {{-- PayPal ID --}}
                    <div class="sm:col-span-2">
                        <label for="paypal_id" class="block text-sm font-medium text-gray-700">PayPal ID</label>
                        <input
                            id="paypal_id"
                            name="paypal_id"
                            type="text"
                            value="{{ old('paypal_id', $buyer->paypal_id) }}"
                            class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                            placeholder="Masukkan email PayPal kamu (opsional)"
                        >
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="pt-6 border-t border-gray-200 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 
                           text-white font-medium px-6 py-2.5 rounded-lg transition">
                    <i class="fa fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
