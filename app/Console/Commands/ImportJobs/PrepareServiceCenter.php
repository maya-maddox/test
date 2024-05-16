<?php

namespace App\Console\Commands\ImportJobs;

use App\Ingestors\CheckInReturnsIngestor;
use App\Ingestors\ReturnItemsIngestor;
use App\Ingestors\SkuIngestor;
use App\Models\ServiceCenter;
use Illuminate\Console\Command;

class PrepareServiceCenter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-jobs:prepare-service-center';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports SKUs, historic service center data etc.';

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
        (new SkuIngestor())->ingest();
        $this->info("Imported SKUs and SKU types");
        ServiceCenter::updateOrCreate([
            'name' => "UK Service Center",
            'code' => "UK",
            'location' => "London, UK",
            'timezone' => "Europe/London",
        ], [
            'user_preference' => [],
        ]);
        $this->info("Service Center initialised");
        (new ReturnItemsIngestor())->ingest();
        $this->info("Imported historic returns");
        (new CheckInReturnsIngestor())->ingest();
        $this->info("Imported test check-in returns");
    }
}
