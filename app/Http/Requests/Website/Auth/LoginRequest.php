<?php

namespace App\Http\Requests\Website\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', function ($attribute, $value, $fail) {
                $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);
                $exists = $isEmail ? User::where('email', $value)->exists() : User::where('username', $value)->exists();
                if (!$exists) {
                    $fail(__('users.errors.invalid_credentials'));
                }
            }],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ];
    }

    public function loginUser()
    {
        $credentials = $this->only('email', 'password');

        if (!auth()->attempt($credentials, $this->input('remember', false))) {
            abort(401, __('users.errors.invalid_credentials'));
        }

        if (auth()->user()->is_blocked) {
            abort(401,  __('users.errors.blocked_account'));
        }

        return [
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('api_token')->plainTextToken,
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => __('users.attributes.email'),
            'password' => __('users.attributes.password'),
            'remember' => __('users.attributes.remember'),
        ];
    }
}
