<?php

namespace Database\Factories;

use App\CrowdOxCountry;
use App\CrowdOxOrder;
use App\CrowdOxOrderAddress;
use App\CrowdOxProject;
use App\CrowdOxState;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxOrderAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxOrderAddress::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            "name" => $this->faker->name(),
            "address_1" => $this->faker->address(),
            "address_2" => $this->faker->secondaryAddress(),
            "city" => $this->faker->city(),
            "state" => $this->faker->state(),
            "postal_code" => $this->faker->postcode(),
            "phone_number" => $this->faker->phoneNumber(),
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'crowd_ox_order_id' => CrowdOxOrder::factory(),
            "crowd_ox_country_id" => CrowdOxCountry::factory(),
            "crowd_ox_state_id" => CrowdOxState::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
