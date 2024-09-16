<?php

namespace App\Http\Requests\Admin;

use App\Models\platform;
use Illuminate\Foundation\Http\FormRequest;

class PlatformStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:2|unique:platforms,name',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function storePlatform()
    {
       $platform = Platform::create($this->validated());
        foreach ($this->images as $image) {
            $path = $image->store('games');
            $platform->images()->create([
                'path' => $path,
                'is_main' => $image['is_main'] ?? false,
                'extension' => $image->extension(),
                'size' => $image->getSize(),
                'type' => 'photo',
            ]);
        }

        return $platform;
    }
}
