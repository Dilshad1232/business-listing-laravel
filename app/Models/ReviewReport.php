<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'user_id',
        'reporter_name',
        'reporter_email',
        'reason',
        'message',
        'status',
        'admin_notes',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /**
     * Reported review.
     */
    public function review()
    {
        return $this->belongsTo(
            BusinessReview::class,
            'review_id'
        );
    }

    /**
     * User who reported the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
