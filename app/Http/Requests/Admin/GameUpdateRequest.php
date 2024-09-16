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
            'platform' => 'sometimes|array|min:1',
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'images' => 'nullable|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_available' => 'sometimes|boolean',
            'is_visible' => 'sometimes|boolean',
        ];
    }

    public function updateGame()
    {
        $this->game->update($this->validated());
        $this->game->platforms()->sync($this->platform);

        if ($this->hasFile('images')) {
            foreach ($this->file('images') as $imageFile) {
                $path = $imageFile->store('games'); //keeps current images
                $this->game->images()->create([
                    'path' => $path,
                    'is_main' => $this->input('is_main', false),
                    'extension' => $imageFile->extension(),
                    'size' => $imageFile->getSize(),
                    'type' => 'photo',
                ]);
            }
        }
        return $this->game->refresh();
    }
}
