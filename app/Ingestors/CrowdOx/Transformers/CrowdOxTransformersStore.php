<?php

namespace App\Ingestors\CrowdOx\Transformers;

use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersStoreContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class CrowdOxTransformersStore implements CrowdOxTransformersStoreContract {

    protected $transformers = [];
    protected $post_transformers = [];

    /**
     * Register a transformer to the store
     *
     * @param string $type crowd ox type
     * @param string $class
     * @return void
     */
    public function register(string $type, string $class): CrowdOxTransformersStoreContract {
        $this->transformers[$type] = $class;
        return $this;
    }

    /**
     * Register a transformer to the store
     *
     * @param string $model_class name of model
     * @param string $class
     * @return void
     */
    public function registerPostTransformer(string $model_class, string $class): CrowdOxTransformersStoreContract {
        $this->post_transformers[$model_class] = $class;
        return $this;
    }

    /**
     * Transform primary provided data
     *
     * @param object $data
     * @return Model
     */
    public function transform(object $data): Model {
        $transformedModels = [];
        $data_type = $data->type;

        foreach ($this->transformers as $type => $transformer) {
            if ($type === $data_type) {
                return App::make($transformer)->transform($data);
            }
        }
    }

    /**
     * Transform included data in correct order
     *
     * @param array $included_data
     * @return void
     */
    public function transformIncluded(array $included_data): array {
        $included_data_remaining = $included_data;
        //make a list of all the data types
        $data_types = array_column($included_data_remaining, "type");
        $converted_models = [];

        //step through transformers
        foreach ($this->transformers as $type => $transformer) {
            //if this transformer isn't present in data types, skip to next transformer
            if (!in_array($type, $data_types)) { continue; }

            //transform all included data with that transformer type
            $included_data_remaining = array_filter($included_data_remaining, function ($data) use ($type, $transformer, &$converted_models) {
                if ($type === $data->type) {

                    $model = App::make($transformer)->transform($data);
                    if ($model !== null) { $converted_models[] = $model; }
                    return false; //done so don't include in remaining data
                }
                return true; //not converted, keep in data remaining
            });

            //nothing left to convert, break out of foreach loop.
            if (count($included_data_remaining) == 0) { break; }
        }

        //if any left, error
        if (count($included_data_remaining) > 0) {
            throw new \Exception("Didn't transform all provided relationship inclusions... misnamed/missing transformer?");
        }

        //run post transformers
        foreach ($this->post_transformers as $model_type => $transformer) {
            foreach ($converted_models as $converted_model) {
                if (get_class($converted_model) !== $model_type) { continue; }
                App::make($transformer)->transform($converted_model);
            }
        }

        return $converted_models;
    }
}
