<?php

namespace Tots\Account\Http\Middleware;

use Closure;
use Tots\Account\Models\TotsAccount;

class AccountMiddleware
{
    /**
     * Obtiene la cuenta
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $accountId = $request->input('account_id') ?? $request->route('account_id') ?? $request->input('id') ?? $request->route('id');
        if($accountId <= 0){
            throw new \Exception('The account id is required');
        }

        $account = TotsAccount::where('id', $accountId)->first();
        if($account === null){
            throw new \Exception('The account not exist');
        }

        return $next($request->merge([TotsAccount::class => $account]));
    }
}
