<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxOrder;
use App\CrowdOxOrderLine;
use App\CrowdOxProduct;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxOrderLineIngestor extends CrowdOxIngestor {

    /**
     * Retrieves order lines from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::order_lines($this->crowd_ox_id);
    }

}
