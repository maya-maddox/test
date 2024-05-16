<?php

namespace App\Providers;

use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersStoreContract;
use App\Ingestors\CrowdOx\Transformers\CrowdOxTransformersStore;
use App\Ingestors\CrowdOx\Transformers\Facade\CrowdOxTransformersStore as CrowdOxTransformersStoreFacade;

use Illuminate\Support\ServiceProvider;

class IngestorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //bind stores to contracts

        //singletons so same result whenever called!
        $this->app->singleton(CrowdOxTransformersStoreContract::class, CrowdOxTransformersStore::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //register ingestors into stores
        foreach (config('ingestors.crowd_ox_transformers') as $type => $transformer)
        {
            CrowdOxTransformersStoreFacade::register($type, $transformer);
        }
        //register ingestors into stores
        foreach (config('ingestors.crowd_ox_transformers_post') as $model => $transformer)
        {
            CrowdOxTransformersStoreFacade::registerPostTransformer($model, $transformer);
        }

    }

}
