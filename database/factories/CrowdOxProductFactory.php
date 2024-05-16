<?php

namespace Database\Factories;

use App\CrowdOxProduct;
use App\CrowdOxProject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxProduct::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            'type' => $this->faker->randomElement(["mapping", "option", "question", "physical", "bundle"]),
            'description' => "<p>".$this->faker->sentence()."</p>",
            'name' => $this->faker->name(),
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
