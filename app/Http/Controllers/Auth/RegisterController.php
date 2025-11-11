<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register', ['title' => 'Daftar Akun']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required'],
            'paypal_id' => ['required', 'string', 'max:255'],
        ], [
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.string' => 'Nama pengguna harus berupa teks.',
            'username.max' => 'Nama pengguna tidak boleh lebih dari :max karakter.',
            'username.unique' => 'Nama pengguna sudah digunakan.',

            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah terdaftar.',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
            'password.min' => 'Kata sandi harus memiliki minimal :min karakter.',

            'password_confirmation.required' => 'Konfirmasi kata sandi wajib diisi.',

            'paypal_id.required' => 'ID PayPal wajib diisi.',
            'paypal_id.string' => 'ID PayPal harus berupa teks.',
            'paypal_id.max' => 'ID PayPal tidak boleh lebih dari :max karakter.',
        ]);

        $user = User::create([
            'id' => Str::uuid(),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'buyer',
        ]);

        Buyer::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'paypal_id' => $request->paypal_id,
        ]);

        auth()->login($user);

        return redirect()->route('buyer.products.index')
            ->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->username . '.');
    }
}
