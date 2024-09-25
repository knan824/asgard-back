<?php

namespace App\Http\Controllers\Website;

use App\Filters\Website\WishlistFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\WishlistStoreRequest;
use App\Http\Resources\Website\WishlistResource;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WishlistFilter $filter)
    {
        $wishlists = auth()->user()->wishlists()->filter($filter)->paginate();

        return WishlistResource::collection($wishlists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WishlistStoreRequest $request)
    {
        $wishlist = $request->storeWishlist();

        return response([
            'wishlist' => new WishlistResource($wishlist),
            'message' => 'Wishlist item added successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->remove();

        return response([
            'message' => 'Wishlist item removed successfully',
        ]);
    }
}
