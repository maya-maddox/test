<?php

namespace Database\Factories;

use App\Models\Returns;
use App\Models\Sku;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReturnItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'returns_id' => Returns::factory(),
            'sku_id' => Sku::factory(),
            'serial_number' => $this->faker->boolean()? $this->faker->ean13() : null,
            'outcome' => $this->faker->randomElement(array_keys(config('servicecenter.returnslog.return_item_outcomes'))),
            'diagnosis' => $this->faker->randomElement([null, $this->faker->sentence()]),
            'pass' => $this->faker->randomElement([null, $this->faker->boolean()]),
            'notes' => $this->faker->randomElement([null, null, $this->faker->sentence(), $this->faker->paragraph()])
        ];
    }
}
