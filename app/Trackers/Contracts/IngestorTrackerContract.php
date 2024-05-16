<?php

namespace App\Trackers\Contracts;

use App\Ingestion;

interface IngestorTrackerContract extends TrackerContract
{
    /**
     * Save tracking to database.
     *
     * @return Ingestion
     */
    public function save(): Ingestion;

}
