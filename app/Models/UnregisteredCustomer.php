<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnregisteredCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'billing_address', 'phone','email'];

    public function directorders()
    {
        return $this->hasMany(UnregisteredOrder::class);
    }
}

