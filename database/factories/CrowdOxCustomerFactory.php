<?php

namespace Database\Factories;

use App\CrowdOxCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxCustomer::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(1000,30000),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
