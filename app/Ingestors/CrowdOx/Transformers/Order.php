<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxCustomer;
use App\CrowdOxOrder;
use App\CrowdOxOrderTag;
use App\CrowdOxProject;
use App\CrowdOxProjectCustomField;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersContract;
use Illuminate\Database\Eloquent\Model;

class Order implements CrowdOxTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param object $remote_order
     * @return Model
     */
    public function transform(object $remote_order): Model {

        $project = CrowdOxProject::where('crowd_ox_id', $remote_order->relationships->project->data->id)->firstOrFail();

        //Replaced for data security
        $customer = CrowdOxCustomer::where('crowd_ox_id', $remote_order->relationships->customer->data->id)->first();
        if (!$customer) {
            $customer = CrowdOxCustomer::factory()->create([
                "crowd_ox_id" => $remote_order->relationships->customer->data->id
            ]);
        }

        // $customer = CrowdOxCustomer::where('crowd_ox_id', $remote_order->relationships->customer->data->id)->firstOrFail();


        $order = CrowdOxOrder::updateIfChangedOrCreate(["crowd_ox_id" => $remote_order->id], [
            "co_updated_at" => $remote_order->attributes->{'updated-at'},
            'co_created_at' => $remote_order->attributes->{'external-created-at'} ?: $remote_order->attributes->{'created-at'}],[
            "crowd_ox_project_id" => $project->id,
            "crowd_ox_customer_id" => $customer->id,
            'co_invited_at' => $remote_order->attributes->{'invite-sent-on'},
            'co_approved_at' => $remote_order->attributes->{'approved-on'},
            'co_cancelled_at' => $remote_order->attributes->{'canceled-on'},
            'co_refused_at' => $remote_order->attributes->{'refused-on'},
            'price_cents' => $remote_order->attributes->{'price-cents'},
            'status' => $this->crowdOxStatus($remote_order),
            'notes' => $remote_order->attributes->notes,
            'authentication_token' => $remote_order->attributes->{'authentication-token'},
            'external_id' => $remote_order->attributes->{'external-id'},
            "raw_data" => json_encode($remote_order),
        ]);


        //sync tags
        $tag_ids = [];
        if (property_exists($remote_order->relationships, "tags")) {
            foreach ($remote_order->relationships->tags->data as $tag_remote) {
                $tag = CrowdOxOrderTag::where('crowd_ox_id', $tag_remote->id)->first();
                if ($tag) { $tag_ids[] = $tag->id; }
            }
        }
        $order->crowdOxOrderTags()->sync($tag_ids);


        //sync custom fields
        $custom_fields = [];
        foreach ($remote_order->attributes->custom as $remote_custom_field_key => $remote_custom_field_value) {
            $field = CrowdOxProjectCustomField::where('key', $remote_custom_field_key)->first();
            if ($field) { $custom_fields[$field->id] = ['value' => $remote_custom_field_value]; }
        }
        $order->crowdOxProjectCustomFields()->sync($custom_fields);

        return $order;
    }

    protected function crowdOxStatus(object $remote_order) {
        $status = "In Progress";
        if ($remote_order->attributes->{'canceled-on'} != null) {
            return "Cancelled";
        }
        if  ($remote_order->attributes->{'current-step'} == "confirm" ||
            $remote_order->attributes->{'current-step'} == "shipping") {
                if ($remote_order->attributes->{'approved-on'} != null) {
                    $status = "Completed";
                }
        }
        $locked = [];
        foreach ($remote_order->attributes->locked ?: [] as $locks) {
            $locked[] = ucfirst($locks->process);
        }
        if (count($locked) > 0) {
            $status = "Locked by ".implode(", ", $locked);
        }
        return $status;
    }
}
