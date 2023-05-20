<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccountPermission;

class CreateController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Process validations
        $this->validate($request, [
            'title' => 'required|min:3',
        ]);
        // Create new model
        $item = new TotsAccount();
        $item->title = $request->input('title');
        $item->caption = $request->input('caption');
        $item->status = TotsAccount::STATUS_ACTIVE;
        // Save new model
        $item->save();
        // Create permission
        $perm = new TotsAccountPermission();
        $perm->account_id = $item->id;
        $perm->user_id = $request->user()->id;
        $perm->role = TotsAccountPermission::ROLE_ADMIN;
        $perm->save();
        // Return data
        return $item;
    }
}