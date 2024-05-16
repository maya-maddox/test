<?php

namespace App\Ingestors\CrowdOx;

use App\Ingestors\CrowdOx\CrowdOxIngestor;
use App\Trackers\Facade\TrackerStore;
use App\CrowdOxCountry;
use App\CrowdOxProject;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxCountryIngestor extends CrowdOxIngestor {

    /**
     * Retrieves countries from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        //This is some dummy data work to return the dummy data in the correct form
        return new CrowdOxDummyDataIngestor("crowdox-countries.json");

        // return CrowdOx::countries();
    }

}
