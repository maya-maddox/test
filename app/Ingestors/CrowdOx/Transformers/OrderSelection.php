<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxOrder;
use App\CrowdOxOrderLine;
use App\CrowdOxOrderSelection;
use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class OrderSelection implements CrowdOxTransformersContract {

    /**
     * Records the remote order selection to the database
     *
     * @param object $remote_order_selection
     * @return Model
     */
    public function transform(object $remote_order_selection): Model {
        //get relationships
        $project = CrowdOxProject::where('crowd_ox_id', $remote_order_selection->relationships->project->data->id)->firstOrFail();
        $product = CrowdOxProduct::where('crowd_ox_id', $remote_order_selection->relationships->product->data->id)->firstOrFail();
        $order = CrowdOxOrder::where('crowd_ox_id', $remote_order_selection->relationships->order->data->id)->firstOrFail();
        $order_line = CrowdOxOrderLine::where('crowd_ox_id', $remote_order_selection->relationships->line->data->id)->firstOrFail();
        //optional
        $product_variation = $remote_order_selection->relationships->{'product-variation'}->data;
        if ($product_variation) {
            $product_variation = CrowdOxProductVariation::where('crowd_ox_id', $product_variation->id)->first();
        }

        //record
        $order_selection = CrowdOxOrderSelection::updateIfChangedOrCreate(["crowd_ox_id" => $remote_order_selection->id], [
            "quantity" => $remote_order_selection->attributes->quantity,
            "crowd_ox_project_id" => $project->id,
            "crowd_ox_product_id" => $product->id,
            "crowd_ox_product_variation_id" => optional($product_variation)->id,
            "crowd_ox_order_line_id" => $order_line->id,
            "crowd_ox_order_id" => $order->id], [
            "raw_data" => json_encode($remote_order_selection),
        ]);


        return $order_selection;
    }
}
