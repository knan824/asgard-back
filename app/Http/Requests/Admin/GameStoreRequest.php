<?php

namespace App\Http\Requests\Admin;

use App\Models\Game;
use App\Rules\OneMainImage;
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
            'mode' => 'required|array|min:1',
            'mode.*' => 'integer|exists:modes,id|required_with:mode',
            'platform' => 'required|array|min:1',
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'images' => ['required', 'array', 'min:1', new OneMainImage],
            'images.*.image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'images.*.is_main' => 'required|boolean',
            'is_available' => 'required|boolean',
            'is_visible' => 'required|boolean',
        ];
    }

    public function storeGame()
    {
        $game = Game::create($this->validated());
        $game->platforms()->attach($this->platform);
        $game->modes()->attach($this->mode);

        foreach ($this->images as $imageData) {
            $path = $imageData['image']->store('games');
            $game->images()->create([
               'path' => $path,
               'is_main' => $imageData['is_main'],
               'extension' => $imageData['image']->extension(),
               'size' => $imageData['image']->getSize(),
               'type' => 'photo',
            ]);
        }

        return $game;
    }
}
