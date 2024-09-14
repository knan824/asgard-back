<?php

namespace App\Http\Requests\Admin;


use App\Models\Price;
use Illuminate\Foundation\Http\FormRequest;

class PriceStoreRequest extends FormRequest
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
            'price' => 'required|integer|min:0',
            'priceable_id' => 'required|integer|exists:subscriptions,id',
            'priceable_type' => 'required|string|in:App\Models\Subscription',
        ];
    }

    public function storePrice()
    {
        return Price::create($this->validated());
    }
}
