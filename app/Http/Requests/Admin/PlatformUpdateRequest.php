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
            'name' => 'sometimes|string|max:255|min:2|unique:platforms,name'
        ];
    }

    public function updatePlatform()
    {
        $this->platform->update($this->validated());

        return $this->platform->refresh();
    }
}
