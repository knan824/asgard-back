<?php

namespace App\Http\Requests\Admin;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;

class GameStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'release_year' => 'required|numeric',
            'developer' => 'required|string',
            'platform' => 'required|string',
        ];
    }

    public function storeGame()
    {
        return Game::create($this->validated());
    }
}
