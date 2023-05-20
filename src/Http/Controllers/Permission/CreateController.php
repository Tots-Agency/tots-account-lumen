<?php

namespace Tots\Account\Http\Controllers\Permission;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccountPermission;

class CreateController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Get Account
        /** @var \Tots\Account\Models\TotsAccount $account */
        $account = $request->input(TotsAccount::class);
        // Verify if exist permission
        $perm = TotsAccountPermission::where('account_id', $account->id)
            ->where('user_id', $request->input('user_id'))
            ->first();

        if($perm !== null) {
            throw new \Exception('Permission already exist');
        }

        // Create permission
        $perm = new TotsAccountPermission();
        $perm->account_id = $account->id;
        $perm->user_id = $request->input('user_id');
        $perm->role = TotsAccountPermission::ROLE_ADMIN;
        $perm->save();

        // Return data
        return $perm;
    }
}