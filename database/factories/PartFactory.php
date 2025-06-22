<?php

namespace Database\Factories;

use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Part>
 */
class PartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Part::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word . ' ' . $this->faker->randomElement(['Motor', 'Rem', 'Wiel', 'Accu', 'Koplamp']),
            'category' => $this->faker->randomElement(['Motor', 'Elektrisch', 'Chassis', 'Remmen', 'Wielen']),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 19.99, 499.99),
            'sku' => strtoupper($this->faker->bothify('??-####')),
            'stock' => $this->faker->numberBetween(0, 50),
            'compatible_with_all' => $this->faker->boolean(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
