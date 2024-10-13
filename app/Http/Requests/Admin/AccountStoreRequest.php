<?php

namespace App\Http\Requests\Admin;

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
        $accountPlatformsRule = function ($attribute, $value, $fail) {
            $isPrimary = $this->is_primary;
            if ($isPrimary && count($value) > 2) {
                $fail([__('accounts.errors.primary_account_max_platforms')]);
            } elseif (!$isPrimary && count($value) > 1) {
                $fail([__('accounts.errors.secondary_account_max_platforms')]);
            }
        };

        return [
            'psn_email' => 'required|string|email|max:255|min:2|unique:accounts,psn_email',
            'password' => 'required|string|min:8|max:255|regex:/[a-zA-Z]/|regex:/[0-9]/|confirmed',
            'platform' => ['required', 'array', 'min:1', $accountPlatformsRule,],
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
            ])->addMedia($this->image, 'accounts');
            $account->platforms()->attach($this->platform);

            return $account->refresh();
        });
    }

    public function attributes():array
    {
        return [
            'psn_email' => __('accounts.attributes.psn_email'),
            'password' => __('accounts.attributes.password'),
            'platform' => __('accounts.attributes.platforms'),
            'platform.*' => __('accounts.attributes.platform'),
            'image' => __('accounts.attributes.image'),
            'is_primary' => __('accounts.attributes.is_primary'),
        ];
    }
}
