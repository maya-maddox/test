<?php

namespace Database\Factories;

use App\Models\ServiceCenter;
use App\Models\Sku;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReturnsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customSku = $this->faker->boolean(30);
        return [
            'service_center_id' => ServiceCenter::factory(),
            'supportsync_reference' => $this->faker->boolean() ? $this->faker->numerify("RN######") : null,
            'zendesk_reference' => $this->faker->boolean() ? $this->faker->numerify("ZD######") : null,
            'other_reference' => $this->faker->boolean(20) ? $this->faker->numerify("CROWDOX-#######") : null,
            'recieved_date' => $this->faker->dateTime(),
            'sku_id' => $customSku ? null : Sku::factory(),
            'custom_sku' => $customSku ? $this->faker->bothify('???-??-##-?-#') : null,
            'check_in_user_id' => User::factory(),
            'technician_id' => User::factory(),
            'tested_date' => $this->faker->dateTime(),
            'return_reason' => $this->faker->randomElement(config('servicecenter.returnslog.return_reasons')),
            'refund_type' => $this->faker->randomElement(config('servicecenter.returnslog.refund_types')),
            'customer_aware' => $this->faker->randomElement([true, false, null]),
            'all_checks' => $this->faker->randomElement([true, false, null]),
            'completed_date' => $this->faker->dateTime(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
