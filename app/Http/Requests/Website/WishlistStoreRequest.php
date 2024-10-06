<?php

namespace App\Http\Requests\Website;

use App\Models\Wishlist;
use Illuminate\Foundation\Http\FormRequest;

class WishlistStoreRequest extends FormRequest
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
            'game_id' => ['required', 'exists:games,id'],
        ];
    }

    public function storeWishlist()
    {
        if (auth()->user()->wishlists()->where('game_id', $this->game_id)->exists()) {
            return response([
                'message' => __('wishlists.errors.item_already_in_wishlist'),
            ], 400);
        }

        return Wishlist::create([
            'game_id' => $this->game_id,
            'user_id' => auth()->user()->id,
        ]);
    }
}
