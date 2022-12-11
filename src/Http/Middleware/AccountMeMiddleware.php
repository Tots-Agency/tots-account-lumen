<?php

namespace Tots\Account\Http\Middleware;

use Closure;
use Tots\Account\Models\TotsAccount;
use Tots\Account\Models\TotsAccountPermission;

class AccountMeMiddleware
{
    /**
     * Obtiene la cuenta del middleware anterior y verifica si el usuario tiene permisos para esa cuenta.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var \Tots\Account\Models\TotsAccount $account */
        $account = $request->input(TotsAccount::class);

        // Verify if has permission in account
        $permission = TotsAccountPermission::where('account_id', $account->id)->where('user_id', $request->user()->id)->first();
        if($permission === null){
            throw new \Exception('Not has permission');
        }

        return $next($request->merge([TotsAccountPermission::class => $permission]));
    }
}
