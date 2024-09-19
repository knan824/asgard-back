<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'release_year' => $this->release_year,
            'developer' => $this->developer,
            'platforms' => PlatformResource::collection($this->platforms),
            'mode' => $this->mode,
            'is_available' => $this->is_available,
        ];
    }
}
