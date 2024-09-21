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
            'platform_type' => $this->platfrom_type,
            'price' => $this->price->price,
            'is_sold' => $this->is_sold,
            'is_blocked' => $this->is_blocked,
            'games' => GameResource::collection($this->games),
            'platforms' => PlatformResource::collection($this->platforms),
            'images' => ImageResource::collection($this->images),
        ];
    }
}
