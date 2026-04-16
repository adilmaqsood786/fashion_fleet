<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
        protected $guarded = ['id'];
public function user()
{
    return $this->belongsTo(User::class);
}

public function vendor()
{
    return $this->belongsTo(Vendor::class);
}

public function rider()
{
    return $this->belongsTo(Rider::class);
}

public function profile()
{
    return $this->belongsTo(UserProfile::class);
}
}
