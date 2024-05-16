<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class ProductVariation implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_order_product
     * @return Model
     */
    public function transform(object $remote_order_product): Model {
        $project = CrowdOxProject::where('crowd_ox_id', $remote_order_product->relationships->project->data->id)->firstOrFail();
        $product = CrowdOxProduct::where('crowd_ox_id', $remote_order_product->relationships->product->data->id)->firstOrFail();

        $order_tag = CrowdOxProductVariation::updateOrCreate(["crowd_ox_id" => $remote_order_product->id], [
            "SKU" => $remote_order_product->attributes->sku,
            "crowd_ox_project_id" => $project->id,
            "crowd_ox_product_id" => $product->id,
            "raw_data" => json_encode($remote_order_product),
        ]);
        return $order_tag;
    }
}
