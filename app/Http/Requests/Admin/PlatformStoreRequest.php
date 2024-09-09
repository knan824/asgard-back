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
        ];
    }

    public function storePlatform()
    {
        return Platform::create($this->validated());
    }
}
