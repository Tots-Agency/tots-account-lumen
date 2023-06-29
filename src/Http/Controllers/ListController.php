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
        // Execute query
        return $elofilter->execute();
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