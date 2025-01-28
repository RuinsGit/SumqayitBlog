<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMore extends Model
{
    protected $table = 'social_more';
    
    protected $fillable = [
        'image',
        'link',
        'order',
        'status',
        'title'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}