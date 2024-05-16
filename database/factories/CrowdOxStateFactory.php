<?php

namespace Database\Factories;

use App\CrowdOxCountry;
use App\CrowdOxState;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxStateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxState::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(1, 10000),
            'name' => $this->faker->state(),
            'crowd_ox_country_id' => CrowdOxCountry::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
