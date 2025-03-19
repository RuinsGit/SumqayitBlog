<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DigitalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'description' => $this->description,
            'image' => $this->image ? Storage::disk('public')->url($this->image) : null,
            'file' => $this->file ? Storage::disk('public')->url($this->file) : null,
            'image_alt' => $this->image_alt,
            'slug' => [
                'az' => $this->slug_az,
                'en' => $this->slug_en,
                'ru' => $this->slug_ru
            ],
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            
            'created_at' => $this->created_at->format('d.m.Y'),
            
        ];
    }
} 