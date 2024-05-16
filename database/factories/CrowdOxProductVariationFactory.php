<?php

namespace Database\Factories;

use App\CrowdOxProduct;
use App\CrowdOxProductVariation;
use App\CrowdOxProject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxProductVariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxProductVariation::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            'SKU' => $this->faker->randomElement([implode("-", [
                        $this->faker->randomElement(["KIT", "PAC"]),
                        $this->faker->randomElement(["ECO", "PRO", "TOR"]),
                        $this->faker->randomElement(["REG", "NAR"]),
                        $this->faker->randomElement(["309", "406", "451", "507", "584", "622"]), //more here
                        $this->faker->randomElement(["B", "S"])
                    ]),
                    implode("-", ["CHARGER", $this->faker->randomElement(["2A", "3A"]), $this->faker->randomElement(["UK", "US", "EU"])]),
                    implode("-", ["THRO", $this->faker->randomElement(["TWIST", "THUMB"])]),
                    "INLI",
                    "HYDR",
                    implode("-", ["PAS", $this->faker->randomElement(["UNI-DISK", "EZF", "BRO-DISK"])]),
                    implode("-", ["TORQ", $this->faker->randomElement(["NARROW", "UNIVERSAL"])]),
                ]),
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'crowd_ox_product_id' => CrowdOxProduct::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }
}
