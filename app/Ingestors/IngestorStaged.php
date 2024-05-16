<?php

namespace App\Ingestors;

use App\Trackers\Facade\TrackerStore;
use Illuminate\Support\Facades\DB;

abstract class IngestorStaged extends Ingestor
{
    /**
     * Import from remote API
     *
     * @return array
     */
    abstract protected function import(): array;


    /**
     * Record results to database models
     *
     * @param array $remote_items
     * @return array
     */
    abstract protected function record(array $remote_items): array;

    /**
     * Ingest the data from a remote service and record to database
     *
     * @return Ingestor
     */
    public function ingest(): Ingestor {
        $this->exhaustedResource = false;

        $remote_items = $this->import();
        $this->tracker->comment("Imported data");


        DB::transaction(function () use ($remote_items) {
            $remote_items = $this->record($remote_items);
        }, 5); //retry transaction up to 5 times if it fails
        
        $this->tracker->comment("Recorded to database")->status("Success")->save();

        return $this;
    }

    /**
     * Ingest the data from a remote service and record to database
     *
     * @return boolean
     */
    public function ingestNew(): bool {
        if (method_exists($this, 'importNew')) {
            return $this->importNew();
        }

        throw new \Exception("No new ingestor for %d", get_class($this));
    }

}
