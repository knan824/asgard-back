<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255|min:2|unique:subscriptions,name,' . $this->subscription->id,
            'price' => 'sometimes|numeric|min:0',
        ];
    }

    public function updateSubscription()
    {
        $this->subscription->update($this->validated());
        $this->subscription->price->update(['price' => $this->price]);

        return $this->subscription->refresh();
    }
}
