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
            'images' => 'nullable|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function updateSubscription()
    {
        $this->subscription->update($this->validated());
        $this->subscription->price->update(['price' => $this->price]);

        if ($this->hasFile('images')) {
            foreach ($this->file('images') as $imageFile) {
                $path = $imageFile->store('games'); //keeps current images
                $this->game->images()->create([
                    'path' => $path,
                    'is_main' => $this->input('is_main', false),
                    'extension' => $imageFile->extension(),
                    'size' => $imageFile->getSize(),
                    'type' => 'photo',
                ]);
            }
        }

        return $this->subscription->refresh();
    }
}
