<?php

namespace App\Http\Requests\Admin;

use App\Rules\OneMainImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class GameUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255|min:2|unique:games,name,' . $this->game->id,
            'release_year' => 'sometimes|date|date_format:Y-m-d|after:2014-01-01',
            'developer' => 'sometimes|string|max:255|min:2',
            'mode' => 'sometimes|array|min:1',
            'mode.*' => 'integer|exists:modes,id|required_with:mode',
            'platform' => 'sometimes|array|min:1',
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'images' => ['sometimes', 'array', 'min:1', new OneMainImage],
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'images.*.is_main' => 'sometimes|boolean',
            'is_available' => 'sometimes|boolean',
            'is_visible' => 'sometimes|boolean',
        ];
    }

    public function updateGame()
    {
        $this->game->update($this->validated());
        $this->game->platforms()->sync($this->platform);
        $this->game->modes()->sync($this->mode);

        if ($this->exists('images')) {
            if ($this->game->images->count() > 0) {
                foreach($this->game->images as $image) {
                    Storage::delete($image->path);
                }
                $this->game->images()->delete();
            }
            foreach ($this->images as $imageFile) {
                $path = $imageFile->store('games');
                $this->game->images()->create([
                    'path' => $path,
                    'is_main' => $this->$imageFile['is_main'] ?? false,
                    'extension' => $imageFile->extension(),
                    'size' => $imageFile->getSize(),
                    'type' => 'photo',
                ]);
            }
        }

        return $this->game->refresh();
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
