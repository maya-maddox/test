<?php

namespace App\Jobs\Ingestors\CrowdOx;

use App\Ingestors\CrowdOx\CrowdOxOrderIngestor;
use App\Ingestors\CrowdOx\CrowdOxProductVariationIngestor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IngestCrowdOxProductVariations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ingestor = new CrowdOxProductVariationIngestor();
        $ingest = $ingestor->ingest();
    }
}
