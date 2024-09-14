<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\PriceResource;
use App\Models\Price;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::paginate(10);

        return PriceResource::collection($prices);
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        return response([
            'price' => new PriceResource($price)
        ]);
    }
}
