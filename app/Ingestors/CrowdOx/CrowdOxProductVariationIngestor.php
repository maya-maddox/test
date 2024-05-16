<?php

namespace App\Ingestors\CrowdOx;

use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use App\Ingestors\CrowdOx\CrowdOxIngestor;
use edh649\CrowdOxLaravel\Facades\CrowdOx;
use Illuminate\Database\Eloquent\Model;

class CrowdOxProductVariationIngestor extends CrowdOxIngestor {

    /**
     * Retrieves products from the CrowdOx API
     *
     * @return object
     */
    protected function CrowdOxApiFunction(): object {
        return CrowdOx::product_variations($this->crowd_ox_id);
    }

}
