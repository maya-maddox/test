<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxProject;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use App\Trackers\Facade\TrackerStore;
use App\CrowdOxProjectCustomField;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxProjectCustomFieldIngestor extends CrowdOxIngestor {

    /**
     * Retrieves projects from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::projects($this->crowd_ox_id)->custom_fields();
    }

}
