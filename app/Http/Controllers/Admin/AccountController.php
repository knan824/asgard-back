<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountStoreRequest;
use App\Http\Requests\Admin\AccountUpdateRequest;
use App\Http\Resources\Admin\AccountResource;
use App\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::paginate();

        return response(AccountResource::collection($accounts));
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
        return response([
            'account' => new AccountResource($account),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountUpdateRequest $request, Account $account)
    {
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
