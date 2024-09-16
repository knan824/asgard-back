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
            'platform' => 'required|array|min:1',
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_available' => 'required|boolean',
            'is_visible' => 'required|boolean',
        ];
    }

    public function storeGame()
    {
        $game = Game::create($this->validated());
        $game->platforms()->attach($this->platform);
        foreach ($this -> images as $image){
            $path = $image -> store ('games');
            $game -> images()->create([
               'path' => $path,
               'is_main' => $image['is_main'] ?? false,
               'extension' => $image-> extension(),
               'size' => $image -> getSize(),
               'type' => 'photo',
            ]);
        }

        return $game;
    }
}
