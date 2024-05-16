<?php

namespace App\Support\CrowdOx\OrderExportMapper\Maps;

use App\CrowdOxOrder;

abstract class BaseMap {

    protected $order;

    public function __construct(CrowdOxOrder $order) {
        $this->order = $order;
    }

}
