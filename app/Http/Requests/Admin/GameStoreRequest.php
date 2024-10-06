<?php

namespace App\Http\Requests\Admin;

use App\Models\Game;
use App\Rules\OneMainImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'name' => 'required|string|max:255|min:2|unique:games,name',
            'release_year' => 'required|date|date_format:Y-m-d|after:2014-01-01',
            'developer' => 'required|string|max:255|min:2',
            'mode' => 'required|array|min:1',
            'mode.*' => 'integer|exists:modes,id|required_with:mode',
            'platform' => 'required|array|min:1',
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'images' => ['required', 'array', 'min:1', new OneMainImage],
            'images.*.image' => 'image|mimes:jpeg,png,jpg|max:2048|required_with:images',
            'images.*.is_main' => 'required|boolean|required_with:images',
            'is_available' => 'required|boolean',
            'is_visible' => 'required|boolean',
        ];
    }

    public function storeGame()
    {
        return DB::transaction(function () {
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
        });
    }

    public function attributes():array
    {
        return [
            'name' => __('games.attributes.name'),
            'release_year' => __('games.attributes.release_year'),
            'developer' => __('games.attributes.developer'),
            'mode' => __('games.attributes.modes'),
            'mode.*' => __('games.attributes.mode'),
            'platform' => __('games.attributes.platforms'),
            'platform.*' => __('games.attributes.platform'),
            'images' => __('games.attributes.images'),
            'images.*.image' => __('games.attributes.image'),
            'images.*.is_main' => __('games.attributes.image_is_main'),
            'is_available' => __('games.attributes.available'),
            'is_visible' => __('games.attributes.visible'),
        ];
    }
}
