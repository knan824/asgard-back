<?php

namespace App\Http\Requests\Website\Auth;

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
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'Invalid credentials',
        ];
    }

    public function loginUser()
    {
        $credentials = $this->only('email', 'password');

        if (!auth()->attempt($credentials, $this->input('remember', false))) {
            abort(401, 'Invalid credentials');
        }

        if (auth()->user()->is_blocked) {
            abort(401, 'Your Account is blocked. Please contact support.');
        }

        auth()->user()->update([
            'last_login_at' => now(),
        ]);

        return [
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('api_token')->accessToken,
        ];
    }
}
