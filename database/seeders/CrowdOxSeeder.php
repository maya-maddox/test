<?php

namespace Database\Seeders;

use App\CrowdOxCountry;
use App\CrowdOxCustomer;
use App\CrowdOxOrder;
use App\CrowdOxOrderAddress;
use App\CrowdOxOrderLine;
use App\CrowdOxOrderSelection;
use App\CrowdOxOrderTag;
use App\CrowdOxOrderTransaction;
use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use App\CrowdOxProjectCustomField;
use App\CrowdOxState;
use Database\Factories\CrowdOxCountryFactory;
use Illuminate\Database\Seeder;

class CrowdOxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = CrowdOxCountry::factory()
            ->times(20)
            ->create();
        $this->command->info("CrowdOx countries seeded");

        $states = [];
        foreach ($countries as $country) {
            $states[$country->id] = CrowdOxState::factory()
                ->times(5)
                ->state(["crowd_ox_country_id" => $countries[0]])
                ->create();
        }
        $this->command->info("CrowdOx states seeded");

        $projects = [];
        foreach ($countries->shuffle()->take(5) as $country) {
            $projects[] = CrowdOxProject::factory()
                ->state(["crowd_ox_country_id" => $country])
                ->create();
        }
        $this->command->info("CrowdOx projects seeded");


        // 'order-tags'
        $ordertags = [];
        foreach ($projects as $project) {
            $ordertags[$project->id] = CrowdOxOrderTag::factory()
                ->times(10)
                ->state(["crowd_ox_project_id" => $project])
                ->create();
        }
        $this->command->info("CrowdOx order tags seeded");

        // 'project-custom-fields'
        $projectcustomfields = [];
        foreach ($projects as $project) {
            $projectcustomfields[$project->id][] = CrowdOxProjectCustomField::factory()
                ->productionBatch()
                ->state(["crowd_ox_project_id" => $project])
                ->create();
            $projectcustomfields[$project->id][] = CrowdOxProjectCustomField::factory()
                ->shippingContainerDestination()
                ->state(["crowd_ox_project_id" => $project])
                ->create();
            $projectcustomfields[$project->id][] = CrowdOxProjectCustomField::factory()
                ->taxPaid()
                ->state(["crowd_ox_project_id" => $project])
                ->create();
            $projectcustomfields[$project->id][] = CrowdOxProjectCustomField::factory()
                ->shippingContainerAllocationExtra()
                ->state(["crowd_ox_project_id" => $project])
                ->create();
            $projectcustomfields[$project->id][] = CrowdOxProjectCustomField::factory()
                ->shippingContainerAllocationReward()
                ->state(["crowd_ox_project_id" => $project])
                ->create();
        }
        $this->command->info("CrowdOx projects custom fields seeded");

        // 'products'
        $products = [];
        foreach ($projects as $project) {
            $products[$project->id] = CrowdOxProduct::factory()
                ->times(10)
                ->state(["crowd_ox_project_id" => $project])
                ->create();
        }
        $this->command->info("CrowdOx products seeded");

        // 'product-variations'
        $productvariations = [];
        foreach ($projects as $project) {
            foreach ($products[$project->id] as $product)
            {
                $productvariations[$product->id] = CrowdOxProductVariation::factory()
                    ->times(3)
                    ->state(["crowd_ox_project_id" => $project,
                             "crowd_ox_product_id" => $product])
                    ->create();
            }
        }
        $this->command->info("CrowdOx product variations seeded");

        // 'customers'
        $customers = CrowdOxCustomer::factory()
            ->times(100)
            ->create();
        $this->command->info("CrowdOx customers seeded");

        // 'orders'
        $orders = [];
        foreach($projects as $project) {
            foreach ($customers->shuffle()->take(20) as $customer) {
                $orders[$project->id][] = CrowdOxOrder::factory()
                    ->state(["crowd_ox_project_id" => $project,
                             "crowd_ox_customer_id" => $customer])
                    ->create();
            }
        }
        $this->command->info("CrowdOx orders seeded");

        // 'order-transactions'
        $ordertransactions = [];
        foreach($projects as $project) {
            foreach ($orders[$project->id] as $order) {
                $ordertransactions[$project->id] = CrowdOxOrderTransaction::factory()
                    ->state(["crowd_ox_project_id" => $project,
                             "crowd_ox_order_id" => $order])
                    ->create();
            }
        }
        $this->command->info("CrowdOx order transactions seeded");

        // 'order-addresses'
        $orderaddresses = [];
        foreach($projects as $project) {
            foreach ($orders[$project->id] as $order) {
                $country_id = $countries->shuffle()->first()->id;
                $orderaddresses[$project->id] = CrowdOxOrderAddress::factory()
                    ->state(["crowd_ox_project_id" => $project,
                             "crowd_ox_order_id" => $order,
                             "crowd_ox_country_id" => $country_id,
                             "crowd_ox_state_id" => $states[$country_id]->shuffle()->first()])
                    ->create();
            }
        }
        $this->command->info("CrowdOx order addresses seeded");

        // 'order-lines'
        $orderlines = [];
        $orderselections = [];
        foreach($projects as $project) {
            foreach ($orders[$project->id] as $order) {
                for ($i=0; $i < rand(1, 8); $i++) {
                    $product =  $products[$project->id]->shuffle()->first();
                    $orderline = CrowdOxOrderLine::factory()
                        ->state(["crowd_ox_project_id" => $project,
                                 "crowd_ox_order_id" => $order,
                                 "crowd_ox_product_id" => $product])
                        ->create();

                    $orderlines[$project->id] = $orderline;

                    //create order selections here too...
                    $orderselections[$project->id] = CrowdOxOrderSelection::factory()
                        ->state(["crowd_ox_project_id" => $project,
                                "crowd_ox_order_id" => $order,
                                "crowd_ox_order_line_id" => $orderline,
                                "crowd_ox_product_id" => $product,
                                "crowd_ox_product_variation_id" => $productvariations[$product->id]->shuffle()->first()])
                        ->create();
                }
            }
        }
        $this->command->info("CrowdOx order lines and order states seeded");


    }
}
