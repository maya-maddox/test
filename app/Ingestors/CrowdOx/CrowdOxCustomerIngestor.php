<?php

namespace App\Ingestors\CrowdOx;

use App\Ingestors\CrowdOx\CrowdOxIngestor;
use App\Trackers\Facade\TrackerStore;
use App\CrowdOxCustomer;
use App\CrowdOxProject;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxCustomerIngestor extends CrowdOxIngestor {

    /**
     * Retrieves customers from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::customers($this->crowd_ox_id);
    }

}
