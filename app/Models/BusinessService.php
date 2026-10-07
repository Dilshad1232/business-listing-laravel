<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BusinessService extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'duration',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'boolean',
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
     * Automatically create slug
     */
    protected static function booted(): void
    {
        static::creating(function ($service) {

            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }

        });
    }
    public function bookings()
{
    return $this->hasMany(Booking::class, 'business_service_id');
}
}
