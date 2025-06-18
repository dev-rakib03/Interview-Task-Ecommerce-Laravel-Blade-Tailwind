<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sku', 'slug', 'description', 'price', 'thumbnail', 'images', 'status'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePublic($query)
    {
        return $query->where('status', 'public');
    }
}
