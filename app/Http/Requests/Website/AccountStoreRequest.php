<?php

namespace App\Http\Requests\Website;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class AccountStoreRequest extends FormRequest
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
            $isPrimary = $this->is_primary;
            if ($isPrimary && count($value) > 2) {
                $fail('A primary account can have a maximum of two platforms.');
            } elseif (!$isPrimary && count($value) > 1) {
                $fail('A secondary account can have a maximum of one platform.');
            }
        };

        return [
            'psn_email' => 'required|string|email|max:255|min:2|unique:accounts,psn_email',
            'password' => 'required|string|min:8|max:255|regex:/[a-zA-Z]/|regex:/[0-9]/|confirmed',
            'platform' => ['required', 'array', 'min:1', $accountPlatformRule,],
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_primary' => 'required|boolean',
        ];
    }

    public function storeAccount()
    {
        return DB::transaction(function () {
            $account = Account::create([
                'user_id' => auth()->id(),
                'psn_email' => $this->psn_email,
                'password' => $this->password,
                'is_primary' => $this->is_primary,
            ]);
            $account->platforms()->attach($this->platform);

            $path = $this->image->store('accounts');
            $account->image()->create([
                'path' => $path,
                'is_main' => true,
                'extension' => $this->image->extension(),
                'size' => $this->image->getSize(),
                'type' => 'photo',
            ]);

            return $account->refresh();
        });
    }
}
