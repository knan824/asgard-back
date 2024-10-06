<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'release_year' => $this->release_year,
            'developer' => $this->developer,
            'is_available' => $this->is_available,
            'is_visible' => $this->is_visible,
            'modes' => ModeResource::collection($this->modes),
            'platforms' => PlatformResource::collection($this->platforms),
            'images' => ImageResource::collection($this->images),
            'accounts_count' => $this->validAccounts->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
