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

class CrowdOxOrderTransactionIngestor extends CrowdOxIngestor {

    /**
     * Retrieves order lines from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::order_transactions($this->crowd_ox_id);
    }

}
