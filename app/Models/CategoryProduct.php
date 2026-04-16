<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    // protected $fillable = ['name', 'parent_id', 'status'];
    protected $guarded = ['id'];

    // Parent category
    public function parent()
    {
        return $this->belongsTo(CategoryProduct::class, 'parent_id');
    }

    // Child categories
    public function children()
    {
        return $this->hasMany(CategoryProduct::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
