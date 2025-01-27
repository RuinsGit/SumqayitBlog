<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryVideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = $request->lang ?? 'az';
        
        return [
            'id' => $this->id,
            'title' => $this->{"title_$lang"},
            'main_video' => $this->main_video ? asset('./' . $this->main_video) : null,
            'main_video_thumbnail' => $this->main_video_thumbnail ? asset('./' . $this->main_video_thumbnail) : null,
            'meta_title' => $this->{"meta_title_$lang"},
            'meta_description' => $this->{"meta_description_$lang"},
            
        ];
    }
} 
