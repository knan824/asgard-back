<?php

namespace App\Http\Controllers\Website;

use App\Filters\Website\AccountFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Website\AccountResource;
use App\Http\Resources\Website\AccountSimpleResource;
use App\Models\Account;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AccountFilter $filter)
    {
        $accounts = Account::with(['user', 'games', 'platforms'])->blocked(false)->sold(false)->hasValidUser()
            ->filter($filter)->paginate();

        return AccountSimpleResource::collection($accounts);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        if ($account->is_blocked) throw new NotFoundHttpException;

        return response([
            'account' => new AccountResource($account),
        ]);
    }
}
