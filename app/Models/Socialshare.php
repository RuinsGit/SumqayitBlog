<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialshare extends Model
{
    protected $fillable = [
        'name',
        'image',
        'link',
        'order',
        'status',
        'sitelink',
        'background_color'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
