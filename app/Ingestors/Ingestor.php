<?php

namespace App\Ingestors;

use App\Trackers\Facade\TrackerStore;

abstract class Ingestor
{
    /**
     * The tracker for this ingestor
     *
     * @var Tracker
     */
    protected $tracker;

    public function __construct() {
        $this->tracker = TrackerStore::tracker(get_class($this));
    }

    /**
     * Ingest the data from a remote service and record to database
     *
     * @return Ingestor
     */
    abstract public function ingest(): Ingestor;

    /**
     * Whether the remote resource was fully exhausted.
     * This can then be checked to see if more jobs need to be dispatched.
     *
     * @var boolean
     */
    protected $exhaustedResource;

    /**
     * Whether the resource was fully exhausted. Null if not yet ran
     *
     * @return boolean|null
     */
    public function resourceExhausted(): ?bool {
        return $this->exhaustedResource;
    }

}
