<?php

namespace App\Ingestors\CrowdOx\Transformers\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CrowdOxPostTransformersContract {

    /**
     * Convert the provided data
     *
     * @param Model $data
     * @return void
     */
    public function transform(Model $data): void;

}
