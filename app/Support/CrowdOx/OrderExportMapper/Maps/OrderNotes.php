<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class OrderNotes extends BaseMap {

    public function export() {
        $json = json_decode($this->order->raw_data);
        return [
            "Order Notes" => $json->attributes->notes ?? '',
        ];
    }
}
