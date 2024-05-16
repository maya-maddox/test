<?php

namespace App\Ingestors\CrowdOx\Transformers\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CrowdOxTransformersContract {

    /**
     * Convert the provided data
     *
     * @param object $data
     * @return Model|null
     */
    public function transform(object $data): ?Model;

}
