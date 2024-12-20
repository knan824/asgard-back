<?php

namespace App\Http\Controllers\Website;

use App\Filters\Website\AccountUserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\AccountStoreRequest;
use App\Http\Requests\Website\AccountUpdateRequest;
use App\Http\Resources\Website\AccountUserResource;
use App\Models\Account;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AccountUserFilter $filter)
    {
        $accounts = auth()->user()->accounts()->with(['image', 'games', 'platforms'])->filter($filter)->paginate();

        return AccountUserResource::collection($accounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $account = $request->storeAccount();

        return response([
            'message' => __('accounts.store'),
            'account' => new AccountUserResource($account),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Account $account)
    {
        if (! $account->belongsToLoggedUser($user)) throw new NotFoundHttpException;

        return response([
            'account' => new AccountUserResource($account),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountUpdateRequest $request, User $user, Account $account)
    {
        if (! $account->belongsToLoggedUser($user)) throw new NotFoundHttpException;

        if ($account->is_sold) return response(['message' => "Can't update your account when it is rented"], 403);

        $account = $request->updateAccount();

        return response([
            'message' =>  __('accounts.update'),
            'account' => new AccountUserResource($account),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Account $account)
    {
        if (! $account->belongsToLoggedUser($user)) throw new NotFoundHttpException;

        $account->remove();

        return response([
            'message' =>  __('accounts.destroy'),
        ]);
    }
}
