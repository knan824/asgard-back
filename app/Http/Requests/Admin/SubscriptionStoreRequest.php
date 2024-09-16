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
            'price' => 'required|numeric|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function storeSubscription()
    {
        $subscription = Subscription::create($this->validated());
        $subscription->price()->create(['price' => $this->price]);
        foreach ($this->images as $image) {
            $path = $image->store('games');
            $subscription->images()->create([
                'path' => $path,
                'is_main' => $image['is_main'] ?? false,
                'extension' => $image->extension(),
                'size' => $image->getSize(),
                'type' => 'photo',
            ]);
        }

        return $subscription;

    }
}
