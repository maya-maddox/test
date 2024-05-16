<?php

namespace Database\Factories;

use App\CrowdOxCountry;
use App\CrowdOxProject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxProject::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            'name' => $this->faker->name(),
            'identifier' => $this->faker->slug(3),
            'currency' => $this->faker->currencyCode(),
            'crowd_ox_country_id' => CrowdOxCountry::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
