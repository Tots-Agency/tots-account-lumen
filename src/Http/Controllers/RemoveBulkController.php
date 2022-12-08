<?php

namespace Tots\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemoveBulkController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Get all params
        $dataItems = $request->input('ids');
        $items = explode(',', $dataItems);
        // Init Transactions
        DB::beginTransaction();
        // Data
        $data = [];
        try {
            // Each item
            foreach($items as $itemId){
                $controller = new RemoveByIdController();
                $controller->handle($itemId);
                $data[] = $itemId;
            }
            // Commit transactions
            DB::commit();
        } catch (\Throwable $th) {
            // Cancel transaction
            DB::rollBack();
            // Return error
            throw $th;
        }        

        return ['deletes' => $data];
    }
}