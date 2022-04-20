<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        "merchant_id",
        "percletype",
        "full_name",
        "phone_number",
        "pickup_date",
        "pickup_time",
        "pickup_address",
        "drop_address",
        "item_description",
        "payment_mode",
        "estimate_time",
        "cost",
        "is_approve",
        "weight"
    ];
}
