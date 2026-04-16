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
}

