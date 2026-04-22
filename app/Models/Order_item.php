<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $guarded = ['id'];
     public function productRatings()
    {
        return $this->hasMany(ProductRating::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
{
    return $this->belongsTo(Order::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}

}
