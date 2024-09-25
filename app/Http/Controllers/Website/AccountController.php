<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\Website\AccountResource;
use App\Models\Account;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = Account::blocked(false)->paginate();

        return AccountResource::collection($account);
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
