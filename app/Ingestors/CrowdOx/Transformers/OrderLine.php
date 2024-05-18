<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxOrder;
use App\CrowdOxOrderLine;
use App\CrowdOxProduct;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class OrderLine implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_order_line
     * @return Model
     */
    public function transform(object $remote_order_line): Model {
        // Get pricing data
        $prices_array = $remote_order_line->attributes->{'price-data'}->prices;
        $product_price_cents = null;
        $shipping_price_cents = null;

        if ($prices_array) {
            foreach ($prices_array as $price) {
                if ($price->type === 'product') {
                    $product_price_cents = $price->amount_cents;
                }

                if ($price->type === 'shipping') {
                    $shipping_price_cents = $price->amount_cents;
                }
            }
        }

        $total_price_cents = $remote_order_line->attributes->{'price-cents'} ?? null;

        //get relationships
        $project = CrowdOxProject::where('crowd_ox_id', $remote_order_line->relationships->project->data->id)->firstOrFail();
        $order = CrowdOxOrder::where('crowd_ox_id', $remote_order_line->relationships->order->data->id)->firstOrFail();
        $product_bundle_remote =  $remote_order_line->relationships->{'product-bundle'}->data;
        if ($product_bundle_remote) {
            $product = CrowdOxProduct::where('crowd_ox_id',$product_bundle_remote->id)->first();
        }

        //record
        $order_line = CrowdOxOrderLine::updateIfChangedOrCreate(["crowd_ox_id" => $remote_order_line->id], [
            "type" => $remote_order_line->attributes->{'line-type'},
            "product_price_cents" => $product_price_cents,
            "shipping_price_cents" => $shipping_price_cents,
            "total_price_cents" => $total_price_cents,
            "crowd_ox_project_id" => $project->id,
            "crowd_ox_product_id" => $product_bundle_remote ? $product->id : null,
            "crowd_ox_order_id" => $order->id ], [
            "raw_data" => json_encode($remote_order_line)
        ]);
        return $order_line;
    }
}
