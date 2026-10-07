<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'image',
        'caption',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
