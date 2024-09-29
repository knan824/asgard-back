<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\WishlistResource;
use App\Models\User;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $wishlist = $user->wishlists()
            ->with(['games'])
            ->paginate();

        return WishlistResource::collection($wishlist);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Wishlist $wishlist)
    {
        return response([
            'wishlist' => new WishlistResource($wishlist),
        ]);
    }
}
