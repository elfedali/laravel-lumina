<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\User;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'category' => fake()->word(),
            'description' => fake()->text(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->word(),
            'city' => fake()->city(),
            'neighborhood' => fake()->word(),
            'country' => fake()->country(),
            'zip_code' => fake()->word(),
            'logo' => fake()->word(),
            'website' => fake()->word(),
            'social_media' => '{}',
            'owner_id' => User::factory(),
        ];
    }
}
