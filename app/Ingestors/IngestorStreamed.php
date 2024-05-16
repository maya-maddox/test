<?php

namespace App\Ingestors;

use App\Trackers\Facade\TrackerStore;
use Illuminate\Support\Facades\DB;

abstract class IngestorStreamed extends Ingestor
{
    /**
     * Import from remote API and record to database
     *
     * @return array
     */
    abstract protected function importAndRecord(): array;
    /**
     * Ingest the data from a remote service and record to database
     *
     * @return Ingestor
     */
    public function ingest(): Ingestor {
        $this->exhaustedResource = false;

        DB::transaction(function () {
            $remote_items = $this->importAndRecord();
        }, 5); //retry transaction up to 5 times if it fails

        $this->tracker->comment("Imported data and recored to database")->status("Success")->save();

        return $this;
    }

}
