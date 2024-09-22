<?php

namespace App\Http\Requests\Admin;


use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'psn_email' => 'required|string|email|max:255|min:2|unique:accounts,email',
            'password' => 'required|string|min:8|max:255|regex:/[a-zA-Z]/|regex:/[0-9]/|confirmed',
            'platform' => 'required|array|min:1',
            'platform.*' => 'integer|exists:platforms,id|required_with:platform',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function storeAccount()
    {
        $account = Account::create($this->validated());
        $account->platforms()->attach($this->platform);
        $account->price()->create(['price' => $this->price]);

        $path = $this->image->store('accounts');
        $account->image()->create([
            'path' => $path,
            'is_main' => true,
            'extension' => $this->image->extension(),
            'size' => $this->image->getSize(),
            'type' => 'photo',
        ]);

        return $account;
    }
}
