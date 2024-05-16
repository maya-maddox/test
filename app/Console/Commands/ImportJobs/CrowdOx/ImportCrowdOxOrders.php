<?php

namespace App\Console\Commands\ImportJobs\CrowdOx;

use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxCountries;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxOrders;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxProducts;
use App\Jobs\Ingestors\CrowdOx\IngestCrowdOxProjects;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class ImportCrowdOxOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-jobs:crowdox-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports crowdox orders and required other models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        IngestCrowdOxCountries::dispatch();
        $this->info("CrowdOx Countries Imported");
        IngestCrowdOxProjects::dispatch();
        $this->info("CrowdOx Projects Imported");
        IngestCrowdOxProducts::dispatch();
        $this->info("CrowdOx Products Imported");
        IngestCrowdOxOrders::dispatch();
        $this->info("CrowdOx Orders Imported");
    }
}
