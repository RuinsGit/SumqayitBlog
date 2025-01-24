<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'special_title_az',
        'special_title_en',
        'special_title_ru',
        'title_az',
        'title_en',
        'title_ru',
        'description_az',
        'description_en',
        'description_ru',
        'document_file',
        'image',
        'status',
    ];
    public function getSpecialTitleAttribute()
    {
        return $this->{'special_title_' . app()->getLocale()};
    }
    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }
    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }
   
    protected $table = 'about'; 


} 