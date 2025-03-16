<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'description',
        'status',
        'category_id', // Add category_id to fillable properties for parent category
    ];

    // Define the relationship to the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Define the relationship to the child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    // Define the relationship to products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
