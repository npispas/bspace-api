<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'description' => $this->faker->realText(120),
            'interior_size' => $this->faker->numberBetween(20, 120),
            'max_occupancy' => $this->faker->numberBetween(2, 4),
            'min_occupancy' => $this->faker->numberBetween(1, 2),
            'available_from' => $this->faker->date(),
            'available_to' => $this->faker->date(),
            'is_published' => $this->faker->boolean,
            'location' => $this->faker->randomElement([
                'Ground Floor',
                '1st Floor',
                '2nd Floor',
                '3rd Floor',
                '4th Floor',
                '5th Floor',
                '6th Floor',
                '7th Floor',
            ]),
            'created_at' => now()->format('Y-m-d'),
            'updated_at' => now()->format('Y-m-d'),
        ];
    }
}
