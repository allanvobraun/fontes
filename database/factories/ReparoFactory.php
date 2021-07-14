<?php

namespace Database\Factories;

use App\Models\Fonte;
use App\Models\Reparo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class ReparoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reparo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'desc_problema' => $this->faker->sentence(4, false),
            'peças' => $this->faker->word(),
            'valor' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['OK', 'NOK']),
        ];
    }
}
