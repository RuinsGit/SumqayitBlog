<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialshareResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => asset($this->image), // Resmin tam URL'sini döndür
            'link' => $this->link,
            'sitelink' => $this->sitelink,
            'background_color' => $this->background_color,
            // 'order' => $this->order,
            'status' => $this->status,
        ];
    }
} 