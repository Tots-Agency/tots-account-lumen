<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;

class FetchByIdController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id, Request $request)
    {
        $item = TotsAccount::where('id', $id)->first();
        if($item === null) {
            throw new \Exception('Item not exist');
        }
        return $item;
    }
}