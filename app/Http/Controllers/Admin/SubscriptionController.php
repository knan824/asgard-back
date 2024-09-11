<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionStoreRequest;
use App\Http\Requests\Admin\SubscriptionUpdateRequest;
use App\Http\Resources\Admin\SubscriptionResource;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Subscription = Subscription::paginate(10);

        return SubscriptionResource::collection($Subscription);
    }

    public function store(SubscriptionStoreRequest $request)
    {
        $Subscription = $request->storeSubscription();

        return response([
            'message' => 'Subscription created successfully',
            'Subscription' => new SubscriptionResource($Subscription),
        ]);
    }

    public function show(Subscription $Subscription)
    {
        return response([
            'Subscription' => new SubscriptionResource($Subscription),
        ]);
    }

    public function update(SubscriptionUpdateRequest $request, Subscription $subscription)
    {
        $Subscription = $request->updateSubscription();

        return response([
            'message' => 'Subscription updated successfully',
            'subscription' => new SubscriptionResource($Subscription),
        ]);
    }

    public function destroy(Subscription $Subscription)
    {
        $Subscription->delete();

        return response([
            'message' => 'Subscription deleted successfully',
        ]);
    }
}
