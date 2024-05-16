<?php

namespace App\Trackers\Contracts;

use App\Trackers\Contracts\TrackerContract;

interface TrackerStoreContract
{
    /**
     * Get a service tracker
     *
     * @param string $service
     * @return TrackerContract
     */
    public function tracker(string $service): TrackerContract;


    /**
     * Get all trackers
     *
     * @param string $service
     * @return [TrackerContract]
     */
    public function all(): array;
}
