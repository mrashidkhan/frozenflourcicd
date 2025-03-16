<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'coupons';

    // Define the fillable fields
    protected $fillable = [
        'coupon_name',
        'coupon_discount',
        'coupon_start_date',
        'coupon_end_date',
    ];

    // Optionally, you can define any relationships here
    // For example, if a coupon belongs to a user or a product
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
