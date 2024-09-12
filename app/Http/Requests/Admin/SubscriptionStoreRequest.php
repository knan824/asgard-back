<?php

namespace App\Http\Requests\Admin;
use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:2|unique:subscriptions,name',
        ];
    }

    public function storeSubscription()
    {
        return Subscription::create($this->validated());
    }
}
