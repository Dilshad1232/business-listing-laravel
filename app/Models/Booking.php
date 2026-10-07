<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'business_id',
        'user_id',
        'business_service_id',
        'offer_id',

        'customer_name',
        'customer_email',
        'customer_phone',

        'booking_date',
        'booking_time',

        'original_amount',
        'discount_amount',
        'final_amount',

        'notes',
        'status',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',

            'original_amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'final_amount' => 'decimal:2',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function businessService(): BelongsTo
    {
        return $this->belongsTo(
            BusinessService::class,
            'business_service_id'
        );
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
