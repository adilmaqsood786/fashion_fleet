<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Order_item::class);
    }

    public function scopeWithDeliveryStatus(Builder $query, string $deliveryStatus): Builder
    {
        return $query->where('delivery_status', $deliveryStatus);
    }

    protected function casts(): array
    {
        return [
            'delivered_at' => 'datetime',
            'placed_at' => 'datetime',
        ];
    }
}
