<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Buyer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'birth_date',
        'gender',
        'address',
        'city',
        'phone_number',
        'paypal_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
