<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'day_of_week',
        'is_closed',
        'is_24_hours',
        'opening_time',
        'closing_time',
        'opening_time_2',
        'closing_time_2',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'is_24_hours' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Business Relation
    |--------------------------------------------------------------------------
    */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Day Name
    |--------------------------------------------------------------------------
    */
    public function getDayNameAttribute()
    {
        return match ($this->day_of_week) {
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            default => 'Unknown',
        };
    }
    public function businessHours()
{
    return $this->hasMany(BusinessHour::class)->orderBy('day_of_week');
}
}
