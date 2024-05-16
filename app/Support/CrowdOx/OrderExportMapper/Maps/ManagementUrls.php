<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class ManagementUrls extends BaseMap {

    public function export() {
        $project = $this->order->crowdOxProject;
        $json = json_decode($this->order->raw_data);
        return [
            //https://manage.crowdox.com/c/106169/projects/108295/orders/3726520
            "Manage Url" => "https://manage.crowdox.com/c/".config('crowdox-laravel.company_id')."/projects/".$project->crowd_ox_id."/orders/".$this->order->crowd_ox_id,
            //https://survey.crowdox.com/confirm/swytch-technology-ltd/gbp-x?order_id=3726520&token=oqJXr2wTL1CHPns88Wpf
            //slightly dodgy hardcoding swytch-technology-ltd. ahwell...
            "Survey Url" => "https://survey.crowdox.com/confirm/swytch-technology-ltd/".$project->identifier."?order_id=".$this->order->crowd_ox_id."&token=".($json->attributes->{'authentication-token'} ?? '')
        ];
    }
}
