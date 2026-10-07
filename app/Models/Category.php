<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'image',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    // public function listings()
    // {
    //     return $this->hasMany(Listing::class);
    // }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
