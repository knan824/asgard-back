<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameSimpleResource extends JsonResource
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
            'name' => $this->name,
            'user' => new UserResource($this->user),
            'price' => new PriceResource($this->price),
            'image' => ImageResource::make($this->MainImage),
            'platforms' => PlatformResource::collection($this->platforms),
            'modes' => ModeResource::collection($this->modes),
        ];
    }
}
