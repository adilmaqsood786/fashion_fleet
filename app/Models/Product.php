<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $guarded = ['id'];

        // Vendor relationship (Many-to-One)
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    
    // Categories relationship (Many-to-Many)
    public function categories()
    {
        return $this->belongsToMany(CategoryProduct::class);

    }
      // Product has many images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Product has many ratings
    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    // (optional) average rating helper
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}

