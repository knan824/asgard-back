<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
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
        $accountPlatformRule = function ($attribute, $value, $fail) {
            $isPrimary = $this->is_primary ?? $this->account->is_primary; //keeps current primary choice if no new is added
            if ($isPrimary && count($value) > 2) {
                $fail('A primary account can have a maximum of two platforms.');
            } elseif (!$isPrimary && count($value) > 1) {
                $fail('A secondary account can have a maximum of one platform.');
            }
        };

        return [
            'password' => 'sometimes|string|min:8|max:255|regex:/[a-zA-Z]/|regex:/[0-9]/|confirmed',
            'platform' => ['sometimes', 'array', 'min:1', $accountPlatformRule],
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'is_primary' => 'sometimes|boolean',
        ];
    }

    public function updateAccount()
    {
        return DB::transaction(function () {
            $this->account->update([
                'password' => $this->password,
                'is_primary' => $this->is_primary,
            ]);
            $this->account->platforms()->sync($this->platform);

            if ($this->exists('image')) {
                Storage::delete($this->account->image->path);

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
        });
    }
}