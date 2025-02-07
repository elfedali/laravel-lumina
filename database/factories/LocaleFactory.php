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
            'name' => null,
            'slug' => null,
            'description' => null,

            'address' => fake()->randomElement(['Rue', 'Avenue', 'Boulevard', 'Place']) . ' ' . fake()->randomElement(['Mohamed V', 'Hassan II', 'Allal Ben Abdellah', 'Abdelkrim El Khattabi', 'Oued Laou', 'Oued Martil',]),
            'city' => fake()->randomElement(['Marrakech', 'Casablanca', 'Rabat', 'Tanger']),
            'neighborhood' => fake()->randomElement(['Guiliz', 'Massira', 'Targa', 'Majorelle']),
            'country' => 'Maroc',
            'zip' => null,

            'phone' => fake()->phoneNumber(),
            'phone2' => fake()->phoneNumber(),

            'is_primary' => fake()->boolean(),
            'company_id' => fake()->randomElement(Company::pluck('id')->toArray()),
        ];
    }
}
