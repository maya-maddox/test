<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class BasicInfo extends BaseMap {

    public function export() {
        return [
            "Order Number" => "CROWDOX-".$this->order->crowd_ox_id,
            "Order Status" => "???", //to work out?
            "Order Source" => "???", //to get from order sources import
        ];
    }
}
