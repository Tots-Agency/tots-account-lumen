<?php

namespace Tots\Account\Http\Controllers\Permission;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccountPermission;

class ListByAccountController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        /** @var \Tots\Account\Models\TotsAccount $account */
        $account = $request->input(TotsAccount::class);
        // Create query
        $elofilter = \Tots\EloFilter\Query::run(TotsAccountPermission::class, $request);
        // Custom filters
        $elofilter->getQueryRequest()->addWhere('account_id', $account->id);
        // Execute query
        return $elofilter->execute();
    }
}