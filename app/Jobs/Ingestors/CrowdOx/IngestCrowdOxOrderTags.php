<?php

namespace App\Jobs\Ingestors\CrowdOx;

use App\Ingestors\CrowdOx\CrowdOxOrderIngestor;
use App\Ingestors\CrowdOx\CrowdOxOrderTagIngestor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IngestCrowdOxOrderTags implements ShouldQueue
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
        $ingestor = new CrowdOxOrderTagIngestor();
        $ingest = $ingestor->ingest();
    }
}
