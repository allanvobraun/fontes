<?php

namespace Database\Factories;

use App\Models\Fonte;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class FonteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fonte::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cod_interno' => $this->faker->numerify('S;N00########'),
            'cod_font' => $this->faker->bothify('#?###??##??'),
            'modelo' => strtoupper($this->faker->word()),
            'fabricante' => strtoupper($this->faker->company()),
        ];
    }

    public function onDate(Carbon $datetime): FonteFactory
    {
        return $this->state([
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ]);
    }
}
