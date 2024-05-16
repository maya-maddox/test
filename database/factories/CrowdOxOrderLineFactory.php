<?php

namespace Database\Factories;

use App\CrowdOxOrder;
use App\CrowdOxOrderLine;
use App\CrowdOxProduct;
use App\CrowdOxProject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxOrderLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxOrderLine::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            'type' => $this->faker->randomElement(["reward", "reward", "reward", "reward", "extra", "extra", "manual", "external"]),
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'crowd_ox_order_id' => CrowdOxOrder::factory(),
            'crowd_ox_product_id' => CrowdOxProduct::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
