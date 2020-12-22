<?php

namespace Database\Factories;

use App\Models\GuestImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GuestImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl()
        ];
    }
}
