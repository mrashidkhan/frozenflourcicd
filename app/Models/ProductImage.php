<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    // use SoftDeletes;
    // Specify the table if it doesn't follow Laravel's naming convention
    protected $table = 'product_images';

    // Define the fillable fields
    protected $fillable = ['product_id', 'image_url'];

    // Define the relationship to the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
