<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id'];
 public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function rider()
    {
        return $this->hasOne(Rider::class);
    }
    public function orders()
{
    return $this->hasMany(Order::class);
}
 public function productRatings()
    {
        return $this->hasMany(ProductRating::class);
    }
}
