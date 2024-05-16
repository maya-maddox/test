<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxCountry;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class Country implements CrowdOxTransformersContract {

    /**
     * Records the remote country to the database
     *
     * @param object $remote_country
     * @return Model
     */
    public function transform(object $remote_country): Model {
        $country = CrowdOxCountry::updateOrCreate(["crowd_ox_id" => $remote_country->id], [
            "name" => $remote_country->attributes->name,
            "iso2" => $remote_country->attributes->iso2,
            "raw_data" => json_encode($remote_country),
        ]);

        return $country;
    }
}
