<?php

namespace App\Providers;

use App\Trackers\Contracts\IngestorTrackerContract;
use App\Trackers\Contracts\OperatorTrackerContract;
use App\Trackers\Contracts\DischargerTrackerContract;
use App\Trackers\Contracts\TrackerStoreContract;
use App\Trackers\IngestorTracker;
use App\Trackers\OperatorTracker;
use App\Trackers\DischargerTracker;
use App\Trackers\TrackerStore;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TrackerServiceProvider extends ServiceProvider //implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        //bind stores to contracts
        $this->app->bind(IngestorTrackerContract::class, IngestorTracker::class);

        //singletons so same result whenever called!
        $this->app->singleton(TrackerStoreContract::class, TrackerStore::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }


    /**
     * Get the services provided by the provider. (needed for deferrable)
     *
     * @return array
     */
    public function provides()
    {
        return [IngestorTrackerContract::class,
            TrackerStoreContract::class];
    }

}
