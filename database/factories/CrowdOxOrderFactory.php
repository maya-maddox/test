<?php

namespace Database\Factories;

use App\CrowdOxCustomer;
use App\CrowdOxOrder;
use App\CrowdOxProject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxOrder::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(1000000, 9999999), //7 digit number
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'crowd_ox_customer_id' => CrowdOxCustomer::factory(),
            'co_created_at' => $this->faker->dateTime(),
            'co_invited_at' => $this->faker->dateTime(),
            'co_approved_at' => $this->faker->randomElement([null, $this->faker->dateTime()]),
            'co_cancelled_at' => $this->faker->randomElement([null, null, null, null, null, $this->faker->dateTime()]),
            'co_refused_at' => $this->faker->randomElement([null, null, null, null, null, null, null, null, $this->faker->dateTime()]),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
            'co_updated_at' => $this->faker->dateTime(),
            'price_cents' => $this->faker->numberBetween(100, 50000),
            'status' => $this->faker->randomElement(["Invited", "Locked By Manual", "Completed", "Cancelled", "Locked By Export", "Locked By Ship", "Locked By Export, Manual", "Locked By Ship, Manual", "Locked By Ship, Manual, Export"]),
            'notes' => $this->faker->randomElement([null, $this->faker->sentence()]),
            'authentication_token' => $this->faker->randomAscii(),
            'external_id' => $this->faker->randomElement([null, $this->faker->numberBetween(1, 10000)]),
        ];

        //really status should only be cancelled if the cancelled date is present
    }
}
