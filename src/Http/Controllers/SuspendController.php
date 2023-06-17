<?php

namespace Tots\Account\Http\Controllers;

use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccount;

class SuspendController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id)
    {
        // Search user exist
        $user = TotsAccount::where('id', $id)->first();
        if($user === null){
            throw new \Exception('This user not exist');
        }
        // Save new status
        $user->status = TotsAccount::STATUS_DELETED;
        $user->save();

        return ['success' => true];
    }
}
