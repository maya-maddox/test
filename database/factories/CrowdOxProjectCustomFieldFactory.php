<?php

namespace Database\Factories;

use App\CrowdOxProject;
use App\CrowdOxProjectCustomField;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CrowdOxProjectCustomFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CrowdOxProjectCustomField::class;

    public function definition() {
        return [
            'crowd_ox_id' => $this->faker->numberBetween(100, 20000),
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(["text", "option", "checkbox"]),
            'key' => $this->faker->uuid(),
            'crowd_ox_project_id' => CrowdOxProject::factory(),
            'raw_data' => json_encode(["data" => $this->faker->randomAscii()]),
        ];
    }

    public function productionBatch() {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Production Batch',
                'type' => 'option',
            ];
        });
    }

    public function shippingContainerDestination() {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Shipping Container Destination',
                'type' => 'text',
            ];
        });
    }

    public function taxPaid() {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Tax Paid',
                'type' => 'checkbox',
            ];
        });
    }

    public function shippingContainerAllocationExtra() {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Shipping Container Allocation (Extra Kit)',
                'type' => 'option',
            ];
        });
    }

    public function shippingContainerAllocationReward() {
        return $this->state(function (array $attributes) {
            return [
                'name' => '
                Shipping Container Allocation (Reward)',
                'type' => 'option',
            ];
        });
    }
}
