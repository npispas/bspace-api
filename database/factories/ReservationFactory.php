<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => $this->faker->uuid,
            'comments' => $this->faker->realText(20),
            'total_amount' => $this->faker->randomFloat('2'),
            'total_due' => $this->faker->randomFloat('2'),
            'currency' => $this->faker->currencyCode,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
