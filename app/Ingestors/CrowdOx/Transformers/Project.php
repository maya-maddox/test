<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxCountry;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class Project implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_project
     * @return Model
     */
    public function transform(object $remote_project): Model {
        $country = CrowdOxCountry::where('crowd_ox_id', $remote_project->relationships->country->data->id)->firstOrFail();
        $project = CrowdOxProject::updateOrCreate(["crowd_ox_id" => $remote_project->id], [
            "name" => $remote_project->attributes->name,
            "identifier" => $remote_project->attributes->identifier,
            "currency" => $remote_project->attributes->currency,
            "crowd_ox_country_id" => $country->id,
            "raw_data" => json_encode($remote_project),
        ]);
        return $project;
    }
}
