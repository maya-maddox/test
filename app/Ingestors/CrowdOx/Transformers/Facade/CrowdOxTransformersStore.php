<?php

namespace App\Ingestors\CrowdOx\Transformers\Facade;

use App\Page;
use App\Ingestors\CrowdOx\Transformers\Contracts\CrowdOxTransformersStoreContract;
use Illuminate\Support\Facades\Facade;


class CrowdOxTransformersStore extends Facade
{

    protected static function getFacadeAccessor()
    {
        return CrowdOxTransformersStoreContract::class;
    }

}
