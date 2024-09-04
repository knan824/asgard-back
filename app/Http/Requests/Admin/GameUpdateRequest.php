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
            'name' => 'sometimes|string',
            'release_year' => 'sometimes|numeric',
            'developer' => 'sometimes|string',
            'mode' => 'sometimes|string',
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
