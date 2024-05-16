<?php

namespace App\Trackers;

use App\Trackers\Facade\DischargerTracker;
use App\Trackers\Facade\IngestorTracker;
use App\Trackers\Facade\OperatorTracker;
use App\Trackers\Facade\TrackerStore;
use Throwable;

class TrackerExceptionHandler {

    public function report(Throwable $e)
    {
        foreach (TrackerStore::all() as $tracker) {
            //add exception as comment
            $tracker->comment(mb_strimwidth($e->getMessage(), 0, 300, ".......")."\n".$e->getFile()." : ".$e->getLine());

            //set status as error
            $tracker->status("Error");

            //save
            $tracker->save();
        }
    }
}
