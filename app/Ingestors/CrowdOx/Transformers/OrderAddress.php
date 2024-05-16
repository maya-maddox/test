<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxCountry;
use App\CrowdOxOrder;
use App\CrowdOxOrderAddress;
use App\CrowdOxProject;
use App\CrowdOxState;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class OrderAddress implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_order_address
     * @return Model|null
     */
    public function transform(object $remote_order_address): ?Model {
        if ($remote_order_address->attributes->name === null && $remote_order_address->attributes->{'address-1'} === null) {
            return null; //No name nor address 1, probably no real address so ignore.
        }
        //get relationships
        $project = CrowdOxProject::where('crowd_ox_id', $remote_order_address->relationships->project->data->id)->firstOrFail();
        $order = CrowdOxOrder::where('crowd_ox_id', $remote_order_address->relationships->order->data->id)->firstOrFail();
        $country = CrowdOxCountry::where('crowd_ox_id', $remote_order_address->relationships->country->data->id)->firstOrFail();
        $state = null;
        if ($remote_order_address->relationships->state->data != null) {
            $state = CrowdOxState::where('crowd_ox_id', $remote_order_address->relationships->state->data->id)->first();
        }
        //record
        $order_address = CrowdOxOrderAddress::updateIfChangedOrCreate(["crowd_ox_id" => $remote_order_address->id], [
            "name" => $remote_order_address->attributes->name,
            "address_1" => $remote_order_address->attributes->{'address-1'},
            "address_2" => $remote_order_address->attributes->{'address-2'},
            "city" => $remote_order_address->attributes->city,
            "state" => $remote_order_address->attributes->{'state-text'},
            "postal_code" => $remote_order_address->attributes->{'postal-code'},
            "phone_number" => $remote_order_address->attributes->{'phone-number'},
            "crowd_ox_project_id" => $project->id,
            "crowd_ox_order_id" => $order->id,
            "crowd_ox_country_id" => $country->id,
            "crowd_ox_state_id" => optional($state)->id] ,[
            "raw_data" => json_encode($remote_order_address)
        ]);
        return $order_address;
    }
}
