<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers';

    // Specify the fillable attributes
    protected $fillable = [
        'first_name',
        'last_name',
        'billing_address',
        'shipping_address',
        'city',
        'postal_code',
        'country',
        'phone',
        'user_id'
    ];

    // Hide sensitive attributes
    protected $hidden = [

        'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Optionally, you can add mutators for password hashing
    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = bcrypt($password);
    // }
}
