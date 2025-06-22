<?php

namespace Database\Factories;

use App\Models\Scooter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scooter>
 */
class ScooterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scooter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word . ' ' . $this->faker->randomNumber(3),
            'brand' => $this->faker->randomElement(['Lerox', 'Vespa', 'Piaggio', 'Honda', 'Yamaha']),
            'model' => $this->faker->word,
            'year' => $this->faker->numberBetween(2020, 2025),
            'price' => $this->faker->randomFloat(2, 999, 4999),
            'description' => $this->faker->paragraph(),
            'color' => $this->faker->colorName,
            'stock' => $this->faker->numberBetween(0, 10),
            'featured' => $this->faker->boolean(20),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
