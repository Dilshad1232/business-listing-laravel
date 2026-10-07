<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'website_name',
        'tagline',
        'logo',
        'favicon',
        'email',
        'phone',
        'whatsapp',
        'address',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'copyright_text',
    ];
}