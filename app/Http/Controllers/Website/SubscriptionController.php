<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SubscriptionResource;
use App\Models\Subscription;


class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::paginate(10);

        return SubscriptionResource::collection($subscriptions);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return response([
            'Subscription' => new SubscriptionResource($subscription),
        ]);
    }


}
