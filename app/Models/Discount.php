<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
        'product_id',
        'weight',
        'original_price',
        'discounted_price',
        'is_most_bought',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isMostBought()
    {
        return $this->is_most_bought;
    }

    // Define the relationship with the OrderItem model
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'discount_id');
    }
}
