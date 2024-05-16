<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class OrderTag implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_order_tag
     * @return Model
     */
    public function transform(object $remote_order_tag): Model {
        $project = CrowdOxProject::where('crowd_ox_id', $remote_order_tag->relationships->project->data->id)->firstOrFail();
        $order_tag = $project->crowdOxOrderTags()->updateOrCreate(["crowd_ox_id" => $remote_order_tag->id], [
            "name" => $remote_order_tag->attributes->name,
            "raw_data" => json_encode($remote_order_tag),
        ]);
        return $order_tag;
    }
}
