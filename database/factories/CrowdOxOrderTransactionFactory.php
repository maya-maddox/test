<?php

namespace Database\Factories;

use App\CrowdOxOrder;
use App\CrowdOxOrderTransaction;
use App\CrowdOxProject;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrowdOxOrderTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxOrderTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'crowd_ox_order_id' => CrowdOxOrder::factory(),
            'amount_cents' => $this->faker->numberBetween(1, 1000)*100,
            'shipping_amount_cents' => $this->faker->numberBetween(1, 50)*10,
            'currency' => $this->faker->randomElement(["EUR", "GBP", "USD"]),
            'confirmed' => true,
            'paid_at' => $this->faker->dateTime(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
