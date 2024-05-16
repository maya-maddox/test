<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class Product implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_order_product
     * @return Model
     */
    public function transform(object $remote_order_product): Model {
        $project = CrowdOxProject::where('crowd_ox_id', $remote_order_product->relationships->project->data->id)->firstOrFail();
        $order_tag = $project->crowdOxProducts()->updateOrCreate(["crowd_ox_id" => $remote_order_product->id], [
            "type" => $remote_order_product->attributes->{'product-type'},
            "name" => $remote_order_product->attributes->name,
            "description" => $remote_order_product->attributes->description,
            "raw_data" => json_encode($remote_order_product),
        ]);
        return $order_tag;
    }
}
