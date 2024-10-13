<?php

namespace App\Http\Requests\Admin;

use App\Models\platform;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function storePlatform()
    {
        return DB::transaction(function () {
            return Platform::create([
                ...$this->validated(),
                'slug' => $this->name,
            ])->addMedia($this->image, 'platforms');
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
