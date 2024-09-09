<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GameUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'name' => 'sometimes|string|max:255|min:2',
            'release_year' => 'sometimes|date|date_format:Y-m-d|after:2014-01-01',
            'developer' => 'sometimes|string|max:255|min:2',
            'mode' => 'sometimes|string|max:255|min:2',
            'platform' => 'sometimes|string|max:255|min:2',
            'platform.*' => 'exists:platforms,id',
            'price' => 'sometimes|numeric|min:0|max:5000',
            'is_available' => 'sometimes|boolean',
            'is_visible' => 'sometimes|boolean',
               ];
    }

    public function updateGame()
    {
        $this->game->update($this->validated());

        return $this->game->refresh();
    }
}
