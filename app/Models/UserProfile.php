<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserProfile extends Model
{   
    // protected $guarded = ['id'];
    protected $fillable = [
    'name',
    'email',
    'profilePhone',
    'role',
    'status',
    'user_id',
    'label',
    'full_name',
    'address_line_1',
    'address_line_2',
    'city',
    'state',
    'postal_code',
    'country',
    'latitude',
    'longitude',
    'is_default',
    'store_name',
    'store_slug',
    'logo',
    'description',
    'address',
    'commission_rate',
    'is_approved',
    'is_active',
    'vehicle_type',
    'vehicle_number',
    'license_Number',
    'is_available',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
{
    return $this->hasMany(Order::class);
}
}