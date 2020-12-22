<?php

namespace Database\Factories;

use App\Models\RoomStay;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomStayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoomStay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date(),
            'start_hour' => $this->faker->time('H:i'),
            'end_date' => $this->faker->date(),
            'end_hour' => $this->faker->time('H:i'),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
