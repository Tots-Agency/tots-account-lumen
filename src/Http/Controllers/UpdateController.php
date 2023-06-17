<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;

class UpdateController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id, Request $request)
    {
        $item = TotsAccount::where('id', $id)->first();
        if($item === null) {
            throw new \Exception('Item not exist');
        }
        // Process validations
        $this->validate($request, [
            'title' => 'required|min:3'
        ]);
        // Update values
        $item->title = $request->input('title');
        $item->caption = $request->input('caption');
        $item->status = $request->input('status');
                
        // Save new model
        $item->save();
        // Return data
        return $item;
    }
}