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
            'name' => fake()->company() . ' ' . fake()->randomElement(['SARL', 'SA', 'SAS', 'SNC', 'SARLU', 'SASU', 'EURL', 'EIRL', 'EI', 'AE', 'EIRL']),
            'category' => fake()->randomElement(['Beauté', 'Esthétique', 'Coiffure', 'Santé', 'Bien-être']),
            // 'logo' => fake()->word(),
            'description' => fake()->text(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->randomElement(['Rue', 'Avenue', 'Boulevard', 'Place']) . ' ' . fake()->randomElement(['Mohamed V', 'Hassan II', 'Allal Ben Abdellah', 'Abdelkrim El Khattabi', 'Oued Laou', 'Oued Martil',]),
            'city' => fake()->randomElement(['Tanger', 'Tétouan', 'Fnideq', 'Mdiq', 'Chefchaouen', 'Larache', 'Asilah', 'Tétouan', 'Tanger', 'Fnideq', 'Mdiq', 'Chefchaouen', 'Larache', 'Asilah']),
            'neighborhood' => fake()->randomElement(['Centre Ville', 'Quartier Administratif', 'Quartier Industriel', 'Quartier Résidentiel', 'Quartier Populaire']),
            'country' => 'Maroc',
            'zip_code' => fake()->postcode(),
            'owner_id' => User::factory(),
        ];
    }
}
