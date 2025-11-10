<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Buyer;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => '12345678',
            'role' => 'admin',
        ]);

        $buyerUser = User::create([
            'id' => Str::uuid(),
            'username' => 'buyeruser',
            'email' => 'buyer@example.com',
            'password' => '12345678',
            'role' => 'buyer',
        ]);

        Buyer::create([
            'id' => Str::uuid(),
            'user_id' => $buyerUser->id,
            'birth_date' => '1995-06-15',
            'gender' => 'male',
            'address' => 'Jl. Mawar No. 7',
            'city' => 'Jakarta',
            'phone_number' => '08123456789',
            'paypal_id' => 'buyer.paypal@example.com',
        ]);
    }
}
