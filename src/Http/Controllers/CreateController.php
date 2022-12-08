<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;

class CreateController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Process validations
        $this->validate($request, [
            'title' => 'required|min:3',
            'caption' => 'required|min:3',
        ]);
        // Create new model
        $item = new TotsAccount();
        $item->title = $request->input('title');
        $item->caption = $request->input('caption');
        $item->status = $request->input('status');
                
        // Save new model
        $item->save();
        // Return data
        return $item;
    }
}