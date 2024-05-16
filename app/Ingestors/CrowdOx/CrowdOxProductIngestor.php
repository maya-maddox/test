<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxProduct;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxProductIngestor extends CrowdOxIngestor {

    /**
     * Retrieves products from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        //This is some dummy data work to return the dummy data in the correct form
        return new CrowdOxDummyDataIngestor("crowdox-products.json");

        //return CrowdOx::products($this->crowd_ox_id);
    }

}
