<?php

namespace App\Trackers\Facade;

use App\Trackers\Contracts\IngestorTrackerContract;
use Illuminate\Support\Facades\Facade;


class IngestorTracker extends Facade
{

    protected static function getFacadeAccessor()
    {
        return IngestorTrackerContract::class;
    }

}
