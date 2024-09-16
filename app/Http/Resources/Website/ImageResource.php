<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'id' => $this->id,
        'path' => $this->path,
        'url' => asset('storage/' . $this->path), // Return the full URL of the image
        'is_main' => $this->is_main,
        'extension' => $this->extension,
        'size' => $this->size,
        'type' => $this->type,
        ];
    }
}
