<?php

namespace Database\Factories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->name,
            'max_occupancy' => $this->faker->numberBetween(2, 4),
            'min_occupancy' => $this->faker->numberBetween(1, 2),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
