<?php

namespace App\Http\Controllers\Website;

use App\Filters\Website\SubscriptionFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\SubscriptionResource;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubscriptionFilter $filter)
    {
        $subscriptions = Subscription::with(['price', 'image'])->filter($filter)->paginate();

        return SubscriptionResource::collection($subscriptions);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return response([
            'subscription' => new SubscriptionResource($subscription),
        ]);
    }
}
