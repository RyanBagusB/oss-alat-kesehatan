<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Buyer;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $buyer = $user->buyer;

        return view('buyer.profile.show', compact('user', 'buyer'));
    }

    public function edit()
    {
        $user = Auth::user();
        $buyer = $user->buyer;

        return view('buyer.profile.edit', compact('user', 'buyer'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $buyer = $user->buyer;

        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'paypal_id' => 'nullable|string|max:100',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $request->filled('password')
                ? Hash::make($validated['password'])
                : $user->password,
        ]);

        if (!$buyer) {
            $buyer = new Buyer(['user_id' => $user->id]);
        }

        $buyer->fill([
            'birth_date' => $validated['birth_date'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
            'paypal_id' => $validated['paypal_id'] ?? null,
        ])->save();

        return redirect()
            ->route('buyer.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
