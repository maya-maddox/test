<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class CustomerEmail extends BaseMap {

    public function export() {
        return [
            "Email" => $this->order->crowdOxCustomer->email,
        ];
    }
}
