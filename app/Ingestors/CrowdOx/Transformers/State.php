<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxCountry;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class State implements CrowdOxTransformersContract {

    /**
     * Records the remote state to the database
     *
     * @param object $remote_state
     * @return Model
     */
    public function transform(object $remote_state): Model {
        $country = CrowdOxCountry::where('crowd_ox_id', $remote_state->relationships->country->data->id)->firstOrFail();
        $state = $country->crowdOxStates()->updateOrCreate(["crowd_ox_id" => $remote_state->id], [
            "name" => $remote_state->attributes->name,
            "raw_data" => json_encode($remote_state),
        ]);

        return $state;
    }
}
