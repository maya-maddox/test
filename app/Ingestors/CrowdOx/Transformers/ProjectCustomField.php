<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxProject;
use App\CrowdOxProjectCustomField;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class ProjectCustomField implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_project_custom_field
     * @return Model
     */
    public function transform(object $remote_project_custom_field): Model {
        $project = CrowdOxProject::where('crowd_ox_id', $remote_project_custom_field->relationships->project->data->id)->firstOrFail();
        $project_custom_field = CrowdOxProjectCustomField::updateOrCreate(["crowd_ox_id" => $remote_project_custom_field->id], [
            "crowd_ox_project_id" => $project->id,
            "name" => $remote_project_custom_field->attributes->name,
            "key" => $remote_project_custom_field->attributes->{'public-id'},
            "type" => $remote_project_custom_field->attributes->{'field-type'},
            "raw_data" => json_encode($remote_project_custom_field),
        ]);
        return $project_custom_field;
    }
}
