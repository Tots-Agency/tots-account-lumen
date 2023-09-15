<?php

namespace Tots\Account\Http\Controllers;

use Tots\Account\Models\TotsAccount;
use Illuminate\Http\Request;
use Tots\Account\Wheres\SearchCreatorLikeWhere;
use Tots\EloFilter\Where\AbstractWhere;

class ListController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Create query
        $elofilter = \Tots\EloFilter\Query::run(TotsAccount::class, $request);
        // Custom filters
        $this->processWheresCreator($elofilter);
        // Custom Orders
        $this->processOrders($elofilter);
        // Execute query
        return $elofilter->execute();
    }

    protected function processOrders(\Tots\EloFilter\Query $elofilter)
    {
        $orders = $elofilter->getQueryRequest()->getOrders();

        $isAddUserJoin = false;
        for ($i=0; $i < count($orders); $i++) {
            $order = $orders[$i];
            if(is_array($order->field)){
                $orders[$i]->field = implode('.', $order->field);
                $isAddUserJoin = true;
            } else if($order->field == 'creator.firstname'){
                $isAddUserJoin = true;
            }
        }

        $elofilter->getQueryRequest()->setOrders($orders);

        if($isAddUserJoin){
            $elofilter->getQueryRequest()->addJoin('tots_account_permission', 'tots_account_permission.account_id', 'tots_account.id');
            $elofilter->getQueryRequest()->addJoin('tots_user AS creator', 'creator.id', 'tots_account_permission.user_id');
        }
    }

    protected function processWheresCreator(\Tots\EloFilter\Query $elofilter)
    {
        // Search where type likes and key include "search-custom"
        $wheres = $elofilter->getQueryRequest()->getWheres();
        
        foreach($wheres as $where){
            if($where->getType() == AbstractWhere::TYPE_LIKES && $where->getKeys()[0] == 'search-custom'){
                $value = $where->getValue();
                
                $elofilter->getQueryRequest()->removeWhere('search-custom');

                $elofilter->getQueryRequest()->addWhereFactored(new SearchCreatorLikeWhere(['value' => $value]));

                break;
            }
        }
    }
}