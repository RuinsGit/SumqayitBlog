<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'description' => $this->description,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'image_alt' => $this->image_alt,
            'slug' => [
                'az' => $this->slug_az,
                'en' => $this->slug_en,
                'ru' => $this->slug_ru
            ],
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'view_count' => $this->view_count,
            'created_at' => $this->created_at->format('d.m.Y'),
            
        ];
    }
} 