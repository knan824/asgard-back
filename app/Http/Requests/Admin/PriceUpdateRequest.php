<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PriceUpdateRequest extends FormRequest
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
            'price' => 'sometimes|integer|min:0',
            'priceable_id' => 'sometimes|integer|exists:subscriptions,id',
            'priceable_type' => 'sometimes|string|in:App\Models\Subscription',
        ];
    }

    public function updatePrice()
    {
        $this->price->update($this->validated());

        return $this->price->refresh();
    }
}
