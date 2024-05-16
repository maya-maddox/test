<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxOrderTag;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxOrderTagIngestor extends CrowdOxIngestor {

    /**
     * Retrieves projects from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::order_tags($this->crowd_ox_id);
    }

}
