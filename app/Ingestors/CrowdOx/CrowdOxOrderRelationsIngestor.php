<?php

namespace App\Ingestors\CrowdOx;

use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxOrderRelationsIngestor extends CrowdOxOrderIngestor {

    /**
     * Retrieves projects from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        //This is some dummy data work to return the dummy data in the correct form
        return new CrowdOxDummyDataIngestor("crowdox-orders-inclusive.json");

        //return CrowdOx::orders($this->crowd_ox_id)->include(['tags', 'lines', 'selections', 'customer', 'shipping-address', 'transactions']);
    }

}
