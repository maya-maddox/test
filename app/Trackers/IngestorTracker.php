<?php

namespace App\Trackers;

use App\Ingestion;
use App\Trackers\Contracts\IngestorTrackerContract;

class IngestorTracker extends Tracker implements IngestorTrackerContract
{
    protected $ingestion = null;


    /**
     * Save ingestion tracking to database.
     * Note: On save will not update key. possible bug?
     *
     * @return Ingestion
     */
    public function save(): Ingestion {
        $ingestion = $this->ingestion;
        if (!$ingestion) {
            $ingestion = new Ingestion();
        }

        $ingestion->fill([
            'raw_data' => $this->raw_data,
            'service' => $this->service,
            'comments' => implode("\n\n", $this->comments),
            'status' => $this->status,
        ]);

        $this->ingestion = $ingestion;
        return $ingestion;
    }

}
