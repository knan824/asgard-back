<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
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
        return DB::transaction(function () {
            $this->platform->update($this->validated());

            if ($this->exists('image')) {
                $this->platform->replaceMedia($this->image);
            }

            return $this->platform->refresh();
        });
    }

    public function attributes():array
    {
        return [
            'name' => __('platforms.attributes.name'),
            'image' => __('platforms.attributes.image'),
        ];
    }
}
