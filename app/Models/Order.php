<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'orders';

    // Define the fillable attributes
    protected $fillable = [
        'customer_id',
        'payment_method',
        'billing_address',
        'paid', // Add paid field
        'delivered', // Add delivered field
        'delivery_date', // Add delivery_date field
    ];

    // Define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getGrandTotalAttribute()
    {
        return $this->items()->sum(DB::raw('price * quantity'));
    }

}
