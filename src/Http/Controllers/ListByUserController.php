<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;

class ListByUserController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Create query
        $elofilter = \Tots\EloFilter\Query::run(TotsAccount::class, $request);
        // Custom filters
        $elofilter->getQueryRequest()->addJoin('tots_account_permission', 'tots_account_permission.account_id', 'tots_account.id');
        $elofilter->getQueryRequest()->addWhere('tots_account_permission.user_id', $request->user()->id);
        // Execute query
        return $elofilter->execute();
    }
}