<?php

namespace Tots\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateBulkController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Get all params
        $items = $request->input('tots_accounts');
        // Init Transactions
        DB::beginTransaction();
        // Data
        $data = [];
        try {
            // Each item
            foreach($items as $item){
                $controller = new UpdateController();
                $data[] = $controller->handle($item->id, new Request($item));
            }
            // Commit transactions
            DB::commit();
        } catch (\Throwable $th) {
            // Cancel transaction
            DB::rollBack();
            // Return error
            throw $th;
        }        

        return ['tots_accounts' => $data];
    }
}