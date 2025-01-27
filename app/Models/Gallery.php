<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery_images';

    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'description_az',
        'description_en',
        'description_ru',
        'main_image',
        'main_image_alt_az',
        'main_image_alt_en',
        'main_image_alt_ru',
        'meta_title_az',
        'meta_title_en',
        'meta_title_ru',
        'meta_description_az',
        'meta_description_en',
        'meta_description_ru'
    ];

    public function galleryType()
    {
        return $this->belongsTo(GalleryType::class);
    }
} 