<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    protected $guarded = ['id'];
    // ✅ Rating belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // (optional) user relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // (optional) order relation
    public function order()
    {
        return $this->belongsTo(Order::class);
    }   
}
