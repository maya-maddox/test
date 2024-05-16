<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxCountry;
use App\CrowdOxCustomer;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class Customer implements CrowdOxTransformersContract {

    /**
     * Records the remote customer to the database
     *
     * @param object $remote_customer
     * @return Model
     */
    public function transform(object $remote_customer): Model {
        $customer = CrowdOxCustomer::updateIfChangedOrCreate(["crowd_ox_id" => $remote_customer->id],[
            "name" => $remote_customer->attributes->{'full-name'},
            "email" => $remote_customer->attributes->email], [
            "raw_data" => json_encode($remote_customer)
        ]);

        //try to link to project
        if (array_key_exists("project", $remote_customer->relationships)) {
            $project = CrowdOxProject::where('crowd_ox_id', $remote_customer->relationships->project->data->id)->first();
            if ($project) {
                $project->crowdOxCustomers()->attach($customer->id);
            }
        }
        return $customer;
    }
}
