<?php

namespace App\Jobs\Ingestors\CrowdOx;

use App\CrowdOxProject;
use App\Ingestors\CrowdOx\CrowdOxOrderIngestor;
use App\Ingestors\CrowdOx\CrowdOxProjectCustomFieldIngestor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IngestCrowdOxProjectsCustomFields implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $project_crowd_ox_ids = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        foreach (CrowdOxProject::all() as $crowd_ox_project) {
            $this->project_crowd_ox_ids[] = $crowd_ox_project->crowd_ox_id;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->project_crowd_ox_ids as $project_crowd_ox_id) {
            $ingestor = new CrowdOxProjectCustomFieldIngestor($project_crowd_ox_id);
            $ingest = $ingestor->ingest();
        }
    }
}
