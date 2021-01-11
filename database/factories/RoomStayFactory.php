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
        $randomDays = $this->faker->numberBetween(0, 10);
        $randomHours = $this->faker->numberBetween(0, 4);

        return [
            'start_date' => now()->addDays($randomDays)->format('Y-m-d'),
            'start_hour' => now()->format('H:i'),
            'end_date' => now()->addDays($randomDays)->format('Y-m-d'),
            'end_hour' => now()->addHours($randomHours)->format('H:i'),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
