<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;

class FetchCurrentController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        return $request->input(TotsAccount::class);
    }
}