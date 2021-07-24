<?php

namespace Database\Factories;

use App\Models\Fonte;
use App\Models\Reparo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class ReparoFactory extends Factory
{
    protected $model = Reparo::class;

    public function definition()
    {
        return [
            'desc_problema' => $this->faker->sentence(4, false),
            'peças' => $this->faker->word(),
            'valor' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(['OK', 'NOK']),
        ];
    }

    public function onDate(Carbon $datetime): ReparoFactory
    {
        return $this->state([
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ]);
    }
}
