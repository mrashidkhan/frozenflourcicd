<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnregisteredOrder extends Model
{
    use HasFactory;

    protected $fillable = ['unregistered_customer_id', 'product', 'delivered', 'delivery_date', 'paid','shipping','total_amount','weight','quantity','price'];

    public function customer()
    {
        return $this->belongsTo(UnregisteredCustomer::class);
    }
}
