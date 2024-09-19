<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Website\PlatformResource;
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
            'platforms' => PlatformResource::collection($this->platforms),
        ];
    }
}
