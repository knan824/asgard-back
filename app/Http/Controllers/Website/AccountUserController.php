<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\AccountStoreRequest;
use App\Http\Requests\Website\AccountUpdateRequest;
use App\Http\Resources\Website\AccountUserResource;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = auth()->user()->accounts()->with(['games', 'platforms', 'image'])->paginate();

        return AccountUserResource::collection($accounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $account = $request->storeAccount();

        return response([
            'message' => 'Account created successfully',
            'account' => new AccountUserResource($account),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Account $account)
    {
        if ($account->user_id !== auth()->id() && $account->user_id !== $user->id) throw new NotFoundHttpException;
        if ($account->is_blocked) throw new NotFoundHttpException;

        return response([
            'account' => new AccountUserResource($account),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountUpdateRequest $request, User $user, Account $account)
    {
        if ($account->user_id !== auth()->id() && $account->user_id !== $user->id) throw new NotFoundHttpException;
        if ($account->is_sold) throw new HttpResponseException(response (["Can't update your account when it is rented"],403));
        if ($account->is_blocked) throw new NotFoundHttpException;

        $account = $request->updateAccount();

        return response([
            'message' => 'Account updated successfully',
            'account' => new AccountUserResource($account),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Account $account)
    {
        if ($account->user_id !== auth()->id() && $account->user_id !== $user->id) throw new NotFoundHttpException;

        $account->remove();

        return response([
            'message' => 'Account deleted successfully',
        ]);
    }
}
