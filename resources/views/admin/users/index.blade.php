@extends('layouts.admin')

@section('content')
<div class="flex flex-col gap-6 bg-gray-50 min-h-screen">

    {{-- Header --}}
    <div class="flex items-end justify-between">
        <div class="flex flex-col gap-y-1.5">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Pengguna
            </h2>

            {{-- Breadcrumbs --}}
            <nav class="text-sm sm:text-base text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center flex-wrap">
                    <li class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline text-indigo-600">Beranda</a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-1 text-gray-400" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="flex items-center text-gray-600 capitalize" aria-current="page">
                        Pengguna
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Card / Table Container --}}
    <div class="bg-white rounded-2xl overflow-hidden shadow">

        {{-- Card Header --}}
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa fa-users text-indigo-600"></i>
                Daftar Pengguna
            </h3>
        </div>

        {{-- Card Body / Table --}}
        <div class="p-4 overflow-x-auto">
            <table class="min-w-full text-sm sm:text-base">
                <thead class="bg-gray-50 text-gray-600 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">#</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Nama Pengguna</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Email</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Peran</th>
                        <th class="px-4 py-3 text-left font-bold tracking-wide">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-800">
                    @forelse ($users as $index => $user)
                        <tr class="transition-colors hover:bg-indigo-50/50">
                            <td class="px-4 py-3">{{ $index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $user->username }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                            <td class="px-4 py-3 capitalize">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold 
                                    {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $user->role === 'admin' ? 'Admin' : ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $user->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                Tidak ada pengguna yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
