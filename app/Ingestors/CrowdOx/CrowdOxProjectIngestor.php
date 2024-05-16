<?php

namespace App\Ingestors\CrowdOx;

use App\Ingestors\CrowdOx\CrowdOxIngestor;
use App\Trackers\Facade\TrackerStore;
use App\CrowdOxProject;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxProjectIngestor extends CrowdOxIngestor {

    /**
     * Retrieves projects from the CrowdOx API
     *
     * @param integer $page
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        //This is some dummy data work to return the dummy data in the correct form
        return new CrowdOxDummyDataIngestor("crowdox-project.json");


        // return CrowdOx::projects($this->crowd_ox_id)->parameter("filter[company]", config('crowdox-laravel.company_id'));
    }
}
