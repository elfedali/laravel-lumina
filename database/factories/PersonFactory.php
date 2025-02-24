<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Locale;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'avatar' => fake()->imageUrl(),
            'point' => fake()->numberBetween(0, 100),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'locale_id' => fake()->randomElement(Locale::pluck('id')->toArray()),
        ];
    }
}
