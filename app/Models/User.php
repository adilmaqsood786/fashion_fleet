<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
     use Notifiable;
    use HasApiTokens;
    protected $guarded = ['id'];
    //  protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];
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
