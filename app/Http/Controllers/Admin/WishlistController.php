<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\WishlistFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\WishlistResource;
use App\Models\User;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WishlistFilter $filter)
    {
        $wishlists = Wishlist::with(['game'])->filter($filter)->paginate();

        return WishlistResource::collection($wishlists);
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
