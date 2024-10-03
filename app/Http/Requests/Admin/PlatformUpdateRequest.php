<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function updatePlatform()
    {
        $this->platform->update($this->validated());

        if ($this->exists('image')) {
            Storage::delete($this->platform->image->path);
            $this->platform->image()->delete();

            $path = $this->image->store('platforms');
            $this->platform->image()->create([
                'path' => $path,
                'is_main' => true,
                'extension' => $this->image->extension(),
                'size' => $this->image->getSize(),
                'type' => 'photo',
            ]);
        }

        return $this->platform->refresh();
    }

    public function attributes():array
    {
        return [
            'name' => __('platforms.attributes.name'),
            'image' => __('platforms.attributes.image'),
        ];
    }
}
