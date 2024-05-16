<?php

namespace App\Trackers\Facade;

use App\Trackers\Contracts\TrackerStoreContract;
use Illuminate\Support\Facades\Facade;


class TrackerStore extends Facade
{

    protected static function getFacadeAccessor()
    {
        return TrackerStoreContract::class;
    }

}
