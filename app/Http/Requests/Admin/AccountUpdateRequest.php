<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class AccountUpdateRequest extends FormRequest
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
            'psn_email' => 'sometimes|string|email|max:255|min:2|unique:accounts,email,'. $this->email->id,
            'password' => 'sometimes|string|min:8|max:255|regex:/[a-zA-Z]/|regex:/[0-9]/|confirmed',
            'platform' => 'sometimes|array|min:1',
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'sometimes|numeric|min:0',
            'is_sold' => 'sometimes|boolean',
            'is_blocked' => 'sometimes|boolean',
            ];
    }

    public function updateAccount()
    {
        $this->account->update($this->validated());
        $this->account->platforms()->sync($this->platform);
        $this->account->price->update(['price' => $this->price]);

        if ($this->exists('image')) {
            Storage::delete($this->account->image->path);
            $this->account->image()->delete();

            $path = $this->image->store('accounts');
            $this->account->image()->update([
                'path' => $path,
                'is_main' => true,
                'extension' => $this->image->extension(),
                'size' => $this->image->getSize(),
                'type' => 'photo',
            ]);
        }

        return $this->account->refresh();
    }

}
