<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\AccountStoreRequest;
use App\Http\Requests\Website\AccountUpdateRequest;
use App\Http\Resources\Website\AccountResource;
use App\Models\Account;

class AccountUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = Account::with(['games','platforms','images'])->auth()->user()->accounts()->paginate();

        return AccountResource::collection($account);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $account = $request->storeAccount();

        return response([
            'message' => 'account created successfully',
            'account' => new AccountResource($account),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        if ($account->user_id !== auth()->id()) {
            return response(['error' => 'Unauthorized'], 403);
        }

        return response([
            'account' => new AccountResource($account),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountUpdateRequest $request, Account $account)
    {
        if ($account->user_id !== auth()->id()) {
            return response(['error' => 'Unauthorized'], 403);
        }

        $account = $request->updateAccount();

        return response([
            'message' => 'account updated successfully',
            'account' => new AccountResource($account),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->remove();

        return response([
            'message' => 'Account deleted successfully',
        ]);
    }
}
