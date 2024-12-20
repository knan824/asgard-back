<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\SubscriptionFilter;
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
    public function index(SubscriptionFilter $filter)
    {
        $subscriptions = Subscription::with(['price', 'image'])->filter($filter)->paginate();

        return SubscriptionResource::collection($subscriptions);
    }

    public function store(SubscriptionStoreRequest $request)
    {
        $subscription = $request->storeSubscription();

        return response([
            'message' => __('subscriptions.store'),
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
            'message' => __('subscriptions.update'),
            'subscription' => new SubscriptionResource($subscription),
        ]);
    }

    public function destroy(Subscription $subscription)
    {
        if (! $subscription->delete()) {
            return response([
                'message' => __('subscriptions.errors.destroy_failed'),
            ], 500);
        }

        return response([
            'message' => __('subscriptions.destroy'),
        ]);
    }
}
