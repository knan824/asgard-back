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
            'release_year' => $this->release_year,
            'developer' => $this->developer,
            'mode' => $this->mode,
            'price' => $this->price,
            'platform'=>$this->platform,
            'is_available' => $this->is_available,
            'is_visible' => $this->is_visible,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
               ];
    }
}
