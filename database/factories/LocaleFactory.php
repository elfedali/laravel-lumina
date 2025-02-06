<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;
use App\Models\Locale;

class LocaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Locale::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'description' => fake()->text(),
            'address' => fake()->word(),
            'city' => fake()->city(),
            'neighborhood' => fake()->word(),
            'country' => fake()->country(),
            'zip' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            'phone2' => fake()->word(),
            'email' => fake()->safeEmail(),
            'website' => fake()->word(),
            'facebook' => fake()->word(),
            'instagram' => fake()->word(),
            'twitter' => fake()->word(),
            'linkedin' => fake()->word(),
            'tiktok' => fake()->word(),
            'youtube' => fake()->word(),
            'cover' => fake()->word(),
            'is_primary' => fake()->boolean(),
            'company_id' => Company::factory(),
        ];
    }
}
