<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'product_name',
        'base_price',
        'description',
        'image_url',
        'weight',
    ];

    // Define the relationship to the category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Define the relationship to discounts
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    // Define the relationship to ProductImages
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


}
