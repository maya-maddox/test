<?php

namespace App\Trackers;

use App\Trackers\Contracts\TrackerContract;
use App\Trackers\Contracts\TrackerStoreContract;

use App\Trackers\Facade\DischargerTracker;
use App\Trackers\Facade\IngestorTracker;
use App\Trackers\Facade\OperatorTracker;

class TrackerStore implements TrackerStoreContract
{

    protected $trackers = [];

    /**
     * Get a service tracker
     *
     * @param string $service
     * @return TrackerContract
     */
    public function tracker(string $service): TrackerContract {
        if (array_key_exists($service, $this->trackers)) {
            return $this->trackers[$service];
        }
        $this->trackers[$service] = $this->newTracker($service);
        return $this->trackers[$service];
    }

    /**
     * Get all trackers
     *
     * @param string $service
     * @return [TrackerContract]
     */
    public function all(): array {
        return $this->trackers;
    }


    protected function newTracker(string $service) {
        $type = config('services.internal.'.$service.".trackable_type", null);
        if (!$type) {
            // the '//' is for normal classes. the '_' covers mocked class (for testing purposes).
            if ((strpos($service, '\\Ingestors\\') !== false) || (strpos($service, '_Ingestors_') !== false)) { $type = "ingestor"; }
            else {
                throw new \Exception("Service [{$service}] type is not present in services internal config and couldn't auto discover type");
            }
        }
        if (!in_array($type, config('services.trackable_types', ["ingestor", "operator", "discharger"]))) { throw new \Exception("Service [{$service}] has invalid trackable type [{$type}]"); }

        if ($type == "ingestor") { return IngestorTracker::service($service); }

        throw new \Exception("Trackable type [{$type}] not supported (but passed validation?...)");
    }
}
