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
        $subscriptions = Subscription::paginate(10);

        return SubscriptionResource::collection($subscriptions);
    }

    public function store(SubscriptionStoreRequest $request)
    {
        $subscription = $request->storeSubscription();

        return response([
            'message' => 'Subscription created successfully',
            'subscription' => new SubscriptionResource($subscription),
        ]);
    }

    public function show(Subscription $subscription)
    {
        return response([
            'subscription' => new SubscriptionResource($subscription),
        ]);
    }

    public function update(SubscriptionUpdateRequest $request, Subscription $subscription)
    {
        $subscription = $request->updateSubscription();

        return response([
            'message' => 'Subscription updated successfully',
            'subscription' => new SubscriptionResource($subscription),
        ]);
    }

    public function destroy(Subscription $subscription)
    {
        if (! $subscription->delete()) {
            return response([
                'message' => 'Subscription could not be deleted as users are subscribed to it',
            ], 500);
        }

        return response([
            'message' => 'Subscription deleted successfully',
        ]);
    }
}
