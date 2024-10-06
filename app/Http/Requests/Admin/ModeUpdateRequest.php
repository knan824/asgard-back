<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ModeUpdateRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'min:1', 'max:30', 'unique:modes,name,' . $this->mode->name],
        ];
    }

    public function updateMode()
    {
        $this->mode->update([
            'name' => $this->name,
        ]);

        return $this->mode->refresh();
    }

    public function attributes():array
    {
        return [
            'name' => __('modes.attributes.name'),
        ];
    }
}
