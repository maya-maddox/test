<?php

namespace App\Support\CrowdOx\OrderCleaner;

use App\CrowdOxOrder;
use App\CrowdOxOrderAddress;
use App\CrowdOxOrderLine;
use App\CrowdOxOrderSelection;
use App\CrowdOxOrderTransaction;
use Illuminate\Support\Facades\Log;

class CrowdOxOrderCleaner {

    protected $order;

    protected $relationsToClean = [
        //ordered from lowest in database to highest (to prevent foreign key conflicts on delete)
        CrowdOxOrderSelection::class => "selections",
        CrowdOxOrderLine::class => "lines",
        CrowdOxOrderTransaction::class => "transactions",
        CrowdOxOrderAddress::class => "shipping-address"
    ];

    public function order(CrowdOxOrder $order): CrowdOxOrderCleaner {
        $this->order = $order;
        return $this;
    }

    public function clean() {
        foreach ($this->relationsToClean as $relationModel => $relationCrowdOxName) {
            $this->cleanRelationship($relationModel, $relationCrowdOxName);
        }
    }

    protected function cleanRelationship($relationModel, $relationCrowdOxName) {
        //get local relationships
        $potentialRelationshipCrowdOxIds = $relationModel::where('crowd_ox_order_id', $this->order->id)->select('crowd_ox_id')->get()->pluck('crowd_ox_id')->toArray();

        //get 'remote' (truth) (from crowdoxorder raw data)
        $data = json_decode($this->order->raw_data);
        try {
            $relevantRelations = $data->relationships->$relationCrowdOxName->data;
            if (!is_array($relevantRelations)) {
                $relevantRelations = [$relevantRelations];
            }
            $relevantRelations = array_filter($relevantRelations, function ($relation) {
                return $relation !== null;
            });
            $relevantRelationsCrowdOxIds = array_map(function ($relation) {
                return $relation->id;
            }, $relevantRelations);

            //compare
            $localNotRemote = array_diff($potentialRelationshipCrowdOxIds, $relevantRelationsCrowdOxIds);

            //delete those present locally not remotely.
            if (count($localNotRemote) > 0) {
                $relationModel::whereIn('crowd_ox_id', $localNotRemote)->delete();
            }
        } catch (\Exception $exception){
            logger(print_r(['data'=>$data, 'error' =>$exception->getMessage()], true));
        }

    }
}
