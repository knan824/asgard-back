<?php

namespace App\Http\Requests\Admin;

use App\Models\Mode;
use Illuminate\Foundation\Http\FormRequest;

class ModeStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1', 'max:30', 'unique:modes'],
        ];
    }

    public function storeMode()
    {
        return Mode::create([
            'name' => $this->name,
        ]);
    }

    public function attributes():array
    {
        return [
            'name' => __('Modes.attributes.name'),
        ];
    }
}
