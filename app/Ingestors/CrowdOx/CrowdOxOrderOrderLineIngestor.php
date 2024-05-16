<?php

namespace App\Ingestors\CrowdOx;

use edh649\CrowdOxLaravel\Facades\CrowdOx;

class CrowdOxOrderOrderLineIngestor extends CrowdOxOrderLineIngestor {

    /**
     * Retrieves order lines from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::orders($this->crowd_ox_id)->order_lines();
    }

}
