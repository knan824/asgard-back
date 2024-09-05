<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GameUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255|min:2',
            'release_year' => 'sometimes|date|date_format:Y-m-d|after:2014-01-01',
            'developer' => 'sometimes|string|max:255|min:2',
            'mode' => 'sometimes|string|max:255|min:2',
            'platform' => 'sometimes|string|max:255|min:2', //|exists:platforms to be added after merge
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
