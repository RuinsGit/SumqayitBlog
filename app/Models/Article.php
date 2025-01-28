<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'text_az',
        'text_en',
        'text_ru',
        'image',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru',
        'description_az',
        'description_en',
        'description_ru',
        'meta_title_az',
        'meta_title_en',
        'meta_title_ru',
        'meta_description_az',
        'meta_description_en',
        'meta_description_ru',
        'slug_az',
        'slug_en',
        'slug_ru',
        'view_count',
    ];
    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }
    public function getTextAttribute()
    {
        return $this->{'text_' . app()->getLocale()};
    }
    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }
    public function getMetaTitleAttribute()
    {
        return $this->{'meta_title_' . app()->getLocale()};
    }
    public function getMetaDescriptionAttribute()
    {
        return $this->{'meta_description_' . app()->getLocale()};
    }
    public function getSlugAttribute()
    {
        return $this->{'slug_' . app()->getLocale()};
    }
    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }
   

} 