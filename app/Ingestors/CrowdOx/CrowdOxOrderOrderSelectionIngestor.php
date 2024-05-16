<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxOrder;
use App\CrowdOxOrderLine;
use App\CrowdOxOrderSelection;
use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxOrderOrderSelectionIngestor extends CrowdOxOrderSelectionIngestor {

    /**
     * Retrieves order lines from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::orders($this->crowd_ox_id)->order_selections();
    }

}
