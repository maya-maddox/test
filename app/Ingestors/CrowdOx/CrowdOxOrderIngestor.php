<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxCustomer;
use App\CrowdOxOrder;
use App\CrowdOxOrderTag;
use App\CrowdOxProject;
use App\CrowdOxProjectCustomField;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxOrderIngestor extends CrowdOxIngestor {

    /**
     * Retrieves projects from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::orders($this->crowd_ox_id)->include('tags');
    }

}
