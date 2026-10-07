<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'user_id',
        'reviewer_name',
        'reviewer_email',
        'rating',
        'title',
        'comment',
        'status',
        'admin_reply',
        'admin_replied_at',
        'helpful_count',
        'is_featured',
    ];

    protected $casts = [
        'rating' => 'integer',
        'helpful_count' => 'integer',
        'is_featured' => 'boolean',
        'admin_replied_at' => 'datetime',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Automatically update business rating/count
     * whenever a review is created or updated.
     */
    protected static function booted()
    {
        static::created(function ($review) {
            $review->updateBusinessRating();
        });

        static::updated(function ($review) {
            $review->updateBusinessRating();
        });

        static::deleted(function ($review) {
            $review->updateBusinessRating();
        });
    }


    /**
     * Recalculate business rating using approved reviews only.
     */
    public function updateBusinessRating()
    {
        $business = $this->business;

        if (!$business) {
            return;
        }

        $approvedReviews = self::where('business_id', $business->id)
            ->where('status', 'approved');

        $count = $approvedReviews->count();

        $rating = $count > 0
            ? round($approvedReviews->avg('rating'), 1)
            : 0;

        $business->update([
            'rating' => $rating,
            'reviews_count' => $count,
        ]);
    }
}
