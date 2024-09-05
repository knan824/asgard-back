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
            'name' => 'required|string|max:255|min:2',
            'release_year' => 'required|date|date_format:Y-m-d|after:2014-01-01',
            'developer' => 'required|string|max:255|min:2',
            'mode' => 'required|string|max:255|min:2',
            'platform' => 'required|string|max:255|min:2', //|exists:platforms to be added after merge
            'price' => 'required|numeric|min:0|max:5000',
            'is_available' => 'required|boolean',
            'is_visible' => 'required|boolean',
        ];
    }

    public function storeGame()
    {
       //game<->platform
        return Game::create($this->validated());
    }
}
