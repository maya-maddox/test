<?php

namespace App\Ingestors\CrowdOx\Transformers\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

interface CrowdOxTransformersStoreContract {

    /**
     * Register a transformer to the store
     *
     * @param string $type crowd ox type
     * @param string $class
     * @return CrowdOxTransformersStoreContract
     */
    public function register(string $type, string $class): CrowdOxTransformersStoreContract;

    /**
     * Register a transformer to the store
     *
     * @param string $model_class name of model
     * @param string $class
     * @return void
     */
    public function registerPostTransformer(string $type, string $class): CrowdOxTransformersStoreContract;

    /**
     * Transform some provided data
     *
     * @param object $data
     * @return Model
     */
    public function transform(object $data): Model;

    /**
     * Transform included data in correct order
     *
     * @param array $included_data
     * @return array of models
     */
    public function transformIncluded(array $included_data): array;
}
