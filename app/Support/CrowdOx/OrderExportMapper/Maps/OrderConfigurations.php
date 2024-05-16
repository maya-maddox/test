<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class OrderConfigurations extends BaseMap {

    public function export() {
        $json = json_decode($this->order->raw_data);
        return [
            "Original Configuration Name" => "???",
            "Configuration Name" => "???",
        ];
    }
}
