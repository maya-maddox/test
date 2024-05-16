<?php

namespace Database\Factories;

use App\CrowdOxCountry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxCountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxCountry::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(1, 10000),
            'name' => $this->faker->country(),
            'iso2' => $this->faker->countryCode(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
