<?php

namespace Database\Factories;

use App\Models\ServiceCenter;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceCenterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceCenter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->countryCode(),
            'location' => $this->faker->address(),
            'user_preference' => $this->faker->randomElements(User::factory()->count(5)->create()->pluck('id')->toArray(), $this->faker->numberBetween(0, 5))
        ];
    }
}
