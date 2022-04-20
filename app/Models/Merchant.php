<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Merchant extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['full_name', 'phone_number', 'merchant_code', 'password', 'pickup_address', 'is_active'];
    protected $hidden = [
        'password'
    ];
}
