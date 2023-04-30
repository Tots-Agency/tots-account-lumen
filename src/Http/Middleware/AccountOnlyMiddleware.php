<?php

namespace Tots\Account\Http\Middleware;

use Closure;
use Tots\Account\Models\TotsAccount;
use Tots\Account\Models\TotsAccountPermission;

class AccountOnlyMiddleware
{
    /**
     * Obtiene la cuenta a traves del UserId, esto se puede utilizar cuando por usuario solo puede tener una cuenta.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Verify if has permission in account
        $permission = TotsAccountPermission::where('user_id', $request->user()->id)->first();
        if($permission === null){
            throw new \Exception('Not has permission');
        }

        return $next($request->merge([TotsAccount::class => $permission->account]));
    }
}
