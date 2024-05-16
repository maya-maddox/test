<?php

namespace Database\Factories;

use App\Models\SkuType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->bothify('???-??-##-?-#'),
            'sku_type_id' => $this->faker->boolean(70) ? SkuType::factory() : null
        ];
    }
}
