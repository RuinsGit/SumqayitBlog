<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worklife extends Model
{
    use HasFactory;

    protected $fillable = [
        'description_az',
        'description_en',
        'description_ru',
    ];

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }

    // Tablo adını belirtin
    protected $table = 'worklife'; // Burada tablo adını 'worklife' olarak ayarlıyoruz
} 