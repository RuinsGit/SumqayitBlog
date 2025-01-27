<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->lang ?? 'az';
        
        return [
            'id' => $this->id,
            'title' => $this->{"title_$lang"},
            'main_image' => $this->main_image ? asset('storage/' . $this->main_image) : null,
            'main_image_alt' => $this->{"main_image_alt_$lang"},
            'meta_title' => $this->{"meta_title_$lang"},
            'meta_description' => $this->{"meta_description_$lang"},
            
        ];
    }
}
