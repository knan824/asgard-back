<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function updateSubscription()
    {
        $this->subscription->update($this->validated());
        $this->subscription->price->update(['price' => $this->price]);

        if ($this->exists('image')) {
            Storage::delete($this->subscription->image->path);
            $this->subscription->image()->delete();

            $path = $this->image->store('subscriptions');
            $this->subscription->image()->create([
                'path' => $path,
                'is_main' => true,
                'extension' => $this->image->extension(),
                'size' => $this->image->getSize(),
                'type' => 'photo',
            ]);
        }

        return $this->subscription->refresh();
    }
}
