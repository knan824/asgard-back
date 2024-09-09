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
            'remember' => ['boolean'],
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
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        if (auth()->user()->is_blocked) {
            return response()->json([
                'message' => 'Your Account is blocked. Please contact support.',
            ], 401);
        }

        $this->session()->regenerate();

        return [
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('api_token')->plainTextToken,
        ];
    }
}
