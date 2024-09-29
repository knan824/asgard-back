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
//            'psn_email' => $this->psn_email,  //show only if user purchased
//            'password' => $this->password,    //show only if user purchased
            'is_sold' => $this->is_sold,
            'is_blocked' => $this->is_blocked,
            'is_primary' => $this->is_primary,
            'user' => new UserSimpleResource($this->user),
            'games' => GameSimpleResource::collection($this->games),
            'platforms' => PlatformResource::collection($this->platforms),
            'image' => new ImageResource($this->image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
