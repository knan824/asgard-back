<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'psn_email' => $this->psn_email,
            'is_sold' => $this->is_sold,
            'is_blocked' => $this->is_blocked,
            'is_primary' => $this->is_primary,
            'games' => GameResource::collection($this->games),
            'platforms' => PlatformResource::collection($this->platforms),
            'images' => ImageResource::collection($this->images),
        ];
    }
}
