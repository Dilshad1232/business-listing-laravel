<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'short_description',
        'description',
        'phone',
        'email',
        'website',
        'address',
        'city',
        'state',
        'country',
        'price',
        'rating',
        'image',
        'status',
        'is_featured',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'sort_order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($listing) {

            if (empty($listing->slug)) {
                $listing->slug = Str::slug($listing->name);
            }

        });
    }
}
