<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'unique_id' => uniqid('test-', false),
            'comments' => $this->faker->realText(20),
            'status' => $this->faker->randomElement([
                'Confirmed',
                'Unconfirmed',
                'Canceled',
                'Checked-in',
                'Checked-out'
            ]),
            'owner_name' => $this->faker->name,
            'total_amount' => $this->faker->randomFloat('2', 10.00, 50.000),
            'total_due' => $this->faker->randomFloat('2', 10.00, 50.000),
            'currency' => $this->faker->currencyCode,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
