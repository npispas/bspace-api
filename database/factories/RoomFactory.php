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
            'description' => $this->faker->realText(150),
            'interior_size' => $this->faker->numberBetween(20, 120),
            'available_from' => $this->faker->date(),
            'available_to' => $this->faker->date(),
            'is_published' => $this->faker->boolean,
            'location' => $this->faker->text(100),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
