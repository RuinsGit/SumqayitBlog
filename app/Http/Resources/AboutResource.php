<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'special_title' => $this->special_title,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? asset($this->image) : null,
            'document_file' => $this->document_file ? asset($this->document_file) : null,
            'status' => (bool)$this->status,
        ];
    }
} 