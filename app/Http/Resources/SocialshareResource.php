<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialshareResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'sitelink' => [
                'sitelink' => $this->sitelink,
                'id' => $this->id,
            ],
            'id' => $this->id,
            'name' => $this->name,
            'image' => asset($this->image), 
            'link' => $this->link,
            'background_color' => $this->background_color,
            // 'order' => $this->order,
            'status' => $this->status,
        ];
    }
} 