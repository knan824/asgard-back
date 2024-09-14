<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PriceStoreRequest;
use App\Http\Requests\Admin\PriceUpdateRequest;
use App\Http\Resources\Admin\PriceResource;
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
     * Store a newly created resource in storage.
     */
    public function store(PriceStoreRequest $request)
    {
        $price = $request->storePrice();

      return response([
          'message' => 'Price created successfully',
          'price' => new PriceResource($price),
      ]);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceUpdateRequest $request, price $price)
    {
        $price = $request->updatePrice();

        return response([
            'message' => 'Price updated successfully',
            'price' => new PriceResource($price),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        $price->delete();

        return response([
            'message' => 'Price deleted successfully',
        ]);
    }
}
