<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\CrowdOxOrder;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxPostTransformersContract;
use App\Support\CrowdOx\OrderCleaner\CrowdOxOrderCleaner;
use Illuminate\Database\Eloquent\Model;

class PostOrderCleaner implements CrowdOxPostTransformersContract {

    /**
     * Records the remote ticket field to the database
     *
     * @param Model $order
     * @return Model
     */
    public function transform(Model $order): Void {
        $cleaner = new CrowdOxOrderCleaner();
        $cleaner->order($order)->clean();
    }
}
