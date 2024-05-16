<?php

namespace Database\Factories;

use App\CrowdOxOrder;
use App\CrowdOxOrderLine;
use App\CrowdOxOrderSelection;
use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxOrderSelectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxOrderSelection::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            "quantity" => $this->faker->randomElement([1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 3, 4]),
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'crowd_ox_order_id' => CrowdOxOrder::factory(),
            'crowd_ox_order_line_id' => CrowdOxOrderLine::factory(),
            'crowd_ox_product_id' => CrowdOxProduct::factory(),
            'crowd_ox_product_variation_id' => CrowdOxProductVariation::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
