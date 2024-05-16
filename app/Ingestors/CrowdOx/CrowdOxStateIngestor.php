<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxCountry;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use App\CrowdOxState;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxStateIngestor extends CrowdOxIngestor {

    /**
     * Retrieves states from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::states();
    }

}
