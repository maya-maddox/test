<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

class Tags extends BaseMap {

    public function export() {
        return [
            "Tags" => implode(",", $this->order->crowdOxOrderTags->pluck('name')->toArray()),
        ];
    }
}
