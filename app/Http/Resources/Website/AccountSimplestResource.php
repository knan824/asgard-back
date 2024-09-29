<?php

namespace App\Http\Resources\Website;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountSimplestResource extends JsonResource
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
            'is_sold' => $this->is_sold,
            'is_blocked' => $this->is_blocked,
            'is_primary' => $this->is_primary,
            'user' => new UserSimpleResource($this->user),
        ];
    }
}
