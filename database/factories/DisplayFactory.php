<?php

namespace Database\Factories;

use App\Models\Display;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory for generating Display model test data.
 *
 * @extends Factory<Display>
 */
class DisplayFactory extends Factory
{
    protected $model = Display::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price_per_day' => $this->faker->randomFloat(2, 50, 500),
            'resolution_height' => $this->faker->numberBetween(720, 2160),
            'resolution_width' => $this->faker->numberBetween(1280, 3840),
            'type' => $this->faker->randomElement(['indoor', 'outdoor']),
            'user_id' => User::factory(),
        ];
    }
}
