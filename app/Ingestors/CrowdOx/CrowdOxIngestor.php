<?php

namespace App\Ingestors\CrowdOx;

use App\Ingestors\CrowdOx\Transformers\Facade\CrowdOxTransformersStore;
use App\Ingestors\Ingestor;
use App\Ingestors\IngestorStreamed;
use App\Trackers\Facade\TrackerStore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class CrowdOxIngestor extends IngestorStreamed {


    protected $crowd_ox_id = null;

    /**
     * Page index to start at
     *
     * @var int
     */
    protected $page_start = 1;

    /**
     * Maximum number of pages to fetch
     *
     * @var int
     */
    protected $max_page_count = null;


    public function __construct(int $crowd_ox_id = null, int $page_start = null, int $max_page_count = null)
    {
        $this->crowd_ox_id = $crowd_ox_id;
        $this->page_start = $page_start ?? 1;
        $this->max_page_count = $max_page_count;

        parent::__construct();
    }

    /**
     * The CrowdOx API function to call to retrieve items
     *
     * @return object
     */
    abstract protected function crowdOxApiFunction(): object;


    /**
     * Import from remote API and record
     *
     * @return array
     */
    protected function importAndRecord(): array {
        $items = [];

        $page = $this->page_start;
        $total_count = 1;
        while (count($items) < $total_count) {
            Log::debug("CO Ingestor Page: [{$page}]");
            if ($this->max_page_count && $page > ($this->page_start + $this->max_page_count -1)) {
                //$this->tracker->comment(sprintf("Stopped at %d pages due to limit", $this->max_page_count));
                break;
            }

            //Get item data from API
            $items_remote  = $this->callCrowdOxApiFunction($page);

            //set total count so we know when we've finished exporting
            if (property_exists($items_remote, 'meta')) {
                $total_count = $items_remote->meta->{'record-count'}; //use this fancy {} to access property with illegal hyphen
            }
            else {
                $total_count = 1; //didn't have property, so we were fetching a single item
            }

            //convert data to array if single object and create blank included array if not presnet
            if (!is_array($items_remote->data)) { $items_remote->data = [$items_remote->data]; }
            if (!property_exists($items_remote, "included")) { $items_remote->included = []; }

            //transform and store relevant data (in the correct hierarchy order too using the store)
            $toTransform = array_merge($items_remote->data, $items_remote->included);
            $new_items = CrowdOxTransformersStore::transformIncluded($toTransform);

            //merge new items into the main array
            $items = array_merge($items, $new_items);

            $page = $page + 1;

            //check if no items were returned. if so, no point in checking the next page, break out
            if (count($items_remote->data) == 0) {
                //$this->tracker->comment(sprintf("Stopped at %d pages as no items returned", $this->max_page_count));
                break;
            }

        }
        //$this->tracker->comment(sprintf("Downloaded and recorded %d remote items", $total_count));

        if ($this->max_page_count && $page > ($this->page_start + $this->max_page_count - 1) && count($items) > 0) { $this->exhaustedResource = false; }
        else { $this->exhaustedResource = true; }
        return $items;
    }


    protected function callCrowdOxApiFunction(int $page) {
        return $this->crowdOxApiFunction()->pageNumber($page)->all();
    }

}
