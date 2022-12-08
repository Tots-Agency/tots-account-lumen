<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;

class ListController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Create query
        $elofilter = \Tots\EloFilter\Query::run(TotsAccount::class, $request);
        // Custom filters
        //$elofilter->getQueryRequest()->addWhere('id', 2);
        // Execute query
        return $elofilter->execute();
    }
}