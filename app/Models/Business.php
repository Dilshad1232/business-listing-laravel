<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\BusinessPhoto;
use App\Models\BusinessService;
use App\Models\BusinessReview;
use App\Models\Product;
use App\Models\Enquiry;
use App\Models\Offer;
class Business extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'country_id',
        'state_id',
        'city_id',
        'area_id',
        'name',
        'slug',
        'tagline',
        'description',
        'phone',
        'email',
        'website',
        'address',
        'pincode',
        'logo',
        'cover_image',
        'status',
        'admin_notes',
        'is_featured',
        'rating',
        'reviews_count',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'rating' => 'decimal:1',
            'reviews_count' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }
    public function businessHours()
{
    return $this->hasMany(BusinessHour::class)
        ->orderBy('day_of_week');
}
public function photos()
{
    return $this->hasMany(BusinessPhoto::class)
        ->orderBy('sort_order')
        ->orderBy('id');
}
public function services()
{
    return $this->hasMany(BusinessService::class)
        ->where('status', true)
        ->orderBy('sort_order')
        ->orderBy('id');
}
public function reviews()
{
    return $this->hasMany(BusinessReview::class);
}
public function products()
{
    return $this->hasMany(Product::class);
}

public function enquiries()
{
    return $this->hasMany(Enquiry::class);
}
public function offers()
{
    return $this->hasMany(Offer::class)
        ->orderBy('sort_order')
        ->latest();
}


public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function activeOffers()
{
    return $this->hasMany(Offer::class)
        ->where('status', true)
        ->orderBy('sort_order')
        ->latest();
}
}
