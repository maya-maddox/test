<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxOrder;
use App\CrowdOxOrderLine;
use App\CrowdOxOrderTransaction;
use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class OrderTransaction implements CrowdOxTransformersContract {

    /**
     * Records the remote order selection to the database
     *
     * @param object $remote_order_transaction
     * @return Model
     */
    public function transform(object $remote_order_transaction): Model {
        //get relationships
        $project = CrowdOxProject::where('crowd_ox_id', $remote_order_transaction->relationships->project->data->id)->firstOrFail();
        $order = CrowdOxOrder::where('crowd_ox_id', $remote_order_transaction->relationships->order->data->id)->firstOrFail();

        //record
        $order_transaction = CrowdOxOrderTransaction::updateIfChangedOrCreate(["crowd_ox_id" => $remote_order_transaction->id], [
            'crowd_ox_project_id' => $project->id,
            'crowd_ox_order_id' => $order->id,
            'amount_cents' => $remote_order_transaction->attributes->{'amount-cents'},
            'shipping_amount_cents' => $remote_order_transaction->attributes->{'shipping-amount-cents'},
            'currency' => $remote_order_transaction->attributes->currency,
            'confirmed' => $remote_order_transaction->attributes->confirmed,
            'paid_at' => $remote_order_transaction->attributes->{'external-created-at'} ?: $remote_order_transaction->attributes->{'created-at'},
        ], [
            "raw_data" => json_encode($remote_order_transaction),
        ]);


        return $order_transaction;
    }
}
