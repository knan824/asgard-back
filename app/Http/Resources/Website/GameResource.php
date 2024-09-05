<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'release_year' => $this->release_year,
            'developer' => $this->developer,
            'platform'=>$this->platform,
            'mode' => $this->mode,
            'price' => $this->price,
        ];
    }
}
