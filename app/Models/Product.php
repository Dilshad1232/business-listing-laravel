<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Enquiry;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'price',
        'discount_price',
        'stock',
        'status',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'stock' => 'integer',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Business relation
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Category relation
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Subcategory relation
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * Automatically create slug
     */
    protected static function booted(): void
    {
        static::creating(function ($product) {

            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }

        });
    }
    public function images()
{
    return $this->hasMany(ProductImage::class)
        ->orderBy('sort_order');
}

public function enquiries()
{
    return $this->hasMany(Enquiry::class);
}
}
