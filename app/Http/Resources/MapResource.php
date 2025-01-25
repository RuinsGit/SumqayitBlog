<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => 1,
            'description' => $this->description,
            // 'created_at' => $this->created_at->format('d-m-Y H:i'),
            // 'updated_at' => $this->updated_at->format('d-m-Y H:i'),
        ];
    }
} 