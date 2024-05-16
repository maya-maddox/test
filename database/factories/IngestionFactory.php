<?php

namespace Database\Factories;

use App\Ingestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IngestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingestion::class;

    public function definition() {
        return [
            "service" => $this->faker->word(),
            "raw_data" => $this->faker->json(),
            "comments" => $this->faker->sentence(),
            "status" => $this->faker->word(),
            "key_id" => factory(Key::class)->make()->id,
        ];
    }
}
