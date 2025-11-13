@extends('layouts.buyer')

@section('content')
<div class="space-y-8 max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="border-b border-gray-200 pb-4 flex items-end justify-between">
        <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-800">Profil Saya</h1>
            <p class="mt-2 text-gray-600">Lihat informasi akun dan data pribadi kamu.</p>
        </div>

        <a href="{{ route('buyer.profile.edit') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white 
                  font-medium px-4 py-2.5 rounded-lg transition">
            <i class="fa fa-edit"></i>
            Edit Profil
        </a>
    </div>

    {{-- Card Profil --}}
    <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-8">
        <div class="space-y-8">
            
            {{-- Informasi Akun --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Informasi Akun</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-sm text-gray-500">Username</p>
                        <p class="font-medium">{{ $user->username }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Informasi Pribadi --}}
            <div class="pt-4 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pribadi</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Lahir</p>
                        <p class="font-medium">{{ $buyer->birth_date ? \Carbon\Carbon::parse($buyer->birth_date)->format('d M Y') : '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="font-medium">
                            @if ($buyer->gender === 'male')
                                Laki-laki
                            @elseif ($buyer->gender === 'female')
                                Perempuan
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Nomor Telepon</p>
                        <p class="font-medium">{{ $buyer->phone_number ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Kota</p>
                        <p class="font-medium">{{ $buyer->city ?? '-' }}</p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-sm text-gray-500">Alamat Lengkap</p>
                        <p class="font-medium whitespace-pre-line">{{ $buyer->address ?? '-' }}</p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-sm text-gray-500">PayPal ID</p>
                        <p class="font-medium">{{ $buyer->paypal_id ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
