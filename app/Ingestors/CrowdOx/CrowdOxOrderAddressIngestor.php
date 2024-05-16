<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxCountry;
use App\CrowdOxOrder;
use App\CrowdOxOrderAddress;
use App\CrowdOxOrderLine;
use App\CrowdOxProject;
use App\CrowdOxState;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxOrderAddressIngestor extends CrowdOxIngestor {

    /**
     * Retrieves order addresses from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::order_addresses($this->crowd_ox_id);
    }


}
