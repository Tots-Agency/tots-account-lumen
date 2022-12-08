<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;

class RemoveByIdController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id)
    {
        $item = TotsAccount::where('id', $id)->first();
        if($item === null) {
            throw new \Exception('Item not exist');
        }
        $item->delete();
        return ['deletes' => $id];
    }
}