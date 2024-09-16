<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlatformUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255|min:2|unique:platforms,name,id',
            'images' => 'sometimes|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function updatePlatform()
    {
        $this->platform->update($this->validated());

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

        return $this->platform->refresh();
    }
}
