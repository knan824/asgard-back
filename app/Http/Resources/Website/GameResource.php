<?php

namespace App\Http\Resources\Website;

use App\Http\Resources\Admin\ImageResource;
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
            'images' => ImageResource::collection($this->images),
            'platforms' => PlatformResource::collection($this->platforms),
            'accounts' => AccountSimplestResource::collection($this->validAccounts),
            'modes' => ModeResource::collection($this->modes),
        ];
    }
}
