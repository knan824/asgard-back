<?php

namespace App\Http\Requests\Admin;

use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function storeSubscription()
    {
        return DB::transaction(function () {
            $subscription = Subscription::create([
                ...$this->validated(),
                'slug' => $this->name,
            ]);
            $subscription->price()->create(['price' => $this->price]);

            $path = $this->image->store('subscriptions');
            $subscription->image()->create([
                'path' => $path,
                'is_main' => true,
                'extension' => $this->image->extension(),
                'size' => $this->image->getSize(),
                'type' => 'photo',
            ]);

            return $subscription;
       });
    }

    public function attributes():array
    {
        return [
            'name' => __('subscriptions.attributes.name'),
            'price' => __('subscriptions.attributes.price'),
            'image' => __('subscriptions.attributes.image'),
        ];
    }
}
